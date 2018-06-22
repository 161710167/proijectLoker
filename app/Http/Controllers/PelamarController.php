<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelamar;
use App\Lowongan;
use Session;
use App\User;
class PelamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pel = Pelamar::with('User','Lowongan')->get();
        return view('pelamar.index',compact('pel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $us = User::all();
         $low = Lowongan::all();
        return view('pelamar.create',compact('us','low'));
    }

    /**      * Store a newly created resource in storage.      *      * @param
\Illuminate\Http\Request  $request      * @return \Illuminate\Http\Response
*/     public function store(Request $request)     {

        $this->validate($request,[
            'telepon' => 'required|',
            'pesan' => 'required|max:225',
            'file_cv' => 'required|',
            'user_id' => 'required|',
            'low_id' => 'required|'
        ]);
        $pel = new Pelamar;
        $pel->telepon = $request->telepon;
        $pel->pesan = $request->pesan;
        $pel->file_cv = $request->file_cv;
        $pel->user_id = $request->user_id;
        $pel->low_id = $request->low_id;
        $pel->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$pel->telepon</b>"
        ]);
        if ($request->hasFile('file_cv')) {
            $file = $request->file('file_cv');
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $destinationPath = public_path().'/assets/cv/';
            $uploadSucces = $file->move($destinationPath, $filename);
            $pel->file_cv = $filename;
        }
        $pel->save();
        return redirect()->route('pelamar.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pel = Pelamar::findOrFail($id);
        return view('pelamar.show',compact('pel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $pel = Pelamar::findOrFail($id);
        $us= User::all();
         $low= Lowongan::all();
        $selectedo = Pelamar::findOrFail($id)->user_id;
        $selectedlow = Pelamar::findOrFail($id)->low_id;
        // dd($selected);
        return view('pelamar.edit',compact('pel','us','low','selectedo','selectedlow'));
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
            'telepon' => 'required|',
            'pesan' => 'required|',
            'file_cv' => 'required|',
            'user_id' => 'required|',
            'low_id' => 'required|'
        ]);
        $pel = Pelamar::findOrFail($id);
        $pel->telepon = $request->telepon;
        $pel->pesan= $request->pesan;
        $pel->file_cv= $request->file_cv;
        $pel->user_id = $request->user_id;
        $pel->low_id = $request->low_id;
        $pel->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$pel->telepon</b>"
        ]);
        return redirect()->route('pelamar.index');
    }

       







        

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pel = Pelamar::findOrFail($id);
        $pel->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('pelamar.index');
    }
}
