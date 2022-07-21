<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="container">
    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-md-2 col-md-offset-10">
                    <form method="GET" id="months-form">
                        <select name="month" id="month" class="form-control" onchange="document.getElementById('months-form').submit()">
                            <option value="Jan" {{$currentMonth == "Jan" ? 'selected' : ''}}>January</option>
                            <option value="Feb" {{$currentMonth == "Feb" ? 'selected' : ''}}>February</option>
                            <option value="Mar" {{$currentMonth == "Mar" ? 'selected' : ''}}>March</option>
                            <option value="Apr" {{$currentMonth == "Apr" ? 'selected' : ''}}>April</option>
                            <option value="May" {{$currentMonth == "May" ? 'selected' : ''}}>May</option>
                            <option value="Jun" {{$currentMonth == "Jun" ? 'selected' : ''}}>June</option>
                            <option value="Jul" {{$currentMonth == "Jul" ? 'selected' : ''}}>July</option>
                            <option value="Aug" {{$currentMonth == "Aug" ? 'selected' : ''}}>August</option>
                            <option value="Sep" {{$currentMonth == "Sep" ? 'selected' : ''}}>September</option>
                            <option value="Oct" {{$currentMonth == "Oct" ? 'selected' : ''}}>October</option>
                            <option value="Nov" {{$currentMonth == "Nov" ? 'selected' : ''}}>November</option>
                            <option value="Dec" {{$currentMonth == "Dec" ? 'selected' : ''}}>December</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
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
                            <td><a href="/budget/transactions/{{$transaction->id}}/edit">{{ $transaction->description }}</a></td>
                            <td>{{ $transaction->category->name }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>
                                <form action="/budget/transactions/{{$transaction->id}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    @csrf

                                    <button class="btn btn-danger btn-xs" type="submit">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

</div>
</x-app-layout>
