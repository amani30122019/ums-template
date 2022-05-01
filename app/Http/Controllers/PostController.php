<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:post-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            return DataTables::of($posts)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                if (Gate::any(['post-edit', 'post-delete'])) {
                    $actionBtn =
            '<div>

            <a href="javascript:void(0)" class="btn-sm btn btn-primary" data-id="'.$row['id'].'" id="show-post-btn">Show</a>
 
            <a href="javascript:void(0)" class="btn-sm btn btn-success" data-id="'.$row['id'].'" id="edit-post-btn">Edit</a>

            <a href="javascript:void(0)" class="btn-sm btn btn-danger" data-id="'.$row['id'].'" id="delete-post-btn">Delete</a>

            </div>' ;
                    return $actionBtn;
                }
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation= Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required'=>'Please fill in your post title',
            'body.required'=>'Please fill in post body',

        ]);
        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=> $validation->getMessageBag()]);
        } else {
            $input = $request->all();
            $newPost= Post::create($input);
            if ($newPost) {
                return response()->json(['code'=>1,'msg'=> 'Post created successfully.']);
            } else {
                return response()->json(['code'=>0,'errors'=> 'Something has gone wrong Post not  saved in database']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePost(Request $request)
    {
        $id = $request->post_id;
      
        $validation= Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required'=>'Please fill in your post title',
            'body.required'=>'Please fill in post body',

        ]);
        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=> $validation->getMessageBag()]);
        } else {
            $post = Post::find($id);
            if ($post) {
                $post->title=$request->title;
                $post->body=$request->body;
                $updated= $post->save();
                if ($updated) {
                    return response()->json(['code'=>1,'msg'=> 'Post Updated successfully.']);
                } else {
                    return response()->json(['code'=>0,'errors'=> 'Something has gone wrong Post not  updates in database']);
                }
            } else {
                return response()->json(['code'=>0,'errors'=> 'Post not found  in database']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPost(Request $request)
    {
        $id= $request->post_id;
        $postDeleted=Post::find($id)->delete();
        if ($postDeleted) {
            return response()->json(['code'=>1,'msg'=>'Post deleted successfully.']);
        }
    }
    // GET USER DETAILS
    public function getPost(Request $request)
    {
        $post_details = Post::find($request->post_id);
        return response()->json(['post'=>$post_details]);
    }
}
