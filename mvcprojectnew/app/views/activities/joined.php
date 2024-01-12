<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Activity Joined</h3>
        <div class="card-toolbar">
        </div>
    </div>

    

    <div class="card-body">
        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>No.</th>
                        
                        <th>Activity's Name</th>
                        <th>Registration Date</th>
                        <th>Activity Date</th>
                        <th>Venue</th>
                        <th>Description</th>
                        <th>Participants</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($data['joinedActivities'] as $index => $activity): ?>
                    
                        <tr>
                            <td><?php echo $index + 1 ?></td>
                           
                            <td><?php echo $activity->act_title; ?></td>
                            <td><?php echo date('d/m/y ', strtotime($activity->date_reg_start)); ?> - <?php echo date('d/m/y ', strtotime($activity->date_reg_end)); ?></td>
                            <td><?php echo date('d/m/y ', strtotime($activity->act_startdate)); ?> - <?php echo date('d/m/y ', strtotime($activity->act_enddate)); ?></td>
                            <td><?php echo $activity->act_venue; ?></td>
                            <td><?php echo $activity->act_desc; ?></td>
                            <td><?php echo $this->activityModel->getParticipantNumber($activity->act_id); ?> / <?php echo $activity->max_participants; ?></td>
                            <td> <button class="btn btn-info" disabled>Joined</button>
                             <a href="<?php echo URLROOT . "/activities/form/" . $activity->act_id ?>" class="btn btn-light-warning">Feedback</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                var table = $('#kt_datatable_posts').DataTable({
                    "pageLength": 10, // set the initial page length as desired
                });

                // Add event listener for category filter change
                $('#categoryFilter').on('change', function () {
                    var selectedCategory = $(this).val();
                    table.columns(1).search(selectedCategory).draw(); // assuming category is in the second column
                });
            });
        </script>
    </div>
    <div class="card-footer">
        Footer
    </div>
</div>
