<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Helper\CourseHelper;

use App\Models\Blog;  
use App\Models\Hashtag;  

class BlogController extends Controller
{
    // Get list of blogs for admin page.
    public function index(Request $request) {
        $blogs = new Blog;

        if ($request->has('sort')) {
            if ($request['sort'] == "latest") {
                $blogs = $blogs->orderBy('created_at', 'desc');
            } else {
                $blogs = $blogs->orderBy('created_at');
            }
        } else {
            $blogs = $blogs->orderBy('created_at', 'desc');
        }
    
        if ($request->has('search')) {
            if ($request->search == "") {
                $url = route('admin.notifications.index', request()->except('search'));
                return redirect($url);
            } else {
                $blogs = $blogs->where('title', 'like', "%".$request->search."%");
            }
        }
    
        $blogs = $blogs->get();
        return view('admin/blog/index', compact('blogs'));
    }

    public function create() {
        $tags = Hashtag::all();
        return view('admin/blog/create', compact('tags'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'                 => 'required',
            'author'                => 'required',
            'duration'              => 'required',
            'short_description'     => 'required',
            'body'                  => 'required',
            'banner'                => 'required|mimes:jpeg,jpg,png',
            'image'                 => 'required|mimes:jpeg,jpg,png',
            'hashtag'               => 'required'
        ]);

        $blog                       = new Blog();
        $blog->title                = $validated['title'];
        $blog->author               = $validated['author'];
        $blog->duration             = $validated['duration'];
        $blog->short_description    = $validated['short_description'];
        $blog->body                 = $validated['body'];
        $blog->hashtag              = $validated['hashtag'];
        $blog->banner               = Helper::storeImage($request->file('banner'), 'storage/images/blog/');
        $blog->image                = Helper::storeImage($request->file('image'), 'storage/images/blog/');
        $blog->is_featured          = FALSE;

        $blog->save();

        $message = 'New blog (' . $blog->title . ') has been added to the database.';

        return redirect()->route('admin.blog.index')->with('message', $message);
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $blog = Blog::findOrFail($id);
        $tags = Hashtag::all();

        return view('admin/blog/update',compact('blog','tags'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title'                 => 'required',
            'author'                => 'required',
            'duration'              => 'required',
            'short_description'     => 'required',
            'body'                  => 'required',
            'banner'                => 'mimes:jpeg,jpg,png',
            'image'                 => 'mimes:jpeg,jpg,png',
            'hashtag'               => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title                = $validated['title'];
        $blog->author               = $validated['author'];
        $blog->duration             = $validated['duration'];
        $blog->short_description    = $validated['short_description'];
        $blog->body                 = $validated['body'];
        $blog->hashtag              = $validated['hashtag'];
        
        if ($request->has('banner')) {
            unlink($blog->banner);
            $blog->banner = Helper::storeImage($request->file('banner'), 'storage/images/blog/');
        }
        
        if ($request->has('image')) {
            unlink($blog->image);
            $blog->image = Helper::storeImage($request->file('image'), 'storage/images/blog/');
        }
        
        $blog->save();

        if ($blog->wasChanged()) {
            $message = 'Blog (' . $blog->title . ') has been updated.';
        } else {
            $message = 'No changes was made to BLog (' . $blog->title . ')';
        }

        return redirect()->route('admin.blog.index')->with('message', $message);
    }

    public function destroy($id) {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        $message = 'Blog (' . $blog->title . ') has been deleted.';
        
        return redirect()->route('admin.blog.index')->with('message', $message);
    }

    // Change the is_featured status of the chosen Blog to its opposite.
    public function setIsFeaturedStatusToOpposite(Request $request, $id) {
        try {
            $blog = Blog::findOrFail($id);
            $blog->is_featured = !$blog->is_featured;
            $blog->save();

            if ($blog->is_featured)
                $message = 'Blog (' . $blog->title.') is now featured.';
            else
                $message = 'Blog (' . $blog->title.') has been un-featured.';
        } catch (Throwable $e) { }

        return redirect()->route('admin.blog.index')->with('message', $message);
    }
}
