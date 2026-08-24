<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\categories;
use Session;
use File;
use App\Validators\BlogValidator;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* blog listing  */
    public function index(Request $request)
    {
        $blog = Blog::all()->sortByDesc("id");
        $cat  = categories::all();
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $blog->each(function ($item, $key) use ($jsonCollection) {
              $img = asset($item->thumbnail);
              $category = $item->category_id ? $item->category->name : "All";
                $jsonCollection->push([
                    'sr_no' => $key+1,
                    'category' => $category,
                    'id'    => $item->id,
                    'title' => $item->title,
                    'post' =>  substr(strip_tags(html_entity_decode($item->post)),0,70),
                    'image' => "<a href='{$img}' target='_blanck'><img src='{$img}'></a>"
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.blog.listing',compact('blog','cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $blog = [];
        $category_options = ['' => 'Please select category'] + ['NULL' => 'All'] + Categories::pluck('name', 'id')->toArray();
        return view('admin.blog.create',compact('blog','category_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogValidator = new BlogValidator();
        try {
            $input = $request->all();
            if (!$blogValidator->with($input)->passes()) {
              $request->session()->flash('error', $blogValidator->getErrors()[0]);
              return back()
              ->withErrors($blogValidator->getValidator())
              ->withInput();
            }

            $blog = new Blog();
            $sessionMsg = 'Blog successfully created.';


            if( !empty($request->id) ){
              $blog = $blog->find($request->id);
              $sessionMsg = 'Blog successfully updated.';
            }

            $dir = public_path("uploads/blogs/");
            if ($banner = $request->file('banner')) {
              if( !empty($blog->banner) && file_exists(public_path($blog->banner)) ){
                unlink(public_path($blog->banner));
              }
      				$name = $banner->getClientOriginalName();
              $newname = "banner_".time()."_{$name}";
      				$file = $banner->move($dir, $newname);
      				$filePath = "uploads/blogs/{$newname}";
              $blog->banner = $filePath;
            }

            if ($thumbnail = $request->file('thumbnail')) {
              if( !empty($blog->thumbnail) && file_exists(public_path($blog->thumbnail)) ){
                unlink(public_path($blog->thumbnail));
              }
      				$name = $thumbnail->getClientOriginalName();
              $newname = "thumbnail_".time()."_{$name}";
              $image_resize = Image::make($thumbnail->getRealPath());
              $image_resize->resize(380, 250);
              $image_resize->save($dir .$newname);
              $filePath = "uploads/blogs/{$newname}";
              $blog->thumbnail = $filePath;
            }

            $blogSlug = strToSlug($request->title,'-');
            $slug = Blog::where(['slug' => $blogSlug ])->count();
            if( $slug > 0 ){
              $blogSlug = "{$blogSlug}-{$slug}";
            }

            if ($request->category_id=='NULL') {
              $category_id = NULL;
            } else {
              $category_id = $request->category_id;
            }

            $blog->category_id = $category_id;
            $blog->title = $request->title;
            $blog->slug = $blogSlug;
            $blog->categories = "";
            $blog->post = htmlentities($_POST['post']);
            $blog->save();

            Session::flash('success',$sessionMsg);
            return redirect(route('admin.blog'));
          } catch (\Exception $e) {
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $blog = [];
      $category_options = ['' => 'Please select category'] + ['NULL' => 'All'] + Categories::pluck('name', 'id')->toArray();
      if( $id){
        $blog = Blog::find($id);
        $category_id = $blog->category_id ? $blog->category_id : "NULL";
      }
      return view('admin.blog.create',compact('blog','category_options', 'category_id'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if( !empty($blog->banner) && file_exists(public_path($blog->banner)) ){
          unlink(public_path($blog->banner));
        }
        if( !empty($blog->thumbnail) && file_exists(public_path($blog->thumbnail)) ){
          unlink(public_path($blog->thumbnail));
        }
        Blog::destroy($id);
        Session::flash('success', 'Blog successfully deleted.');
        return redirect(route('admin.blog'));
    }
}
