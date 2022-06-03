@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h3>Stuff</h3>
                    <ul>
                        <li><a href="/budget/transactions">Budget Stuff</a></li>
                        <li><a href="/video/channel/test/edit">Video Channel Stuff</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
