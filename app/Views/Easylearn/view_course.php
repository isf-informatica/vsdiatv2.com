<?php 
    include 'template/login_header.php'; 
    $unique = $_GET['id'];
    $school_medium = json_decode(get_settings_name('School Medium') , true)['data'];

    $course = json_decode(get_course_status($_GET['id']), true)['data'];
	if($course == 'FALSE')
	{
		die;
	}
?>

<style>
    .course_certificate:before,
    .course_visibility:before {
        content: 'No';
        left: -4rem;
    }
    
    .course_certificate:after,
    .course_visibility:after {
        content: 'Yes';
        right: -4rem;
        opacity: .5;
    }
</style>

<section class='content'>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class='box'>
                <div class='box-body'>
                    <div class="panel">
                        <div class="text-start p-3">   
                            <a href="manageCourses" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        </div>

                        <div class="text-center"><h3>Course Details</h3></div>

                        <form id="edit_course">
                            <div class="row justify-content-center m-20">

                                <?php $session->set('edit_course_token', md5(uniqid(mt_rand(), true))); ?>
                                <input type="hidden" id='edit_course_token' name="edit_course_token" value="<?=$session->get('edit_course_token'); ?>">
                                <input type="hidden" id='unique_id' name="unique_id" value="<?=$unique ?>">

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="course_name">Course Name :</label>
                                        <input type="text" class="form-control form-control-flush" id="course_name" placeholder="Course Name" required>
                                        
                                        <div class='d-none btn-danger check_course_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Course Name</div>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <div class="form-label-group">
                                        <div class="form-label-group text-center">
                                            <img src="" class="view_img" id="view_img" alt="" style="height:200px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3 align-self-center">
                                    <div class="form-label-group">
                                        <label for="course_img">Course Image :</label>
                                        <input type="file" class="form-control form-control-flush" id="course_img" placeholder="Course Name" accept="image/*">
                                        
                                        <div class='d-none btn-danger check_course_img' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose Course Image</div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="course_sm_descp">Course Small Description :</label>
                                        <input type="text" class="form-control form-control-flush" id="course_sm_descp" placeholder="Course Small Description" >
                                        
                                        <div class='d-none btn-danger check_course_sm_descp' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Course Description</div>
                                    </div>
                                </div>

                                <div class="col-md-10 mb-3">
                                    <div class="form-label-group">
                                        <label for="course_descp"> Description :</label>
                                        <textarea type="text" class="form-control form-control-flush" id="course_descp" placeholder="Description" style="height: 150px; resize: none;"></textarea>
                                        
                                        <div class='d-none btn-danger check_course_descp' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Course Description</div>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <div class="form-label-group">
                                        <label for="course_lang"> Language :</label>
                                        <select name="course_lang" id="course_lang" class="form-select form-control">
                                            <?php foreach($school_medium as $medium){ ?>
                                            <option value='<?=$medium['value']; ?>'> <?=$medium['value']; ?> </option>
                                            <?php } ?>                                        
                                        </select>
                                        <div class='d-none btn-danger check_course_lang' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Course Language</div>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3">
                                </div>

                                <div class="col-md-5 mb-3 pt-5">
                                    <div class="form-label-group">
                                        <label for="course_visibility"> Course Visibility :</label>
                                        <button type="button" style='border-radius: 20px;' class="btn btn-sm btn-toggle course_visibility" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            <div style='border-radius: 50%;' class="handle"></div>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3 pt-5">
                                    <div class="form-label-group">
                                        <label for="course_certificate"> Course Certificate :</label>
                                        <button type="button" style='border-radius: 20px;' class="btn btn-sm btn-toggle course_certificate" data-toggle="button" aria-pressed="false" autocomplete="off">
                                            <div style='border-radius: 50%;' class="handle"></div>
                                        </button>
                                    </div>
                                </div> 

                            
                                <div class="col-md-12 text-center m-3">
                                    <div class="form-label-group">
                                        <button type="button" id='delete_course' class="btn btn-danger waves-effect waves-light">Delete</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <button type="submit" class="btn btn btn-primary waves-effect waves-light mt-5">Save Course</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Course.js"></script>