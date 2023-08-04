@extends('layouts.app')

@section('content')
    <h1>Welcome</h1>
    @empty($books)
        <div class="alert alert-danger" role="alert">
            <span>No books yet!</span>
        </div>
    @endempty
    <div class="row justify-content-center align-items-center g-2">
        {{-- @dump($books) --}}
        @foreach ($books as $book)
            <div class="col-3">
                @include('components.book-card')
            </div>
        @endforeach
        {{-- @dump($books) --}}

        {{-- @dd(\Illuminate\Support\Facades\DB::getQueryLog()) --}}
    </div>
@endsection
