<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreBlogPost;

use App\Post;


class PostController extends Controller
{
    public function index()
    {
    	$posts = DB::table('posts')->where('active',1)->orderBy('created_at','desc')->paginate(7);
    	$title = 'Latest Posts';
    	return view('home',['title'=>'RECENT BLOG POSTS','postz'=>$posts]);
    }

    public function create(Request $request)
    {
        if($request->user()->can_post())
        {
            return view('post.create');
        }
        else
        {
            return redirect('/')->withErrors('You dont have enough permission to post a blog');
        } 
    }
    public function store(StoreBlogPost $request)
    {
        $post = new Post();
        $post -> title = $request -> get('title');
        $post -> body = $request -> get('body');
        $post -> slug =  str_slug($post -> title);
        $post -> author_id = $request->user()->id;
        if($request->has('save'))
        {
            $post -> active = 0 ;
            $message = "Saved successfully";
        }
        else
        {
            $post -> active = 1;
            $message = "Published Successfully";
        }
        $post->save();
        return redirect('edit/'.$post -> slug)->withMessage($message);

    }

    public function edit(Request $request,$slug)
    {
        $post = Post::where('slug',$slug)->first();
        if( $post && ($post->author_id == $request->user()->id || $request -> user()->is_admin() ) )
        {
            return view('post.edit')->with('post',$post);
        }
        else
        {
            return redirect('/')->withErrors('Unauthorized user');
        }
    }

    public function update(Request $request)
    {
        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        if($post && ($post->author_id == $request->user()->id  || $request->user()->is_admin() ))
        {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Post::where('slug',$slug)->first();
            if($duplicate && ($duplicate->id != $post->id))
            {
                return redirect('edit/'.$post->slug)->withErrors('Title already exists');
            }
            else
            {
                $post->slug = $slug;
            }
            $post->title = $title;
            $post->body =$request->input('body');

            if($request->has('save'))
            {
                $post->active = 0;
                $message = "Post saved successfully";
                $landing = 'edit/'.$post->slug;
            }
            else
            {
                $post->active = 1;
                $message = "Post updated successfully";
                $landing = $post->slug;
            }

        } 
        else
        {
            return redirect('/')->withErrors('You dont have enough permissions to edit this post');
        }
        $post->save();
        return redirect($landing)->withMessage($message);

    }

    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        if($post)
        {
            return view('post.show',['postz' => $post]);
        }
        else
        {
            return redirect('/')->withErrors('Content not found');
        }
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if($post && ($post->author_id == $request->user()->id  || $request->user()->is_admin() ))
        {
            $post->delete();
            $data['message'] = 'Post deleted successfully';
        }
        else
        {
            $data['errors'] = "No permission";
        }
        return redirect('/')->with($data);
    }

}
