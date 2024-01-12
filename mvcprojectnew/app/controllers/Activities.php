<?php

class Activities extends Controller
{

    public function __construct()
    {
        $this->activityModel = $this->model('Activity');
    }

    public function index()
    {
        $user_role = $_SESSION['user_role'];

        //$activities = $this->activityModel->manageAllActivities();

        //$data = [

        //    'activities' => $activities


        //];

        if ($user_role === 'Student') {
            $activities = $this->activityModel->findAllActivity();
        } elseif($user_role === 'Client'){
            $user_id = $_SESSION['user_id'];
            $activities = $this->activityModel->findAllActivityOrganizer($user_id);
        }else{

            $activities = $this->activityModel->showAllActivities();
        }


        $data = [

            'activities' => $activities,
            'isStudentJoined' => function ($user_id, $act_id) {
                return $this->activityModel->findALlActivityOrganizer($user_id);
            }

        ];

        $this->view('activities/index', $data);
    }

    public function create()
    {

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/users/login");
        }

        // Set the timezone to Kuala Lumpur for formatting
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $data =
            [
                'act_title' => '',
                'act_desc' => '',
                'act_startdate' => '',
                'act_enddate' => '',
                'date_reg_start' => '',
                'date_reg_end' => '',
                'act_starttime' => '',
                'act_endtime' => '',
                'act_venue' => '',
                'act_image' => '',
                'act_category' => '',
                'max_participants' => ''

            ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                if (!array_key_exists($ext, $allowed)) {
                    $_SESSION['failed'] = "Error: You cannot upload files of this type!";
                    header("Location: " . URLROOT . "/activities");
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                    header("Location: " . URLROOT . "/activities");
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
                    'date_reg_start' => trim($_POST['date_reg_start']),
                    'date_reg_end' => trim($_POST['date_reg_end']),
                    'act_starttime' => trim($_POST['act_starttime']),
                    'act_endtime' => trim($_POST['act_endtime']),
                    'act_venue' => trim($_POST['act_venue']),
                    'act_category' => trim($_POST['act_category']),
                    'max_participants' => trim($_POST['max_participants']),
                    'act_image' => $location
                ];


            if ($data['act_title'] && $data['act_desc'] && $data['act_startdate'] && $data['date_reg_start'] && $data['date_reg_end'] && $data['act_enddate'] && $data['act_starttime'] && $data['act_endtime'] && $data['act_venue'] && $data['act_image']  && $data['act_category']  && $data['max_participants']) {
                if ($this->activityModel->addActivity($data)) {
                    header("Location: " . URLROOT . "/activities");
                } else {
                    die("Something went wrong :(");
                }
            } else {
                $this->view('activities/index', $data);
            }
        }

