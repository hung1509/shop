<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {

        $query=Banner::query(); 
        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.banner.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'title' =>'required|max:50',
            'description' =>'required',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg'
        ],[
            'title.required' =>'Không được để trống tên',
            'title.max' =>'Tên quá dài',
            'description.required' =>'Không được để trống mô tả',
            'image.required' =>'Không được để trống ảnh',
            'image.mimes' => 'File không hợp lệ'
        ]);
        $banner = new Banner();
        $banner->title = $request->input('title');
        $banner->slug = Str::slug($request->input('title'));
        $banner->description = $request->description;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_uploads = 'uploads/banner/';
            $request->file('image')->move($path_uploads, $filename);
            $banner->image = $path_uploads.$filename;
        }
        if($request->has('is_active')){
            $is_active = 1;
        }
        $banner->is_active = $is_active;
        $banner->save();

        return redirect()->route('admin.banner.index');
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
        $data = Banner::FindOrFail($id);
        return view('admin.banner.edit', ['data' => $data]);
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
            'title' =>'required|max:50',
            'description' =>'required',
            'new_image' =>'mimes:jpeg,png,jpg,gif,svg'
        ],[
            'title.required' =>'Không được để trống tên',
            'title.max' =>'Tên quá dài',
            'description.required' =>'Không được để trống mô tả',
            'new_image.mimes' => 'File không hợp lệ'
        ]);
        $banner = Banner::FindOrFail($id);
        $banner->title = $request->input('title');
        $banner->slug = Str::slug($request->input('title'));
        $banner->description = $request->description;
        if($request->hasFile('new_image')){
            $file = $request->file('new_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_uploads = 'uploads/banner/';
            $request->file('new_image')->move($path_uploads, $filename);
            $banner->image = $path_uploads.$filename;
        }
        if($request->has('is_active')){
            $is_active = 1;
        }
        $banner->is_active = $is_active;
        $banner->save();

        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner =  Banner::FindOrFail($id);
        $banner->delete();
        return response()->json([ 'status' => true,200]);
    }
}
