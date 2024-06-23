<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Check-in</title>
    <link rel="stylesheet" href="../public/styles.css">
    <script>
        function toggleDetails() {
            const visitReason = document.getElementById('visit_reason').value;
            
            document.getElementById('dropoff_details_container').style.display = visitReason === 'dropoff' || visitReason === 'both' ? 'block' : 'none';
            document.getElementById('pickup_details_container').style.display = visitReason === 'pickup' || visitReason === 'both' ? 'block' : 'none';
        }

        function togglePriorityDetails() {
            const dropoffPriority = document.getElementById('dropoff_priority').checked;
            const pickupPriority = document.getElementById('pickup_priority').checked;

            document.getElementById('dropoff_priority_details_container').style.display = dropoffPriority ? 'block' : 'none';
            document.getElementById('pickup_priority_details_container').style.display = pickupPriority ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Driver Ticket System</h2>
        <form action="submit_checkin.php" method="post">
            <label for="registration">Vehicle Registration or driver number:</label>
            <input type="text" id="registration" name="registration" required>

            <label for="visit_reason">Visit Reason:</label>
            <select id="visit_reason" name="visit_reason" onchange="toggleDetails()">
                <option value="">Select...</option>
                <option value="dropoff">Dropoff</option>
                <option value="pickup">Pickup</option>
                <option value="both">Both</option>
            </select>

            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" required>

            <label for="vehicle_type">Vehicle Type:</label>
            <div>
                <input type="checkbox" id="small_rigid" name="vehicle_type[]" value="small_rigid"> <label for="small_rigid">Small Rigid</label>
            </div>
            <div>
                <input type="checkbox" id="large_rigid" name="vehicle_type[]" value="large_rigid"> <label for="large_rigid">Large Rigid</label>
            </div>
            <div>
                <input type="checkbox" id="semi_trailer" name="vehicle_type[]" value="semi_trailer"> <label for="semi_trailer">Semi Trailer</label>
            </div>
            <div>
                <input type="checkbox" id="b_double" name="vehicle_type[]" value="b_double"> <label for="b_double">B Double</label>
            </div>

            <label for="special_info">Special Information:</label>
            <div>
                <input type="checkbox" id="tailgate" name="special_info[]" value="tailgate"> <label for="tailgate">Loading for Tailgate Delivery</label>
            </div>
            <div>
                <input type="checkbox" id="rear_loading" name="special_info[]" value="rear_loading"> <label for="rear_loading">Fridge Truck/Pantek for Rear Loading</label>
            </div>
            <div>
                <input type="checkbox" id="dropoff_priority" name="priority[]" value="dropoff" onclick="togglePriorityDetails()"> <label for="dropoff_priority">Dropoff Priority</label>
            </div>
            <div>
                <input type="checkbox" id="pickup_priority" name="priority[]" value="pickup" onclick="togglePriorityDetails()"> <label for="pickup_priority">Pickup Priority</label>
            </div>

            <div id="dropoff_details_container" style="display: none;">
                <label for="dropoff_details">Dropoff Details:</label>
                <textarea id="dropoff_details" name="dropoff_details"></textarea>
            </div>

            <div id="pickup_details_container" style="display: none;">
                <label for="pickup_details">Pickup Details:</label>
                <textarea id="pickup_details" name="pickup_details"></textarea>
            </div>

            <div id="dropoff_priority_details_container" style="display: none;">
                <label for="dropoff_priority_details">Dropoff Priority Details:</label>
                <textarea id="dropoff_priority_details" name="dropoff_priority_details"></textarea>
            </div>

            <div id="pickup_priority_details_container" style="display: none;">
                <label for="pickup_priority_details">Pickup Priority Details:</label>
                <textarea id="pickup_priority_details" name="pickup_priority_details"></textarea>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
