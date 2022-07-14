<?php 
    include 'template/login_header.php';

    if($session->get('user')['permissions'] == 'Student')
    {
        $course_details  = json_decode(enrolledcourse_details_getdata($session->get('user')['id'], $session->get('classroom_id')), true)['data'];
    }
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(https://eduadmin-template.multipurposethemes.com/bs4/images/svg-icon/color-svg/custom-1.svg)">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong><?=$session->get('user')['username'] ?>!</strong></h2>
                            </div>
                            
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($session->get('user')['permissions'] == 'Student')
    { ?>
        <div class="row">
            <div class="col-12">                                                        
                <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-header no-border px-0">
                        <h4 class="box-title">Your Courses</h4> 
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                            <button class="btn btn-primary-light px-10">View All</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <?php if($course_details == 'No Data Found'){} else{ foreach($course_details as $course_detail){ ?>
            <div class="col-xl-4 col-md-6 col-12">
                <a href="#" class="box pull-up" id="enrolledcoursedetail" data-unique="<?=$course_detail['unique_id']?>">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                                                                    
                                <img class="icon bg-primary-light rounded-circle w-60 h-60 text-center l-h-80" src="<?=$course_detail['course_image']?>" alt="...">
                            
                            <div class="ml-15">                                         
                                <h5 class="mb-0"><?=$course_detail['course_name'] ?></h5>
                                <p class="text-fade font-size-12 mb-0">You Watched</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-20">
                            <div class="w-p90">
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?=$course_detail['percentage']?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$course_detail['percentage']?>%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div><?=$course_detail['percentage']?>%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } }?>
        </div>
    <?php } ?>
</section>

<?php include 'template/login_footer.php'?>