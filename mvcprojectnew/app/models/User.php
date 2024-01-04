<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    // public function register($data) {
    //     $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

    //     //Bind values
    //     $this->db->bind(':username', $data['username']);
    //     $this->db->bind(':email', $data['email']);
    //     $this->db->bind(':password', $data['password']);

    //     //Execute function
    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }


    public function register($data)
    {

        // Set timezone 
        date_default_timezone_set("Asia/Taipei");
        $user_datetime = date('Y-m-d H:i:s');
        $user_reg_status = "active";

        //insert value for user registration
        //insert value for profile detail
        if ($data['user_role'] == "Student") {

            //student users and profile
            $this->db->query("INSERT INTO users (username, email, password, user_role, datetime_register, user_reg_status) 
            VALUES(:username, :email, :password, :user_role, :datetime_register, :user_reg_status);
            
            INSERT INTO st_profile (st_ic, st_email, st_fullname, st_gender, st_race, univ_code, st_address, st_image) 
            VALUES(:st_ic, :st_email, :st_fullname, :st_gender, :st_race, :univ_code, :st_address , :st_image );");

            //Bind values for st_profile table
            $st_ic = "";
            $st_fullname = "";
            $st_gender = "";
            $st_race = "";
            $univ_code = "";
            $st_address = "";
            $st_image = "";

         //Bind values for users table

            $this->db->bind(':st_ic', $st_ic);
            $this->db->bind(':st_email', $data['email']);
            $this->db->bind(':st_fullname', $st_fullname);
            $this->db->bind(':st_gender', $st_gender);
            $this->db->bind(':st_race', $st_race);
            $this->db->bind(':univ_code', $univ_code);
            $this->db->bind(':st_address', $st_address);
            $this->db->bind(':st_image', $st_image);
      
            //Bind values for users table
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':user_role', $data['user_role']);
            $this->db->bind(':datetime_register', $user_datetime);
            $this->db->bind(':user_reg_status', $user_reg_status);

        } elseif ($data['user_role'] == "Partner") {
         

        } else {
           
        }

        //execute function
        if ($this->db->execute()) {
            return true;
        } else {
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
}
