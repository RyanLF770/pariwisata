<!-- resources/views/pages/transaction-create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Transaction for Booking {{ $booking->id }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Transaction for Booking {{ $booking->id }}</h2>
        <p>Destination: {{ $booking->destination->title }}</p>
        <p>Quantity: {{ $booking->quantity }}</p>
        <p>Total Amount: Rp. {{ $booking->quantity * $booking->destination->price }}</p>
        <form action="{{ route('transaction.store', $booking->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="">Select Payment Method</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="PayPal">PayPal</option>
                    <option value="OVO">OVO</option>
                    <option value="GoPay">GoPay</option>
                    <option value="DANA">DANA</option>
                    <option value="ShopeePay">ShopeePay</option>
                </select>
            </div>
            <div class="form-group">
                <label for="payment_details">Payment Details</label>
                <textarea name="payment_details" id="payment_details" rows="3" class="form-control" required placeholder="Provide relevant payment details based on your selected method. For example, for Credit Card: Card Number, Cardholder Name, Expiration Date, CVV."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
        <a href="{{ route('destination.management') }}" class="btn btn-secondary mt-3">Cancel</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
