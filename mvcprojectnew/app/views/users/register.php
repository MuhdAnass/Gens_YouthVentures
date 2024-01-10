<?php require APPROOT . '/views/includes/head.php'; ?>

<div class="navbar">
    <?php require APPROOT . '/views/includes/navigation.php'; ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2 style="font-family: 'Arial', sans-serif; color: #333;">Register</h2>

        <form id="register-form" method="POST" action="<?php echo URLROOT; ?>/users/register">
            <input type="text" placeholder="Full Name *" name="fullname" class="input-field">
            <span class="invalid-feedback"><?php echo $data['usernameError']; ?></span>

            <input type="text" placeholder="Username *" name="username" class="input-field">
            <span class="invalid-feedback"><?php echo $data['usernameError']; ?></span>

        

            <input type="email" placeholder="Email *" name="email" class="input-field">
            <span class="invalid-feedback"><?php echo $data['emailError']; ?></span>

            <input type="password" placeholder="Password *" name="password" class="input-field">
            <span class="invalid-feedback"><?php echo $data['passwordError']; ?></span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword" class="input-field">
            <span class="invalid-feedback"><?php echo $data['confirmPasswordError']; ?></span>

            <label for="userRole">User Role: </label>
            <select id="userRole" name="user_role" required>
                <option value="Student">Student</option>
                <option value="Client">Client</option>
            </select>

            <button id="submit" type="submit" value="submit" class="submit-button">Submit</button>

            <p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an account!</a></p>
        </form>
    </div>
</div>
