<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lowongan;
use App\Perusahaan;
use App\KategoriLowongan;
use Session;
class LowonganController extends Controller
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
       $low = Lowongan::all();
        return view('lowongan.index',compact('low'));
}                       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $p = Perusahaan::all();
        $kat = KategoriLowongan::all();
        return view('lowongan.create',compact('p','kat'));
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
            'nama_low' => 'required|max:225',
            'tgl_mulai' => 'required|',
            'lokasi' => 'required|max:225',
            'gaji' => 'required|',
            'deskripsi_iklan' => 'required|max:',
            'status' => 'required|',
            'pers_id' => 'required|',
            'kategori_id' => 'required|'
        ]);
        $low = new Lowongan;
        $low->nama_low = $request->nama_low;
        $low->tgl_mulai = $request->tgl_mulai;
        $low->lokasi = $request->lokasi;
        $low->gaji = $request->gaji;
        $low->deskripsi_iklan = $request->deskripsi_iklan;
        $low->status = $request->status;
        $low->pers_id = $request->pers_id;
        $low->kategori_id = $request->kategori_id;
        $low->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$low->nama_low</b>"
        ]);
        return redirect()->route('lowongan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $low = Lowongan::findOrFail($id);
        return view('lowongan.show',compact('low'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $low = Lowongan::findOrFail($id);
        $p= Perusahaan::all();
         $kat= KategoriLowongan::all();
        $selectedp = Lowongan::findOrFail($id)->pers_id;
        $selectedkat = Lowongan::findOrFail($id)->kategori_id;
        // dd($selected);
        return view('lowongan.edit',compact('low','p','kat','selectedp','selectedkat'));
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
    'nama_low' => 'required|',
    'tgl_mulai' => 'required|',
    'lokasi' => 'required',
    'gaji' => 'required',
    'deskripsi_iklan' => 'required',
    'status' => 'required'
 ]);
 $low = Lowongan::findOrFail($id);
 $low->nama_low = $request->nama_low;
 $low->tgl_mulai= $request->tgl_mulai;
 $low->lokasi= $request->lokasi;
 $low->gaji= $request->gaji;
 $low->deskripsi_iklan= $request->deskripsi_iklan;
 $low->status= $request->status;
$low->pers_id = $request->pers_id;
 $low->kategori_id = $request->kategori_id;
 $low->save();
 Session::flash("flash_notification", [
"level"=>"success",
 "message"=>"Berhasil menyimpan <b>$low->nama_low</b>"
 ]);
           return redirect()->route('lowongan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $low = Lowongan::findOrFail($id);
        $low->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('lowongan.index');
    }
}
