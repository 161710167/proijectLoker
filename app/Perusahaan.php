<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
	protected $table ='perusahaans';
    protected $fillable = ['nama_pers','logo','deskripsi','telepon','user_id'];
    public $timestamps = true;

    public function User(){
        return $this->belongsto('App\User','user_id');
    }
    public function Lowongan(){
        return $this->HasOne('App\Lowongan','pers_id');
    }
}
