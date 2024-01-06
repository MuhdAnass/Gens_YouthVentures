<!-- dashboard/index.php -->


<h1>Dashboard Content</h1>

<?php



// Create an instance of Database
$getTotalAct = new Database();
$getTotalUser = new Database();
$getNumofStud = new Database();
$getNumofClient = new Database();


// Prepare and execute a query
$getTotalAct->query("SELECT * FROM activities");
$getTotalUser->query("SELECT * FROM users");
$getNumofStud ->query("SELECT * FROM users WHERE user_role = 'Student'");
$getNumofClient ->query("SELECT * FROM users WHERE user_role = 'client'");

// execution
$getTotalAct->execute();
$getTotalUser->execute();
$getNumofStud->execute();
$getNumofClient->execute();

// Fetch data
$Total_activity = $getTotalAct->rowCount();
$Total_user = $getTotalUser->rowCount();
$NumofStudent = $getNumofStud->rowCount();
$NumofClient = $getNumofClient->rowCount();

// Process data

//------------calculate percentage-------------------------//

$Stud = number_format(($NumofStudent/$Total_user)*100,2);
$Client = number_format(($NumofClient/$Total_user)*100,2);

//------------calculate percentage-------------------------//

?>



<?php
// Sample code for memory usage tracking
echo "Peak memory usage: " . (memory_get_peak_usage(true) / (1024 * 1024)) . " MB";
?>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid align-items-center justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px ">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-user fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Wrapper-->

                        <!--end::Wrapper-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-center justify-content-center">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column text-center">
                        <span class="fw-bolder fs-2x text-gray-900 "><?php echo $Total_user ?></span>
                        <span class="fw-bold fs-5 text-gray-500">User Registered</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid align-items-center justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px ">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-coffee fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Wrapper-->

                        <!--end::Wrapper-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-center justify-content-center">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column text-center">
                        <span class="fw-bolder fs-2x text-gray-900"><?php echo $Total_activity ?></span>
                        <span class="fw-bold fs-5 text-gray-500">Activity Registered</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid align-items-center justify-content-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px ">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-apple fs-2x text-gray-800"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Wrapper-->

                        <!--end::Wrapper-->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-center justify-content-center">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column text-center">
                        <span class="fw-bolder fs-2x text-gray-900">$45,142.00</span>
                        <span class="fw-bold fs-5 text-gray-500">SAP UI Progress</span>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--------------------------------------------------1st chart----------------------------------------------------------------------------------->

    <div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Card widget 28-->
            <div class="card card-flush">
                <!--begin::Header-->
                <div class="card-header pt-2">
                    <!--begin::Card title-->
                    <div class="card-title flex-stack flex-row-fluid align-items-center justify-content-center">
                        <!-- Add any header content here if needed -->
                    </div>
                    <!--end::Header-->
                </div>
                <!--end::Card title-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-center justify-content-center">
                    <!-- Place the chart container inside the card body -->
                    <div id="kt_docs_google_chart_pie" style="height: 300px; width: 100%;"></div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 28-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>

<!-- Include the script after the card -->
<head>
    <!-- Include the Google Charts library -->
    <script src="//www.google.com/jsapi"></script>
</head>
<body>
    <!-- Your JavaScript scripts -->
    <script>
        // Google Charts initialization
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['user', 'Percentage'],
                ['Students', <?php echo $NumofStudent ?>],
                ['Clients',<?php echo $NumofClient ?>],

            ]);

            var options = {
                title: 'Distribution of Clients and Students',
                colors: ['#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1']
            };

            var chart = new google.visualization.PieChart(document.getElementById('kt_docs_google_chart_pie'));
            chart.draw(data, options);
        }
    </script>
</body>

<!--------------------------------------------------end 1st chart----------------------------------------------------------------------------------->


<!--------------------------------------------------2nd chart----------------------------------------------------------------------------------->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChartJS Example</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Chart container -->
    <canvas id="kt_chartjs_2" width="400" height="200"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('kt_chartjs_2');

            // Define colors
            var primaryColor = '#4CAF50'; // Replace with your color variable or value
            var dangerColor = '#FF5722'; // Replace with your color variable or value

            // Define fonts
            var fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';

            // Chart labels
            const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];

            // Sample data for two bars in each month
            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Dataset 1',
                        backgroundColor: primaryColor,
                        data: [10, 20, 15, 25, 30, 18, 22],
                    },
                    {
                        label: 'Dataset 2',
                        backgroundColor: dangerColor,
                        data: [15, 25, 20, 30, 35, 28, 32],
                    },
                ],
            };

            // Chart config
            const config = {
                type: 'bar',
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: false,
                        },
                    },
                    responsive: true,
                },
                defaults: {
                    global: {
                        defaultFont: {
                            family: fontFamily,
                        },
                    },
                },
            };

            // Init ChartJS
            var myChart = new Chart(ctx, config);
        });
    </script>
</body>
</html>

<!--------------------------------------------------end 2nd chart----------------------------------------------------------------------------------->