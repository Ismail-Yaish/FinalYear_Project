{{-- Stripe Payment Gateway - checkout.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>

    @include('posts.layouts.head')

    <title>BRIDGES - Payment Gateway</title>

</head>


<body>

    @include('posts.layouts.navbar')

{{-- Payment Gateway Info Start --}}
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Stripe Payment Gateway</h1>
                <hr>
                <div class="card mb-4">
                    <div class="card-header">
                        <p>Payment Information</p>
                    </div>
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed mb-2">
                            <thead class="mb-3">
                                <tr>
                                    <th style="width: 15%">Booking ID No:</th>
                                    <th style="width: 40%">Booking Description</th>
                                    <th style="width: 20%">Scheduled Date</th>
                                    <th style="width: 15%">Initial Offer Price (MVR)</th>
                                    <th style="width: 20%" class="text-center">Accepted Price (MVR)</th>
                                    {{-- <th style="width: 10%"></th> --}}
                                </tr>
                            </thead>
                            <tbody class="mb-3">
                                <tr>
                                    <td data-th="Booking No.">{{ $booking->id }}</td>
                                    <td data-th="Description">{{ strip_tags($booking->description) }}</td>
                                    <td data-th="Scheduled Date">{{ $booking->booking_date }}</td>
                                    <td data-th="Initial Offer Price">{{ $booking->offer_price }}</td>
                                    <td data-th="Accepted Price" class="text-center">{{ $booking->accepted_price ?? '[No Price has been Offered]' }}</td>
                                    <td class="actions" data-th="">
                                        {{-- <button class="btn btn-danger btn-sm cart_remove"><i class="fa-solid fa-trash"></i> Delete</button> --}}
                                    </td>
                                </tr>
                            </tbody>
                            {{-- Table Footer --}}
                            <tfoot class="col mt-2">
                                <tr>
                                    <td colspan="6" style="text-align:right;">
                                        <h3><strong>Final Price: </strong></h3>
                                        <h3><strong>MVR {{ $booking->accepted_price ?? $booking->offer_price }}</strong></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align:right;">
                                        <form action="{{ route('session', ['booking' => $booking->id]) }}" method="POST">
                                            <a href="{{ url('/posts/bookings') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Return</a>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type='hidden' name="total" value="{{ $booking->accepted_price ?? $booking->offer_price }}">
                                            <input type='hidden' name="productname" value="Booking #{{ $booking->id }} Payment">
                                            <button class="btn btn-success" type="submit" id="checkout-live-button"><i class="fa fa-credit-card" aria-hidden="true"></i> Checkout</button>
                                        </form>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Payment Gateway Info End --}}


@include('posts.layouts.footer')


@include('posts.layouts.scripts')



</body>
</html>
