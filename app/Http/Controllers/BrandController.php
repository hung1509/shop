<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $query = Brand::query();
        if($request->keysearch){
            $query->where('name', 'like', '%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.brand.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'website' =>'required',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg'
        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'website.required' =>'Không được để trống đường link',
            'image.required' =>'Không được để trống ảnh',
            'image.mimes' => 'File không hợp lệ'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->website = $request->website;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_'.$file->getClientOriginalName();
            $path_upload = 'uploads/brand/';
            $request->file('image')->move($path_upload, $filename);
            $brand->image = $path_upload.$filename; 
        }
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $brand->is_active = $is_active;
        $brand->save();
        return redirect()->route('admin.brand.index');
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
        $data = Brand::FindOrFail($id);
        return view('admin.brand.edit', ['data' => $data]);
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
            'website' =>'required',
            'new_image' =>'mimes:jpeg,png,jpg,gif,svg'
        ],[
            'name.required' =>'Không được để trống tên',
            'name.max' =>'Tên quá dài',
            'website.required' =>'Không được để trống đường link',
            'image.mimes' => 'File không hợp lệ'
        ]);
        $brand = Brand::FindOrFail($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->website = $request->website;
        if($request->hasFile('new_image')){
            @unlink(public_path($brand->image));
            $file = $request->file('new_image');
            $filename = time() . '_'.$file->getClientOriginalName();
            $path_upload = 'uploads/brand/';
            $request->file('new_image')->move($path_upload, $filename);
            $brand->image = $path_upload.$filename; 
        }
        $is_active=0;
        if($request->has('is_active')){
            $is_active = 1;
        }
        $brand->is_active = $is_active;
        $brand->save();
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand =  Brand::FindOrFail($id);
        $brand->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }
}
