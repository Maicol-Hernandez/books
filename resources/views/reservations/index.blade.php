@extends('layouts.app')

@section('content')
    <h1>Your Reservation</h1>
    @if (!isset($reservation) || $reservation->books->isEmpty())
        <div class="alert alert-warning" role="alert">
            <span>Your reservation is empty!</span>
        </div>
    @else
        <h4 class="text-center">Your reservation Total <strong>{{ $reservation->total }}</strong></h4>
        <a class="btn btn-success mb-3" href="{{ route('orders.create') }}" role="button">
            Start Order
        </a>
        <div class="row justify-start-center align-items-center g-2">
            @foreach ($reservation->books as $book)
                <div class="col-3">
                    @include('components.book-table')
                </div>
            @endforeach
        </div>
    @endif
@endsection
