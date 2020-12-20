<?php

namespace App\Http\Controllers;

use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Str;         //include str karena kita pake function str

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tags::paginate(10);
        return view('admin.tag.index', compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:20'
        ]);

        // dd($request->all());                     //test data request yg diinput
        $tag = Tags::create([
            'name' => $request->name,
            'slug' => str::slug($request->name)      //slug diambil dari data di form name
        ]);
        return redirect('/tag')->with('status','Data Mahasiswa Berhasil Ditambahakan !');
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
        $tag = Tags::findorfail($id);
        return view('admin.tag.edit', compact('tag'));
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
        $this->validate($request, [
            'name' => 'required|max:20'
        ]);

        $tag_data = [
            'name' => $request->name,
            'slug' => str::slug($request->name)    
        ];

        Tags::whereId($id)->update($tag_data);

        return redirect()->route('tag.index')->with('status','Data Mahasiswa Berhasil DiEdit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tags::findorfail($id);
        $tag->delete();

        return redirect()->route('tag.index')->with('status','Data Mahasiswa Berhasil DiHapus !');
    }
}
