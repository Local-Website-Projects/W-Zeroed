<?php
session_start();
require_once('config/dbConfig.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Dhaka");
$inserted_at = date("Y-m-d H:i:s");

if(!isset($_SESSION['seller_id'])) {
    echo "
    <script>
    window.location.href='Login'
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
    <title>FreelanHub - Job Board & Freelance Marketplace</title>
    <?php include ('include/css.php');?>
</head>

<body class="lg:overflow-hidden">
<!-- Header -->
<?php include ('include/header.php');?>

<div class="dashboard_main overflow-hidden lg:w-screen lg:h-screen flex sm:pt-20 pt-16">
    <?php include ("include/sidebar_user.php");?>
    <div class="dashboard_message scrollbar_custom w-full bg-surface">
        <div class="container h-fit lg:pt-15 lg:pb-30 max-lg:py-12 max-sm:py-8">
            <button class="btn_open_popup btn_menu_dashboard flex items-center gap-2 lg:hidden" data-type="menu_dashboard">
                <span class="ph ph-squares-four text-xl"></span>
                <strong class="text-button">Menu</strong>
            </button>
            <h4 class="heading4 max-lg:mt-3">Message</h4>
            <div class="message_block flex max-h-[700px] overflow-hidden mt-7.5 rounded-lg bg-white">
                <div class="left overflow-hidden flex-shrink-0 xl:w-[400px] lg:w-[45%] sm:w-[40%] w-full">
                    <div class="form_search flex items-center h-[5.5rem] px-6 border-b sm:border-r border-line">
                        <form class="relative w-full h-12">
                            <input type="text" class="w-full h-full pl-4 pr-12 border border-line rounded-lg overflow-hidden" placeholder="Search Users" required />
                            <button type="submit" class="absolute top-1/2 -translate-y-1/2 right-4">
                                <span class="ph ph-magnifying-glass text-xl block"></span>
                            </button>
                        </form>
                    </div>
                    <ul class="list_chat flex flex-col gap-0.5 scrollbar_custom w-full sm:border-r border-line" role="tablist">
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person1">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/1.png" alt="company/1" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">Bright Future</strong>
                                    <span class="chat_time caption1 text-secondary">16:24 PM</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Yes, I did! It sounds exciting. Are you involved in it?</p>
                                    <span class="chat_quantity flex items-center justify-center w-5 h-5 rounded-full bg-red text-xs font-semibold text-white">2</span>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person2">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/2.png" alt="company/2" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-yellow"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">Innovations</strong>
                                    <span class="chat_time caption1 text-secondary">15:56 PM</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Hey! There I'm available</p>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person3">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/3.png" alt="company/3" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-yellow"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">CoreTech</strong>
                                    <span class="chat_time caption1 text-secondary">14:10 PM</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Yes, I'm Candidate</p>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person4">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/4.png" alt="company/4" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">GlobalTech Partners</strong>
                                    <span class="chat_time caption1 text-secondary">11:23 AM</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Hey! There I'm available</p>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person5">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/5.png" alt="company/5" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">PrimeEdge Solutions</strong>
                                    <span class="chat_time caption1 text-secondary">Yesterday</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Yes, I'm Candidate</p>
                                    <span class="chat_quantity flex items-center justify-center w-5 h-5 rounded-full bg-red text-xs font-semibold text-white">1</span>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person6">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/6.png" alt="company/6" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-placehover"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">EliteTech Solutions</strong>
                                    <span class="chat_time caption1 text-secondary">Tuesday</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Hey! There I'm available</p>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person7">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/7.png" alt="company/7" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-yellow"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">Stellar Enterprises</strong>
                                    <span class="chat_time caption1 text-secondary">01/06/2024</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Yes, I'm Candidate</p>
                                </div>
                            </div>
                        </li>
                        <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person8">
                            <div class="relative flex-shrink-0 w-[3.25rem] h-[3.25rem]">
                                <img src="assets/images/company/8.png" alt="company/8" class="chat_avatar w-full h-full rounded-full object-cover" />
                                <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                            </div>
                            <div class="chat_content w-full">
                                <div class="flex items-center justify-between gap-4">
                                    <strong class="chat_name text-button">Quantum Dynamics</strong>
                                    <span class="chat_time caption1 text-secondary">06/06/2024</span>
                                </div>
                                <div class="flex items-center justify-between gap-4">
                                    <p class="chat_text">Hey! There I'm available</p>
                                    <span class="chat_quantity flex items-center justify-center w-5 h-5 rounded-full bg-red text-xs font-semibold text-white">1</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right w-full max-sm:flex-shrink-0">
                    <div class="chat_box relative h-full pb-20" data-chat="person1">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/1.png" alt="company/1" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">Bright Future</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">Texas, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">How was your weekend?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Hi, John! I'm fine, Thanks !</p>
                                    </div>
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">It was great, thanks for asking. I went hiking with some friends. How about you?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:30 AM</div>
                                </div>
                                <div class="message_time flex justify-center relative">
                                    <div class="line absolute top-1/2 left-0 w-full h-px bg-line"></div>
                                    <span class="relative caption1 text-secondary px-5 bg-white">April 22, 2024</span>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">By the way, did you hear about the new project our team is starting?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">09:30 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Yes, I did! It sounds exciting. Are you involved in it?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">16:24 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person2">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/2.png" alt="company/2" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">Innovations</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">What u doing?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Can u help me a little?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Hey! There I'm available</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person3">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/3.png" alt="company/3" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">CoreTech</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">Texas, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Hello?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Are you Candidate ?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Yes, I'm Candidate</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person4">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/4.png" alt="company/4" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">GlobalTech Partners</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">What u doing?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Can u help me a little?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Hey! There I'm available</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person5">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/5.png" alt="company/5" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">PrimeEdge Solutions</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Hello?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Are you Candidate ?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Yes, I'm Candidate</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person6">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/6.png" alt="company/6" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">EliteTech Solutions</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">What u doing?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Can u help me a little?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Hey! There I'm available</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person7">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/7.png" alt="company/7" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">Stellar Enterprises</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Hello?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Are you Candidate ?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Yes, I'm Candidate</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                    <div class="chat_box relative h-full pb-20" data-chat="person8">
                        <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                            <div class="left flex items-center gap-3">
                                <button class="back_to_list_btn sm:hidden">
                                    <span class="ph-bold ph-caret-left text-2xl block"></span>
                                </button>
                                <div class="avatar relative flex-shrink-0 w-9 h-9">
                                    <img src="assets/images/company/8.png" alt="company/8" class="w-full h-full rounded-full object-cover" />
                                    <span class="dot_status absolute right-0 bottom-0 w-3 h-3 border-2 border-surface rounded-full bg-success"></span>
                                </div>
                                <div>
                                    <strong class="text-button">Quantum Dynamics</strong>
                                    <div class="flex items-center gap-1">
                                        <span class="ph ph-map-pin text-lg text-secondary"></span>
                                        <span class="caption1 text-secondary">California, USA</span>
                                    </div>
                                </div>
                            </div>
                            <button class="more_option_btn">
                                <span class="ph-bold ph-dots-three text-2xl block"></span>
                            </button>
                        </div>
                        <div class="chat_content scrollbar_custom">
                            <div class="content flex flex-col gap-5 w-full p-6">
                                <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">What u doing?</p>
                                    </div>
                                    <div class="inner flex flex-row-reverse items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background">Can u help me a little?</p>
                                    </div>
                                    <div class="time_stamp text-secondary">11:28 AM</div>
                                </div>
                                <div class="message_item flex flex-col gap-1 items-end self-end justify-end xl:w-1/2 sm:w-2/3 w-5/6">
                                    <div class="inner flex items-center gap-2">
                                        <button class="ph ph-dots-three-vertical text-xl flex-shrink-0"></button>
                                        <p class="content py-3 px-4 rounded-2xl rounded-br-none bg-background">Hey! There I'm available</p>
                                    </div>
                                    <div class="time_stamp text-secondary">15:56 PM</div>
                                </div>
                            </div>
                        </div>
                        <form class="form_chat flex items-center gap-3 absolute left-0 bottom-0 w-full h-20 px-6 border-t border-line bg-white">
                            <div class="form_input relative w-full h-12">
                                <input type="text" placeholder="Add a message..." class="w-full h-full border border-line bg-surface rounded pl-4 pr-14" required />
                            </div>
                            <button class="flex flex-shrink-0 items-center justify-center w-12 h-12 rounded bg-black text-white duration-300 hover:bg-primary">
                                <span class="ph ph-paper-plane-tilt text-2xl"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:fixed bottom-0 left-0 z-[1] lg:pl-[280px] flex items-center justify-center w-full h-15 bg-white duration-300 shadow-md">
            <span class="copyright caption1 text-secondary">©2024 FreelanHub. All Rights Reserved</span>
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
