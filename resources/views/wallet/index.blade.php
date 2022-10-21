@extends('layouts.app')
@section('content')
    @foreach($wallets as $wallet)
        {{$wallet->name}}
    @endforeach

@endsection
