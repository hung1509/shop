<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Vendor;
use App\Image;
use App\Size;
use App\ProductSize;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $query=DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id') 
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                ->select('products.*', 'categories.name AS category_name', 'brands.name AS brand_name', 'vendors.name AS vendor_name')
                ->where('products.is_active', '=', 1);

        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.product.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        $vendor = Vendor::all();
        $size = DB::table('sizes')->get();
        return view('admin.product.create', [
            'category' => $category,
            'brand' => $brand,
            'vendor' => $vendor,
            'size' => $size
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:50',
            'price' =>'required',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg',
            'image-1'=>'required|mimes:jpeg,png,jpg,gif,svg',
            'image-2'=>'required|mimes:jpeg,png,jpg,gif,svg',
            'image-3'=>'required|mimes:jpeg,png,jpg,gif,svg',
            'category_id'=>'required',
            'brand_id'=>'required',
            'vendor_id'=>'required',
            'quantity'=>'required'

        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'price.required' =>'Không được để giá',
            'image.required' => 'Không được để trống ảnh',
            'image-1.required' => 'Không được để trống ảnh',
            'image-2.required' => 'Không được để trống ảnh',
            'image-3.required' => 'Không được để trống ảnh',
            'image.mimes' => 'File không hợp lệ',
            'image-1.mimes' => 'File không hợp lệ',
            'image-2.mimes' => 'File không hợp lệ',
            'image-3.mimes' => 'File không hợp lệ',
            'quantity.required'=>'Không được để trống số lượng',
            'brand_id.required'=>'Không được để trống nhãn hàng',
            'category_id.required'=>'Không được để trống danh mục',
            'vendor_id.required'=>'Không được để trống nhà cung cấp'
        ]);
        $size = DB::table('sizes')->get();
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->sale = $request->sale;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->vendor_id = $request->vendor_id;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_'.$file->getClientOriginalName();
            $path_upload = 'uploads/product/';
            $request->file('image')->move($path_upload, $filename);
            $product->image = $path_upload.$filename; 
        }
        $product->description = $request->description;
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $product->is_active = $is_active;
        $product->save();
        // thêm vào bảng images
        for($i = 1 ; $i<=3; $i++){
            $image = new Image();
            if($request->hasFile('image-'.$i)){
                $file = $request->file('image-'.$i);
                $filename = time() . '_'.$file->getClientOriginalName();
                $path_upload = 'uploads/product/';
                $request->file('image-'.$i)->move($path_upload, $filename);
                $image->image = $path_upload.$filename; 
            }
            $image->product_id = $product->id;
            $image->save();
        }
        // thêm vào bảng product size
        foreach($size as $key => $val){
            if($request->has('size-'.$key)){
                $size_id = $request->input('size-'.$key);
                $productSize = new ProductSize;
                $productSize->size_id = $size_id;
                $productSize->product_id = $product->id;
                $productSize->save();
            }
        }
        return redirect()->route('admin.product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::FindOrFail($id);
        $category = Category::all();
        $vendor = Vendor::all();
        $brand = Brand::all();
        $image = Image::query()->where('product_id', '=', $id)->get();
        $size_id = ProductSize::query()->where('product_id', '=', $id)->get();
        $size = DB::table('sizes')->get();
        return view('admin.product.edit', ['data' => $data, 'category' => $category, 'brand' => $brand, 'vendor' => $vendor, 'image' => $image, 'size' => $size, 'size_id'=>$size_id]);
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
        $request->validate([
            'name' =>'required|max:50',
            'price' =>'required',
            'new_image' =>'mimes:jpeg,png,jpg,gif,svg',
            'new_image-1'=>'mimes:jpeg,png,jpg,gif,svg',
            'new_image-2'=>'mimes:jpeg,png,jpg,gif,svg',
            'new_image-3'=>'mimes:jpeg,png,jpg,gif,svg',
            'category_id'=>'required',
            'brand_id'=>'required',
            'vendor_id'=>'required',
            'quantity'=>'required'

        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'price.required' =>'Không được để giá',
            'new_image.mimes' => 'File không hợp lệ',
            'new_image-1.mimes' => 'File không hợp lệ',
            'new_image-2.mimes' => 'File không hợp lệ',
            'new_image-3.mimes' => 'File không hợp lệ',
            'quantity.required'=>'Không được để trống số lượng',
            'brand_id.required'=>'Không được để trống nhãn hàng',
            'category_id.required'=>'Không được để trống danh mục',
            'vendor_id.required'=>'Không được để trống nhà cung cấp'
        ]);
        $product = Product::FindOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->sale = $request->sale;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->vendor_id = $request->vendor_id;
        if($request->hasFile('new_image')){
            @unlink(public_path($product->image));
            $file = $request->file('new_image');
            $filename = time() . '_'.$file->getClientOriginalName();
            $path_upload = 'uploads/product/';
            $request->file('new_image')->move($path_upload, $filename);
            $product->image = $path_upload.$filename; 
        }
        $product->description = $request->description;
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $product->is_active = $is_active;
        $product->save();

        $images = Image::query()->where('product_id', '=', $id)->get();
        $key=0;
        foreach($images as $val){
            $key++;
            if($request->hasFile('new_image-'.$key)){
                @unlink(public_path($val->image));
                $file = $request->file('new_image-'.$key);
                $filename = time() . '_'.$file->getClientOriginalName();
                $path_upload = 'uploads/product/';
                $request->file('new_image-'.$key)->move($path_upload, $filename);
                $val->image = $path_upload.$filename; 
                $val->save();
            }
        }
        // sửa size
        $size = Size::query()->get();
        $pro_size_id = ProductSize::query()->where('product_id', '=', $id)->delete();
        foreach($size as $key => $val){
            if($request->has('size-'.$key)){
                $size_id = $request->input('size-'.$key);
                $productSize = new ProductSize;
                $productSize->size_id = $size_id;
                $productSize->product_id = $product->id;
                $productSize->save();
            }
        }
        return redirect()->route('admin.product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  Product::FindOrFail($id);
        $images = Image::query()->where('product_id', '=', $id)->delete();
        $size = ProductSize::query()->where('product_id', '=', $id)->delete();
        $product->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }
}
