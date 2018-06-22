<?php

namespace App\Http\Controllers;

use App\Lamaran;
use App\Lowongan;
use Illuminate\Http\Request;
use Session;
class LamaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $l = Lamaran::with('Lowongan')->get();
        return view('lamaran.index',compact('l'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $q = Lowongan::all();
        
        return view('lamaran.create',compact('q'));
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
            'file_cv' => 'required|',
            'status' => 'required|',
            'low_id' => 'required|'
        ]);
        $l = new Lamaran;
        $l->file_cv = $request->file_cv;
        $l->status = $request->status;
        $l->low_id = $request->low_id;
        $l->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$l->file_cv</b>"
        ]);
        return redirect()->route('lamaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $l = Lamaran::findOrFail($id);
        return view('lamaran.show',compact('l'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $l = Lamaran::findOrFail($id);
        $q = Lowongan::all();
        $selectedq = Lamaran::findOrFail($id)->low_id;
        return view('lamaran.edit',compact('l','q','selectedq'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'file_cv' => 'required|',
            'status' => 'required|',
            'low_id' => 'required|'
        ]);
        $l = Lowongan::findOrFail($id);
        $l->file_cv = $request->file_cv;
        $l->status = $request->status;
        $l->low_id = $request->low_id;
        $l->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$l->file_cv</b>"
        ]);
        return redirect()->route('lamaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $l = Lamaran::findOrFail($id);
        $l->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('lamaran.index');
    }
}
