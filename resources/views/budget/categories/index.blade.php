<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="card">


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->created_at->format('m/d/Y') }}</td>
                                <td><a href="/budget/categories/{{$category->slug}}">{{ $category->name }}</a></td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <form action="/budget/categories/{{$category->slug}}" method="POST">
                                        {{ method_field('DELETE') }}
                                        @csrf

                                        <button class="btn btn-danger btn-xs" type="submit">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
