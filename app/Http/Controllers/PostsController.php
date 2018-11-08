<?php

namespace App\Http\Controllers;


use App\Post;
use Session;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postAll = Post::all();
        return view('index', ['postAll' => $postAll])->with('post',Post::all());

        // return view('index')->with('post', Post::all());
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
        // dd($request->all());

        $this->validate($request , [

            'found'=> 'required',
            'image'=> 'required|image',
            'place' => 'required',
            'details'=>  'required',
            'lat' => 'required',
            'lng'=> 'required',
            'contact'=> 'required',

        ]);

        $featured_img = $request->image;
        $featured_new_name = time().$featured_img->getClientOriginalName();
        $featured_img->move('uploads/posts' , $featured_new_name);
 
        $post = Post::create([
            
            'user_id'=>auth()->user()->id,
            'found'=> $request->found,
            'place' =>$request->place,
            'details'=>$request->details,
            'image'=>'uploads/posts/'.$featured_new_name,
            'lat' =>$request->lat,
            'lng'=> $request->lng,
            'contact'=> $request->contact
        ]);
        // dd($request->all());
        

         Session::flash('success','Post created succesfully');



         return redirect()->route('home');
        
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
}
