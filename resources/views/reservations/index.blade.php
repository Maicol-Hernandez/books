@extends('layouts.app')

@section('content')
    <h1>Your Reservation</h1>
    @if (!isset($reservation) || $reservation->books->isEmpty())
        <div class="alert alert-warning" role="alert">
            <span>Your reservation is empty!</span>
        </div>
    @else
        <h4 class="text-center">Your reservation Total: <strong>{{ $reservation->total }}</strong></h4>
        <form class="d-inline" method="POST" action="{{ route('orders.store') }}">
            @csrf
            <button type="submit" class="btn btn-success mb-3">
                Confirm Reservation
            </button>
        </form>

        <div class="row justify-content-center align-items-center g-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span id="card_title">
                                        {{ __('Books') }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Author</th>
                                                <th scope="col">description</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservation->books as $book)
                                                @include('components.book-table')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
