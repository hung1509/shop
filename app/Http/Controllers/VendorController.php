<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $query=Vendor::query(); 
        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.vendor.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vendor.create');
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
            'email' =>'required|email',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' =>'required'
        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'email.required' =>'Không được để trống email',
            'email.email' => 'Email không hợp lệ',
            'phone.required' =>'Không được để trống số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' =>'Số điện thoại không hợp lệ',
            'address.required' => 'Không được để trống địa chỉ'
        ]);
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->slug = Str::slug($request->name);
        $vendor->address = $request->address;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $vendor->is_active = $is_active;
        $vendor->save();
        return redirect()->route('admin.vendor.index');
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
        $data = Vendor::FindOrFail($id);
        return view('admin.vendor.edit', ['data' => $data]);
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
            'email' =>'required|email',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'address' =>'required'
        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'email.required' =>'Không được để trống email',
            'email.email' => 'Email không hợp lệ',
            'phone.required' =>'Không được để trống số điện thoại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'phone.min' =>'Số điện thoại không hợp lệ',
            'phone.max' =>'Số điện thoại không hợp lệ',
            'address.required' => 'Không được để trống địa chỉ'
        ]);
        $vendor = Vendor::FindOrFail($id);
        $vendor->name = $request->name;
        $vendor->slug = Str::slug($request->name);
        $vendor->address = $request->address;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $vendor->is_active = $is_active;
        $vendor->save();
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor =  Vendor::FindOrFail($id);
        $vendor->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }
}
