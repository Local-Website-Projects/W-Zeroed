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

                    </div>
                    <ul class="list_chat flex flex-col gap-0.5 scrollbar_custom w-full sm:border-r border-line" role="tablist" style="min-height: 600px">
                        <?php
                        $fetch_messages = $db_handle->runQuery("SELECT * from seller_messages where seller_id = {$_SESSION['seller_id']} order by s_msg_id DESC");
                        $fetch_messages_no = $db_handle->numRows("SELECT * from seller_messages where seller_id = {$_SESSION['seller_id']} order by s_msg_id DESC");
                        for ($i=0; $i <$fetch_messages_no; $i++) {
                            ?>
                            <a href="Message?sender=<?php echo $fetch_messages[$i]['s_msg_id']?>">
                            <li class="chat_item flex gap-5 w-full px-6 py-4 cursor-pointer duration-300 hover:bg-background hover:bg-opacity-80" data-chat="person1">
                                    <div class="chat_content w-full">
                                        <div class="flex items-center justify-between gap-4">
                                            <strong class="chat_name text-button"><?php echo $fetch_messages[$i]['full_name'];?></strong>
                                        </div>
                                        <div class="flex items-center justify-between gap-4">
                                            <p class="chat_text"><?php echo $fetch_messages[$i]['sender_email'];?></p>
                                        </div>
                                    </div>
                            </li>
                            </a>
                            <?php
                        }
                        ?>
                    </ul>
                </div>




                <div class="right w-full max-sm:flex-shrink-0">
                    <?php
                    if($_GET['sender']){
                        $fetch_single_message = $db_handle->runQuery("SELECT * from seller_messages where seller_id = {$_SESSION['seller_id']} and s_msg_id = {$_GET['sender']} order by s_msg_id DESC");
                        ?>
                        <div class="chat_box relative h-full pb-20">
                            <div class="heading flex items-center justify-between w-full h-[5.5rem] px-7 border-b border-line">
                                <div class="left flex items-center gap-3">
                                    <div>
                                        <strong class="text-button"><?php echo $fetch_single_message[0]['full_name'];?></strong>
                                        <div class="flex items-center gap-1">
                                            <span class="ph ph-envelope text-lg text-secondary"></span>
                                            <span class="caption1 text-secondary"><?php echo $fetch_single_message[0]['sender_email'];?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat_content scrollbar_custom">
                                <div class="content flex flex-col gap-5 w-full p-6">
                                    <div class="message_item flex flex-col gap-1 items-start self-start xl:w-1/2 sm:w-2/3 w-5/6">
                                        <div class="inner flex flex-row-reverse items-center gap-2">
                                            <p class="content py-3 px-4 rounded-2xl rounded-bl-none bg-background"><?php echo $fetch_single_message[0]['message'];?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else{
                       ?>
                        <div class="flex items-center justify-center h-full"> <!-- This is where you center the content -->
                            <p class="text-center" style="font-weight: bold">You have not received any message yet!  When you get a new message that will arrive here.</p><br/>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php include ('include/dashboard_footer.php');?>
    </div>
</div>

<!-- Menu mobile -->
<?php include ("include/mobile_menu.php");?>

<!-- Modal -->
<?php include ('include/modal.php');?>


<?php include ('include/script.php');?>
</body>
</html>
