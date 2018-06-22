<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriLowongan extends Model
{
    protected $fillable = ['nama_kategori'];
    public $timestamps = true;

    public function Lowongan(){
        return $this->HasOne('App\Lowongan','kategori_id');
    }
}
