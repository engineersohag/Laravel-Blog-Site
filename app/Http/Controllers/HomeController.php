<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Alert;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id()){
            $usertype = Auth()->user()->usertype;

            if($usertype=="user"){
                return redirect()->route('/');
            }elseif ($usertype=='admin') {
                return view('admin.index');
            }else{
                return redirect()->back();
            }
        }
    }

    public function homepage(){
        $blogs = Post::orderBy('created_at', 'DESC')->paginate(50);
        return view('home.home', compact('blogs'));
    }

    public function blog_post_details($id)
    {
        $blog = Post::with('category')->find($id); 
        return view('home.blog-post-details', compact('blog'));
    }

    public function user_blog_add(){
        if(Auth::id()){
            $categories = Category::select('id', 'name')->orderBy('name')->get();
            return view('home.blog-post-add', compact('categories'));
        }else{
            return redirect()->route('/');
        }
    }

    public function user_blog_store(BlogPostRequest $request){
        $category = Category::where('id', $request->category)->first();

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time(). '_' . uniqid(). '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'),$imageName);
        }

        if(Auth::user()->usertype=='admin'){
            $post_status = 'active';
        }else{
            $post_status = 'pending';
        }

        Post::create([
            'title' => $request->name,
            'category_id' => $category->id,
            'user_id' => Auth::id(), 
            'image' => $imageName,
            'description' => $request->description,
            'name' => Auth::user()->name ?? 'Anonymous',
            'post_status' => $post_status, 
            'usertype' => Auth::user()->usertype ?? 'user', 
        ]);

        Alert::success('Congrats', 'Your blog post has been uploaded successfully!');

        return redirect()->route('/')->with('status', 'Blog post has been uploaded successfully!');
    }

    public function user_blogs(){
        $userId = Auth::id(); 
        $blogs = Post::where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(50);

        return view('home.myBlog', compact('blogs'));
    }

    public function user_blog_edit($id){
        $blog = Post::find($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        return view('home.blog-post-edit', compact('blog', 'categories'));
    }

    public function user_blog_update(BlogPostRequest $request){
        $post = Post::find($request->id);
        $category = Category::where('id', $request->category)->first();

        $imageName = $post->image; 

        if($request->hasFile('image')){
            if($imageName && File::exists(public_path('uploads/posts/' . $imageName))){
                File::delete(public_path('uploads/posts/' . $imageName));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $imageName);
        }

        $post_status = Auth::user()->usertype == 'admin' ? 'active' : 'pending';

        // Update the post
        $post->update([
            'title' => $request->name,
            'category_id' => $category->id,
            'user_id' => Auth::id(),
            'image' => $imageName,
            'description' => $request->description,
            'name' => Auth::user()->name ?? 'Anonymous',
            'post_status' => $post_status,
            'usertype' => Auth::user()->usertype ?? 'user',
        ]);

        Alert::success('Congrats', 'Your blog has been updated successfully!');
        return redirect()->route('user.blogs');
    }

    public function user_blog_delete($id){
        $blog = Post::find($id);

        // image delete
        if(File::exists(public_path('uploads/posts').'/'.$blog->image)){
            File::delete(public_path('uploads/posts').'/'.$blog->image);
        }

        $blog->delete();
        Alert::success('Congrats', 'Your blog has been deleted successfully!');
        return redirect()->route('user.blogs');
    }

    
}
