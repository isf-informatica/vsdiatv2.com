<?php 
    include 'template/login_header.php';
    $school_medium = json_decode(get_settings_name('School Medium') , true)['data'];
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active"><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                            <div class='col-6'>
                                <div style='text-align: right' class='p-3'>
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_course_modal">Add
                                        Course</a>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-center text-dark bold">Course List</h4>
                        <div class="table-responsive p-3">
                            <table id="course_list" class="table text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Course Name</th>
                                        <th>Visibility</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<div class="modal fade none-border add-category" id="add_course_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Course</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form id="add_course">
                        <div class="row justify-content-center m-20">

                            <?php $session->set('add_course_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='add_course_token' name="add_course_token" value="<?=$session->get('add_course_token'); ?>">

                            <div class="col-md-12 mb-3">
                                <div class="form-label-group">
                                    <label for="course_name">Course Name :</label>
                                    <input type="text" class="form-control form-control-flush" id="course_name"placeholder="Course Name" required>
                                    
                                    <div class='d-none btn-danger check_course_name' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i> Enter Valid Course Name
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <label for="course_img">Course Image :</label>
                                    <input type="file" class="form-control form-control-flush" id="course_img" placeholder="Course Name" accept="image/*" required>
                                    
                                    <div class='d-none btn-danger check_course_img' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i> Choose Course Image
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <label for="course_lang"> Language :</label>
                                    <select name="course_lang" id="course_lang" class="form-select form-control">
                                        <?php foreach($school_medium as $medium){ ?>
                                        <option value='<?=$medium['value']; ?>'> <?=$medium['value']; ?> </option>
                                        <?php } ?>
                                    </select>

                                    <div class='d-none btn-danger check_course_lang' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i> Enter Valid Course Language
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-label-group">
                                    <label for="course_sm_descp">Course Small Description :</label>
                                    <input type="text" class="form-control form-control-flush" id="course_sm_descp" placeholder="Course Small Description">
                                    
                                    <div class='d-none btn-danger check_course_sm_descp' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i> Enter Valid Course Description
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-label-group">
                                    <label for="course_descp"> Description :</label>
                                    <textarea type="text" class="form-control form-control-flush" id="course_descp" rows="3" placeholder="Description" style='resize: none;'></textarea>
                                    
                                    <div class='d-none btn-danger check_course_descp' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i> Enter Valid Course Description
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-15">
                                <div class="switch-container">
                                    <div class="switch-holder">
                                        <div class="switch-label">
                                            <span>Course Visibility :</span>
                                        </div>

                                        <div class="switch-toggle">
                                            <input type="checkbox" id="course_visibility">
                                            <label for="course_visibility"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 mt-15">
                                <div class="switch-container">
                                    <div class="switch-holder">
                                        <div class="switch-label">
                                            <span>Course Certificate :</span>
                                        </div>

                                        <div class="switch-toggle">
                                            <input type="checkbox" id="course_certificate">
                                            <label for="course_certificate"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer col-12">
                                <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                                &nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn btn btn-primary waves-effect waves-light">Add Course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Course.js"></script>