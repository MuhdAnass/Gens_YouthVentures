<?php

// DashboardModel.php
class Dashboard {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function fetchDataAct() {
        // Implement your database query to fetch data for the dashboard
        $this->db->query('SELECT * FROM activities');
        
        $result = $this->db->rowCount();

        return $result;
    }
}

?>
