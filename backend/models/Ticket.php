<?php
class Ticket {
    private $conn;
    private $table = 'tickets';

    public $id;
    public $vehicle_id;
    public $job_type;
    public $dropoff_details;
    public $pickup_details;
    public $dropoff_priority;
    public $dropoff_priority_details;
    public $pickup_priority;
    public $pickup_priority_details;
    public $status;
    public $created_at;
    public $updated_at;
    public $closed_at;
    public $forklift_operator_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET vehicle_id=?, job_type=?, dropoff_details=?, pickup_details=?, dropoff_priority=?, dropoff_priority_details=?, pickup_priority=?, pickup_priority_details=?, status=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("issssissi", $this->vehicle_id, $this->job_type, $this->dropoff_details, $this->pickup_details, $this->dropoff_priority, $this->dropoff_priority_details, $this->pickup_priority, $this->pickup_priority_details, $this->status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($query);
        return $stmt;
    }

    public function read_single() {
        $query = "SELECT * FROM " . $this->table . " WHERE id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET vehicle_id=?, job_type=?, dropoff_details=?, pickup_details=?, dropoff_priority=?, dropoff_priority_details=?, pickup_priority=?, pickup_priority_details=?, status=?, updated_at=NOW() WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("issssissii", $this->vehicle_id, $this->job_type, $this->dropoff_details, $this->pickup_details, $this->dropoff_priority, $this->dropoff_priority_details, $this->pickup_priority, $this->pickup_priority_details, $this->status, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
