@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-10">
                        <span>
                            <h4>Total ${{$total_price_for_user}}</h4>
                        </span>
                    </div>
                    <div class="col-md-2">
                        <span style="float: right">
                             <a href="{{ route('wallet.store') }} " type="button" class="btn btn-primary btn-sm">Add Wallet</a>
                        </span>
                    </div>

                </div>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wallets as $wallet)
                            <tr>
                                <td><h5 class="card-title">{{$wallet->name}}</h5></td>
                                <td><h6 class="card-title">{{$wallet->type}}</h6></td>
                                <td>$ {{$wallet->amount}}</td>
                                <td>
                                    <a style="float:left;margin-right: 3px"
                                       href="{{ route('transaction.store',$wallet->id )}} " type="button"
                                       class="btn btn-primary">Create Transaction</a>


                                    <a style="float:left;margin-right: 3px" class="btn btn-primary"
                                       href="{{route('wallet.single',$wallet->id)}}">
                                        View
                                    </a>
                                    <form method="post" action="{{route('wallet.destroy',$wallet->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger" type="submit">Remove</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>


                </div>
                @if($wallets->count()>1)
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-12">
                            <h3>Create New Transaction</h3>
                            @include('transfer.partial.transferForm', ['wallets' => $wallets])

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
