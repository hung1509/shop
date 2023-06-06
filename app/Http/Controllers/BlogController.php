<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Blog::query(); 
        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.blog.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'content' =>'required',
            'image' =>'required|mimes:jpeg,png,jpg,gif,svg'
        ],[
            'title.required' =>'Không được để trống tên',
            'title.max' =>'Tên quá dài',
            'content.required' =>'Không được để trống nội dung',
            'image.required' =>'Không được để trống ảnh',
            'image.mimes' => 'File không hợp lệ'
        ]);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_uploads = 'uploads/blog/';
            $request->file('image')->move($path_uploads, $filename);
            $blog->image = $path_uploads.$filename;
        }
        if($request->has('is_active')){
            $is_active = 1;
        }
        $blog->is_active = $is_active;
        $blog->user_id = '1';
        $blog->save();

        return redirect()->route('admin.blog.index');
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
        $data = Blog::FindOrFail($id);
        return view('admin.blog.edit', ['data' => $data]);
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
            'content' =>'required',
            'new_image' =>'mimes:jpeg,png,jpg,gif,svg'
        ],[
            'title.required' =>'Không được để trống tên',
            'title.max' =>'Tên quá dài',
            'content.required' =>'Không được để trống mô tả',
            'new_image.mimes' => 'File không hợp lệ'
        ]);
        $blog = Blog::FindOrFail($id);
        $blog->title = $request->input('title');
        $blog->content = $request->content;
        if($request->hasFile('new_image')){
            $file = $request->file('new_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_uploads = 'uploads/blog/';
            $request->file('new_image')->move($path_uploads, $filename);
            $blog->image = $path_uploads.$filename;
        }
        if($request->has('is_active')){
            $is_active = 1;
        }
        $blog->is_active = $is_active;
        $blog->save();

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog =  Blog::FindOrFail($id);
        $blog->delete();
        return response()->json([ 'status' => true,200]);
    }
}
