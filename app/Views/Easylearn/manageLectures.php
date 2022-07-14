<?php include 'template/login_header.php';  

    if($session->get('user')['permissions'] == 'School')
    {
        $batch = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], 0), true);
    }
    elseif($session->get('user')['permissions'] == 'Classroom')
    {
        $batch = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], $session->get('classroom_id')), true);
    }

    $lecturer = json_decode(get_lecturer_name($session->get('user')['permissions'], $session->get('user')['reg_id']), true);
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_schedule_modal">Add Schedule</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class='row'>
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div id="schedule_calendar">  
                                                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>

<!-- Modal Add Schedule -->
<div class="modal fade none-border add_schedule_modal add-category" id="add_schedule_modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add a schedule</strong></h4>
            </div>

            <form id='add_schedule'>
                <?php $session->set('add_schedule_token', md5(uniqid(mt_rand(), true))); ?>
                <input type="hidden" id='add_schedule_token' name="add_lecture_token" value="<?=$session->get('add_schedule_token'); ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label style='color: #969ba0;' class="control-label form-label">Lecture Name</label>
                            <input class="form-control form-white" placeholder="Enter name" id='lecture_name' type="text" name="lecture-name" >
                            
                            <div class='d-none btn-danger check_lecture_name' style='font-size: 12px; padding-left: 20px;'>
                                <i class="fas fa-times-circle"></i> Enter valid Lecture Name
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Lecture Date</label>
                            <input class="form-control form-white" placeholder="Enter Date" id='lecture_date' type="text" name="lecture-date" >
                            
                            <div class='d-none btn-danger check_lecture_date' style='font-size: 12px; padding-left: 20px;'>
                                <i class="fas fa-times-circle"></i> Enter valid Lecture Date
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Lecture Color</label>
                            <select class="form-control form-white" data-placeholder="Choose a color..." id='lecture_color' name="lecture-color" >
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="form-label-group">
                                <label for="batch_name">Batch Name :</label>
                                <select id="batch_name" class="form-control">
                                    <?php if($batch['data'] != 0){ foreach ($batch['data'] as $batch_name) { ?>
                                        <option value="<?=$batch_name['id']?>"><?=$batch_name['batch_name']?></option>
                                    <?php } } ?>
                                </select>
                                <div class="d-none check-batch_name" style="font-size:12px;"></div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="form-label-group">
                                <label for="lecturer_name">Lecturer Name :</label>
                                <select id="lecturer_name" class="form-control">

                                    <?php if($lecturer['data'] != 0){ foreach ($lecturer['data'] as $lecturer_name) { ?>
                                        <option value="<?=$lecturer_name['id']?>"><?=$lecturer_name['username']?></option>
                                    <?php } } ?>
                                </select>
                                <div class="d-none check-lecturer_name" style="font-size:12px;"></div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">Start Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose start time" id='lecture_start_time' type="text" name="start-time" >
                                
                                <div class='d-none btn-danger check_lecture_start_time' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Enter valid Lecture Time
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">End Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose end time" id='lecture_end_time' type="text" name="end-time" >
                                
                                <div class='d-none btn-danger check_lecture_end_time' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Enter valid Lecture Time
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View Schedule -->
<div class="modal fade none-border add-category add-category" id="edit-category" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Schedule</strong></h4>
            </div>

            <form id='edit_schedule'>
                <?php $session->set('edit_schedule_token', md5(uniqid(mt_rand(), true))); ?>
                <input type="hidden" id='edit_schedule_token' name="edit_schedule_token" value="<?=$session->get('edit_schedule_token'); ?>">
                <input type="hidden" id='start_date' name="start_date" value="">                        
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-12 ">
                            <div class="form-label-group">
                                <select id="sc_batch_name" class="form-control text-center" disabled>
                                    <?php if($batch['data'] != 0){  foreach ($batch['data'] as $batch_name) { ?>
                                        <option value="<?=$batch_name['id']?>"><?=$batch_name['batch_name']?></option>
                                    <?php } } ?>
                                </select>
                                <div class="d-none check-sc_course_name" style="font-size:12px;"></div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Lecture Name</label>
                            <input class="form-control form-white" placeholder="Enter name" id='schedule_name' type="text" name="lecture-name">
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Select Teacher</label>
                            <select class="form-control form-white" data-placeholder="Choose a Teascher..." id='schedule_mentor' name="select-teacher">
                                <?php if($lecturer['data'] != 0){  foreach ($lecturer['data'] as $lecturer_name) { ?>
                                    <option value="<?=$lecturer_name['id']?>"><?=$lecturer_name['username']?></option>
                                <?php } } ?>
                            </select>
                        </div>
                  
                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">Start Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose start time" id='schedule_start_time' type="text" name="start-time">
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <div class="bootstrap-timepicker">
                                <label style='color: #969ba0;' class="control-label form-label">End Time</label>
                                <input class="form-control form-white timepicker" placeholder="Choose end time" id='schedule_end_time' type="text" name="end-time">
                            </div>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Choose Lecture Color</label>
                            <select class="form-control form-white" data-placeholder="Choose a color..." id='schedule_color' name="lecture-color">
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                            </select>
                        </div>

                        <div class="col-md-6 mt-15">
                            <label style='color: #969ba0;' class="control-label form-label">Meet Link</label>
                            <input class="form-control form-white" placeholder="Meet Link" type="text" id='schedule_url' name="schedule-url" disabled>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class='row' style='width: 100%'>
                        <div class='col-6'>
                            <button type="button" class="btn btn-danger waves-effect waves-light delete_schedule">Delete</button>
                            <button type="submit" class="btn btn-info waves-effect">Edit</button>
                        </div>

                        <div class='col-6' style='text-align: right'>
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <a href='#' target='_blank' id='meet_url' class="btn btn-primary save-category waves-effect waves-light">Start Meet</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/vendor_components/moment/min/moment.min.js"></script>
<script src="<?=base_url(); ?>/public/Easylearn/vendor_components/fullcalendar/main.min.js"></script>
<script src="<?=base_url(); ?>/public/Easylearn/js/Schedule.js"></script>

