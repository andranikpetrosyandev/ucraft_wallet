<form method="POST" action="{{ route('transfer.create') }}">
    @csrf
    <div class="row">

        <div class="col-md-4">
            <label for="exampleInputEmail1">From</label>
            <select class="form-control" id="exampleFormControlSelect1" name="from_wallet_id">
                @foreach($wallets as $wallet)
                    <option value="{{$wallet->id}}">{{$wallet->name}} ( ${{$wallet->amount}} )</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-4">
            <label for="exampleInputEmail1">To</label>
            <select class="form-control" id="exampleFormControlSelect1" name="to_wallet_id">
                @foreach($wallets as $wallet)
                    <option value="{{$wallet->id}}">{{$wallet->name}} ( ${{$wallet->amount}} )</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="exampleInputEmail1">Amount</label>
            <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
            @error('amount')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


        </div>
        <div class="form-group">
            <button style="float:right;margin-top:10px" type="submit" class="btn btn-primary">create</button>
        </div>

    </div>
</form>
@error('from_wallet_id')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

