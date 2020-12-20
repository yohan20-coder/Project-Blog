<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tags;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::paginate(5);
        return view('admin.post.index', Compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.post.create', compact('category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul' => 'required',
            'category_id' => 'required',
            'konten' => 'required',
            'gambar' => 'required'
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $post = Post::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->konten,
            'gambar' => 'public/uploads/post/'.$new_gambar,
            'slug'  => Str::slug($request->judul),
            'users_id' => Auth::id()
        ]);

        $post->tags()->attach($request->tags);

        $gambar->move('public/uploads/post/', $new_gambar);
        return redirect()->route('post.index')->with('status','Data Post Berhasil DiSimpan !');
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
        $tags = Tags::all();
        $category = Category::all();
        $post = Post::findorfail($id);
        return view('admin.post.edit', compact('post','tags','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'category_id' => 'required',
            'konten' => 'required'
        ]);

        $post = Post::findorfail($id);
        if($request->has('gambar')){            
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/post/', $new_gambar);

            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->konten,
                'gambar' => 'public/uploads/post/'.$new_gambar,
                'slug'  => Str::slug($request->judul)
            ];
        }else{
            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->konten,
                'slug'  => Str::slug($request->judul)
            ];
        }

        

        $post->tags()->sync($request->tags);    //attach memasukan data baru sync mengedit data
        $post->update($post_data);              //mengupdate data

        return redirect()->route('post.index')->with('status','Data Post Berhasil DiUpdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findorfail($id);
        $post->delete();

        return redirect()->route('post.index')->with('status','Data Post Berhasil DiHapus !');
    }

    public function tampil_hapus()
    {
        $post = Post::onlyTrashed()->paginate(10);
        return view('admin.post.hapus', compact('post'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->route('post.tampil_hapus')->with('status','Data Post Berhasil DiRestore silakan cek di Post !');
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();               //hapus secara permanen

        return redirect()->route('post.tampil_hapus')->with('status','Data Post Berhasil DiHapus!');
    }
}
