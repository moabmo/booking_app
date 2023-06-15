<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="date"],
        .form-group input[type="time"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form</h2>
        <form method="POST" action="/submit">
            @csrf
            <div class="form-group">
                <label for="date">Choose a date:</label>
                <input type="date" id="date" name="date" min="{{ now()->format('Y-m-d') }}" max="{{ now()->addMonths(1)->endOfMonth()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="time">Choose a time:</label>
                <select id="time" name="time" required>
                    <option value="" disabled selected>Select a time</option>
                    <option value="08:00">08:00 AM</option>
                    <option value="09:00">09:00 AM</option>
                    <option value="10:00">10:00 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="16:00">04:00 PM</option>
                    <option value="17:00">05:00 PM</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        // Function to disable the unavailable time options based on the selected date
        function disableUnavailableTimes() {
            var dateInput = document.getElementById('date');
            var timeSelect = document.getElementById('time');
            
            var selectedDate = new Date(dateInput.value);
            var selectedDay = selectedDate.getDay(); // Get the day of the week (0-6, 0: Sunday, 1: Monday, etc.)

            // Enable all time options
            for (var i = 0; i < timeSelect.options.length; i++) {
                timeSelect.options[i].disabled = false;
            }

            // Disable time options outside the range of 8 AM to 5 PM on weekdays
            if (selectedDay >= 1 && selectedDay <= 5) { // Weekdays (Monday-Friday)
                var startHour = 8;
                var endHour = 17;

                // Disable time options before 8 AM and after 5 PM
                for (var j = 0; j < timeSelect.options.length; j++) {
                    var hour = parseInt(timeSelect.options[j].value.split(':')[0]);
                    if (hour < startHour || hour > endHour) {
                        timeSelect.options[j].disabled = true;
                    }
                }
            } else { // Disable all time options for weekends (Saturday and Sunday)
                for (var k = 0; k < timeSelect.options.length; k++) {
                    timeSelect.options[k].disabled = true;
                }
            }
        }

        // Add an event listener to the date input to disable the unavailable times when the date changes
        var dateInput = document.getElementById('date');
        dateInput.addEventListener('change', disableUnavailableTimes);

        // Initialize the time options based on the initial selected date
        disableUnavailableTimes();
    </script>
</body>
</html>
