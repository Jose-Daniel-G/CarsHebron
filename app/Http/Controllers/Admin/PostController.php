<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:admin.post.index')->only('index');
    //     $this->middleware('can:admin.post.create')->only('create', 'store');
    //     $this->middleware('can:admin.post.edit')->only('edit', 'update');
    //     $this->middleware('can:admin.post.destroy')->only('destroy');
    // }
    public function index()
    {
        return view('admin.posts.index');
    }

    
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request)
    { 
       
        // dd($request->all());
        $post = Post::create($request->all());

        $file = $request->file('file');
        if (!empty($file)) {
            $nombre =  time() . "_" . $file->getClientOriginalName();$imagenes = $file->storeAs('public/logos', $nombre);
            $url = Storage::url($imagenes);
            $post->image()->create([ 'url' => $url]);
        }
        
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('admin.posts.edit', $post)->with('success','las validaciones pasarion con exito');
    }

    public function edit(Post $post)
    {
        $this->authorize('author',$post);
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));

    }

   
    public function update(PostRequest $request, Post $post)
    {
        // $this->authorize('author',$post);
        $post->update($request->all());
    
        $file = $request->file('file');
        if (!empty($file)) {
    
            $nombre =  time() . "_" . $file->getClientOriginalName();
            $imagenes = $file->storeAs('public/uploads', $nombre);
            $url = Storage::url($imagenes); // URL para guardar en la base de datos
            $path = Storage::path($imagenes); // Ruta completa en el sistema de archivos
    
            if($post->image->url){
                // Convertir la URL almacenada en la base de datos en una ruta válida
                $oldImagePath = public_path('storage/' . str_replace('storage/', '', $post->image->url));
    
                // Verificar si el archivo existe antes de intentar eliminarlo
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
    
                $post->image->update(['url' => $url]);
            } else {
                $post->image()->create(['url' => $url]);
            }
        }
    
        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post actualizado correctamente');
    }
    
    
    public function destroy(Post $post){
        $this->authorize('author',$post);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success','El post ha sido eliminado exitosamente');
    }
}
