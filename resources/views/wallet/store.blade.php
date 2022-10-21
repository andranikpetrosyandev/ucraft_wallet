@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('wallet.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Wallet Name</label>
                        <input type="text" class="form-control"  name="wallet_name" placeholder="Enter Wallet Name">
                        @error('wallet_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Wallet Type</label>
                        <input type="text" class="form-control" name="wallet_type" placeholder="Enter wallet type">
                        @error('wallet_type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button style="float:right;margin-top:10px" type="submit" class="btn btn-primary">Create Wallet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
