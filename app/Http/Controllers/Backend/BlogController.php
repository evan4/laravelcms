<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = config('cms.image.directory');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = false;

        if(($status = $request->get('status')) &&  $status === 'trash')
        {
            $posts = Post::onlyTrashed()->latest()->paginate($this->limit);
            $postsCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        }
        elseif($status === 'published') 
        {
            $posts = Post::published()->latest()->paginate($this->limit);
            $postsCount = Post::published()->count();
        }
        elseif($status === 'scheduled') 
        {
            $posts = Post::scheduled()->latest()->paginate($this->limit);
            $postsCount = Post::scheduled()->count();
        }
        elseif($status === 'draft') 
        {
            $posts = Post::draft()->latest()->paginate($this->limit);
            $postsCount = Post::draft()->count();
        }
        elseif($status === 'own') 
        {
            $posts = $request->user()->posts()->latest()->paginate($this->limit);
            $postsCount = $request->user()->posts()->count();
        }
        else
        {
            $posts = Post::latest()->paginate($this->limit);
            $postsCount = Post::count(); 
        }

        $statusList = $this->statusList($request);

        return view('backend.blog.index', compact('posts', 'postsCount', 'onlyTrashed', 'statusList'));
    }

    public function statusList($request)
    {
        return [
            'own' => $request->user()->posts()->count(),
            'all' => Post::count(),
            'published' => Post::published()->count(),
            'scheduled' => Post::scheduled()->count(),
            'draft' => Post::draft()->count(),
            'trash' => Post::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $categories = Category::all();
        return view('backend.blog.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        
        $data = $this->handleRequest($request, null);
        
        $request->user()->posts()->create($data);

        return redirect('/backend/blog')->with('message', 'Your post was created successfully!');
    }

    private function handleRequest($request, $old_image = null)
    {
        $destination = $this->uploadPath;
        $hasImage = false;

        if( $request['_method'] === 'PUT' ||  $request['_method'] === 'PATCH'){
            $data =$request;

            if(isset($request['image'])){
                $hasImage = true;
                $image = $request['image'];
                $this->deleteImage($old_image);
            }

        }else{
            $data =$request->all();
            $hasImage = $request->hasFile('image');
            if($hasImage){
                $image = $request->file('image');
            }
        }
        //dd($data);
        if($hasImage){
           
            $width = config('cms.image.thumbnail.width');
            $height = config('cms.image.thumbnail.height');
            //Storage::makeDirectory($destination, $mode = 0777, true);
           
            $path = Storage::disk('local')->put($destination, $image, 'public');
            $filename =explode('/', $path);
            $data['image'] = end($filename);
            
            //$extension = $image->getClientOriginalExtension();
            $extension_pos = strrpos($data['image'], '.');
            $thumbnail = substr($data['image'], 0, $extension_pos) . '_thumb' . substr($data['image'], $extension_pos);

            $img = Image::make($image);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();                 
            });
            $img->stream(); // <-- Key point

            $store  = Storage::disk('local')->put($destination.'/'. $thumbnail, $img, 'public');

        }

        return $data;
    }

    private function deleteImage($old_image)
    {
        $destination = $this->uploadPath;

        Storage::disk('local')->delete($destination .'/'. $old_image);

        $extension_pos = strrpos($old_image, '.');
        $thumbnail = substr($old_image, 0, $extension_pos) . '_thumb' . substr($old_image, $extension_pos);

        Storage::disk('local')->delete($destination .'/'. $thumbnail);
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
        $post = Post::find($id);
        $categories = Category::all();
        return view('backend.blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PostRequest $request, $id)
    {
        $post = Post::find($id);
        $datas =$request->all();
        $data = $this->handleRequest($datas,  $post->image);

        $post->update($data);

        return redirect('/backend/blog')->with('message', 'Your post was updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect('/backend/blog')->with('trash-message', ['Your post was moved to trash!', $id]);
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if($post->image != ''){
          $this->deleteImage($post->image);  
        }
        
        $post->forceDelete();

        return redirect('/backend/blog?status=trash')->with('message', 'Your post was deleted succefully!');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', 'Your post was moved from the trash!');
    }

}
