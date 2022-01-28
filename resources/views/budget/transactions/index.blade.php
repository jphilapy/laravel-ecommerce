@extends('layouts/app')
<div class="container">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>{{ $transaction->created_at->format('m/d/Y') }}</tr>
                    <tr>{{ $transaction->description }}</tr>
                    <tr>{{ $transaction->category->name }}</tr>
                    <tr>{{ $transaction->amount }}</tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
