<?php
class Activities extends Controller{
    public function __construct(){
        $this->activityModel = $this->model('Activity');
    }

    public function index(){
        $activities = $this->activityModel->manageAllActivities();

        $data= [

            'activities' => $activities

        ];

        $this->view('activities/index', $data);
    }

    public function create()
    {
        
        $data = 
        [
            'act_title' => '',
            'act_desc' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'user_id' => $_SESSION['user_id'],
            'act_title' => trim($_POST['act_title']),
            'act_desc' => trim($_POST['act_desc']),
            'act_datetime' => date('Y-m-d H:i:s')
            ];


            if ($data['act_title'] && $data['act_desc']){
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

    public function update($act_id)
    {
        $activity = $this->activityModel->findActivityById($act_id);


        $data = 
        [
            'activity' => $activity,
            'act_title' => '',
            'act_desc' => '',
    
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = 
            [
            'act_id' => $act_id,
            'activity' => $activity,
            'user_id' => $_SESSION['user_id'],
            'act_title' => trim($_POST['act_title']),
            'act_desc' => trim($_POST['act_desc']),
          
            ];


            if ($data['act_title'] && $data['act_desc']){
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