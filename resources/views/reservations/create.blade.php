<div class="modal fade" id="reservationModalToggle{{ $book->id }}" aria-hidden="true"
    aria-labelledby="reservationModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalToggleLabel">Modal 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="d-inline" method="POST"
                action="{{ route('books.reservations.store', ['book' => $book->id]) }}">
                <div class="modal-body">
                    Show a second modal and hide this one with the button below.
                    @csrf
                    <div class="mb-3">
                        <label for="fecha">Fecha:</label>
                        <input type="text" id="fecha" name="date_range" class="form-control datepicker" required>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
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
