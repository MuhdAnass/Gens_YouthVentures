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
            $data = 
            [
            'user_id' => $_SESSION['user_id'],
            'badge_title' => trim($_POST['badge_title']),
            'badge_desc' => trim($_POST['badge_desc']),
            'badge_img' => trim($_POST['badge_img'])
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
            $data = 
            [
            'badge_id' => $id,
            'badge' => $badge,
            'user_id' => $_SESSION['user_id'],
            'badge_title' => trim($_POST['badge_title']),
            'badge_desc' => trim($_POST['badge_desc']),
            'badge_img' => trim($_POST['badge_img'])
    
            ];


            if (empty($data['titleError'] && $data['bodyError'])){
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