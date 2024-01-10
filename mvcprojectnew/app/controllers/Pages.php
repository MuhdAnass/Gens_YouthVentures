<?php
class Pages extends Controller {

    public function __construct()
    {
        $this->pageModel = $this->model('Page');
    }


    public function index() {
        $data = [
            'title' => 'Home page'
        ];

        $this->view('index', $data);
    }

    public function edit_profile()
    {

        //check for post from form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { //if server request open

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

                $username = $_SESSION['username'];
                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize){
                    $_SESSION['failed'] = "Error: File size is larger than the allowed limit.";
                            header("Location: " . URLROOT . "/pages/edit_profile");
                } 
                $location = "images/users/" . $username;

                if (in_array($filetype, $allowed)) {

                    if (file_exists($location . $filename)) {
                        echo $filename . " is already exists.";
                    } else {
                        
                            # create directory if not exists in upload/ directory
                            if (!is_dir($location)) {
                                //mkdir($location, 0755);
                                mkdir('images/users/' . $username, 0777, true);
                            }

                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                            $location .= "/" . $fileNameNew;

                            move_uploaded_file($_FILES['file']['tmp_name'], $location);
                    }
                } else {
                    $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/pages/edit_profile");
                }
            } else {

                $_SESSION['failed'] = "Error: There was an error uploading your file!";
                        header("Location: " . URLROOT . "/pages/edit_profile");
              
            }

            // $_POST['update_student'] hidden value from form
           if ($_POST['update_student']) {

                if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {  //statement unbtuk update gambar (nanti ic,name semua) takkan hilang

                    $data = [


                        'st_ic' => trim($_POST['st_ic']),
                        'st_email' => trim($_POST['st_email']),
                        'st_fullname' => trim($_POST['st_fullname']),
                        'st_gender' => trim($_POST['st_gender']),
                        'st_race' => trim($_POST['st_race']),
                        'univ_code' => trim($_POST['univ_code']),
                        'st_address' => trim($_POST['st_address']),
                        'st_image' => $location
    
                    ];

                }else{  //statement kalau taknak update gambar

                    $data = [

                        'st_ic' => trim($_POST['st_ic']),
                        'st_email' => trim($_POST['st_email']),
                        'st_fullname' => trim($_POST['st_fullname']),
                        'st_gender' => trim($_POST['st_gender']),
                        'st_race' => trim($_POST['st_race']),
                        'univ_code' => trim($_POST['univ_code']),
                        'st_address' => trim($_POST['st_address']),
               
                    ];
                }

            }

            //var_dump($data);

          if ($_POST['update_student']) {
                if ($this->pageModel->updateStudentProfile($data)) {
                    header("Location: " . URLROOT . "/pages/edit_profile");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('pages/index');
            }
        } // end of if statement 

        $studentProfile = $this->pageModel->studentProfile();

        $data = [
            'studentProfile' => $studentProfile
        ];

        $this->view('pages/index', $data);
    }
}
