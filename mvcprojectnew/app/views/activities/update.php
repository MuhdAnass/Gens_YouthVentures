<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Update Activity</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
                <a href="<?php echo URLROOT . "/activities/update/" . $data['activity']->act_id ?>" ></a>

            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/activities/update/<?php echo $data['activity']->act_id ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="update_activity" value="1" />

            
        
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Activity </label>
                <input type="text" name="act_title" class="form-control form-control-solid" value="<?php echo $data['activity']->act_title ?>" required />
            </div>

            <div class="mb-10">
                <label for="starDate" class="required form-label">Start Date </label>
                <input type="date" name="act_startdate" class="form-control form-control-solid" value="<?php echo $data['activity']->act_startdate ?>" required />
            </div>

            <div class="mb-10">
                <label for="endDate" class="required form-label">End Date </label>
                <input type="date" name="act_enddate" class="form-control form-control-solid" value="<?php echo $data['activity']->act_enddate ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Date Registration Start</label>
                <input type="date" name="date_reg_start" class="form-control form-control-solid" value="<?php echo date('Y-m-d', strtotime($data['activity']->date_reg_start)); ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Date Registration End</label>
                <input type="date" name="date_reg_end" class="form-control form-control-solid" value="<?php echo date('Y-m-d', strtotime($data['activity']->date_reg_end)); ?>" required />
            </div>

            <div class="mb-10">
                <label for="startTime" class="required form-label">Start Time </label>
                <input type="time" name="act_starttime" class="form-control form-control-solid" value="<?php echo $data['activity']->act_starttime ?>" required />
            </div>

            <div class="mb-10">
                <label for="endTime" class="required form-label">End Time </label>
                <input type="time" name="act_endtime" class="form-control form-control-solid" value="<?php echo $data['activity']->act_endtime ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Venue </label>
                <input type="text" name="act_venue" class="form-control form-control-solid" value="<?php echo $data['activity']->act_venue ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Maximum Participants</label>
                <input type="number" name="max_participants" class="form-control form-control-solid" value="<?php echo $data['activity']->max_participants; ?>" required />
            </div>

            

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="act_desc" class="form-control" aria-label="With textarea" required><?php echo $data['activity']->act_desc ?></textarea>
                </div>
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Category</label>
                <select name="act_category" class="form-select form-select-solid" aria-label="Choose One" required <?php echo $data['activity']->act_category ?>>
                    <option value="" disabled selected>Choose One</option>
                    <option value="Competition / Scholarship">Competition / Scholarship </option>
                    <option value="Program / Activities">Program / Activities</option>
                    <option value="Bootcamp / Workshop">Bootcamp / Workshop</option>
                    <option value="Part Time">Part Time/Volunteering</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>

            <div class="mb-10">
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Image</label>
            <div class="col-lg-8">
                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('<?php echo URLROOT."/public/".$data['activity']->act_image; ?>')">
                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('<?php echo URLROOT."/public/".$data['activity']->act_image; ?>')"></div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                        <i class="ki-duotone ki-pencil fs-7"></i>
                        <input type="file" name="file" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="profile_avatar_remove" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                        <i class="ki-duotone ki-cross fs-2"></i>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                        <i class="ki-duotone ki-cross fs-2"></i>
                    </span>
                </div>
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
            </div>
        </div>

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>