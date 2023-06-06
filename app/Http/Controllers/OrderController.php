<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('orders')->orderByDesc('created_at')->paginate(10);
        return view('admin.order.index', ['data' => $data]);
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
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = "Đã xác nhận";
        $order->payment_id = $request->payment;
        $order->total = $request->total;
        $order->note = $request->note;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->save();
        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            $o_detail = new OrderDetail;
            $o_detail->order_id = $order->id;
            $o_detail->product_id = $key;
            $o_detail->quantity = $value['quantity'];
            $product = Product::FindOrFail($key);
            $product->quantity = $product->quantity - $value['quantity'];
            if($value['quantity'] > $product->quantity){
                $order->delete();
                return redirect()->back()->with('quantity', 'Không đủ hàng');
            }
            $product->save();
            $o_detail->size = $value['size'];
            $o_detail->save();
        }
        session()->forget('cart');
        return redirect()->route('myAccount', ['id' => Auth::user()->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::FindOrFail($id);
        $o_items = DB::table('order_detail')
                    ->where('order_detail.order_id', '=', $id)
                    ->join( 'products', 'order_detail.product_id', '=', 'products.id')
                    ->select('order_detail.*', 'products.name AS product_name', 'products.sale AS product_sale', 'products.price AS product_price')
                    ->get();
        return view('admin.order.detail', ['order'=>$order, 'items'=>$o_items]);
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
        $order =  Order::FindOrFail($id);
        $o_items = OrderDetail::query()->where('order_id', '=', $id)->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }

    public function cancel($id){
        $order = Order::FindOrFail($id);
        $order->status = "Đã hủy";
        $order->save();
        $o_product = OrderDetail::query()->where('order_id', '=', $id)->get();
        foreach ($o_product as $value) {
            $product = Product::FindOrFail($value->product_id);
            $product->quantity += $value->quantity;
            $product->save();
        }
        return redirect()->back();
    }
    public function confirm($id){
        $order = Order::FindOrFail($id);
        $order->status = "Đã nhận";
        $order->save();
        return redirect()->back();
    }
    public function back(){
        return redirect()->route('myAccount', ['id'=>Auth::user()->id]);
    }
}
