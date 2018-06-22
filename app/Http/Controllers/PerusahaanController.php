<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\User;
use Illuminate\Http\Request;
use Session;
class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $p = Perusahaan::with('User')->get();
        return view('perusahaan.index',compact('p'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $o = User::all();
        return view('perusahaan.create',compact('o'));
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
            'nama_pers' => 'required|',
            'logo' => 'required|',
            'deskripsi' => 'required|max:',
            'telepon' => 'required|',
            'user_id' => 'required|'
        ]);
        $p = new Perusahaan;
        $p->nama_pers = $request->nama_pers;
        $p->logo = $request->logo;
        $p->deskripsi = $request->deskripsi;
        $p->telepon = $request->telepon;
        $p->user_id = $request->user_id;
        $p->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$p->logo</b>"
        ]);
        //upload
        if ($request->hasFile('logo')) {
            $file= $request->file('logo');
            $destinationPath =public_path().'/assets/admin/images/icon/';
            $filename =str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuscces =$file->move($destinationPath, $filename);
            $p->logo  = $filename;
        }
        $p->save();
          return redirect()->route('perusahaan.index');
      }


    /**
     * Display the specified resource.
     *
     * @param  \App\Pengantin  $pengantin
     * @return \Illuminate\Http\Response
     */
     public function show($id)
    {
        $p = Perusahaan::findOrFail($id);
        return view('perusahaan.show',compact('p'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\perusahaan  $pengantin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Perusahaan::findOrFail($id);
        $o= User::all();
        $selectedo = Perusahaan::findOrFail($id)->user_id;
        // dd($selected);
        return view('perusahaan.edit',compact('p','o','selectedo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengantin  $pengantin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama_pers' => 'required|',
            'logo' => 'required|',
            'deskripsi' => 'required|',
            'telepon' => 'required|',
            'user_id' => 'required|'
        ]);
        $p = Perusahaan::findOrFail($id);
        $p->nama_pers = $request->nama_pers;
        $p->logo = $request->logo;
        $p->deskripsi = $request->deskripsi;
        $p->telepon = $request->telepon;
        $p->user_id = $request->user_id;

        //edit upload foto
        if ($request->hasFile('logo')) {
            $file= $request->file('logo');
            $destinationPath =public_path().'/assets/admin/image/icon/login/';
            $filename =str_random(6). '_' .$file->getClientOriginalName();
            $uploadSuscces =$file->move($destinationPath, $filename);
        
               //hapus foto lama jika ada
            if ($p->logo) {
            $logo= $p->logo;
            $filepath = public_path(). DIRECTORY_SEPARATOR .'/assets/admin/images/icon/'. DIRECTORY_SEPARATOR . $p->logo;
           try {
               File::delete($filefath);
           } catch (FileNotFoundException $e) {

            //file sudah dihapus
               }
           }
            $p->logo= $filename;
        }
        $p->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$p->email</b>"
        ]);
        return redirect()->route('perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengantin  $pengantin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $p = Perusahaan::findOrFail($id);
        $p->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('perusahaan.index');
    }
}
