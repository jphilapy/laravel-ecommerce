@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Action</th>
                    </thead>
                    <tbody>

                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at->format('m/d/Y') }}</td>
                            <td><a href="/budget/transactions/edit/{{$transaction->id}}">{{ $transaction->description }}</a></td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->amount }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
