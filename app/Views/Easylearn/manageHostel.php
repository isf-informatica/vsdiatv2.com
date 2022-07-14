<?php include 'template/login_header.php';?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active"><i
                                        class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary add_hostel"> Add Hostel </a>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Hostel List</h4>
                    <div class="table-responsive p-3">
                        <table id="hostel_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Hostel Name</th>
                                    <th>Hostel Type</th>
                                    <th>No Of Rooms</th>
                                    <th>People Capacity Per Room</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="edit_hostel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Hostel</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                <form id="edit_hostel_form">
                    <div class="row d-flex justify-content-center">
                        <?php $session->set('hostel_edit_token', md5(uniqid(mt_rand(), true)));?>
                        <input type="hidden" id='hostel_edit_token' name="hostel_edit_token"
                            value="<?=$session->get('hostel_edit_token');?>">
                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="edit_hostel_nm">Hostel Name</label>
                                <input type="text" class="form-control form-control-flush" id="edit_hostel_nm"
                                    placeholder="Hostel Name">

                                <div class="d-none bg-danger check_edit_hostel_nm"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i>Invalid Name
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="edit_hostel_type">Hostel Type</label>
                                <select name="" id="edit_hostel_type" class="form-control form-select">
                                    <option value="Boys">Boys</option>
                                    <option value="Girls">Girls</option>
                                    <option value="Both">Both</option>

                                </select>

                                <div class="d-none bg-danger check_edit_hostel_type"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No Of Rooms
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="edit_no_of_rooms">No Of Rooms</label>
                                <input type="number" class="form-control form-control-flush" id="edit_no_of_rooms"
                                    placeholder="No Of Rooms" min="1" value="1">

                                <div class="d-none bg-danger check_edit_no_of_rooms"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No Of Rooms
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="edit_room_capcity">People Capacity Per Room</label>
                                <input type="number" class="form-control form-control-flush" id="edit_room_capcity"
                                    placeholder="Total Capacity" min="1" value="1">

                                <div class="d-none bg-danger check_edit_room_capcity"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No of availability
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-3 edit_btn">Edit</button>
                            <button type="button" class="btn btn-danger mt-3 del_btn">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border add-category" id="add_hostel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Hostel</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                <form id="add_hostel_form">
                    <div class="row d-flex justify-content-center">
                        <?php $session->set('hostel_add_token', md5(uniqid(mt_rand(), true)));?>
                        <input type="hidden" id='hostel_add_token' name="hostel_add_token"
                            value="<?=$session->get('hostel_add_token');?>">
                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="hostel_nm">Hostel Name</label>
                                <input type="text" class="form-control form-control-flush" id="hostel_nm"
                                    placeholder="Hostel Name">

                                <div class="d-none bg-danger check_hostel_nm"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i>Invalid Name
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="hostel_type">Hostel Type</label>
                                <select name="" id="hostel_type" class="form-control form-select">
                                    <option value="Boys">Boys</option>
                                    <option value="Girls">Girls</option>
                                    <option value="Both">Both</option>

                                </select>

                                <div class="d-none bg-danger check_hostel_type"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No Of Rooms
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="no_of_rooms">No Of Rooms</label>
                                <input type="number" class="form-control form-control-flush" id="no_of_rooms"
                                    placeholder="No Of Rooms" min="1" value="1">

                                <div class="d-none bg-danger check_no_of_rooms"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No Of Rooms
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-label-group mt-3">
                                <label for="room_capcity">People Capacity Per Room</label>
                                <input type="number" class="form-control form-control-flush" id="room_capcity"
                                    placeholder="Total Capacity" min="1" value="1">

                                <div class="d-none bg-danger check_room_capcity"
                                    style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i> Invalid No of availability
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mt-3 form-control">Add Hostel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php';?>
<script src="<?=base_url();?>/public/Easylearn/js/mis.js?<?=date("Ymd")?>"></script>