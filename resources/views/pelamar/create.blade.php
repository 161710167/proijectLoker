@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Tambah Data Perusahaan
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<form action="{{ route('pelamar.store') }}" method="post" >
			  		{{ csrf_field() }}
			  		<div class="form-group {{ $errors->has('telepon') ? ' has-error' : '' }}">
			  			<label class="control-label">telepon</label>	
			  			<input type="text" name="telepon" class="form-control"  required>
			  			@if ($errors->has('telepon'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telepon') }}</strong>
                            </span>
                        @endif
			  		</div>
			  			<div class="form-group {{ $errors->has('pesan') ? ' has-error' : '' }}">
			  			<label class="control-label">pesan</label>	
			  			<input type="text" name="pesan" class="form-control"  required>
			  			@if ($errors->has('pesan'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pesan') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		<div class="form-group {{ $errors->has('file_cv') ? ' has-error' : '' }}">
			  			<label class="control-label">FileCV</label>	
			  			<input type="file" name="file_cv"  required>
			  			@if ($errors->has('file_cv'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file_cv') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		

			  			<div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
			  			<label class="control-label">User</label>	
			  			<select name="user_id" class="form-control">
			  				@foreach($us as $data)
			  				<option value="{{ $data->id }}">{{ $data->email}}</option>
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
			  			<select name="low_id" class="form-control" >
			  				@foreach($low as $data)
			  				<option value="{{ $data->id }}">{{ $data->nama_low}}</option>
			  				@endforeach
			  			</select>
			  			@if ($errors->has('low_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('low_id') }}</strong>
                            </span>
                        @endif
			  		</div>
			  		
			  		<div class="form-group">
			  			<button type="submit" class="btn btn-primary">Tambah</button>
			  		</div>
			  	</form>
			  </div>
			</div>	
		</div>
	</div>
</div>
@endsection