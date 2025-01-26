<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
        <title>Zeroed - Login</title>
        <?php include ('include/css.php');?>
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
                            <span class="caption1 text-white opacity-60">Login</span>
                        </div>
                        <h3 class="heading3 text-white mt-2 animate animate_top" style="--i: 2">Login</h3>
                    </div>
                </div>
            </div>
        </section>

        <!-- Form Login -->
        <section class="form_login lg:py-20 sm:py-14 py-10">
            <div class="container flex items-center justify-center">
                <div class="content sm:w-[448px] w-full">
                    <h3 class="heading3 text-center">Log In</h3>
                    <form class="form mt-6">
                        <div class="form-group">
                            <label for="username">Email address*</label>
                            <input id="username" type="email" name="username" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Email address*" required />
                        </div>
                        <div class="form-group mt-6">
                            <label for="password">Password*</label>
                            <input id="password" type="password" name="password" class="form-control w-full mt-3 border border-line px-4 h-[50px] rounded-lg" placeholder="Password*" required />
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <a class="text-primary hover:underline" href="#!">Forgot password?</a>
                        </div>
                        <div class="block-button mt-6">
                            <button class="button-main bg-primary w-full text-center">Login</button>
                        </div>
                        <div class="navigate flex items-center justify-center gap-2 mt-6">
                            <span class="text-surface1">Not registered yet?</span>
                            <a class="text-button hover:underline" href="Register">Sign Up</a>
                        </div>
                        <div class="option-title relative text-center py-6">
                            <span class="px-5 bg-white">or sign up with</span>
                            <div class="line absolute top-1/2 -translate-y-1/2 left-0 w-full h-px bg-line z-[-1]"></div>
                        </div>
                        <div class="list-login grid sm:grid-cols-3 gap-3">
                            <a class="bg-surface h-12 flex items-center justify-center gap-3 rounded border border-line duration-300 hover:bg-black hover:text-white" href="#!">
                                <span class="ph-fill ph-facebook-logo text-[#3B5998] text-2xl"></span>
                                <strong class="text-button">Facebook</strong>
                            </a>
                            <a class="bg-surface h-12 flex items-center justify-center gap-3 rounded border border-line duration-300 hover:bg-black hover:text-white" href="#!">
                                <span class="ph ph-google-logo text-[#FF4B26] text-2xl"></span>
                                <strong class="text-button">Google</strong>
                            </a>
                            <a class="bg-surface h-12 flex items-center justify-center gap-3 rounded border border-line duration-300 hover:bg-black hover:text-white" href="#!">
                                <span class="ph ph-x-logo text-2xl"></span>
                                <strong class="text-button">Twitter</strong>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <?php include ('include/footer.php');?>



        <?php include ('include/mobile_menu.php');?>

        <?php include ('include/script.php');?>
    </body>

</html>
