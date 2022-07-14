<?php include 'template/login_header.php'; ?>


<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active"><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>
                        
                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="addStudents" class="btn btn-primary">Add Students</a>
                            </div>
                        </div>

                    </div>

                    <h4 class="text-center text-dark bold">Student List</h4>
                    <div class="table-responsive p-3">
                        <table id="student_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade show" id="view_student_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel" style="color:#3c6fd0;">
                    Students's Information:
                </h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-5 align-self-center">
                        <div class="text-center">
                            <img src="" class="img border border-primary student_image" style="height: 200px; width: 200px; border-radius:50%;" alt="">
                        </div>

                        <div class="text-center m-3">
                            <h4><b class="s_name">Ravi Shanker</b></h4>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 mt-3">
                        <p style="padding-left:5px;">
                            <i class="fa fa-solid fa-user"></i> &nbsp; <b>About</b>
                        </p>

                        <div class="row">
                            <div class="col-4">
                                <b>Email:</b>
                            </div>

                            <div class="col-8 s_email">
                                RaviShankar@gmail.com
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Description:</b>
                            </div>

                            <div class="col-8">
                                <p class="s_descp">
                                    Video provides a powerful way to help you prove your point. When you click
                                    Online
                                    Video, you can paste in the embed code for the video you want to add.
                                </p>
                            </div>
                        </div>
                        <br>
                        <hr class="MentorHrTag">

                        <div class='d-flex justify-content-center p-5'>
                            <button type='button' class="btn btn-rounded btn-danger delete-student"> 
                                <i class="ti-close"> Delete </i> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js"></script>
<?php include 'template/login_footer.php'; ?>