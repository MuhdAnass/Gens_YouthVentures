<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Create Badge</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/badges/create" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Badge </label>
                <input type="text" name="badge_title" class="form-control form-control-solid" placeholder="Badge name" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Badge Description</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="badge_desc" class="form-control" aria-label="With textarea" required></textarea>
                </div>
            </div>

            

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Upload Image</label>
                <input type="file" name="badge_img" class="form-control" accept="image/*">
            </div>


            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>