        $this->view('activities/index', $data);
    }

    public function update($act_id)
    {
        // Set the timezone to Kuala Lumpur for formatting
        date_default_timezone_set('Asia/Kuala_Lumpur');

        $activity = $this->activityModel->findActivityById($act_id);

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/activities");
            exit();
        } 

        $data =
            [
                'activity' => $activity,
                'act_title' => '',
                'act_desc' => '',
                'act_startdate' => '',
                'act_enddate' => '',
                'date_reg_start' => '',
                'date_reg_end' => '',
                'act_starttime' => '',
                'act_endtime' => '',
                'act_venue' => '',
                'act_category' => '',
                'act_image' => '',
                'max_participants' => '',
                'u_url' => URLROOT . "/activity/update/" . $act_id
            ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                if (!array_key_exists($ext, $allowed)) {
                    $_SESSION['failed'] = "Error: You cannot upload files of this type!";
                    header("Location: " . URLROOT . "/activities");
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                    header("Location: " . URLROOT . "/activities");
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

            // $_POST['update_student'] hidden value from form
            if ($_POST['update_activity']) {

                if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {  //statement unbtuk update gambar (nanti ic,name semua) takkan hilang

                    $data = [


                        'user_id' => $_SESSION['user_id'],
                        'act_title' => trim($_POST['act_title']),
                        'act_desc' => trim($_POST['act_desc']),
                        'act_startdate' => trim($_POST['act_startdate']),
                        'act_enddate' => trim($_POST['act_enddate']),
                        'date_reg_start' => trim($_POST['date_reg_start']),
                        'date_reg_end' => trim($_POST['date_reg_end']),
                        'act_starttime' => trim($_POST['act_starttime']),
                        'act_endtime' => trim($_POST['act_endtime']),
                        'act_venue' => trim($_POST['act_venue']),
                        'act_category' => trim($_POST['act_category']),
                        'max_participants' => trim($_POST['max_participants']),
                        'act_image' => $location

                    ];
                } else {  //statement kalau taknak update gambar

                    $data = [

                        'user_id' => $_SESSION['user_id'],
                        'act_title' => trim($_POST['act_title']),
                        'act_desc' => trim($_POST['act_desc']),
                        'act_startdate' => trim($_POST['act_startdate']),
                        'act_enddate' => trim($_POST['act_enddate']),
                        'date_reg_start' => trim($_POST['date_reg_start']),
                        'date_reg_end' => trim($_POST['date_reg_end']),
                        'act_starttime' => trim($_POST['act_starttime']),
                        'act_endtime' => trim($_POST['act_endtime']),
                        'act_venue' => trim($_POST['act_venue']),
                        'max_participants' => trim($_POST['max_participants']),
                        'act_category' => trim($_POST['act_category'])

                    ];
                }
            }

            $data =
                [
                    'act_id' => $act_id,
                    'activity' => $activity,
                    'user_id' => $_SESSION['user_id'],
                    'act_title' => trim($_POST['act_title']),
                    'act_desc' => trim($_POST['act_desc']),
                    'act_startdate' => trim($_POST['act_startdate']),
                    'act_enddate' => trim($_POST['act_enddate']),
                    'date_reg_start' => trim($_POST['date_reg_start']),
                    'date_reg_end' => trim($_POST['date_reg_end']),
                    'act_starttime' => trim($_POST['act_starttime']),
                    'act_endtime' => trim($_POST['act_endtime']),
                    'act_venue' => trim($_POST['act_venue']),
                    'act_category' => trim($_POST['act_category']),
                    'max_participants' => trim($_POST['max_participants']),
                    'act_image' => $location

                ];

            if ($data['act_title'] && $data['act_desc'] && $data['act_startdate'] && $data['act_enddate'] && $data['date_reg_start'] && $data['date_reg_end'] && $data['act_starttime'] && $data['act_endtime'] && $data['act_venue'] && $data['act_image']) {
                if ($this->activityModel->updateActivity($data, $act_id)) {
                    header("Location: " . URLROOT . "/activities");
                } else {
                    die("Something went wrong :(");
                }
            } else {
                $this->view('activities/index', $data);
            }
        }

        $this->view('activities/index', $data);
    }

    public function delete($act_id)
    {
        $activity = $this->activityModel->findActivityById($act_id);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->activityModel->deleteActivity($act_id)) {
                header("Location: " . URLROOT . "/activities");
            } else {
                die('Something went wrong..');
            }
        }
    }

    public function join($act_id)
    {
        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/activities");
            exit();
        }

        $activity = $this->activityModel->findActivityById($act_id);

        // Redirect if the user is the owner of the activity
        if ($activity->user_id == $_SESSION['user_id']) {
            header("Location: " . URLROOT . "/activities");
            exit();
        }

        // Check if registration is ended or activity is full
        if ($this->activityModel->isRegistrationEnded($act_id, $activity->date_reg_end)) {
            echo '<script>alert("Registration has ended.")</script>';
            echo '<script>window.location.href = "http://localhost/mvcprojectnew/activities";</script>';
        } else if ($this->activityModel->isActivityFull($act_id, $activity->max_participants)) {
            echo '<script>alert("The activity is full.")</script>';
            echo '<script>window.location.href = "http://localhost/mvcprojectnew/activities";</script>';
        } else if ($this->activityModel->isStudentJoined($_SESSION['user_id'], $act_id)) {
            echo '<script>alert("You have already joined this activity.")</script>';
            echo '<script>window.location.href = "http://localhost/mvcprojectnew/activities";</script>';
        } else if ($this->activityModel->isRegistrationStarted($act_id, $activity->date_reg_start)) {
            echo '<script>alert("Registration has not started yet.")</script>';
            echo '<script>window.location.href = "http://localhost/mvcprojectnew/activities";</script>';
        } else {
            // Perform the join operation
            if ($this->activityModel->joinActivity($act_id, $_SESSION['user_id'])) {
                echo '<script>alert("You have successfully joined the activity.")</script>';
                echo '<script>window.location.href = "http://localhost/mvcprojectnew/activities";</script>';
            } else {
                die("Something went wrong :(");
            }
        }
    }

    public function joined()
    {
        if (!isLoggedIn() || $_SESSION['user_role'] !== "Student") {
            header("Location: " . URLROOT . "/activities");
            exit();
        }

        // Fetch activities that the current student has joined
        $joinedActivities = $this->activityModel->getJoinedActivities($_SESSION['user_id']);

        $data = [
            'joinedActivities' => $joinedActivities,
        ];


        $this->view('activities/index', $data);
        
    }
}
