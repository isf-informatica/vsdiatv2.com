<?php include 'template/login_header.php'; ?>

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
                                <button class="btn btn-primary" id="add_anc_btn">Add Announcements</button>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center text-dark bold">Announcements</h3>
                    <div class="table-responsive p-3">
                        <table id="anc_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Topic</th>
                                    <th>Announcements</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade none-border add-category" id="add_anc_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Announcements</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="add_anc_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('anc_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='anc_token' name="anc_token" value="<?=$session->get('anc_token'); ?>">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="topic">Topic :</label>
                                <input type="text" class="form-control form-control-flush" id="topic"
                                    placeholder="Topic">
                                <div class='d-none bg-danger check-topic' style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="anc_date">Date :</label>
                                <input type="text" class="form-control form-control-flush" id="anc_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-anc_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <div class="bootstrap-timepicker">
                                    <label style='color: #969ba0;' class="control-label form-label">Time</label>
                                    <input class="form-control form-white anc_time" placeholder="Choose start time"
                                        id='anc_time' type="text" name="start-time" autocomplete="off">
                                </div>
                                <div class='d-none bg-danger check-anc_time' style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="announcements">Announcements :</label>
                                <input type="text" class="form-control form-control-flush" id="announcements"
                                    placeholder="Announcements">
                                <div class='d-none bg-danger check-announcements'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn btn-primary add_anc" id="add_anc">Add
                                Announcements</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade none-border add-category" id="edit_anc_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Announcements</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_anc_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('edit_anc_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='edit_anc_token' name="edit_anc_token"
                            value="<?=$session->get('edit_anc_token'); ?>">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_topic">Topic :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_topic"
                                    placeholder="Topic">
                                <div class='d-none bg-danger check-edit_topic'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_anc_date">Date :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_anc_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-edit_anc_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <div class="bootstrap-timepicker">
                                    <label style='color: #969ba0;' class="control-label form-label">Time</label>
                                    <input class="form-control form-white edit_anc_time" placeholder="Choose start time"
                                        id='edit_anc_time' type="text" name="start-time">
                                </div>
                                <div class='d-none bg-danger check-edit_anc_time'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_announcements">Announcements :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_announcements"
                                    placeholder="Announcements">
                                <div class='d-none bg-danger check-edit_announcements'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn btn-primary edit_anc" id="edit_anc">
                                Edit</button>
                            <button type="button" class="btn del_anc_btn" style="background-color:red;color:white;">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/vendor_components/moment/min/moment.min.js"></script>
<script src="<?=base_url(); ?>/public/Easylearn/js/media.js?<?=date("Ymd") ?>"></script>