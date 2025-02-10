<?php
session_start();
if(isset($_SESSION['seller_id'])){
    echo "
    <script>
    window.location.href = 'Seller-Profile';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>Zeroed - Signup</title>
    <?php include ('include/css.php')?>
</head>

<body>
<!-- Header -->
<?php include ('include/header.php');?>


<div class="container flex items-center justify-center min-h-screen mt-5" style="height: 100vh;">
    <div class="grid sm:grid-cols-2 mt-5">
        <section class="form_login lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <img src="assets/images/new/signup2.png"/>
                </div>
            </div>
        </section>
        <section class="form_register lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <div id="candidate" class="tab_list active" role="tabpanel" aria-labelledby="tab_candidate" aria-hidden="false">
                        <form action="Insert" method="post" class="form mt-6">
                            <div class="form-group">
                                <label for="username">Email address*</label>
                                <input id="username" type="email" name="email" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Email address*" required />
                            </div>
                            <div class="form-group mt-6">
                                <label for="password">Password*</label>
                                <input id="password" type="password" name="password" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Password*" required />
                                <span id="password_error" style="color: red; display: none;">Minimum length of the password should be 8 characters.</span>
                            </div>
                            <div class="form-group mt-6">
                                <label for="confirmPassword">Confirm password*</label>
                                <input id="confirmPassword" type="password" name="confirmPassword" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Confirm password*" required />
                                <span id="candidate_error" style="color: red; display: none;">Password and confirm password have not matched</span>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <div class="sub-input-checkbox flex items-center gap-2">
                                    <input id="checkbox" type="checkbox" name="checkbox" required/>
                                    <label for="checkbox" class="text-surface1">I agree to the <a href="Terms" target="_blank" class="text-button hover:underline">Terms of User</a></label>
                                </div>
                            </div>
                            <div class="block-button mt-6">
                                <button class="button-main bg-primary w-full text-center" type="submit" id="candidate_signUp" name="candidate_signup">Create a new account</button>
                            </div>
                            <div class="navigate flex items-center justify-center gap-2 mt-6">
                                <span class="text-surface1">Already have an account?</span>
                                <a class="text-button hover:underline" href="Login">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Form Register -->


<?php include ('include/footer.php');?>

<?php include ('include/mobile_menu.php');?>

<?php include ('include/script.php');?>

<script>
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("confirmPassword");
    const errorSpan = document.getElementById("candidate_error");
    const error = document.getElementById("password_error");
    const submitButton = document.getElementById("candidate_signUp");

    function passwordLength() {
        const password = passwordField.value;
        const isPasswordValid = password.length >= 8;

        if (isPasswordValid) {
            error.style.display = "none";
            submitButton.disabled = false;
        } else {
            error.style.display = "block";
            submitButton.disabled = true;
        }
    }

    function validatePasswords() {
        const password = passwordField.value;
        const confirmPassword = confirmPasswordField.value;

        // Check if password length is at least 8 characters
        const isPasswordValid = password.length >= 8;

        // Check if passwords match
        const doPasswordsMatch = password === confirmPassword;

        if (isPasswordValid && doPasswordsMatch) {
            errorSpan.style.display = "none";
            submitButton.disabled = false;
            submitButton.classList.remove("disabled-btn");
        } else {
            errorSpan.style.display = "block";
            submitButton.disabled = true;
            submitButton.classList.add("disabled-btn");
        }
    }

    // Add event listeners to input fields
    passwordField.addEventListener("input", passwordLength);
    confirmPasswordField.addEventListener("input", validatePasswords);
</script>
</body>

</html>
