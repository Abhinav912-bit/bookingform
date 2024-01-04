<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>List Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <form method="GET" action="{{ route('bookings.create') }}"><Button class="btn btn-primary" type="submit">Add Booking</Button></form>
    <h2>List Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Booking Type</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Booking Slot</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example data, replace with actual data from your database -->
            @foreach($bookings as $booking)
            <tr>
                <td>{{$booking->name}}</td>
                <td><a href="mail:to{{ $booking->email}}">{{$booking->email}}</a></td>
                <td>{{$booking->booking_type}}</td>
                <td>{{$booking->booking_date}}</td>
                <td>{{$booking->booking_time}}</td>
                <td>{{$booking->booking_slot}}</td>
                <td>
                <div class="btn-group" role="group" aria-label="Booking Actions">
                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                    <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
            </tr>
            @endforeach
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>