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
                    <div class="mb-3">
                        <label class="form-label" for="fecha">Date:</label>
                        <input type="text" id="fecha" name="date_range" class="form-control datepicker" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Notes:</label>
                        <textarea class="form-control" id="message-text" placeholder="Notes" required></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
