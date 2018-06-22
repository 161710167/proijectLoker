@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                 <div class="card-header">Selamat Datang Admin</div>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
