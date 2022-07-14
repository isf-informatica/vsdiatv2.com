
<!DOCTYPE html>
<html lang="en">

<?php
    $session = \Config\Services::session();
    helper('common');

    function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }

    $unique=$_GET['uniqueid'];

    if($session->get('user')['permissions'] == 'Student')
    {
        $topicname = json_decode(get_topic_name($unique, $session->get('user')['id'], $session->get('classroom_id')) , true)['data'];
    }
    else
    {
        $topicname = json_decode(get_topic_name_class($unique) , true)['data'];
    }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url(); ?>/public/Easylearn/images/fav.png">

    <title>Easylearn</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/css/vendors_css.css">
    <!-- Style-->
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/css/style.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/css/skin_color.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/css/easylearn.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/fonts/fontawesome/fontawesome.css">
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/Sweet Alert/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/datatables.net-bs4/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/dropify/dropify.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/intl-tel-input-12.1.0/build/css/intlTelInput.css">

    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/bootstrapDatepicker/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/bootstrapDatepicker/bootstrap-datepicker.standalone.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/vendor_components/fullcalendar/main.min.css" />
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/libs/Toast/toast.style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?=base_url(); ?>/public/Easylearn/libs/Toast/toast.script.js"></script>
</head>

<style>
    .responsive-iframe {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .iframe-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    .sidebar-menu li > a{
        white-space: normal !important;
    }

    .row > *{
        padding-left: 0 !important;
    }

    .main-sidebar{
        width : 400px;
    }

    .fixed .multinav {
        width : 400px;
    }

    .main-header div.logo-box {
        width : 400px;
    }

    .sidebar-collapse .wrapper > aside > section> .multinav > .multinav-scroll > ul >li {
        display: none;
    }

    .content-wrapper{
        margin-left: 400px;
    }

    @media (max-width: 767px){
        .main-sidebar {
            -webkit-transform: translate(-400px, 0);
            -ms-transform: translate(-400px, 0);
            -o-transform: translate(-400px, 0);
            transform: translate(-400px, 0);
        }

        .content-wrapper{
            margin-left: 0px;
        }
    }
</style>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box justify-content-start">
                <a href="#"
                    class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent"
                    data-toggle="push-menu" role="button">
                    <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></span>
                </a>
                <!-- Logo -->
                <a href="dashboard" class="logo">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo"><img src="<?=base_url(); ?>/public/Easylearn/images/transparent_easylearn_black.png"
                                alt="logo"></span>
                        <span class="dark-logo"><img src="<?=base_url(); ?>/public/Easylearn/images/transparent_easylearn_white.png"
                                alt="logo"></span>
                    </div>
                </a>
            </div>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu"
                                role="button">
                                <span class="icon-Align-left"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></span>
                            </a>
                        </li>
                        <li class="btn-group nav-item d-none d-xl-inline-block">
                            <a href="contact_app_chat.html" class="waves-effect waves-light nav-link svg-bt-icon"
                                title="Chat">
                                <i class="icon-Chat"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                        <li class="btn-group nav-item d-none d-xl-inline-block">
                            <a href="mailbox.html" class="waves-effect waves-light nav-link svg-bt-icon"
                                title="Mailbox">
                                <i class="icon-Mailbox"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                        <li class="btn-group nav-item d-none d-xl-inline-block">
                            <a href="extra_taskboard.html" class="waves-effect waves-light nav-link svg-bt-icon"
                                title="Taskboard">
                                <i class="icon-Clipboard-check"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">
                        <li class="btn-group nav-item d-lg-inline-flex d-none">
                            <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen"
                                title="Full Screen">
                                <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>

                        <!-- Notifications -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                                title="Notifications">
                                <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                            <ul class="dropdown-menu animated bounceIn">

                                <li class="header">
                                    <div class="p-20">
                                        <div class="flexbox">
                                            <div>
                                                <h4 class="mb-0 mt-0">Notifications</h4>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu sm-scrol notification-container">
                                        <li class='notification d-none'>
                                            <a href="announcements">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all</a>
                                </li>
                            </ul>
                        </li>

                        <!-- User Account-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                                title="User" style='font-size: 16px; font-weight: bold;'>
                                <?=initials($session->get('user')['username']); ?>
                            </a>
                            <ul class="dropdown-menu animated flipInX">
                                <li class="user-body">
                                    <a class="dropdown-item" href="profile"><i class="ti-user text-muted mr-2"></i>
                                        Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item logout" href="#"><i class="ti-lock text-muted mr-2"></i>
                                        Logout</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar" title="Dark Mode" class="waves-effect waves-light dark-light-mode">
                                <i class="icon-Sun-fog"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <!-- sidebar-->
            <section class="sidebar position-relative">
                <div class="multinav">
                    <div class="multinav-scroll" style="height: 100%;">
                        <!-- sidebar menu-->
                        <ul class="sidebar-menu" data-widget="tree">

                            <li class="header"> <?=$topicname[0]['course_name'] ?> </li>

                            <?php $topic_name = ''; $sub_topic = '';

                            foreach($topicname as $topic){ 
                                if($topic['sub_topic'] == '' || $topic['sub_topic'] == Null){ ?>

                                    <li class="treeview">
                                        <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                            <div class='row'>
                                                <div class="col-1">
                                                    <i class="icon-Circle"><span class="path1"></span><span class="path2"></span></i>
                                                </div>

                                                <div class='col-11'>
                                                    <span> <?=$topic['topic_name'] ?> </span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                <?php } else{ 

                                    if(strtolower(trim($topic['topic_name'])) == strtolower(trim($topic_name)))
                                    {
                                        if($topic['chapter'] == '' || $topic['chapter'] == Null) { ?>

                                            <li class="treeview">
                                                <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="ion-ios-circle-outline"><span class="path1"></span><span class="path2"></span></i> 
                                                        </div>

                                                        <div class='col-11'>
                                                            <?=$topic['sub_topic']; ?>
                                                        </div>
                                                    </div>                                            
                                                </a>
                                            </li>

                                    <?php }
                                        
                                        if(strtolower(trim($topic['sub_topic'])) == strtolower(trim($sub_topic)))
                                        { ?>

                                            <li class="treeview">
                                                <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> 
                                                        </div>

                                                        <div class='col-11'>
                                                            <?=$topic['chapter']; ?>
                                                        </div>
                                                    </div>                                            
                                                </a>
                                            </li>

                                    <?php }
                                        else{
                                            if($sub_topic == '')
                                            {

                                            }
                                            else
                                            {
                                                echo '</ul> </li>';
                                            }
                                            $sub_topic = $topic['sub_topic']; ?>
                                            
                                            <li class="treeview">
                                                <a href="#">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="ion-ios-circle-outline"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>

                                                        <div class='col-10'>
                                                            <span> <?=$topic['sub_topic'] ?> </span>
                                                        </div>

                                                        <span class="col-1 my-auto pull-right-container">
                                                            <i class="fa fa-angle-right pull-right"></i>
                                                        </span>
                                                    </div>
                                                </a>

                                                <ul class="treeview-menu">	
                                                    <li class="treeview">
                                                        <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                                            <div class='row'>
                                                                <div class="col-1">
                                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> 
                                                                </div>

                                                                <div class='col-11'>
                                                                    <?=$topic['chapter']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                            <?php }
                                    }
                                    else
                                    {
                                        if($topic_name == '')
                                        {

                                        }
                                        else
                                        {
                                            echo '</ul> </li>';

                                            if($sub_topic == '')
                                            {

                                            }
                                            elseif(strtolower(trim($topic['sub_topic'])) != strtolower(trim($sub_topic)))
                                            {
                                                echo '</ul> </li>';
                                            }
                                        } $topic_name = $topic['topic_name']; ?>

                                            <li class="treeview">
                                                <a href="#">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="icon-Circle"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>

                                                        <div class='col-10'>
                                                            <span> <?=$topic['topic_name'] ?> </span>
                                                        </div>

                                                        <span class="col-1 my-auto pull-right-container">
                                                            <i class="fa fa-angle-right pull-right"></i>
                                                        </span>
                                                    </div>
                                                </a>

                                                <ul class="treeview-menu">	

                                        <?php if($topic['chapter'] == '' || $topic['chapter'] == Null) { ?>

                                            <li class="treeview">
                                                <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="ion-ios-circle-outline"><span class="path1"></span><span class="path2"></span></i> 
                                                        </div>

                                                        <div class='col-11'>
                                                            <?=$topic['sub_topic']; ?>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                        <?php } else{ 
                                            
                                            $sub_topic = $topic['sub_topic']; ?>
                                            
                                            <li class="treeview">
                                                <a href="#">
                                                    <div class='row'>
                                                        <div class="col-1">
                                                            <i class="ion-ios-circle-outline"><span class="path1"></span><span class="path2"></span></i>
                                                        </div>

                                                        <div class='col-10'>
                                                            <span> <?=$topic['sub_topic'] ?> </span>
                                                        </div>

                                                        <span class="col-1 my-auto pull-right-container">
                                                            <i class="fa fa-angle-right pull-right"></i>
                                                        </span>
                                                    </div>
                                                </a>

                                                <ul class="treeview-menu">	
                                                    <li class="treeview">
                                                        <a href="#" class="show-topic" data-id="<?=$topic['unique_id'] ?>">
                                                            <div class='row'>
                                                                <div class="col-1">
                                                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i> 
                                                                </div>

                                                                <div class='col-11'>
                                                                    <?=$topic['chapter']; ?>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                    <?php } } } ?>
                            <?php } ?>

                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </aside>

        <div class="content-wrapper">
            <div class="container-full">
                <section class="content">
                    <div class="d-inline-block align-items-center">
						<nav>
							<ol id='breadcrumb' class="breadcrumb d-none">

							</ol>
						</nav>
					</div>

                    <div id='tab-list' class="p-3 mb-6 d-none">
                        <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                            <li class="nav-item mt-20 course_material d-none"> 
                                <a class="nav-link active" style='border:1px solid #b5b5c3;border-radius: 5px;' data-toggle="tab" href="#course_material" role="tab">
                                    Course Material
                                </a> 
                            </li>
                            &emsp;
                            <li class="nav-item mt-20 course_video d-none"> 
                                <a class="nav-link" style='border:1px solid #b5b5c3; border-radius: 5px;' data-toggle="tab" href="#course_video" role="tab">
                                    Course Video
                                </a> 
                            </li>
                            &emsp;
                            <li class="nav-item mt-20 lab_video d-none"> 
                                <a class="nav-link" style='border:1px solid #b5b5c3; border-radius: 5px;' data-toggle="tab" href="#lab_video" role="tab">
                                    Lab Video
                                </a> 
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="course_material" role="tabpanel" aria-labelledby="course_material-tab">
                            <div class='iframe-container'>
                                <iframe id='course_material_holder' oncontextmenu="return false;" controls controlsList="nodownload" class="responsive-iframe" src=""></iframe>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="course_video" role="tabpanel" aria-labelledby="course_video-tab">
                            <div class='iframe-container'>
                                <iframe id='course_video_holder' oncontextmenu="return false;" controls controlsList="nodownload" class="responsive-iframe" src=""></iframe>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="lab_video" role="tabpanel" aria-labelledby="lab_video-tab">
                            <div class='iframe-container'>
                                <iframe id='lab_video_holder' oncontextmenu="return false;" controls controlsList="nodownload" class="responsive-iframe" src=""></iframe>
                            </div>
                        </div>
                    </div>

                    <h3 class="topic_description d-none">Topic Description</h3>

                    <p class="mb-6 line-height-md" id='topic_description'></p>

                    <div class="d-md-flex row align-items-center justify-content-between">
                        <div class="p-3 col-6">   
                            <a href="#" class="btn btn-info active" id='prev_topic' data-id="0"> <i class="fas fa-backward"></i> &nbsp;&nbsp;Previous </a>
                        </div>

                        <div class="p-3 text-right col-6">
                            <a href="#" class="btn btn-info active" id='next_topic' data-id="0"> Next&nbsp;&nbsp;<i class="fas fa-forward"></i> </a>
                        </div>
                    </div>
                </section>

<?php 
    include 'template/login_footer.php';
?>

<script src="<?=base_url(); ?>/public/Easylearn/js/course.js"></script>