<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(){
        $blog = DB::table('blogs')
            ->select('blogs.id','blogs.post','blogs.image','blogs.created_at','users.name')
            ->join('users','users.id','=','blogs.user_id')
            ->get();
        return view('pages.blog',compact('blog'));
    }

    public function index()
    {

        $blog = DB::table('blogs')
            ->select('blogs.id','blogs.post','blogs.image','blogs.created_at','users.name')
            ->join('users','users.id','=','blogs.user_id')
            ->get();
        return view('Dashboard.blog',compact('blog'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog = Blog::all();
        return view('Dashboard.add_blog',compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required',
            'post'=>'required',
            'image'=>'required|mimes:jpg,png,jepg'
        ]);

        $blog =new Blog();
        $blog->user_id = $request->input('user_id');
        $blog->post = $request->input('post');
        $image = $request->file('image');
        $fileName = time().'.'.$image->extension();
        $image->move();
        $blog->save('image',$fileName);
        $blog->image = $fileName;
        $blog->save();
        return redirect()->route('blods.index')->with('success','added done');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('Dashboard.edit_blog',compact('blog'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request,[
            'user_id'=>'required',
            'post'=>'required',
            'image'=>'required|mimes:jpg,png,jepg'
        ]);

        $blog->user_id = $request->input('user_id');
        $blog->post = $request->input('post');
        $blog->image = $request->input('image');
        $blog->save();

        return redirect()->route('blods.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blods.index');

    }
}
