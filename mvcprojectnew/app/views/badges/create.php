<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Create Badge</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">


        <form action="<?php echo URLROOT; ?>/badges/create" method="POST" enctype="multipart/form-data">
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
            <label class="col-lg-4 col-form-label fw-semibold fs-6">Image</label>
            <div class="col-lg-8">
                <div class="image-input image-input-outline" data-kt-image-input="true">
                    <div class="image-input-wrapper w-125px h-125px"></div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="ki-duotone ki-pencil fs-7"></i>
                        <input type="file" name="file" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="profile_avatar_remove" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="ki-duotone ki-cross fs-2"></i>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
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