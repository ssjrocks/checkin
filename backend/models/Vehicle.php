<?php
class Vehicle {
    private $conn;
    private $table = 'vehicles';

    public $id;
    public $registration;
    public $size;
    public $side_color;
    public $rear_loading_required;
    public $driver_name;
    public $is_frequent;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " SET registration=?, size=?, side_color=?, rear_loading_required=?, driver_name=?, is_frequent=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssssi", $this->registration, $this->size, $this->side_color, $this->rear_loading_required, $this->driver_name, $this->is_frequent);

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
        $query = "UPDATE " . $this->table . " SET registration=?, size=?, side_color=?, rear_loading_required=?, driver_name=?, is_frequent=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssssii", $this->registration, $this->size, $this->side_color, $this->rear_loading_required, $this->driver_name, $this->is_frequent, $this->id);

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
