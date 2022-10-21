@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Transactions</h3>
                <div class="row" style="text-align:center">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Wallet Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->wallet->name}}</td>
                                    <td>
                                        @if($transaction->type == 'debit')
                                            <i style="color: red" class="fa fa-arrow-left"></i>
                                            {{$transaction->type}}
                                        @else
                                            <span style="color: green" class="fa fa-arrow-right"></span>
                                            {{$transaction->type}}
                                        @endif
                                    </td>
                                    <td>${{$transaction->amount}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>



                        </table>
                        <div class="row" style="float: right">
                            {!! $transactions->links() !!}
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
