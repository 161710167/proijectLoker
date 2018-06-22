@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Show Data Perusahaan 
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
			        <div class="form-group">
			  			<label class="control-label">Nama Perusahaan</label>	
			  			<input type="text" name="nama_pers" class="form-control" value="{{ $p->nama_pers }}"  readonly>
			  		</div>
        			<div class="form-group">
			  			<label class="control-label">Logo</label>	
			  			<br>
			  			<img src="{{asset('assets/admin/images/loker/'.$p->logo.'')}}" width="70" height="70">
			  		</div>
				<div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">Deskripsi</label>	
			  			<textarea name="deskripsi" class="form-control" rows = "10" value="{{ $p->deskripsi }}" readonly></textarea>
			  		</div>
			  		
			  		<div class="form-group">
			  			<label class="control-label">Telepon</label>	
			  			<input type="number" name="telepon" class="form-control" value="{{ $p->telepon }}"  readonly>
			  		</div>
        			
			  		<div class="form-group">
			  			<label class="control-label">User</label>	
			  			<input type="text" name="user_id" class="form-control" value="{{ $p->User->email }}"  readonly>
			  		</div>
			  	</div>
			</div>	
		</div>
	</div>
</div>
@endsection