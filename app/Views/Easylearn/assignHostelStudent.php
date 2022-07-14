<?php include 'template/login_header.php';

$student = json_decode(get_student($session->get('user')['permissions'], $session->get('user')['reg_id'], ''), true);
$student_availability =  json_decode(student_availability($session->get('user')['reg_id']), true);

?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="manageHostel" class="btn btn-info active"><i
                                        class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary assign_student">Assign Student</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold hostel_nm">Hostel Name</h4>
                    <div class="table-responsive p-3">
                        <table id="assign_student_hostel_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Room No</th>
                                    <th>Student Name / Email</th>
                                    <th>Student Gender</th>
                                    <th>Compartment</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<div class="modal fade none-border add-category" id="assign_student" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Assign Student Hostel</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="assign_hostel_student">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="room_no">Room No :</label>
                                <select name="" id="room_no" class="room_no form-control form_select">

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cmpt_no">Compartment No :</label>
                                <select name="" id="cmpt_no" class="cmpt_no form-control form_select">

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="student_id">Student Name :</label>
                                <select name="" id="student_id" class="student_id form-control form_select">

                                    <?php if($student_availability['data'] != 'FALSE') { 
                                        foreach ($student_availability['data'] as $dat) {?>
                                    <option value="<?=$dat['account_id']?>"><?=$dat['student_name']?> -
                                        <?=$dat['student_emailid']?> - <?=$dat['student_gender']?></option>
                                    <?php } }else{ ?>
                                        <option value="">No Student</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="check_in">Check In Date :</label>
                                <input type="text" name="" id="check_in" class="datepicker form-control"
                                    placeholder="Check In Date">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="check_out">Check Out Date :</label>
                                <input type="text" name="" id="check_out" class="datepicker form-control"
                                    placeholder="Check Out Date">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Assign To Student</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade none-border add-category" id="edit_assign_student" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Assign Student Hostel</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="edit_assign_hostel_student">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_room_no">Room No :</label>
                                <select name="" id="edit_room_no" class="edit_room_no form-control form_select">

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_cmpt_no">Compartment No :</label>
                                <select name="" id="edit_cmpt_no" class="edit_cmpt_no form-control form_select">

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="edit_student_id">Student Name :</label>
                                <select name="" id="edit_student_id" class="edit_student_id form-control form_select">

                                    <?php if($student_availability['data'] != 'FALSE') { 
                                        foreach ($student_availability['data'] as $dat) {?>
                                    <option value="<?=$dat['account_id']?>"><?=$dat['student_name']?> -
                                        <?=$dat['student_emailid']?> - <?=$dat['student_gender']?></option>
                                    <?php } }else{ ?>
                                        <option value="">No Student</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_check_in">Check In Date :</label>
                                <input type="text" name="" id="edit_check_in" class="datepicker form-control"
                                    placeholder="Check In Date">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="edit_check_out">Check Out Date :</label>
                                <input type="text" name="" id="edit_check_out" class="datepicker form-control"
                                    placeholder="Check Out Date">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Edit Assign To Student</button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?php include 'template/login_footer.php';?>
<script src="<?=base_url();?>/public/Easylearn/js/mis.js?<?=date("Ymd")?>"></script>