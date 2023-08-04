@extends('layouts.app')

@section('content')

    <h1>List of Books</h1>

    <a href="{{ route('books.create') }}" class="btn btn-success mb-3">
        {{ __('Create New Book') }}
    </a>

    @empty($books)
        <div class="alert alert-warning">
            <span>This list of books is empty</span>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Status</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $key => $product)
                        <tr class="">
                            <td scope="row">{{ $product->id }}</td>
                            <td scope="row">{{ $product->title }}</td>
                            <td scope="row">{{ $product->description }}</td>
                            <td scope="row">{{ $product->price }}</td>
                            <td scope="row">{{ $product->stock }}</td>
                            <td scope="row">{{ $product->status }}</td>
                            <td>
                                {{-- <a href="{{ route('books.show', $product->title) }}" class="btn btn-link">
                                    {{ __('Show') }}
                                </a> --}}

                                <a href="{{ route('books.show', $product->id) }}" class="btn btn-link">
                                    {{ __('Show') }}
                                </a>

                                <a href="{{ route('books.edit', $product->id) }}" class="btn btn-link">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('books.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection
