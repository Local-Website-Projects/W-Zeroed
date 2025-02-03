<?php
class DBController {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "zeroed";
    private $from_email='';
    private $notification_email='';
    private $conn;

    function __construct() {
        if($_SERVER['SERVER_NAME']=="www.regtoiletconference.org"||$_SERVER['SERVER_NAME']=="regtoiletconference.org"){
            $this->host = "localhost";
            $this->user = "u868827285_toilet_confere";
            $this->password = "e>qA61M+";
            $this->database = "u868827285_toilet_confere";
        }

        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        return $conn;
    }

    function checkValue($value) {
        $value=mysqli_real_escape_string($this->conn, $value);
        return $value;
    }

    function runQuery($query) {
        $result = mysqli_query($this->conn,$query);
        while($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if(!empty($resultset))
            return $resultset;
    }

    function insertQuery($query) {
        $result = mysqli_query($this->conn,$query);
        return $result;
    }

    function from_email(){
        return $this->from_email;
    }

    function numRows($query) {
        $result  = mysqli_query($this->conn,$query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    function notify_email(){
        return $this->notification_email;
    }

    // Method to start a transaction
    function startTransaction() {
        return mysqli_begin_transaction($this->conn);
    }

    // Method to commit a transaction
    function commitTransaction() {
        return mysqli_commit($this->conn);
    }

    // Method to rollback a transaction
    function rollbackTransaction() {
        return mysqli_rollback($this->conn);
    }
}
