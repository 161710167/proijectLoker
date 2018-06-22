@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Edit Data Perusahaan
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<form action="{{ route('kategori.update',$kat->id) }}" method="post">
			  		<input name="_method" type="hidden" value="PATCH">
        			{{ csrf_field() }}
        			<div class="form-group {{ $errors->has('nama_kategori') ? ' has-error' : '' }}">
			  			<label class="control-label">Nama Kategori</label>	
			  			<input type="text" name="nama_kategori" value="{{ $kat->nama_kategori }}" class="form-control"  required>
			  			@if ($errors->has('nama_kategori'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_kategori') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		
			  		<div class="form-group">
			  			<button type="submit" class="btn btn-primary">Simpan</button>
			  		</div>
			  	</form>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection
