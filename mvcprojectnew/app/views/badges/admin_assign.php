<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Create Badge</h3>
        <div class="card-toolbar">
            <?php if (isLoggedIn()) : ?>
                <a href="<?php echo URLROOT; ?>/badges" class="btn btn-light-primary"><i class="fa fa-home"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">

        <!-- admin_assign_badge.php -->
        <form action="<?php echo URLROOT; ?>/badges/admin_assign" method="POST">
            <label for="student">Select Student:</label>
            <select name="student" id="student">
                <?php foreach ($students as $student) : ?>
                    <option value="<?php echo $student->student_id; ?>"><?php echo $student->student_name; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="badge">Select Badge:</label>
            <select name="badge" id="badge">
                <?php foreach ($badges as $badge) : ?>
                    <option value="<?php echo $badge->badge_id; ?>"><?php echo $badge->badge_title; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Assign Badge</button>
        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>