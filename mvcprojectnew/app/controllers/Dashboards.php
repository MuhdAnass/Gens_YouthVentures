<?php
class Dashboards extends Controller{

        public function __construct()
        {
            $this->dashboardModel = $this->model('Dashboard');
        }

        public function index()
        {
            $activities = $this->dashboardModel->fetchDataAct();

            $data = [

                'activities' => $activities
            ];

            $this->view('dashboard/index', $data);
        }

}

?>