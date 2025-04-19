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

class AdminController extends Controller
{
    public function categories(){
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
    public function category_add(){
        return view('admin.category-add');
    }
    public function category_store(StoreCategoryRequest $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Category has been added successfully!');
    }
    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }
    public function category_update(StoreCategoryRequest $request){
        $category = Category::find($request->id);
        $category->name = $request->name;

        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Category has been updated successfully!');
    }
    public function category_delete($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'Category has been deleted successfully!');
    }

    public function blog_post(){
        $blogs = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.blog-post', compact('blogs'));
    }
    public function blog_post_add(){
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.blog-post-add', compact('categories'));
    }
    public function blog_post_store(BlogPostRequest $request){
        $category = Category::where('name', $request->category)->first();

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

        return redirect()->route('admin.blog.page')->with('status', 'Blog post has been uploaded successfully!');
    
    }
    public function blog_post_edit($id){
        $blog = Post::find($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        return view('admin.blog-post-edit', compact('blog', 'categories'));
    }
    public function blog_post_update(BlogPostRequest $request){
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

        return redirect()->route('admin.blog.page')->with('status', 'Blog post has been updated successfully!');

    }

    public function blog_post_delete($id){
        $blog = Post::find($id);

        // image delete
        if(File::exists(public_path('uploads/posts').'/'.$blog->image)){
            File::delete(public_path('uploads/posts').'/'.$blog->image);
        }

        $blog->delete();
        return redirect()->route('admin.blog.page')->with('status', 'Blog has been deleted successfully!');
    }

    public function all_users(){
        $users = User::all();
        return view('admin.all-users', compact('users'));

    }

    public function show_all_comments(){
        $comments = Comment::all();
        return view('admin.all-comments', compact('comments'));
    }
    public function delete_comments($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.all.comments')->with('status', 'Comment has been deleted successfully!');
    }


}
