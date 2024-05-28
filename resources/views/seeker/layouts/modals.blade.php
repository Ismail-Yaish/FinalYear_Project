{{-- Modal for Cancel Booking / With Reason Start --}}
<div class="modal fade" id="declineReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="booking_id" id="booking_id">
                    <div class="mb-3">
                        <label for="declineReason" class="form-label">Please provide a reason for cancelling the booking:</label>
                        <textarea class="form-control" id="declineReason" name="decline_reason" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Modal for Cancel Booking / With Reason End --}}



{{-- Modal for Accepting Booking Start --}}
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptModalLabel">Accept Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('accept_booking', ['id' => $booking->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="AcceptedPrice" class="form-label">Accepted Price</label>
                        <input type="number" step="0.01" class="form-control" id="AcceptedPrice" name="accepted_price" placeholder="Enter accepted price" required>
                        @error('accepted_price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Modal for Accepting Booking End --}}

