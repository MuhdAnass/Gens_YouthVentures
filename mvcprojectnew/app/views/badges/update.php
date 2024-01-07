<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Update Activity</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/badges/update/<?php echo $data['badge']->badge_id ?>" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Badge </label>
                <input type="text" name="act_title" class="form-control form-control-solid" value="<?php echo $data['badge']->badge_title ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Upload Image </label>
                <input type="file" name="act_image" class="form-control" accept="image/*" value="<?php echo $data['badge']->badge_img ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Badge Description</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="act_desc" class="form-control" aria-label="With textarea" required><?php echo $data['badge']->badge_desc ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>