<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Manage Activities</h3>
        <div class="card-toolbar">
            <?php if (isLoggedIn() && $_SESSION['user_role'] !== "Student") : ?>
                <a href="<?php echo URLROOT; ?>/activities/create" class="btn btn-light-primary">Create</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="kt_datatable_posts" class="table table-striped table-hover table-responsive">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Date registration</th>
                        <th>Venue</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Max Participants</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['activities'] as $activity) : ?>
                        <tr>
                            <td><?php echo $activity->act_title; ?></td>
                            <td><?php echo $activity->act_startdate; ?><br>to<br><?php echo $activity->act_enddate; ?></td>
                            <td><?php echo $activity->act_starttime; ?><br>-<br><?php echo $activity->act_endtime; ?></td>
                            <td><?php echo $activity->date_reg_start; ?><br>to<br><?php echo $activity->date_reg_end; ?></td>
                            <td><?php echo $activity->act_venue; ?></td>
                            <td><img src="<?php echo URLROOT . "/public/" . $activity->act_image; ?>" alt="Activity Image" style="width: 100px; height: 100px;"></td>
                            <td><?php echo $activity->act_category; ?></td>
                            <td><?php echo $activity->max_participants; ?></td>


                            <td>
                               
                                    <?php if ($_SESSION['user_role'] !== "Student" ) : ?>
                                        <a href="<?php echo URLROOT . "/activities/update/" . $activity->act_id ?>" class="btn btn-light-warning">Update</a>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt<?php echo $activity->act_id ?>">
                                            Delete
                                        </button>
                                  

                                <?php elseif ($_SESSION['user_role'] == "Student") : ?>
                                    <?php if ($this->activityModel->isRegistrationEnded($activity->act_id, $activity->date_reg_end)) : ?>
                                        <button class="btn btn-secondary" disabled>Ended</button>
                                    <?php elseif ($this->activityModel->isStudentJoined($_SESSION['user_id'], $activity->act_id)) : ?>
                                        <button class="btn btn-success" disabled>Joined</button>
                                        <!-- Add additional button or modify existing button for joined student -->
                                        <!--- <a href="//echo URLROOT . "/activity/leave/" . $activity->act_id 
                                                        " class="btn btn-danger">Leave</a> -->
                                    <?php elseif ($this->activityModel->isRegistrationStarted($activity->act_id, $activity->date_reg_start)) : ?>
                                        <button class="btn btn-secondary" disabled>Not Started</button>
                                    <?php elseif ($this->activityModel->isActivityFull($activity->act_id)) : ?>
                                        <button class="btn btn-secondary" disabled>Full</button>
                                    <?php else : ?>
                                        <a href="<?php echo URLROOT . "/activities/join/" . $activity->act_id ?>" class="btn btn-light-warning" data-bs-toggle="modal" data-bs-target="#joinModal<?php echo $activity->act_id; ?>">Join</a>
                                    <?php endif; ?>
                                <?php endif; ?>



                                <?php if ($_SESSION['user_role'] !== "Student") : ?>
                                    <div class="modal fade" tabindex="-1" id="kt<?php echo $activity->act_id ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Delete Activity</h3>

                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>

                                                <div class="modal-body">
                                                    Are you sure want to delete this activity?
                                                </div>

                                                <div class="modal-footer">
                                                    <form action="<?php echo URLROOT . "/activities/delete/" . $activity->act_id; ?>" method="POST">
                                                        <input type="hidden" id="expenses" name="expenses" value="expenses">
                                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary font-weight-bold">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <?php if ($_SESSION['user_role'] == "Student") : ?>
                                    <!-- Add the modal for Join action -->
                                    <div class="modal fade" tabindex="-1" id="joinModal<?php echo $activity->act_id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Join Activity</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Activity Name:</strong> <?php echo $activity->act_title; ?></p>
                                                    <p><strong>Category:</strong> <?php echo $activity->act_category; ?></p>
                                                    <p><strong>Registration Date:</strong> <?php echo date('d/m/y ', strtotime($activity->date_reg_start)); ?> - <?php echo date('d/m/y ', strtotime($activity->date_reg_end)); ?>
                                                    <p><strong>Activity Date:</strong> <?php echo date('d/m/y', strtotime($activity->act_startdate)); ?></p>
                                                    <p><strong>Venue:</strong> <?php echo $activity->act_venue; ?></p>
                                                    <p><strong>Description:</strong> <?php echo $activity->act_desc; ?></p>
                                                    <p><strong>Participants:</strong> <?php echo $this->activityModel->getParticipantNumber($activity->act_id); ?> / <?php echo $activity->max_participants; ?></p>
                                                    <hr>
                                                    <p>Are you sure to join this activity?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">Cancel</button>
                                                    <a href="<?php echo URLROOT . "/activities/join/" . $activity->act_id ?>" class="btn btn-primary font-weight-bold">Join</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>


                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



        <script>
            $(document).ready(function() {
                var table = $('#kt_datatable_posts').DataTable({

                });
            });
        </script>



    </div>
    <div class="card-footer">
        Footer
    </div>
</div>