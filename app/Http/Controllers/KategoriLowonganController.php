<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriLowongan;
use Session;
class KategoriLowonganController extends Controller
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
        $kat = KategoriLowongan::all();
        return view('kategori.index',compact('kat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama_kategori' => 'required|',
            
        ]);
        $kat = new KategoriLowongan;
        $kat->nama_kategori = $request->nama_kategori;
        
        $kat->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$kat->nama_kategori</b>"
        ]);
        return redirect()->route('kategori.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kat= KategoriLowongan::findOrFail($id);
        return view('kategori.show',compact('kat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kat = KategoriLowongan::findOrFail($id);
        return view('kategori.edit',compact('kat'));
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
            'nama_kategori' => 'required|',
           
        ]);
        $kat = KategoriLowongan::findOrFail($id);
        $kat->nama_kategori = $request->nama_kategori;
        $kat->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$kat->nama_kategori</b>"
        ]);
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kat = KategoriLowongan::findOrFail($id);
        $kat->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('kategori.index');
    }
}
