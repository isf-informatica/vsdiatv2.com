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

    if($session->get('user')['permissions'] == 'Student')
    {
        $labs = json_decode(get_labs_student($session->get('user')['id'], $session->get('classroom_id')), true)['data'];
    }
    else
    {
        $labs = 'False';
    }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url(); ?>/public/Easylearn/images/fav.png">

    <title>VSD-IAT</title>

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
    
    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/vendor_components/fullcalendar/main.min.css"/>

    <link rel="stylesheet" href="<?=base_url(); ?>/public/Easylearn/vendor_components/select2/dist/css/select2.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

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
                            <li class="header">Home & Dashboard</li>

                            <li>
                                <a href="dashboard">
                                    <i class="icon-Layout-4-blocks"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <?php if($session->get('user')['status'] == 'Verified') { if($session->get('user')['permissions'] == 'Super admin') {?>
                                <li class="header">Features</li>

                                <li>
                                    <a href="manageadmin" >
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Manage Admins</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="manageconfigurations">
                                        <i class="icon-Settings1"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Configurations</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if($session->get('user')['permissions'] == 'Admin') { ?>
                                <li class="header">Features</li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Like"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        <span>Approvals</span>

                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="schoolrequests">
                                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>School Requests
                                            </a>
                                        </li>
                                        <li>
                                            <a href="jrcollegerequests">
                                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Jr College Requests
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mentorRequests">
                                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mentor Requests
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if($session->get('user')['permissions'] == 'School' || $session->get('user')['permissions'] == 'Jr College' ) { ?>
                                <li class="header">Classroom & Attendance</li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Classroom</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="manageClassroom"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Classroom
                                            </a>
                                        </li>

                                        <li>
                                            <a href="manageMentors"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Mentors
                                            </a>
                                        </li>

                                        <li>
                                            <a href="manageStudents"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Students
                                            </a>
                                        </li>

                                        <li>
                                            <a href="manageBatch"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Batch
                                            </a>
                                        </li>

                                        <li>
                                            <a href="managelabinstance"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Lab Instance
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Examination</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="manageExam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Manage Exam</a></li>
                                        <li><a href="Exam_result"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Exam Result</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Courses</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="manageCourses"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Manage Courses</a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Camera"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Media</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="managenews"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>News</a>
                                        </li>
                                        <li>
                                            <a href="manageannouncements"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Announcements</a>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>

                            <?php if($session->get('user')['permissions'] == 'Classroom') { ?>

                                <li class="header">Classroom & Attendance</li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Classroom</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="manageStudents"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Students
                                            </a>
                                        </li>

                                        <li>
                                            <a href="manageBatch"><i class="icon-Commit"><span class="path1"></span>
                                                <span class="path2"></span></i>Manage Batch
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Book-open"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Courses</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="manageCourses"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Manage Courses</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Examination</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="manageExam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Manage Exam</a></li>
                                        <li><a href="Exam_result"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Exam Result</a></li>
                                    </ul>
                                </li>

                            <?php } ?>

                            <?php if($session->get('user')['permissions'] == 'Mentor') { ?>
                                <li class="header">Examination</li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Pen-tool-vector"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Exam</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="mcq_exam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>MCQ Exam</a></li>
                                        <li><a href="sentence_exam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Sentence Exam</a></li>
                                    </ul>
                                </li>

                            <?php } ?>

                            <?php if($session->get('user')['permissions'] == 'Student') { ?>
                                <li class="header">Examination</li>

                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Pen-tool-vector"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Exam</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="mcq_exam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>MCQ Exam</a></li>
                                        <li><a href="sentence_exam"><i class="icon-Commit"><span class="path1"></span><span
                                                        class="path2"></span></i>Sentence Exam</a></li>
                                    </ul>
                                </li>

                                <?php if($labs != 'False'){ $i = 1; foreach($labs as $lab) { ?>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="icon-Add-user"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Lab Instance</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="https://www.remotespark.com/view/rdpdirect.html?server=<?=$lab['lab_ip']; ?>&port=3389&user=<?=$lab['lab_username']; ?>&pwd=<?=$lab['lab_password']; ?>&keyboard=1033&width=0&height=0&fullBrowser=Full%20browser&fullScreen=Full%20screen&server_bpp=16&playSound=0&soundPref=0&mapClipboard=on&mapPrinter=on&mapDisk=on&startProgram=noapp&smoothfont=on&=Open&clear=Clear&delete=Delete&save=Save&connect=Connect&gateway=www.remotespark.com" target='_blank'>
                                                <i class="icon-Commit">
                                                    <span class="path1"></span><span class="path2"></span>
                                                </i> Lab Instance <?=$i; ?>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <?php $i++; } } ?>

                            <?php } ?>

                            <?php } ?>

                            <li class="header">Feedback & Reports</li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Like"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Feedback</span>
                                </a>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Key"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Change Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

        </aside>

        <div class="content-wrapper">
            <div class="container-full">