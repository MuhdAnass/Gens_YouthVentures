<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {

        // Set timezone 
        date_default_timezone_set("Asia/Taipei");
        $user_datetime = date('Y-m-d H:i:s');
        $user_reg_status = "active";

        // Insert value for user registration
        // Insert value for profile detail
        if ($data['user_role'] == "Student") {

            // Student users and profile
            $this->db->query("INSERT INTO users (username, email, password, user_role, datetime_register, user_reg_status) 
                              VALUES(:username, :email, :password, :user_role, :datetime_register, :user_reg_status)");

            // Bind values for users table
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':user_role', $data['user_role']);
            $this->db->bind(':datetime_register', $user_datetime);
            $this->db->bind(':user_reg_status', $user_reg_status);

            // Execute the query
            if (!$this->db->execute()) {
                return false;
            }

            // Retrieve the last inserted user ID
            $user_id = $this->db->lastInsertId();

            // Insert value for st_profile table
            $this->db->query("INSERT INTO st_profile (user_id, st_ic, st_email, st_fullname, st_gender, st_race, univ_code, st_address, st_image) 
                              VALUES(:user_id, :st_ic, :st_email, :st_fullname, :st_gender, :st_race, :univ_code, :st_address, :st_image)");

            // Bind values for st_profile table
            $st_ic = "";
            $st_fullname = "";
            $st_gender = "";
            $st_race = "";
            $univ_code = "";
            $st_address = "";
            $st_image = "";

            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':st_ic', $st_ic);
            $this->db->bind(':st_email', $data['email']);
            $this->db->bind(':st_fullname', $st_fullname);
            $this->db->bind(':st_gender', $st_gender);
            $this->db->bind(':st_race', $st_race);
            $this->db->bind(':univ_code', $univ_code);
            $this->db->bind(':st_address', $st_address);
            $this->db->bind(':st_image', $st_image);

            // Execute the query
            return $this->db->execute();
        } elseif ($data['user_role'] == "Client") {
            // Insert client-specific data into the database
            $this->db->query("INSERT INTO users (username, email, password, user_role, datetime_register, user_reg_status)
                              VALUES(:username, :email, :password, :user_role, :datetime_register, :user_reg_status)");

            // Bind values for users table
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':user_role', $data['user_role']);
            $this->db->bind(':datetime_register', $user_datetime);
            $this->db->bind(':user_reg_status', $user_reg_status);

            // Execute the query
            return $this->db->execute();
        } else {
            // Handle other user roles if needed
            return false;
        }
    
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($row) {
            $hashedPassword = $row->password;
    
            if (password_verify($password, $hashedPassword)) {
                return $row; // User authenticated successfully
            }
        }
    
        return false; // User not found or authentication failed
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserRole ($user_id, $user_role)
    {
        $this->db->query('UPDATE users SET user_role=:user_role WHERE id= :user_id');

        $this->db->bind(':user_role',$user_role);
        $this->db->bind(':user_id',$user_id);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}
