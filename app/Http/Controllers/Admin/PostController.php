<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;

class PostController extends Controller
{
    protected $headers = [
        'title' => 'Create Post',
        'button' => 'Save',
        'modelname' => 'Post',
        'button_id' => 'save',
        'module_name' => 'Post'
    ];

    protected $rules = array(
        'title' => 'required',
        'description' => 'required',
        'activity_id' => 'required',
        'image' => 'nullable',
    );

    protected $messages = array(
        'title.required' => 'post title is required',
        'description.required' => 'post description is required',
    );

    /**
     * Constucter function.
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::orderBy('created_at')->get()->toArray();

        return view('dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $headers = $this->headers;

        return view('admin.create_post', compact('headers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);
        $is_saved = Posts::create($input);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if ($is_saved) {
            $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        }
        return response()->json($arr);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
    }
}
