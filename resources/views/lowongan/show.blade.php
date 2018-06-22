@extends('layouts.admin')
@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Show Data Lowongan
			  	<div class="panel-title pull-right"><a href="{{ url()->previous() }}">Kembali</a>
			  	</div>
			  </div>
			  <div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">nama_low</label>	
			  			<input type="text" name="nama_low" class="form-control" value="{{ $low->nama_low }}"  readonly>
			  		</div>
			  		<div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">tgl_mulai</label>	
			  			<input type="date" name="tgl_mulai" class="form-control" value="{{ $low->tgl_mulai }}"  readonly>
			  		</div>
			  		<div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">lokasi</label>	
			  			<input type="text" name="lokasi" class="form-control" value="{{ $low->lokasi }}"  readonly>
			  		</div>
			  		<div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">gaji</label>	
			  			<input type="number" name="gaji" class="form-control" value="{{ $low->gaji }}"  readonly>
			  		</div>
				<div class="panel-body">
        			<div class="form-group">
			  			<label class="control-label">deskripsi_iklan</label>	
			  			<input type="text" name="deskripsi_iklan" class="form-control" value="{{ $low->deskripsi_iklan }}"  readonly>
			  		
			  		<div class="form-group">
			  			<label class="control-label">Deskripsi Perusahaan</label>	
			  			<textarea name="pers_id" class="form-control" rows = "10" value="{{ $low->Perusahaan->deskripsi }}" readonly></textarea>
			  		</div>
			  	</div>
			</div>	
		</div>
	</div>
</div>
@endsection