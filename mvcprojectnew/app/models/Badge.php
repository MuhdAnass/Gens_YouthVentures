<?php

class Badge{

    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function manageAllBadges()
    {
        $this->db->query('SELECT * FROM badges');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addBadge($data)
    {
        $this->db->query('INSERT INTO badges (badge_title, badge_desc, badge_img, user_id) VALUES (:badge_title, :badge_desc, :badge_img, :user_id)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':badge_title', $data['badge_title']);
        $this->db->bind(':badge_desc', $data['badge_desc']);
        $this->db->bind(':badge_img', $data['badge_img']);


        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findBadgeById($badge_id)
    {
        $this->db->query('SELECT * FROM badges WHERE badge_id = :badge_id');
        $this->db->bind(':badge_id', $badge_id);

        $row = $this->db->single();

        return $row;
    }

    public function updateBadge($data)
    {
        $this->db->query('UPDATE badges SET badge_title = :badge_title, badge_desc = :badge_desc, badge_img = :badge_img WHERE badge_id = :badge_id');

        $this->db->bind(':badge_id', $data['badge_id']);
        $this->db->bind(':badge_title', $data['badge_title']);
        $this->db->bind(':badge_desc', $data['badge_desc']);
        $this->db->bind(':badge_img', $data['badge_img']);

        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteBadge($badge_id){
        $this->db->query('DELETE FROM badges WHERE badge_id = :badge_id');

        $this->db->bind(':badge_id', $badge_id);

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