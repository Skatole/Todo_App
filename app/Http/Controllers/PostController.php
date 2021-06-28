<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use ErrorException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'posts' => PostResource::collection($posts)
        ]);
    }

    // public function getAllDevPosts() {

    //    $developers = ModelsRole::findByName('Developer');

    //     $posts = Post::where('user_id', $developers->users->id)->first();
    //     return response()->json([
    //         'status' => 'success',
    //         'posts' => $posts
    //     ]);
    // }

    // public function getUserPosts(StoreUserRequest $user) {

    //     $posts = User::whereId($user->id)->posts()->get();
    //     return response()->json([
    //         'status' => 'success',
    //         'posts' => $posts
    //     ]);
    // }


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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        return response()->json([
            'status' => 'success',
            'posts' => new PostResource($post)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $posts = User::findOrFail($id)->post()->get();
        // foreach($user->post() as $p) {

        // }
        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json([
            'status' => 'success',
            'post' => new PostResource($post)
        ]);
    }


    public function updateSwitch(StorePostRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {

        $post->update($request)->validate();
        return response()->json([
            'status' => 'success',
            'post' => new PostResource($post)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {

        $post->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
