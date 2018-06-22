<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Session;
class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
         $k = Member::with('User')->get();
        return view('member.index',compact('k'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $p = User::all();
        return view('member.create',compact('p'));
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
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $k = new Member;
        $k->foto = $request->foto;
        $k->alamat = $request->alamat;
        $k->user_id = $request->user_id;
        $k->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$k->email</b>"
        ]);
       //upload
        if ($request->hasFile('foto')) {
            $file= $request->file('foto');
            $destinationPath =public_path().'/assets/admin/images/icon/';
            $filename =str_random(6).'_'.$file->getClientOriginalName();
            $uploadSuscces =$file->move($destinationPath, $filename);
            $k->foto  = $filename;
        }
        $k->save();
          return redirect()->route('member.index');
      }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $k = Member::findOrFail($id);
        return view('member.show',compact('k'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $k = Member::findOrFail($id);
        $p = User::all();
        $selectedp = Member::findOrFail($id)->user_id;
        return view('member.edit',compact('p','k','selectedp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $k = Member::findOrFail($id);
        $k->foto = $request->foto;
        $k->alamat = $request->alamat;
        $k->user_id = $request->user_id;
         //edit upload foto
        if ($request->hasFile('foto')) {
            $file= $request->file('foto');
            $destinationPath =public_path().'/assets/admin/image/icon/login/';
            $filename =str_random(6). '_' .$file->getClientOriginalName();
            $uploadSuscces =$file->move($destinationPath, $filename);
        
        //hapus foto lama jika ada
            if ($k->foto) {
            $old_foto= $k->foto;
            $filepath = public_path(). DIRECTORY_SEPARATOR .'/assets/admin/images/icon/'. DIRECTORY_SEPARATOR . $k->foto;
           try {
               File::delete($filefath);
           } catch (FileNotFoundException $e) {

            //file sudah dihapus
               }
           }
            $k->foto  = $filename;
        }
        $k->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$k->email</b>"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $k = Member::findOrFail($id);
        $k->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('member.index');
    }
}
