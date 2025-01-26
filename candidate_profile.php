<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="FreelanHub - Job Board & Freelance Marketplace" />
        <title>FreelanHub - Job Board & Freelance Marketplace</title>
        <?php include ('include/css.php');?>
    </head>

    <body class="lg:overflow-hidden">
        <!-- Header -->
        <?php include ('include/header.php');?>

        <div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
            <?php include ("include/sidebar_user.php");?>

            <div class="dashboard_profile scrollbar_custom w-full bg-surface">
                <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
                    <button class="btn_open_popup btn_menu_dashboard flex items-center gap-2 min-[1400px]:hidden" data-type="menu_dashboard">
                        <span class="ph ph-squares-four text-xl"></span>
                        <strong class="text-button">Menu</strong>
                    </button>
                    <div class="heading flex flex-wrap items-center justify-between gap-4">
                        <h4 class="heading4 max-lg:mt-3">Job Seeker Name</h4>
                        <a href="#" class="button-main">Send Message</a>
                    </div>
                    <div class="profile_block overflow-hidden flex max-lg:flex-col-reverse gap-y-10 w-full mt-7.5">
                        <div class="left flex-shrink-0 lg:w-[29.5%]">
                            <div class="list_social p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                                <iframe src="assets/video/Snapinsta.mp4" style="width: 320px; height: 600px"></iframe>
                            </div>
                            <div class="info_overview p-8 rounded-lg bg-white shadow-sm mt-7.5">
                                <h5 class="heading5">Full Name</h5>
                                <ul class="candidates_info pt-1">
                                    <li class="location flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Location:</span>
                                        <strong class="text-title">Las Vegas, USA</strong>
                                    </li>
                                    <li class="phone flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Phone:</span>
                                        <strong class="text-title">+12-345-678-910</strong>
                                    </li>
                                    <li class="email flex flex-wrap items-center justify-between gap-1 w-full py-4 border-b border-line">
                                        <span class="text-secondary">Email:</span>
                                        <strong class="text-title">hi.avitex@gmail.com</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right lg:w-[70.5%] lg:pl-7.5">
                            <div class="tools p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                                <h5 class="heading5">Core Skills</h5>
                                <div class="list flex flex-wrap items-center gap-3 mt-5">
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                </div>
                                <h5 class="heading5 mt-5">Core Skills</h5>
                                <div class="list flex flex-wrap items-center gap-3 mt-5">
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                    <span class="tag bg-surface caption1">Sub-skills</span>
                                </div>
                            </div>
                            <div class="education w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                                <h5 class="heading5">Education</h5>
                                <ul class="list flex flex-col gap-7 mt-5 pl-7 border-l border-line">
                                    <li>
                                        <div class="flex items-center gap-4 mb-1">
                                            <strong class="edu_name text-button-sm">FPT University</strong>
                                            <span class="time caption2">2016 - 2020</span>
                                        </div>
                                        <strong class="position text-button">Software Engineering</strong>
                                        <p class="desc text-secondary mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-4 mb-1">
                                            <strong class="edu_name text-button-sm">Devpro</strong>
                                            <span class="time caption2">2020 - 2021</span>
                                        </div>
                                        <strong class="position text-button">UI/UX Design Course</strong>
                                        <p class="desc text-secondary mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="experience w-full overflow-hidden p-8 mt-7.5 rounded-lg bg-white shadow-sm">
                                <h5 class="heading5">Experience</h5>
                                <ul class="list flex flex-col gap-7 mt-5 pl-7 border-l border-line">
                                    <li>
                                        <div class="flex items-center gap-4 mb-1">
                                            <strong class="company_name text-button-sm">Avitex Agency Inc.</strong>
                                            <span class="time text-xs font-semibold uppercase">June 2021 - December 2022</span>
                                        </div>
                                        <strong class="position text-button">UI/UX Design</strong>
                                        <p class="desc text-secondary mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                    </li>
                                    <li>
                                        <div class="flex items-center gap-4 mb-1">
                                            <strong class="company_name text-button-sm">Google Inc.</strong>
                                            <span class="time text-xs font-semibold uppercase text-primary">January 2023 - Present</span>
                                        </div>
                                        <strong class="position text-button">UI/UX Design</strong>
                                        <p class="desc text-secondary mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:fixed bottom-0 left-0 z-[2] lg:pl-[280px] flex items-center justify-center w-full h-15 bg-white duration-300 shadow-md">
                    <span class="copyright caption1 text-secondary">©2025 Zeroed. All Rights Reserved</span>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <?php include ("include/mobile_menu.php");?>

        <!-- Modal -->
        <?php include ('include/modal.php');?>


        <?php include ('include/script.php');?>
    </body>
</html>
