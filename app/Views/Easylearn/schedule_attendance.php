<?php include 'template/login_header.php'; ?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="manageAttendance" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add-attendance">Add Attendance</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Attendance List</h4>
                    <div class="table-responsive p-3">
                        <table id="schedule_attendance_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Total Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="add-attendance" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Attendance</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form class="p-t10" id="add_attendance">
                <div class="modal-body">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('attendance_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='attendance_token' name="attendance_token" value="<?=$session->get('attendance_token'); ?>">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="attendance_status">Attendance Status :</label>
                                <select class="form-control" id='attendance_status' data-placeholder="Select Status" style="width: 100%;">
                                    <option value='Present'> Present </option>
                                    <option value='Absent'> Absent </option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-12 m-15 align-self-center'>
                            <div class="table-responsive p-5">
                                <table id="attendance_students_list" class="table" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Student Name</th>
                                            <th>Student Email</th>
                                        </tr>
                                    </thead>
                                </table>
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

<script src="<?=base_url(); ?>/public/Easylearn/js/classroom.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>