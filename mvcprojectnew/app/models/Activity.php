<?php

class Activity{

    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function manageAllActivities()
    {
        $this->db->query('SELECT * FROM activities');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addActivity($data)
    {
        $this->db->query('INSERT INTO activities (act_title, act_desc, act_startdate, act_enddate, act_starttime, act_endtime, act_venue, act_image, user_id) VALUES (:act_title, :act_desc, :act_startdate, :act_enddate, :act_starttime, :act_endtime, :act_venue, :act_image, :user_id)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':act_title', $data['act_title']);
        $this->db->bind(':act_desc', $data['act_desc']);
        $this->db->bind(':act_startdate', $data['act_startdate']);
        $this->db->bind(':act_enddate', $data['act_enddate']);
        $this->db->bind(':act_starttime', $data['act_starttime']);
        $this->db->bind(':act_endtime', $data['act_endtime']);
        $this->db->bind(':act_venue', $data['act_venue']);
        $this->db->bind(':act_image', $data['act_image']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findActivityById($act_id)
    {
        $this->db->query('SELECT * FROM activities WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);

        $row = $this->db->single();

        return $row;
    }

    public function updateActivity($data)
    {
        $this->db->query('UPDATE activities SET act_title = :act_title, act_desc = :act_desc, act_startdate = :act_startdate, act_enddate = :act_enddate, act_starttime = :act_starttime, act_endtime = :act_endtime, act_venue = :act_venue, act_image = :act_image WHERE act_id = :act_id');

        $this->db->bind(':act_id', $data['act_id']);
        $this->db->bind(':act_title', $data['act_title']);
        $this->db->bind(':act_desc', $data['act_desc']);
        $this->db->bind(':act_startdate', $data['act_startdate']);
        $this->db->bind(':act_enddate', $data['act_enddate']);
        $this->db->bind(':act_starttime', $data['act_starttime']);
        $this->db->bind(':act_endtime', $data['act_endtime']);
        $this->db->bind(':act_venue', $data['act_venue']);
        $this->db->bind(':act_image', $data['act_image']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteActivity($act_id){
        $this->db->query('DELETE FROM activities WHERE act_id = :act_id');

        $this->db->bind(':act_id', $act_id);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    


}


?>