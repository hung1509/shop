<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Blog;
use App\Brand;
use App\Image;
use App\Product;
use App\Category;
use App\Vendor;
use App\User;
use App\OrderDetail;
use App\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::query()->where('is_active', '=', '1')->get();
        $banner = Banner::query()->where('is_active', '=', '1')->get();
        $newProduct = DB::table('products')->select()->where('is_active', '=', '1')->orderByDesc('id')->paginate(5);
        $hotProduct = DB::table('products')->select()->where('is_active', '=', '1')->where('hot', '=', '1')->paginate(5);
        $blog = DB::table('blogs')->select()->where('is_active', '=', '1')->paginate(3);

        return view('client.index', ['brand' => $brand, 'banner' => $banner, 'newProduct' => $newProduct, 'hotProduct' => $hotProduct, 'blog' => $blog]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Product::findOrFail($id);
        $images = Image::query()->where('product_id', '=', $id)->get();
        $category = Category::findOrFail($data->category_id);
        $vendor = Vendor::findOrFail($data->vendor_id);
        $brand = Brand::findOrFail($data->brand_id);
        $sizes = $data->size;
        $relatedProducts = Product::query()
                        ->where('category_id', '=', $data->category_id, 'and' , 'id', 'not', $id)
                        ->orWhere('brand_id', '=', $data->brand_id, 'and' , 'id', 'not', $id)
                        ->get();
        return view('client.productDetail', ['data' => $data, 'images' => $images, 'category' => $category, 'vendor' => $vendor, 'brand' => $brand, 'sizes' => $sizes, 'relatedProducts' => $relatedProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // shop
    public function shop(Request $request){
        $query=DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('products.*', 'categories.name as category_name')
                ->where('products.is_active','=', 1);
        $hot = Blog::query()->where('is_active', '=', 1)->paginate(5);

        $keySearch = null;
        $orderby = null;
        if($request->orderby){
            switch($request->orderby){
                case '1': $query->orderByDesc('products.price'); break;
                case '2': $query->orderBy('price'); break;
                case '3': $query->orderByDesc('name'); break;
                case '4': $query->orderBy('name'); break;
            }
            $orderby = $request->orderby;
        }
        // dd($query);
        if($request->keysearch){
            $query->where('products.name', 'like' ,'%'.$request->keysearch.'%')
                  ->orWhere('categories.name', '=', $request->keysearch);
            $keySearch = $request->keysearch;
        }
        $data=$query->paginate(9)->appends(['keysearch'=>$request->keysearch]);
        
        $category = Category::query()->where('parent_id', '=', 0, 'and', 'is_active', '=', 1)->get();
        return view('client.shop', ['data'=>$data, 'category'=>$category, 'keySearch'=>$keySearch, 'orderby'=>$orderby, 'hot'=>$hot]);
    }

    // contact 
    public function contact(){
        return view('client.contact');
    }

    // blog
    public function blog(){
            $blog = Blog::query()->where('is_active', '=', 1)->paginate(6);
            $brand = Brand::query()->where('is_active', '=', '1')->get();
            return view('client.blog', ['brand' => $brand, 'blog' => $blog]);
    }
    // blog detail
    public function blogdetail($id){
        $data = Blog::FindOrFail($id);
        $related = Blog::query()->where('user_id','=', $data->user_id)->paginate(3);
        $hot = Blog::query()->where('is_active', '=', 1)->paginate(3);

        return view('client.blogdetail',['data' => $data, 'related' => $related, 'hot' => $hot]);
    }
// about us
    public function aboutus(){
        $brand = Brand::query()->where('is_active', '=', '1')->get();
        return view('client.about', ['brand' => $brand]);
    }
    // signin
    public function signin(){
        return view('client.login');
    }
    public function postSignin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
			return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function signout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function signup(Request $request){
        $user = New User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->is_admin = 0;
        $user->save();
        return redirect()->back()->with('success','Đăng kì thành công');
    }

    public function updateAcc(Request $request){
        $user = User::FindOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('success','Cập nhật thành công');
    }
    // my cart
    public function myCart(){
        return view('client.myCart');
    }
    // add to cart
    public function addToCart(Request $request ,$id){
        $product = Product::find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            if($cart[$id]['size'] == $request->size){
                $cart[$id]['quantity'] += 1;
            }else{
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'image' => $product->image,
                    'sale' => $product->sale,
                    'size' => $request->size
                ];
            }
        }else{
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->quantity,
                    'image' => $product->image,
                    'sale' => $product->sale,
                    'size' => $request->size
                ];
            }
        session()->put('cart', $cart);
        $cart = session()->get('cart');
        $cartComponent = view('client.layouts.shoppingCart', compact('cart'))->render();
        return response()->json([
            'cart_component' => $cartComponent,
            'code' => '200',
            'message' =>'success',
        ], 200);
    }
    // remove from cart
    public function removeFormCart(Request $request, $id){
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            $cartComponent = view('client.layouts.shoppingCart', compact('cart'))->render();
            return response()->json([
                'cart_component' => $cartComponent,
                'code' => 200,
                'massage' => 'success'
            ], 200);
        }
    // update cart
    public function updateCart(Request $request, $id){
        $cart = session()->get('cart');
        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        $cart = session()->get('cart');
        $cartComponent = view('client.layouts.shoppingCart', compact('cart'))->render();
            return response()->json([
                'cart_component' => $cartComponent,
                'code' => 200,
                'massage' => 'success'
            ], 200);
    }
    public function removeCart(){
        session()->forget('cart');
        $cart = session()->get('cart');
        $cartComponent = view('client.layouts.shoppingCart', compact('cart'))->render();
            return response()->json([
                'cart_component' => $cartComponent,
                'code' => 200,
                'massage' => 'success'
            ], 200);
    }

    // checkout
    public function checkout(){
        return view('client.checkout');
    }
    // order
    public function orderDetail($id){
        $order = Order::FindOrFail($id);
        $o_items = DB::table('order_detail')
                    ->where('order_detail.order_id', '=', $id)
                    ->join( 'products', 'order_detail.product_id', '=', 'products.id')
                    ->select('order_detail.*', 'products.name AS product_name', 'products.sale AS product_sale', 'products.price AS product_price')
                    ->get();
        return view('client.orderDetail', ['order'=>$order, 'items'=>$o_items]);
    }
}

