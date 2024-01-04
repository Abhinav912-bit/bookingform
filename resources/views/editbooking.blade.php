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
        <h2>Edit Booking</h2>

        <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mt-3">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $booking->name }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $booking->email }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="booking_type">Booking Type:</label>
                <select id="booking_type" name="booking_type" class="form-control" required>
                    <option value="FULL_DAY" @if($booking->booking_type == 'FULL_DAY') selected @endif>Full Day</option>
                    <option value="HALF_DAY" @if($booking->booking_type == 'HALF_DAY') selected @endif>Half Day</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="booking_date">Booking Date:</label>
                <input type="text" name="booking_date" id="booking_date" class="form-control" value="{{ $booking->booking_date }}" required>
            </div>

            <div class="form-group mt-3">
                <label for="booking_slot">Booking Slot:</label>
                <select id="booking_slot" name="booking_slot" class="form-control" required>
                @if($booking->booking_type == 'FULL_DAY')
                <option value="FULL_DAY" selected>Full Day</option>
                
                @else

                <option value="MORNING" @if($booking->booking_type == 'MORNING') selected @endif>Morning</option>
                <option value="EVENING"  @if($booking->booking_type == 'EVENING') selected @endif>Evening</option>
                @endif
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="booking_time">Booking Time:</label>
                <input type="time" name="booking_time" class="form-control" value="{{ $booking->booking_time }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
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
                    value: 'Full Day',
                    text: 'Full Day',
                    selected: true,
                    disabled: true
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
        var disabledDates = <?php echo json_encode($booking_dates); ?>;

        // Add dates up to today to the disabledDates array
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
</script> -->

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
                if (successData !== null) {
                    var bookingSlot = successData.booking_slot;                                                            
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
    // document.addEventListener("DOMContentLoaded", function() {
        // disableDates(booking_type);
    // });

    $('#booking_type').on('change', function(){        
        disableDates();
    });

    function disableDates(booking_type = $('#booking_type').val()) {
        $('#booking_date').val('');
        var today = new Date();
        var disabledDates = <?php echo json_encode($booked_dates); ?>;
        if (booking_type == 'FULL_DAY') {
            disabledDates = disabledDates.concat(<?php echo json_encode($morning_dates); ?>);
            disabledDates = disabledDates.concat(<?php echo json_encode($evening_dates); ?>);
            ddates = <?php echo json_encode($booking_dates); ?>
        }

        for (var date = new Date("2024-01-01"); date <= today; date.setDate(date.getDate() + 1)) {
            var formattedDate = date.toISOString().split('T')[0];
            if (!disabledDates.includes(formattedDate)) {
                disabledDates.push(formattedDate);                
            }
        }
        flatpickr("#booking_date", {
            disable: disabledDates,
        });
    }
</script>