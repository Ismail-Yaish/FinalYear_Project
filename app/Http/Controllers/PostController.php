<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   //Incorporate User Authentication into functions

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // Retrieve categories associated with posts
        // $categories = Category::whereHas('posts')->get();

        // Retrieve categories for all posts with posts
        $categories = $this->showHeader();
    
        // Retrieve all posts from Voyager's `posts` table using the Post model
        $posts = Post::with('category')->paginate(10); // Retrieve Category Name instead of ID
    
        // Role_id 3 = poster; Role_id 4 = seeker

        return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
    }

    public function seeker()    //Handling Post-View in seeker dashboard
    {
        // Retrieve categories associated with posts
        $categories = Category::whereHas('posts')->get();
    
        // Retrieve all posts from Voyager's `posts` table using the Post model
        $posts = Post::with('category')->paginate(10); // Retrieve Category Name instead of ID

        // Retrieve notifications for the authenticated user
        $notifications = Auth::user()->notifications;

        return view('seeker.dashboard', ['posts' => $posts, 'categories' => $categories, 'notifications' => $notifications]);
    }

    public function myPosts()   //My Posts View
    {
        // Retrieve posts created by the authenticated user
        $posts = Post::where('author_id', Auth::id())->get();

        return view('posts.myposts', ['posts' => $posts]);
    }

    // Display Categories in Header
    public function showHeader()
    {
        // Retrieve categories associated with posts
        $categories = Category::whereHas('posts')->get();

        // Retrieve all categories
        // $categories = Category::all();

        return $categories;
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=> 'required',
            'body'=> 'required',
            'status'=> 'required',
            'category_id'=> 'required',
            
            'slug'=> 'nullable',
        ]);

        //Set author id using the ID of currently authenticated user
        $data['author_id'] = Auth::id();

        $newPost = Post::create($data);

        return redirect(route('posts.myposts'))->with('success','Post has been added!');
    }

    public function add()
    {
        // Retrieve all categories
        $categories = Category::all();

        return view('posts.addpost', compact('categories'));
    }



    public function edit(Post $post)
    {
        //Check if the authenticated user is the author of the post
        if(Auth::user()->id !== $post->author_id) {
            // Redirect unauthorized users
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post. ');
        }
        
        // Retrieve all categories
        $categories = Category::all();
        return view('posts.editpost', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, Post $post)
    {

        // Check if the authenticated user is the author of the post
        if(Auth::user()->id !== $post->author_id) {
            // Redirect unauthorized users
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post. ');
        }

        // Validation
        $data = $request->validate([
            'title'=> 'required',
            'body'=> 'required',
            'status'=> 'nullable',
            'category_id'=> 'nullable|integer', // Ensure category_id is nullable and an integer
            'slug'=> 'nullable',
        ]);

        // Convert category_id to integer if it's provided as a string
        if (isset($data['category_id'])) {
            $data['category_id'] = (int)$data['category_id'];
        }
       
        $post->update($data);

        return redirect(route('posts.myposts'))->with('success', 'Post Updated Successfully!');
    }

    public function destroy(Post $post)
    {
        // Check if the authenticated user is the author of the post
        if(Auth::user()->id !== $post->author_id) {
            // Redirect unauthorized users
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post. ');
        }

        // Delete Post
        $post->delete();
        return redirect(route('posts.myposts'))->with('success', 'Post Deleted Successfully!');
    }

    public function view($postId)  // View a selected post from Poster Dashboard
    {
        // Retrieve the post by its ID
        $post = Post::findOrFail($postId);

        // Return the view with the post data
        return view('posts.post-detail', compact('post'));
    }


    public function viewClientPost($postId)  // View a selected post from Seeker Dashboard
    {
        // Retrieve the post by its ID
        $post = Post::findOrFail($postId);

        // Return the view with the post data
        return view('seeker.post-detail', compact('post'));
    }
}
