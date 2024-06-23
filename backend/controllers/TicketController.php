<?php
include_once '../db/connection.php';
include_once '../models/Vehicle.php';
include_once '../models/Ticket.php';

class TicketController {
    private $conn;
    private $ticket;
    private $vehicle;

    public function __construct($db) {
        $this->conn = $db;
        $this->ticket = new Ticket($db);
        $this->vehicle = new Vehicle($db);
    }

    public function create_ticket() {
        $this->ticket->vehicle_id = isset($_POST['vehicle_id']) ? $_POST['vehicle_id'] : null;
        $this->ticket->job_type = $_POST['job_type'];
        $this->ticket->dropoff_details = isset($_POST['dropoff_details']) ? $_POST['dropoff_details'] : null;
        $this->ticket->pickup_details = isset($_POST['pickup_details']) ? $_POST['pickup_details'] : null;
        $this->ticket->dropoff_priority = in_array('dropoff', $_POST['priority']) ? 1 : 0;
        $this->ticket->dropoff_priority_details = isset($_POST['dropoff_priority_details']) ? $_POST['dropoff_priority_details'] : null;
        $this->ticket->pickup_priority = in_array('pickup', $_POST['priority']) ? 1 : 0;
        $this->ticket->pickup_priority_details = isset($_POST['pickup_priority_details']) ? $_POST['pickup_priority_details'] : null;
        $this->ticket->status = 'open';

        if ($this->ticket->create()) {
            echo json_encode(array('message' => 'Ticket Created'));
        } else {
            echo json_encode(array('message' => 'Ticket Not Created'));
        }
    }

    public function get_tickets() {
        $result = $this->ticket->read();
        $num = $result->num_rows;

        if ($num > 0) {
            $tickets_arr = array();
            while ($row = $result->fetch_assoc()) {
                array_push($tickets_arr, $row);
            }
            echo json_encode($tickets_arr);
        } else {
            echo json_encode(array('message' => 'No Tickets Found'));
        }
    }
}
?>
