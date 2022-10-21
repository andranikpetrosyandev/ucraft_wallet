@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               @include('transfer.partial.transferForm', ['wallets' => $wallets])
            </div>
        </div>
    </div>
@endsection
