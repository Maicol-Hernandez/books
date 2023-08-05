<tr>
    <td scope="row">{{ $book->id }}</td>
    <td scope="row">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-none">
                    <div class="card-body">
                        <h3 class="card-title">{{ $book->title }}</h3>
                        <div id="carousel{{ $book->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($book->images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="img-fluid img-thumbnail" src="{{ asset($image->path) }}"
                                            width="300" height="300" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel{{ $book->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel{{ $book->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
    <td scope="row">{{ $book->author }}</td>
    <td scope="row">{{ $book->description }}</td>
    <td>
        @isset($reservation)
            <form class="d-inline" method="POST"
                action="{{ route('books.reservations.destroy', ['reservation' => $reservation->id, 'book' => $book->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Remove reservationt</button>
            </form>
        @else
            <form class="d-inline" method="POST" action="{{ route('books.reservations.store', ['book' => $book->id]) }}">
                @csrf
                <button type="submit" class="btn btn-success">Add To Reservation</button>
            </form>
        @endisset
    </td>
</tr>