<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->


        <!--Content area here-->
        <?php
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                        $url = "https://";
                    else
                        $url = "http://";
                    // Append the host(domain name, ip) to the URL.   
                    $url .= $_SERVER['HTTP_HOST'];

                    // Append the requested resource location to the URL   
                    $url .= $_SERVER['REQUEST_URI'];
                    
                    ?>

        <?php

                    $c_url = URLROOT . "/activities"; 
                    $t_url = URLROOT . "/activities/create"; 
                    $u_url = '';            
                    $f_url = URLROOT . "/activities/joined";   
                    
                    
                
                    if (isset($data['activity']) && is_object($data['activity'])) {
                    $u_url = URLROOT . "/activities/update/".$data['activity']->act_id;
                    $f_url = URLROOT . "/activities/form".$data['activity']->act_id; 
                    }
                    
                   $userRole = $_SESSION['user_role']; //student/client/admin

                    //error_reporting(0);
                if ($userRole == 'Client' || $userRole == 'Admin'){

                    if ($url == $c_url) {
        
                        require 'manage.php';

                    }elseif($url == $t_url){

                        require 'create.php';

                    }elseif($url == $u_url){

                        require 'update.php';

                    }else{


                    }
                }elseif ($userRole == 'Student'){

                    if ($url == $c_url) {
        
                        require 'manage.php';

                    }elseif($url == $f_url){

                        require 'joined.php';

                    }
                }

                    ?>

        <!--end::Row-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->


