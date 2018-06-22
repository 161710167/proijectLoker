@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Edit Data Lamaran 
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<form action="{{ route('pelamar.update',$pel->id) }}" method="post" >
			  		<input name="_method" type="hidden" value="PATCH">
        			{{ csrf_field() }}
        			<div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
			  			<label class="control-label">telepon</label>	
			  			<input type="number" value="{{ $pel->telepon }}" name="telepon" class="form-control"  required
			  			@if ($errors->has('telepon'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telepon') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		<div class="form-group {{ $errors->has('pesan') ? ' has-error' : '' }}">
			  			<label class="control-label">pesan</label>	
			  			<input type="text" value="{{ $pel->pesan }}" name="pesan" class="form-control"  required
			  			@if ($errors->has('pesan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pesan') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		<div class="form-group {{ $errors->has('file_cv') ? ' has-error' : '' }}">
			  			<label class="control-label">File Cv</label>	
			  			<input type="file" name="file_cv" class="form-control" value="{{ $pel->file_cv }}" required>
			  			@if ($errors->has('file_cv'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file_cv') }}</strong>
                            </span>
                        @endif
			  		</div>

			  			<div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
			  			<label class="control-label">User</label>	
			  			<select name="user_id" class="form-control">
			  				@foreach($o as $data)
			  				<option value="{{ $data->id }}" {{ $selectedo == $data->id ? 'selected="selected"' : '' }} >{{ $data->email }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
			  		</div>

			  		<div class="form-group {{ $errors->has('low_id') ? ' has-error' : '' }}">
			  			<label class="control-label">Lowongan</label>	
			  			<select name="low_id" class="form-control">
			  				@foreach($low as $data)
			  				<option value="{{ $data->id }}" {{ $selectedlow == $data->id ? 'selected="selected"' : '' }} >{{ $data->nama_low }}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('low_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('low_id') }}</strong>
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