<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(10);
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => 'required|min:3|max:25',
            'email' => 'required',
            'tipe' => 'required'
        ]);
        
        if($request->input('password')){                //has utk gambar selain itu gunakan input
            $password = bcrypt($request->password);
        }else{
            $password = bcrypt('1234');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tipe'  => $request->tipe,
            'password' => $password
        ]);

        return redirect()->route('user.index')->with('status','Data User Berhasil DiSimpan !');
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
        $user = User::findorfail($id);
        return view('admin.user.edit', compact('user'));
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
            'name' => 'required|min:3|max:25',
            'email' => 'required',
            'tipe' => 'required'
        ]);
        
        if($request->input('password')){                //has utk gambar selain itu gunakan input
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'tipe'  => $request->tipe,
                'password' =>bcrypt($request->password)
            ];
        }else{
            $user_data = [
                'name' => $request->name,
                'email' => $request->email,
                'tipe'  => $request->tipe
            ];
        }
       
        // User::whereId($id)->update($user_data); atau

        $user = User::find($id);
        $user->update($user_data);

        return redirect()->route('user.index')->with('status','Data User Berhasil DiEdit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $user->delete();

        return redirect()->route('user.index')->with('status','Data user Berhasil DiHapus !');
    }
}
