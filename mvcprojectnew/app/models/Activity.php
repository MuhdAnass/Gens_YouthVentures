<?php

class Activity
{

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

    public function findAllActivity()
    {
        $this->db->query("SELECT * FROM activities ORDER BY act_id DESC");

        $result = $this->db->resultSet();

        return $result;
    }

    public function addActivity($data)
{
    $this->db->query('INSERT INTO activities (act_title, act_desc, act_startdate, act_enddate, act_starttime, act_endtime, act_venue, act_image, act_category, user_id, max_participants, date_reg_start, date_reg_end) VALUES (:act_title, :act_desc, :act_startdate, :act_enddate, :act_starttime, :act_endtime, :act_venue, :act_image, :act_category, :user_id, :max_participants, :date_reg_start, :date_reg_end)');

    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':act_title', $data['act_title']);
    $this->db->bind(':act_desc', $data['act_desc']);
    $this->db->bind(':act_startdate', $data['act_startdate']);
    $this->db->bind(':act_enddate', $data['act_enddate']);
    $this->db->bind(':act_starttime', $data['act_starttime']);
    $this->db->bind(':act_endtime', $data['act_endtime']);
    $this->db->bind(':act_venue', $data['act_venue']);
    $this->db->bind(':act_image', $data['act_image']);
    $this->db->bind(':act_category', $data['act_category']);
    $this->db->bind(':max_participants', $data['max_participants']);
    $this->db->bind(':date_reg_start', $data['date_reg_start']); // Add this line
    $this->db->bind(':date_reg_end', $data['date_reg_end']); // Add this line


    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}


    public function findActivityById($id)
    {
        $this->db->query('SELECT * FROM activities WHERE act_id = :act_id');
        $this->db->bind(':act_id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updateActivity($data, $act_id)
{
    $setPart = '';
    $updateData = [
        'act_title',
        'act_desc',
        'act_startdate',
        'act_enddate',
        'date_reg_start',
        'date_reg_end',
        'act_starttime',
        'act_endtime',
        'act_venue',
        'act_image',
        'act_category',
        'max_participants'
    ];

    foreach ($updateData as $field) {
        if (isset($data[$field])) {
            $setPart .= $field . ' = :' . $field . ', ';
        }
    }

    // Remove the trailing comma and space
    $setPart = rtrim($setPart, ', ');

    // Build the full query
    $query = "UPDATE activities SET $setPart WHERE act_id = :act_id";

    // Execute the query
    $this->db->query($query);

    // Bind parameters dynamically
    foreach ($updateData as $field) {
        if (isset($data[$field])) {
            $this->db->bind(":$field", $data[$field]);
        }
    }

    $this->db->bind(':act_id', $act_id);

    // Execute the query and handle the result (if needed)
    return $this->db->execute();
}



    public function deleteActivity($act_id)
    {
        $this->db->query('DELETE FROM activities WHERE act_id = :act_id');

        $this->db->bind(':act_id', $act_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function joinActivity($act_id, $user_id)
    {

        // Your existing code to fetch user details
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();

        $email = $row->email;

        // Fetch student profile based on email
        $this->db->query('SELECT * FROM st_profile WHERE st_email = :email');
        $this->db->bind(':email', $email);
        $row2 = $this->db->single();

        $st_id = $row2->st_id;
        $st_fullname = $row2->st_fullname;
        $st_email = $row2->st_email;
        $st_gender = $row2->st_gender;
        $univ_code = $row2->univ_code;
        $st_address = $row2->st_address;
        $st_ic = $row2->st_ic;

        // Fetch the max participant_id for the given ac_id
         $this->db->query('SELECT COALESCE(MAX(participant_id), 0) AS max_participant_id FROM activity_participants WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);
        $row3 = $this->db->single();

        $max_participant_id = $row3->max_participant_id;

        // Increment the max_participant_id to get the new participant_id
        $participant_id = $max_participant_id + 1;

        // Insert the participant into the activity_participants table
        $this->db->query('INSERT INTO activity_participants (participant_id, act_id, st_id, st_fullname, st_email, st_gender, univ_code, st_address, st_ic) VALUES (:participant_id, :act_id, :st_id, :st_fullname, :st_email, :st_gender, :univ_code, :st_address, :st_ic)');

        $this->db->bind(':participant_id', $participant_id);
        $this->db->bind(':act_id', $act_id);
        $this->db->bind(':st_id', $st_id);
        $this->db->bind(':st_fullname', $st_fullname);
        $this->db->bind(':st_email', $st_email);
        $this->db->bind(':st_gender', $st_gender);
        $this->db->bind(':univ_code', $univ_code);
        $this->db->bind(':st_address', $st_address);
        $this->db->bind(':st_ic', $st_ic);

        return $this->db->execute();
    }

    public function isStudentJoined($user_id, $act_id)
    {
        // Fetch user details
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
    
        if (!$row) {
            // User not found, cannot be a student
            return false;
        }
    
        $email = $row->email;
    
        // Fetch student profile based on email
        $this->db->query('SELECT * FROM st_profile WHERE st_email = :email');
        $this->db->bind(':email', $email);
        $row2 = $this->db->single();
    
        // Check if the student profile exists
        if (!$row2) {
            // Student profile not found
            return false;
        }
    
        $st_id = $row2->st_id;
    
        // Check if the student is already a participant in the specified activity
        $this->db->query('SELECT * FROM activity_participants WHERE st_id = :st_id AND act_id = :act_id');
        $this->db->bind(':st_id', $st_id);
        $this->db->bind(':act_id', $act_id);
    
        return $this->db->rowCount() > 0;
    }
    



    // Add a method to check if the registration date has ended
    public function isRegistrationEnded($act_id, $date_reg_end)
    {
        $currentDate = date('Y-m-d');

        return $currentDate > $date_reg_end;
    }

    public function isRegistrationStarted($act_id, $date_reg_start)
    {
        $currentDate = date('Y-m-d');

        return $currentDate < $date_reg_start;
    }

    public function getParticipantNumber($act_id)
    {
        $this->db->query('SELECT COUNT(*) as count FROM activity_participants WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);
        $current_participants = $this->db->single()->count;

        return $current_participants;
    }

    // Add a method to check if the activity is full
    public function isActivityFull($act_id)
    {
        // Fetch the maximum number of participants for the activity from the 'activity' table
        $this->db->query('SELECT max_participants FROM activities WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);
        $max_participants = $this->db->single()->max_participants;

        // Check the current number of participants for the activity
        $this->db->query('SELECT COUNT(*) as count FROM activity_participants WHERE act_id = :act_id');
        $this->db->bind(':act_id', $act_id);
        $current_participants = $this->db->single()->count;

        // Check if the current number of participants is equal to or greater than the maximum
        return $current_participants >= $max_participants;
    }



    public function leaveActivity($act_id, $user_id)
    {
        $this->db->query('SELECT * FROM users WHERE  id = :user_id');

        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();

        $email = $row->email;

        $this->db->query('SELECT * FROM st_profile WHERE st_email = :email');

        $this->db->bind(':email', $email);

        $row2 = $this->db->single();

        $st_id = $row2->st_id;

        $this->db->query('DELETE FROM activity_participants WHERE act_id = :act_id AND st_id = :st_id');

        $this->db->bind(':act_id', $act_id);
        $this->db->bind(':st_id', $st_id);

        return $this->db->execute();
    }

    public function getJoinedActivities($user_id)
    {
        // Fetch student profile based on user_id
        $this->db->query('SELECT * FROM users WHERE id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();

        if (!$row) {
            // User not found, cannot be a student
            return false;
        }

        $email = $row->email;

        // Fetch student profile based on email
        $this->db->query('SELECT * FROM st_profile WHERE st_email = :email');
        $this->db->bind(':email', $email);
        $row2 = $this->db->single();

        // Check if the student profile exists
        if (!$row2) {
            // Student profile not found
            return false;
        }

        $st_id = $row2->st_id;

        // Fetch the activities that the student has joined
        $this->db->query('SELECT * FROM activity_participants WHERE st_id = :st_id');
        $this->db->bind(':st_id', $st_id);
        $rows = $this->db->resultSet();

        if (!$rows) {
            // No activities found
            return false;
        }

        $joinedActivities = [];

        foreach ($rows as $row) {
            // Fetch activity details for each ac_id
            $this->db->query('SELECT * FROM activities WHERE act_id = :act_id');
            $this->db->bind(':act_id', $row->act_id);
            $activityDetails = $this->db->single();

            if ($activityDetails) {
                // Add activity details to the result array
                $joinedActivities[] = $activityDetails;
            }
        }

        return $joinedActivities;
    }

    public function findAllActivityOrganizer($user_id)
    {
        $this->db->query('SELECT * FROM activities WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        // Execute the query and fetch results, return them as needed
        return $this->db->resultSet();
    }

    public function showAllActivities()
    {
        $this->db->query('SELECT * FROM activities');

        return $this->db->resultSet();
    }
}
