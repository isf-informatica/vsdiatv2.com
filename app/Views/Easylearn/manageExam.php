<?php 
    include 'template/login_header.php'; 

    if($session->get('user')['permissions']=='School' || $session->get('user')['permissions']=='Jr College')
    {
        $course_details    = json_decode(course_details_getdata($session->get('user')['permissions'], $session->get('user')['reg_id'], $session->get('user')['id'],0), true);
        $classroom = json_decode(get_classroom($session->get('user')['permissions'], $session->get('user')['reg_id']), true)['data'];
    }
    elseif ($session->get('user')['permissions']=='Classroom') 
    {
        $course_details    = json_decode(course_details_getdata($session->get('user')['permissions'], $session->get('user')['reg_id'], $session->get('user')['id'],$session->get('classroom_id')), true);
    }
?>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add-exam">Add Exam</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Exam List</h4>

                    <div class="table-responsive p-3">
                        <table id="exam_list" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Exam Title</th>
                                    <th>Exam Category</th>
                                    <th>Course Name</th>
                                    <th>Exam Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
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
<section>

<!-- Modal Add Exam -->
<div class="modal fade none-border add-category" id="add-exam" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Exam</strong></h4>
            </div>

            <form id='add_mcq_exam'>
                <?php $session->set('add_exam_token', md5(uniqid(mt_rand(), true))); ?>
                <input type="hidden" id='add_exam_token' name="add_exam_token" value="<?=$session->get('add_exam_token'); ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Title</label>
                            <input class="form-control form-white" placeholder="Enter name" id='exam_title' type="text" name="exam_title" required>
                            <div class='d-none btn-danger check_exam_title' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter valid Exam Title</div>
                        </div>

                        <?php if($session->get('user')['permissions'] == 'School' || $session->get('user')['permissions'] == 'Jr College'){ ?>
                        <div class="col-md-12 mt-15">
                            <div class="form-label-group">
                                <label style='color: #969ba0;' class="control-label form-label">Classroom Name :</label>

                                <select class="form-control form-control-flush" id='classroom_id'>
                                    <?php if($classroom != 'No data'){ foreach($classroom as $class){ ?>
                                        <option value='<?=$class['id'] ?>'> <?=$class['classroom_name']; ?> </option>
                                    <?php } } ?>
                                </select>
                                <div class='d-none btn-danger check_classroom_id' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Select Classroom Name</div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($session->get('user')['permissions'] == 'Classroom'){ ?>
                            <input type="hidden" id='classroom_id' name="classroom_id" value="<?=$session->get('classroom_id'); ?>">
                            <div class='d-none btn-danger check_classroom_id' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Select Classroom</div>
                        <?php } ?>

                        
                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Course</label>
                            <select class="form-control form-white" data-placeholder="Choose a course..." id='exam_course' name="exam_course" required>
                                <option value="">Please Classroom room</option>
                            </select>
                            <div class='d-none btn-danger check_exam_course' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Select Course</div>
                        </div>
    

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Date</label>
                            <input class="form-control form-white" placeholder="Enter Date" id='exam_date' type="text" name="exam_date" required>
                            <div class='d-none btn-danger check_exam_date' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Date</div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Duration (min)</label>
                            <input class="form-control form-white" placeholder="Enter Duration" id='exam_duration' type="number" name="exam_duration" required>
                            <div class='d-none btn-danger check_exam_duration' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Category</label>
                            <select class="form-control form-white" data-placeholder="Choose category..." id='exam_category' name="exam_category" required>
                                <option value="MCQ Exam">MCQ Exam</option>
                                <option value="Sentence Completion">Sentence Completion</option>
                                <option value="Short Answer">Short Answer</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">Start Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose start time" id='exam_start_time' type="text" name="start-time" required>
                                <div class='d-none btn-danger check_exam_start_time' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Time</div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">End Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose end time" id='exam_end_time' type="text" name="end-time" required>
                                <div class='d-none btn-danger check_exam_end_time' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Time</div>
                            </div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Right Answer Mark</label>
                            <input class="form-control form-white" placeholder="Enter Right Mark" id='exam_right_mark' type="number" name="exam_right_mark" required>
                            <div class='d-none btn-danger check_exam_right_mark' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Wrong Answer Mark</label>
                            <input class="form-control form-white" placeholder="Enter Wrong Mark" id='exam_wrong_mark' type="number" name="exam_wrong_mark" required>
                            <div class='d-none btn-danger check_exam_wrong_mark' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="switch-container">
                                <div class="switch-holder">
                                    <div class="switch-label">
                                        <span>Show Result</span>
                                    </div>

                                    <div class="switch-toggle">
                                        <input type="checkbox" id="show_result">
                                        <label for="show_result"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="switch-container">
                                <div class="switch-holder">
                                    <div class="switch-label">
                                        <span>Multiple Response</span>
                                    </div>

                                    <div class="switch-toggle">
                                        <input type="checkbox" id="multiple_response">
                                        <label for="multiple_response"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Exam -->
<div class="modal fade none-border add-category" id="edit-exam" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Exam</strong></h4>
            </div>

            <form id='edit_mcq_exam'>
                <?php $session->set('edit_exam_token', md5(uniqid(mt_rand(), true))); ?>
                <input type="hidden" id='edit_exam_token' name="edit_exam_token" value="<?=$session->get('edit_exam_token'); ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Title</label>
                            <input class="form-control form-white" placeholder="Enter name" id='edit_exam_title' type="text" name="edit_exam_title" required>
                            <div class='d-none btn-danger check_edit_exam_title' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter valid Exam Title</div>
                        </div>

                        <?php if($session->get('user')['permissions'] == 'School' || $session->get('user')['permissions'] == 'Jr College'){ ?>
                        <div class="col-md-12 mt-15">
                            <div class="form-label-group">
                                <label style='color: #969ba0;' class="control-label form-label">Classroom Name :</label>

                                <select class="form-control form-control-flush" id='edit_classroom_id'>
                                    <?php if($classroom != 'No data'){ foreach($classroom as $class){ ?>
                                        <option value='<?=$class['id'] ?>'> <?=$class['classroom_name']; ?> </option>
                                    <?php } } ?>
                                </select>
                                <div class='d-none btn-danger check_edit_classroom_id' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Select Classroom Name</div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($session->get('user')['permissions'] == 'Classroom'){ ?>
                            <input type="hidden" id='edit_classroom_id' name="classroom_id" value="<?=$session->get('classroom_id'); ?>">
                            <div class='d-none btn-danger check_edit_classroom_id' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Select Classroom</div>
                        <?php } ?>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Course</label>
                            <select class="form-control form-white" data-placeholder="Choose a course..." id='edit_exam_course' name="edit_exam_course" required>

                                <?php if($course_details['data'] != 'False'){ foreach($course_details['data'] as $course){ ?>
                                <option value=<?=$course['id'] ?>> <?=$course['course_name'] ?> </option>
                                <?php } } ?>
                            </select>
                        </div>


                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Date</label>
                            <input class="form-control form-white" placeholder="Enter Date" id='edit_exam_date' type="text" name="edit_exam_date" required>
                            <div class='d-none btn-danger check_edit_exam_date' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Date</div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Exam Duration (min)</label>
                            <input class="form-control form-white" placeholder="Enter Duration" id='edit_exam_duration' type="number" name="edit_exam_duration" required>
                            <div class='d-none btn-danger check_edit_exam_duration' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Category</label>
                            <select class="form-control form-white" data-placeholder="Choose category..." id='edit_exam_category' name="edit_exam_category" required>
                                <option value="MCQ Exam">MCQ Exam</option>
                                <option value="Sentence Completion">Sentence Completion</option>
                                <option value="Short Answer">Short Answer</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">Start Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose start time" id='edit_exam_start_time' type="text" name="start-time" required>
                                <div class='d-none btn-danger check_edit_exam_start_time' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Time</div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">End Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose end time" id='edit_exam_end_time' type="text" name="end-time" required>
                                <div class='d-none btn-danger check_edit_exam_end_time' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Choose valid Time</div>
                            </div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Right Answer Mark</label>
                            <input class="form-control form-white" placeholder="Enter Right Mark" id='edit_exam_right_mark' type="number" name="edit_exam_right_mark" required>
                            <div class='d-none btn-danger check_edit_exam_right_mark' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6  mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Wrong Answer Mark</label>
                            <input class="form-control form-white" placeholder="Enter Wrong Mark" id='edit_exam_wrong_mark' type="number" name="edit_exam_wrong_mark" required>
                            <div class='d-none btn-danger check_edit_exam_wrong_mark' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i> Enter Valid Mark</div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="switch-container">
                                <div class="switch-holder">
                                    <div class="switch-label">
                                        <span>Show Result</span>
                                    </div>

                                    <div class="switch-toggle">
                                        <input type="checkbox" id="edit_show_result">
                                        <label for="edit_show_result"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="switch-container">
                                <div class="switch-holder">
                                    <div class="switch-label">
                                        <span>Multiple Response</span>
                                    </div>

                                    <div class="switch-toggle">
                                        <input type="checkbox" id="edit_multiple_response">
                                        <label for="edit_multiple_response"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    &nbsp;
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    &nbsp;
                    <button type="button" id='delete_mcq_exam' class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?=base_url(); ?>/public/Easylearn/js/exam.js"></script>
<script src="<?=base_url(); ?>/public/easylearn/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
<?php include 'template/login_footer.php'; ?>