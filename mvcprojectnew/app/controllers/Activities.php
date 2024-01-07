<?php 

class Activities extends Controller{

    public function __construct()
    {
        $this->activityModel = $this->model('Activity');
    }

    public function index()
    {
        $activities = $this->activityModel->manageAllActivities();

        $data = [

            'activities' => $activities


        ];
       
        $this->view('activities/index', $data);
    }

    public function create()
    {

        // Set the timezone to Kuala Lumpur for formatting
        date_default_timezone_set('Asia/Kuala_Lumpur');
        
        $data = 
        [
            'act_title' => '',
            'act_desc' => '',
            'act_startdate' => '',
            'act_enddate' => '',
            'act_starttime' => '',
            'act_endtime' => '',
            'act_venue' => '',
            'act_image' => ''

        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
             
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check if file was uploaded without errors
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["file"]["name"];
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];

                $fileExt = explode('.', $filename);
                $fileActualExt = strtolower(end($fileExt));

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)){
                    $_SESSION['failed'] = "Error: You cannot upload files of this type!";
                    header("Location: " . URLROOT . "/pages/edit_profile");
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize){
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                            header("Location: " . URLROOT . "/pages/edit_profile");
                } 
                $location = "images/activities/" . $username;

                if (in_array($filetype, $allowed)) {

                    if (file_exists($location . $filename)) {
                        echo $filename . " is already exists.";
                    } else {
                        
                            # create directory if not exists in upload/ directory
                            if (!is_dir($location)) {
                                //mkdir($location, 0755);
                                mkdir('images/activities/' . $username, 0777, true);
                            }

                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                            $location .= "/" . $fileNameNew;

                            move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    }
                } else {
                    $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/activities/create");
                }
            } else {

                $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/activities/create");
              
            }

            $data = 
            [
            'user_id' => $_SESSION['user_id'],
            'act_title' => trim($_POST['act_title']),
            'act_desc' => trim($_POST['act_desc']),
            'act_startdate' => trim($_POST['act_startdate']),
            'act_enddate' => trim($_POST['act_enddate']),
            'act_starttime' => trim($_POST['act_starttime']),
            'act_endtime' => trim($_POST['act_endtime']),
            'act_venue' => trim($_POST['act_venue']),
            'act_image' => $location
            ];


            if ($data['act_title'] && $data['act_desc'] && $data['act_startdate'] && $data['act_enddate'] && $data['act_starttime'] && $data['act_endtime'] && $data['act_venue'] && $data['act_image'] ){
                if ($this->activityModel->addActivity($data)){
                    header("Location: " . URLROOT. "/activities" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('activities/index', $data);
            }
        }
        
        $this->view('activities/index', $data);
    }

    public function update($id)
    {
        // Set the timezone to Kuala Lumpur for formatting
        date_default_timezone_set('Asia/Kuala_Lumpur');
        
        $activity = $this->activityModel->findActivityById($id);


        $data = 
        [
            'activity' => $activity,
            'act_title' => '',
            'act_desc' => '',
            'act_startdate' => '',
            'act_enddate' => '',
            'act_starttime' => '',
            'act_endtime' => '',
            'act_venue' => '',
            'act_image' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'act_id' => $id,
            'activity' => $activity,
            'user_id' => $_SESSION['user_id'],
            'act_title' => trim($_POST['act_title']),
            'act_desc' => trim($_POST['act_desc']),
            'act_startdate' => trim($_POST['act_startdate']),
            'act_enddate' => trim($_POST['act_enddate']),
            'act_starttime' => trim($_POST['act_starttime']),
            'act_endtime' => trim($_POST['act_endtime']),
            'act_venue' => trim($_POST['act_venue']),
            'act_image' => trim($_POST['act_image'])
    
            ];

            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check if file was uploaded without errors
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                $filename = $_FILES["file"]["name"];
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];

                $fileExt = explode('.', $filename);
                $fileActualExt = strtolower(end($fileExt));

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)){
                    $_SESSION['failed'] = "Error: You cannot upload files of this type!";
                    header("Location: " . URLROOT . "/pages/edit_profile");
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize){
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                            header("Location: " . URLROOT . "/pages/edit_profile");
                } 
                $location = "images/activities/" . $username;

                if (in_array($filetype, $allowed)) {

                    if (file_exists($location . $filename)) {
                        echo $filename . " is already exists.";
                    } else {
                        
                            # create directory if not exists in upload/ directory
                            if (!is_dir($location)) {
                                //mkdir($location, 0755);
                                mkdir('images/activities/' . $username, 0777, true);
                            }

                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                            $location .= "/" . $fileNameNew;

                            move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    }
                } else {
                    $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/activities/create");
                }
            } else {

                $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/activities/create");
              
            }

            if ($data['act_title'] && $data['act_desc'] && $data['act_startdate'] && $data['act_enddate'] && $data['act_starttime'] && $data['act_endtime'] && $data['act_venue'] && $data['act_image']){
                if ($this->activityModel->updateActivity($data)){
                    header("Location: " . URLROOT. "/activities" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('activities/index', $data);
            }
        }

        $this->view('activities/index', $data);
    }

    public function delete($act_id)
    {
        $activity = $this->activityModel->findActivityById($act_id);

        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->activityModel->deleteActivity($act_id)){
                header("Location: " . URLROOT . "/activities");
            }
            else
            {
                die('Something went wrong..');
            }

        }

        
        
    }

}


?>