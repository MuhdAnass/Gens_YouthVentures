 <?php
    require APPROOT . '/views/includes/head_metronic.php';
    ?>

 <?php
    require APPROOT . '/views/includes/begin_app.php';
    ?>


 <!--begin::Content-->
 <div id="kt_app_content" class="app-content flex-column-fluid">
     <!--begin::Content container-->
     <div id="kt_app_content_container" class="app-container container-fluid">
         <!--begin::Row-->


         <!--------------------------start adjust here------------------------------------------------------------>

         <div class="card shadow-sm">
             <div class="card-header">
                 <h3 class="card-title">Your Dashboard</h3>
                 <div class="card-toolbar">
                     <!-- if want to put toolbar-->
                 </div>
             </div>
             <div class="card-body">

                 <!--------------------------------------------------------------------------------->

                 <?php require APPROOT . '/views/dashboard/index.php'   ?>

                 <!--------------------------------------------------------------------------------->

             </div>
             <div class="card-footer">
                 Footer
             </div>
         </div>

         <!--------------------------end adjust here------------------------------------------------------------>




         <!--end::Row-->
     </div>
     <!--end::Content container-->
 </div>
 <!--end::Content-->

 <?php
    require APPROOT . '/views/includes/end_app.php';
    ?>



 <?php
    require APPROOT . '/views/includes/footer_metronic.php';
    ?>