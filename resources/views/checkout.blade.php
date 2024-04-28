{{-- //resources/views/checkout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>

    {{-- Include Meta Tags --}}
    @include('posts.layouts.meta')

    {{-- Bootstrap --}}
    @include('posts.layouts.bootstrap')

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <title>Stripe Payment Gateway</title>

    {{-- Include CSS Styles --}}
	@include('posts.layouts.styles')

</head>
<body>
    
    {{-- Include Navbar --}}
    @include ('posts.layouts.navbar')

    <div class="container mt-5" style="margin-bottom: 200px">
        <div class="row" style="padding-bottom: 100px">
            <h1>Stripe Payment Gateway</h1>
            <hr>
            <div class='col-md-12'>
                <div class="card">
                    <div class="card-header">
                        Payment Information
                    </div>
                    <div class="card-body">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Booking No.</th>
                                    <th style="width: 35%">Booking Description</th>
                                    <th style="width: 20%">Scheduled Date</th>
                                    <th style="width: 15%">Initial Offer Price (MVR)</th>
                                    <th style="width: 15%" class="text-center">Accepted Price (MVR)</th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Booking No.">{{ $booking->id }}</td>
                                    <td data-th="Description">{{ strip_tags($booking->description) }}</td>
                                    <td data-th="Scheduled Date">{{ $booking->booking_date }}</td>
                                    <td data-th="Initial Offer Price">{{ $booking->offer_price }}</td>
                                    <td data-th="Accepted Price" class="text-center">{{ $booking->accepted_price ?? '[No Price has been Offered]' }}</td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            {{-- Table Footer --}}
                            <tfoot>
                                <tr>
                                    <td colspan="6" style="text-align:right;"><h3><strong>Final Price: </strong></h3>
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

    {{-- Include Footer --}}
    @include ('posts.layouts.footer')

    {{-- Include Scripts --}}
    @include ('posts.layouts.scripts')

</body>
</html>
