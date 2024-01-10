<?php 

class Badges extends Controller{

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

        
        $data = 
        [
            'badge_title' => '',
            'badge_desc' => '',
            'badge_img' => ''

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


            if ($data['badge_title'] && $data['badge_desc'] && $data['badge_img']){
                if ($this->badgeModel->addBadge($data)){
                    header("Location: " . URLROOT. "/badges" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('badges/index', $data);
            }
        }
        
        $this->view('badges/index', $data);
    }

    public function update($id)
    {
        $badge = $this->badgeModel->findBadgeById($id);


        $data = 
        [
            'badge' => $badge,
            'badge_title' => '',
            'badge_desc' => '',
            'badge_img' => ''
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

             // $_POST['update_student'] hidden value from form
           if ($_POST['update_badge']) {

            if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {  //statement unbtuk update gambar (nanti ic,name semua) takkan hilang

                $data = [


                    'user_id' => $_SESSION['user_id'],
                    'badge_title' => trim($_POST['badge_title']),
                    'badge_desc' => trim($_POST['badge_desc']),
                    'badge_img' => $location

                ];

            }else{  //statement kalau taknak update gambar

                $data = [

                    'user_id' => $_SESSION['user_id'],
                    'badge_title' => trim($_POST['badge_title']),
                    'badge_desc' => trim($_POST['badge_desc']),
                    
           
                ];
            }
        }
        
            $data = 
            [
            'badge_id' => $id,
            'badge' => $badge,
            'user_id' => $_SESSION['user_id'],
            'badge_title' => trim($_POST['badge_title']),
            'badge_desc' => trim($_POST['badge_desc']),
            'badge_img' => $location
    
            ];


            if (empty($data['badge_title'] && $data['badge_desc'] && $data['badge_img'])){
                if ($this->badgeModel->updateBadge($data)){
                    header("Location: " . URLROOT. "/badges" );
                }
                else
                {
                    die("Something went wrong :(");
                }
            }
            else
            {
                $this->view('badges/index', $data);
            }
        }

        $this->view('badges/index', $data);
    }
    
    
    public function delete($badge_id)
    {
        $badge = $this->badgeModel->findBadgeById($badge_id);

        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($this->badgeModel->deleteBadge($badge_id)){
                header("Location: " . URLROOT . "/badges");
            }
            else
            {
                die('Something went wrong..');
            }

        }

        
        
    }

}


?>