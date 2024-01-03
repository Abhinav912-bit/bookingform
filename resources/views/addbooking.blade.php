<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Booking</title>
</head>

<body>
    <div class="container">
        <h2>Create Booking</h2>

        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf

            <div class="form-group mt-3">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="booking_type">Booking Type:</label>
                <select id="booking_type" name="booking_type" class="form-control" required>
                    <option value="">--Select Your Booking Type--</option>
                    <option value="FULL_DAY">Full Day</option>
                    <option value="HALF_DAY">Half Day</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="booking_date">Booking Date:</label>
                <input type="text" name="booking_date" id="booking_date" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <label for="booking_slot">Booking Slot:</label>
                <select id="booking_slot" name="booking_slot" class="form-control" required>
                    <option value="">--Select Your Slot--</option>
                    <option value="MORNING">Morning</option>
                    <option value="EVENING">Evening</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="booking_time">Booking Time:</label>
                <input type="time" name="booking_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('#booking_type').on('change', function() {
            updateBookingSlotOptions();
        });

        function updateBookingSlotOptions() {
            var bookingType = $('#booking_type').val();
            var bookingSlotSelect = $('#booking_slot');

            bookingSlotSelect.empty();

            if (bookingType === 'FULL_DAY') {
                bookingSlotSelect.append($('<option>', {
                    value: 'FULL_DAY',
                    text: 'Full Day',
                    selected: true,
                }));
            } else {

                bookingSlotSelect.append($('<option>', {
                    value: '',
                    text: '--Select Your Slot--'
                }));

                bookingSlotSelect.append($('<option>', {
                    value: 'MORNING',
                    text: 'Morning'
                }));

                bookingSlotSelect.append($('<option>', {
                    value: 'EVENING',
                    text: 'Evening'
                }));
            }
        }
    });

    $(document).on("change", "#booking_type,#booking_date", function(e) {
        $.ajax({
            url: '{{route("bookings.checkBooking")}}',
            type: "POST",
            dataType: "json",
            headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
            data: {
                booking_date: $('#booking_date').val(),
            },
            success: function(successData) {
                if(successData !== null){
                    var bookingSlot = successData.booking_slot;
                // Enable or disable options in Booking Slot based on Booking Slot value from success data
                if (bookingSlot === 'MORNING') {
                    $('#booking_slot option[value=MORNING]').prop('disabled', true);
                    $('#booking_slot option[value=EVENING]').prop('selected', true);
                } else if (bookingSlot === 'EVENING') {
                    $('#booking_slot option[value=MORNING]').prop('selected', true);
                    $('#booking_slot option[value=EVENING]').prop('disabled', true);
                }
                }
            },
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date();
        var disabledDates = <?php echo json_encode($booked_dates); ?>;

        
        for (var date = new Date("2024-01-01"); date <= today; date.setDate(date.getDate() + 1)) {
            var formattedDate = date.toISOString().split('T')[0];
            if (!disabledDates.includes(formattedDate)) {
                disabledDates.push(formattedDate);
            }
        }
        flatpickr("#booking_date", {
            disable: disabledDates,
        });
    });
</script>