<div class="modal fade" id="reservationModalToggle{{ $book->id }}" aria-hidden="true"
    aria-labelledby="reservationModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalToggleLabel">Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" method="POST" action="{{ route('books.reservations.store', ['book' => $book->id]) }}">
                <div class="modal-body">
                    @csrf
                    <div class="text-start mb-3">
                        <p><strong>Book title:</strong>
                            {{ $book->title }}
                        </p>
                        <p><strong>Author:</strong>
                            {{ $book->author }}
                        </p>
                    </div>

                    <hr>
                    <div class="text-start mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Description</strong></p>
                                <p>{{ $book->description }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-none">
                                    <div class="card-body">
                                        <div id="carousel{{ $book->id }}-1" class="carousel slide carousel-fade"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($book->images as $image)
                                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                        <img class="img-fluid img-thumbnail"
                                                            src="{{ asset($image->path) }}" width="300"
                                                            height="300" alt="">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carousel{{ $book->id }}-1" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carousel{{ $book->id }}-1" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fecha">Date:</label>
                        <input type="text" id="fecha" name="date_range" class="form-control datepicker" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="message-text" placeholder="Notes" required></textarea>
                    </div>
                    <hr>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
