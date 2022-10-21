@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @error('wallet_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <form method="POST" action="{{ route('transaction.create') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Wallet</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="wallet_id">
                            @foreach($wallets as $wallet)
                                @if($wallet->id == $wallet_id)
                                    <option selected value="{{$wallet->id}}">{{$wallet->name}} (${{$wallet->amount}})
                                    </option>
                                @else
                                    <option value="{{$wallet->id}}">{{$wallet->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
                        @error('amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Type</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="type">
                            <option value="credit">Credit</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button style="float:right;margin-top:10px" type="submit" class="btn btn-primary">create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
