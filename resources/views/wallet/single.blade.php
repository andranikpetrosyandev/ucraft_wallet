@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <h1>{{$wallet->name}}</h1>
                    </div>
                    <div class="col-md-4">
                        <h1>${{$wallet->amount}}</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('transfer.store') }}" type="button" class="btn btn-primary btn-sm">Create Transfer</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Time</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $key=>$transaction)
                                <tr>
                                    <td>{{$transaction->created_at}}</td>
                                    <td>
                                        @if($transaction->type == 'debit')
                                            <i style="color: red"  class="fa fa-arrow-left"></i>
                                            {{$transaction->type}}
                                        @else
                                            <span style="color: green" class="fa fa-arrow-right"></span>
                                            {{$transaction->type}}
                                        @endif
                                    </td>
                                    <td>${{$transaction->amount}}</td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="row" style="float: right">
                            {!! $records->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
