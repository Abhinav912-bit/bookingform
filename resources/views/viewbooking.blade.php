<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Booking Details</title>
</head>
<body>

<div class="container mt-5">
    <h2>Booking Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{$booking->name}}</p>
            <p><strong>Booking Date:</strong> {{$booking->booking_date}}</p>
            <p><strong>Booking Time:</strong> {{$booking->booking_time}}</p>

            <!-- Add more details as needed -->

            <a href="{{ route('bookings.index') }}" class="btn btn-primary">Back to Bookings</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
