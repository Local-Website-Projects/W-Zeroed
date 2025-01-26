<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from freelanhub.vercel.app/Register by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 25 Jan 2025 07:12:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
    <title>FreelanHub - Job Board & Freelance Marketplace</title>
    <?php include ('include/css.php')?>
</head>

<body>
<!-- Header -->
<?php include ('include/header.php');?>

<!-- Breadcrumb -->
<section class="breadcrumb">
    <div class="breadcrumb_inner relative sm:mt-20 mt-16 lg:py-20 py-14">
        <div class="breadcrumb_bg absolute top-0 left-0 w-full h-full">
            <img src="assets/images/components/breadcrumb_candidate.webp" alt="breadcrumb_candidate" class="w-full h-full object-cover" />
        </div>
        <div class="container relative h-full">
            <div class="breadcrumb_content flex flex-col items-start justify-center xl:w-[1000px] lg:w-[848px] md:w-5/6 w-full h-full">
                <div class="list_breadcrumb flex items-center gap-2 animate animate_top" style="--i: 1">
                    <a href="Home" class="caption1 text-white">Home</a>
                    <span class="caption1 text-white opacity-40">/</span>
                    <span class="caption1 text-white opacity-60">Register</span>
                </div>
                <h3 class="heading3 text-white mt-2 animate animate_top" style="--i: 2">Register</h3>
            </div>
        </div>
    </div>
</section>

<!-- Form Register -->
<section class="form_register lg:py-20 sm:py-14 py-10">
    <div class="container flex items-center justify-center">
        <div class="content sm:w-[448px] w-full">
            <h3 class="heading3 text-center">Create a free account</h3>
            <div class="menu_tab w-full mt-8">
                <ul class="list grid grid-cols-2 gap-5 w-full" role="tablist">
                    <li role="presentation">
                        <button class="tab_btn -fill -fill-primary w-full py-3 text-button text-center rounded bg-surface duration-300 hover:text-primary active" id="tab_candidate" role="tab" aria-controls="candidate" aria-selected="true">Candidate</button>
                    </li>
                    <li role="presentation">
                        <button class="tab_btn -fill -fill-primary w-full py-3 text-button text-center rounded bg-surface duration-300 hover:text-primary" id="tab_employer" role="tab" aria-controls="employer" aria-selected="false">Employer</button>
                    </li>
                </ul>
            </div>
            <div id="candidate" class="tab_list active" role="tabpanel" aria-labelledby="tab_candidate" aria-hidden="false">
                <form class="form mt-6">
                    <div class="form-group">
                        <label for="username">Candidate email address*</label>
                        <input id="username" type="email" name="username" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Email address*" required />
                    </div>
                    <div class="form-group mt-6">
                        <label for="password">Password*</label>
                        <input id="password" type="password" name="password" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Password*" required />
                    </div>
                    <div class="form-group mt-6">
                        <label for="confirmPassword">Confirm password*</label>
                        <input id="confirmPassword" type="password" name="confirmPassword" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Confirm password*" required />
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="sub-input-checkbox flex items-center gap-2">
                            <input id="checkbox" type="checkbox" name="checkbox" />
                            <label for="checkbox" class="text-surface1">I agree to the <a href="term-of-use.html" class="text-button hover:underline">Terms of User</a></label>
                        </div>
                    </div>
                    <div class="block-button mt-6">
                        <button class="button-main bg-primary w-full text-center">Create a new account</button>
                    </div>
                    <div class="navigate flex items-center justify-center gap-2 mt-6">
                        <span class="text-surface1">Already have an account?</span>
                        <a class="text-button hover:underline" href="Login">Login</a>
                    </div>
                </form>
            </div>
            <div id="employer" class="tab_list" role="tabpanel" aria-labelledby="tab_employer" aria-hidden="true">
                <form class="form mt-6">
                    <div class="form-group">
                        <label for="username">Employer email address*</label>
                        <input id="username" type="email" name="username" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Email address*" required />
                    </div>
                    <div class="form-group mt-6">
                        <label for="password">Password*</label>
                        <input id="password" type="password" name="password" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Password*" required />
                    </div>
                    <div class="form-group mt-6">
                        <label for="confirmPassword">Confirm password*</label>
                        <input id="confirmPassword" type="password" name="confirmPassword" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Confirm password*" required />
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="sub-input-checkbox flex items-center gap-2">
                            <input id="checkbox" type="checkbox" name="checkbox" />
                            <label for="checkbox" class="text-surface1">I agree to the <a href="term-of-use.html" class="text-button hover:underline">Terms of User</a></label>
                        </div>
                    </div>
                    <div class="block-button mt-6">
                        <button class="button-main bg-primary w-full text-center">Create a new account</button>
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

<?php include ('include/footer.php');?>

<?php include ('include/mobile_menu.php');?>

<?php include ('include/script.php');?>
</body>

</html>
