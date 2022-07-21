<?php include 'template/login_header.php'; ?>

<div class="modal fade none-border add-category" id="add_mentor_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Mentor</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form id="add_mentor">
                <div class="row justify-content-center p-15">
                    <?php $session->set('mentor_token', md5(uniqid(mt_rand(),true))); ?>
                    <input type="hidden" id='mentor_token' name="mentor_token"
                        value="<?=$session->get('mentor_token'); ?>">
                    <div class="col-md-5 mb-15">
                        <div class="form-label-group">
                            <label for="m_name">Mentor Name</label>
                            <input type="text" class="form-control form-control-flush" id="m_name"
                                placeholder="Mentor Name">
                            <div class="d-none bg-danger check-m_name" style="font-size:12px;padding-left: 20px;"><i
                                    class="fas fa-times-circle"></i>Name cannot be blank</div>
                        </div>
                    </div>


                    <div class="col-md-5 mb-15">
                        <div class="form-label-group">
                            <label for="m_emailid">Email ID</label>
                            <input type="email" class="form-control form-control-flush" id="m_emailid"
                                placeholder="Mentor Email ID">
                            <div class="d-none bg-danger check-m_emailid" style="font-size:12px;padding-left: 20px;"><i
                                    class="fas fa-times-circle"></i>Enter valid Email ID</div>
                        </div>
                    </div>

                    <br>
                    <div class="col-4">
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn btn-primary">Add Mentor</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade show" id="edit_mentor_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel" style="color:#3c6fd0;">Mentor Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body"
                style="padding: 50px;background-image: linear-gradient(to top, #f6ebe3bb, #f6f4fdcc);">
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <div class="text-center">
                            <img src="" class="img border border-primary mentor_image"
                                style="width:50%;border-radius:75%;" alt="">
                        </div>
                        <div class="text-center m-3">
                            <h4><b class="m_name">Ravi Shanker</b></h4>
                            <p class="m_email">Product Developer</p>
                        </div>
                    </div>
                    <div class='d-flex justify-content-center p-5'>
                        <a class="btn btn-rounded btn-danger delete_mentor" data-id=""> <i class="ti-trash"> Delete</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <!-- <a href="addmentors" class="btn btn-secondary m-5" style="align:right;">Add mentors</a><br> -->
    <div class="row d-flex justify-content-center">
        <!-- <a href="addmentors" class="btn btn-secondary m-5" style="float:right;">Add mentors</a> -->
        <div class="col-12 pb-20">
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
                                <button type="button" id="add_mentor_btn" class="btn btn-primary m-15">Add Mentors</button>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Mentor List</h4>
                    <div class="table-responsive p-3">
                        <table id="mentor_view" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Mentor Name</th>
                                    <th>Mentor Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>
<script src="<?=base_url(); ?>/public/easylearn/js/cls_mentor.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>
