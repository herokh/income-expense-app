@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-black-50">Create new expense</h1>
    <form action="{{ route('store-expense') }}" method="POST">
    <div class="form-group">
        <label for="formGroupExampleInput">Amount</label>
        <input type="number" class="form-control" name="amount">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Transaction DateTime</label>
        <input type="date" class="form-control" name="transaction_datetime">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Note</label>
        <textarea class="form-control" name="note"></textarea>
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
