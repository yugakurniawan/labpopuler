@extends('layouts.app')
@section('title', 'Error')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow" style="opacity: 0.8; border-radius: 20px">
                <div class="card-body">
                    <h2 class="text-center">{{ $message }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
