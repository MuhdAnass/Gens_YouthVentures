<?php

class Badges extends Controller
{

    public function __construct()
    {
        $this->badgeModel = $this->model('Badge');
    }

    public function index()
    {
        $badges = $this->badgeModel->manageAllBadges();

        $data = [

            'badges' => $badges


        ];

        $this->view('badges/index', $data);
    }

    public function create()
    {

        if (!isLoggedIn()) {

            header("Location: " . URLROOT . "/badges");
        }


        $data =
            [
                'badge_title' => '',
                'badge_desc' => '',
                'badge_img' => ''

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
                    header("Location: " . URLROOT . "/pages/edit_profile");
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                    header("Location: " . URLROOT . "/pages/edit_profile");
                }
                $location = "images/badges/" . $username;

                if (in_array($filetype, $allowed)) {

                    if (file_exists($location . $filename)) {
                        echo $filename . " is already exists.";
                    } else {

                        # create directory if not exists in upload/ directory
                        if (!is_dir($location)) {
                            //mkdir($location, 0755);
                            mkdir('images/badges/' . $username, 0777, true);
                        }

                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                        $location .= "/" . $fileNameNew;

                        move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    }
                } else {
                    $_SESSION['failed'] = "Error: There was an error uploading your file!";
                    header("Location: " . URLROOT . "/badges/create");
                }
            } else {

                $_SESSION['failed'] = "Error: There was an error uploading your file!";
                header("Location: " . URLROOT . "/badges/create");
            }
            $data =
                [
                    'user_id' => $_SESSION['user_id'],
                    'badge_title' => trim($_POST['badge_title']),
                    'badge_desc' => trim($_POST['badge_desc']),
                    'badge_img' => $location
                ];


            if ($data['badge_title'] && $data['badge_desc'] && $data['badge_img']) {
                if ($this->badgeModel->addBadge($data)) {
                    header("Location: " . URLROOT . "/badges");
                } else {
                    die("Something went wrong :(");
                }
            } else {
                $this->view('badges/index', $data);
            }
        }

        $this->view('badges/index', $data);
    }

    public function update($id)
    {
        $badge = $this->badgeModel->findBadgeById($id);

        if (!isLoggedIn()) {
            header("Location: " . URLROOT . "/badges");
            exit; // Ensure to stop script execution after header redirect
        }

        $data = [
            'badge' => $badge,
            'badge_title' => '',
            'badge_desc' => '',
            'badge_img' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Check if file was uploaded without errors
            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

                // Process file upload logic
                $filename = $_FILES["file"]["name"];
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];

                $fileExt = explode('.', $filename);
                $fileActualExt = strtolower(end($fileExt));

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) {
                    $_SESSION['failed'] = "Error: You cannot upload files of this type!";
                    header("Location: " . URLROOT . "/badges/create");
                    exit; // Ensure to stop script execution after header redirect
                }

                $username = $_SESSION['email'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                    header("Location: " . URLROOT . "/badges/create");
                    exit; // Ensure to stop script execution after header redirect
                }

                $location = "images/badges/" . $username;

                if (in_array($filetype, $allowed)) {
                    if (!is_dir($location)) {
                        mkdir($location, 0777, true);
                    }

                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $location .= "/" . $fileNameNew;
                    move_uploaded_file($_FILES['file']['tmp_name'], $location);

                    // Update $data with the new file information
                    $data['badge_img'] = $location;
                } else {
                    $_SESSION['failed'] = "Error: There was an error uploading your file!";
                    header("Location: " . URLROOT . "/badges/create");
                    exit; // Ensure to stop script execution after header redirect
                }
            }

            // Update other form data
            $data['badge_title'] = trim($_POST['badge_title']);
            $data['badge_desc'] = trim($_POST['badge_desc']);

            // Ensure to include badge_id in data array
            $data['badge_id'] = $id;

            // Use the correct check for the update_badge field
            if (isset($_POST['update_badge'])) {
                if ($this->badgeModel->updateBadge($data)) {
                    header("Location: " . URLROOT . "/badges");
                    exit; // Ensure to stop script execution after header redirect
                } else {
                    die("Something went wrong :(");
                }
            }
        }

        $this->view('badges/index', $data);
    }



    public function delete($badge_id)
    {
        $badge = $this->badgeModel->findBadgeById($badge_id);

        if (!isLoggedIn()) {

            header("Location: " . URLROOT . "/badges");
        }

        $data =
            [
                'badge' => $badge,
                'badge_title' => '',
                'badge_desc' => '',
                'badge_img' => ''
            ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($this->badgeModel->deleteBadge($badge_id)) {
                header("Location: " . URLROOT . "/badges");
            } else {
                die('Something went wrong..');
            }
        }
    }

    // AdminController.php
    public function assignBadge()
    {
        // Load the necessary models
        $studentModel = $this->model('Student');
        $badgeModel = $this->model('Badge');

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming you have proper validation for $_POST values

            $studentId = $_POST['student'];
            $badgeId = $_POST['badge'];

            // Assign the badge to the student
            if ($studentModel->assignBadge($studentId, $badgeId)) {
                // Successfully assigned
                // Redirect or show success message
            } else {
                // Failed to assign
                // Redirect or show error message
            }
        } else {
            // Load students and badges to display in the form
            $students = $studentModel->getAllStudents();
            $badges = $badgeModel->getAllBadges();

            // Pass the data to the view
            $data = [
                'students' => $students,
                'badges' => $badges,
            ];

            // Load the view
            $this->view('admin/assign_badge', $data);
        }
    }
}
