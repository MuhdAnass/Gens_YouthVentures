<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Create Activity</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/activities" class="btn btn-light-primary">Manage Activities</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/activities/update/<?php echo $data['activity']->act_id ?>" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Activity </label>
                <input type="text" name="act_title" class="form-control form-control-solid" value="<?php echo $data['activity']->act_title ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Description</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="act_desc" class="form-control" aria-label="With textarea" required><?php echo $data['activity']->act_desc ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>