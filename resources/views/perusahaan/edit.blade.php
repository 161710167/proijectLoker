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
			  	<form action="{{ route('perusahaan.update',$p->id) }}" method="post" encytype="multipart/form-data">
			  		<input name="_method" type="hidden" value="PATCH">
        			{{ csrf_field() }}
        			<div class="form-group {{ $errors->has('nama_pers') ? ' has-error' : '' }}">
			  			<label class="control-label">Nama Perusahaan</label>	
			  			<input type="text" name="nama_pers" value="{{ $p->nama_pers }}" class="form-control"  required>
			  			@if ($errors->has('nama_pers'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nama_pers') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
			  			<label class="control-label">Logo</label>	
			  			<input type="file" name="logo" value="{{ $p->logo }}" class="form-control"  required>
			  			<img src="{{asset('/assets/admin/images/icon/'.$p->logo.'')}}">
			  			@if ($errors->has('logo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
			  		</div>

					<div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}">
			  			<label class="control-label">Deskripsi</label>	
			  			<textarea name="deskripsi" class="form-control" rows = "10"   required>{{ $p->deskripsi }}</textarea>
			  			@if ($errors->has('deskripsi'))
                            <span class="help-block">
                                <strong>{{ $errors->first('deskripsi') }}</strong>
                            </span>
                        @endif
			  		</div>

                   <div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
			  			<label class="control-label">Telepon</label>	
			  			<input type="number" name="telepon" value="{{ $p->telepon }}" class="form-control"  required>
			  			@if ($errors->has('telepon'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telepon') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		<div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
			  			<label class="control-label">User</label>	
			  			<select name="user_id" class="form-control">
			  				@foreach($o as $data)
			  				<option value="{{ $data->id }}">{{ $data->email }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_id') }}</strong>
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
