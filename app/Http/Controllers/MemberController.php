<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=DB::table('users');
        if($request->keysearch){
            $query->where('name', 'like' ,'%'.$request->keysearch.'%')
            ->orwhere('id', 'like' ,'%'.$request->keysearch.'%');
        }
        $data=$query->paginate(10)->appends(['keysearch'=>$request->keysearch]);
        return view('admin.member.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member =  Member::FindOrFail($id);
        $member->delete();
        return response()->json([
             'status' => true,
            //  'url'
             200
            ]);
    }
}
