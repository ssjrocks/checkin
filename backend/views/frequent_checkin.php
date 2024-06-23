<?php
include 'templates/header.php';
include '../db/connection.php';

// Fetch frequent visitors from the database
$query = "SELECT id, registration, driver_name FROM vehicles WHERE is_frequent = 1";
$result = $conn->query($query);
?>

<h2>Frequent Visitor Check-in</h2>
<form action="../controllers/TicketController.php" method="post">
    <label for="frequent_visitor">Select Frequent Visitor:</label>
    <select id="frequent_visitor" name="vehicle_id" required>
        <option value="">Select...</option>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['registration'] . " - " . $row['driver_name'] . "</option>";
            }
        }
        ?>
    </select>

    <label for="visit_reason">Visit Reason:</label>
    <select id="visit_reason" name="job_type" onchange="toggleDetails()">
        <option value="">Select...</option>
        <option value="dropoff">Dropoff</option>
        <option value="pickup">Pickup</option>
        <option value="both">Both</option>
        <option value="yard">Yard</option>
    </select>

    <div id="dropoff_details_container" style="display: none;">
        <label for="dropoff_details">Dropoff Details:</label>
        <textarea id="dropoff_details" name="dropoff_details"></textarea>
        <div id="dropoff_priority_container" style="display: none;">
            <input type="checkbox" id="dropoff_priority" name="priority[]" value="dropoff" onclick="togglePriorityDetails()"> <label for="dropoff_priority">Dropoff Priority</label>
            <div id="dropoff_priority_details_container" style="display: none;">
                <label for="dropoff_priority_details">Dropoff Priority Details:</label>
                <textarea id="dropoff_priority_details" name="dropoff_priority_details"></textarea>
            </div>
        </div>
    </div>

    <div id="pickup_details_container" style="display: none;">
        <label for="pickup_details">Pickup Details:</label>
        <textarea id="pickup_details" name="pickup_details"></textarea>
        <div id="pickup_priority_container" style="display: none;">
            <input type="checkbox" id="pickup_priority" name="priority[]" value="pickup" onclick="togglePriorityDetails()"> <label for="pickup_priority">Pickup Priority</label>
            <div id="pickup_priority_details_container" style="display: none;">
                <label for="pickup_priority_details">Pickup Priority Details:</label>
                <textarea id="pickup_priority_details" name="pickup_priority_details"></textarea>
            </div>
        </div>
    </div>

    <button type="submit">Submit</button>
</form>

<script>
    function toggleDetails() {
        const visitReason = document.getElementById('visit_reason').value;

        const dropoffDetailsContainer = document.getElementById('dropoff_details_container');
        const pickupDetailsContainer = document.getElementById('pickup_details_container');
        const dropoffPriorityContainer = document.getElementById('dropoff_priority_container');
        const pickupPriorityContainer = document.getElementById('pickup_priority_container');

        dropoffDetailsContainer.style.display = (visitReason === 'dropoff' || visitReason === 'both') ? 'block' : 'none';
        pickupDetailsContainer.style.display = (visitReason === 'pickup' || visitReason === 'both') ? 'block' : 'none';

        dropoffPriorityContainer.style.display = (visitReason === 'dropoff' || visitReason === 'both') ? 'block' : 'none';
        pickupPriorityContainer.style.display = (visitReason === 'pickup' || visitReason === 'both') ? 'block' : 'none';

        // Hide priority details textareas if the priority checkbox is unchecked
        if (!document.getElementById('dropoff_priority').checked) {
            document.getElementById('dropoff_priority_details_container').style.display = 'none';
        }
        if (!document.getElementById('pickup_priority').checked) {
            document.getElementById('pickup_priority_details_container').style.display = 'none';
        }
    }

    function togglePriorityDetails() {
        const dropoffPriority = document.getElementById('dropoff_priority').checked;
        const pickupPriority = document.getElementById('pickup_priority').checked;

        document.getElementById('dropoff_priority_details_container').style.display = dropoffPriority ? 'block' : 'none';
        document.getElementById('pickup_priority_details_container').style.display = pickupPriority ? 'block' : 'none';
    }

    window.onload = function() {
        // Initialize the page to a default state
        document.getElementById('visit_reason').value = '';
        toggleDetails();
        togglePriorityDetails();
    }
</script>

<?php include 'templates/footer.php'; ?>
