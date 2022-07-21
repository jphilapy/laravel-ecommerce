<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Update Transaction
                    </div>
                    <div class="card-body">
                        <form action="/budget/transactions/{{$transaction->id}}" method="POST" class="requires-validation" novalidate>
                            {{method_field('PUT')}}
                            @include('budget.transactions.form', ['buttonText'=>'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
