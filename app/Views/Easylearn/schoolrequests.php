<?php 
    include 'template/login_header.php';
?>

<section class="content">
    <div class="row">
        <div class='col-md-12 mt-30'>
            <div class="panel">
                <div class="text-start p-3">
                    <a href="dashboard" class="btn btn-info active">
                        <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                    </a>
                </div>

                <div class="text-center">
                    <h3>School Requests</h3>
                </div>

                <ul class="nav nav-tabs customtab2 d-flex justify-content-center pt-30" role="tablist">
                    <li class="nav-item mt-20">
                        <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab" href="#first-stage" role="tab">
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right::before"></i>
                            </span>

                            <span class="hidden-xs-down">First Stage</span>
                        </a>
                    </li>

                    <li class="nav-item mt-20">
                        <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab" href="#final-stage" role="tab">
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right::before"></i>
                            </span>

                            <span class="hidden-xs-down">Final Stage</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="first-stage" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table id="first_school_requests" class="table align-middle p-5" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sr. No.</th>
                                                        <th scope="col">School Name</th>
                                                        <th scope="col">School Type</th>
                                                        <th scope="col">Board Type</th>
                                                        <th scope="col">School Medium</th>
                                                        <th scope="col">School Code</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="final-stage" role="tabpanel">
                        <div class="p-15">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box-body">
                                        <div class="table-responsive ">
                                            <table id="final_school_requests" class="table p-5" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sr. No.</th>
                                                        <th scope="col">School Name</th>
                                                        <th scope="col">School Type</th>
                                                        <th scope="col">Board Type</th>
                                                        <th scope="col">School Medium</th>
                                                        <th scope="col">School Code</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
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

<div class="modal fade show" id="view_school_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel" style="color:#3c6fd0;">School Information: </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 mt-3 align-self-center">
                        <div class="text-center">
                            <img src="" class="img school_logo" style="height: 200px; width: 200px; border-radius:50%;" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mt-3 align-self-center">
                        <div class="text-center">
                            <img src="" class="img school_image" style="height: 200px; width: 200px; border-radius:50%;" alt="">
                        </div>
                    </div>

                    <div class="col-12 col-md-12 align-self-center">
                        <div class="text-center m-3">
                            <h4><b class="school_name"> School Name</b></h4>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 mt-3">
                        <hr class="MentorHrTag">
                    </div>

                    <div class='col-12 col-lg-5 mt-3'>
                        <p style="padding-left:5px;"><i class="fa fa-solid fa-user"></i> &nbsp; <b>About</b></p>

                        <div class="row">
                            <div class="col-5">
                                <b>School Type :</b>
                            </div>

                            <div class="col-7 school_type">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Board Type :</b>
                            </div>

                            <div class="col-7 board_type">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>School Medium :</b>
                            </div>

                            <div class="col-7 school_medium">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>School Code:</b>
                            </div>

                            <div class="col-7 school_code">
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-5">
                                <b>Is Co-ed :</b>
                            </div>

                            <div class="col-7 is_coed">
                            </div>
                        </div>
                        <br>

                        <div class="row d-none">
                            <div class="col-5">
                                <b>Gender Type :</b>
                            </div>

                            <div class="col-7 gender_type">
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class='col-lg-1 mt-3'></div>

                    <div class='col-12 col-lg-5 mt-3'>
                        <p style="padding-left:5px;"><i class="fa fa-solid fa-user"></i> &nbsp; <b>Contact Details</b></p>

                        <div class="row">
                            <div class="col-5">
                                <b>Contact Number 1 :</b>
                            </div>

                            <div class="col-7 contact_number_1">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Contact Number 2 :</b>
                            </div>

                            <div class="col-7 contact_number_2">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Administrator Name :</b>
                            </div>

                            <div class="col-7 administrator_name">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Administrator Email :</b>
                            </div>

                            <div class="col-7 administrator_email">
                            </div>
                        </div>
                        <br>

                        <div class="row d-none">
                            <div class="col-7">
                                <b>Principal's Letter :</b>
                            </div>

                            <div class="col-5">
                                <a href="" class="btn btn-light btn-xl pl_doc  pl-2 mt-2 pr-2 mb-1">
                                    <i class="fas fa-file-download"></i>&nbsp; Download
                                </a>
                            </div>
                        </div>
                        <br>

                        <div class="row d-none">
                            <div class="col-7">
                                <b>University Affiliation Certificate :</b>
                            </div>

                            <div class="col-5">
                                <a href="" class="btn btn-light btn-xl uac_doc  pl-2 mt-2 pr-2 mb-1">
                                    <i class="fas fa-file-download"></i>&nbsp; Download
                                </a>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class='col-12 col-lg-12 mt-3'>
                        <p style="padding-left:5px;"><i class="fa fa-solid fa-user"></i> &nbsp; <b>Address</b></p>
                        <hr class="MentorHrTag">

                        <div class="row">
                            <div class="col-5">
                                <b>Address Line 1 :</b>
                            </div>

                            <div class="col-7 address_line_1">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Address Line 2 :</b>
                            </div>

                            <div class="col-7 address_line_2">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Country :</b>
                            </div>

                            <div class="col-7 school_country">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>State :</b>
                            </div>

                            <div class="col-7 school_state">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>City :</b>
                            </div>

                            <div class="col-7 school_city">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Postal Code :</b>
                            </div>

                            <div class="col-7 postal_code">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-5">
                                <b>Description :</b>
                            </div>

                            <div class="col-7 description">
                            </div>
                        </div>
                        <br>

                        <hr class="MentorHrTag">
                    </div>

                    <div class="col-12 mt-3">
                        <div class='d-flex justify-content-center p-5'>
                            <button type="button" id="school_disapprove" class="btn waves-effect waves-light btn-danger btn-md">Disapprove</button>&emsp;&emsp;
                            <button type="button" id="school_approve" class="btn waves-effect waves-light btn-primary btn-md">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url(); ?>/public/Easylearn/js/Approve.js"></script>

<?php 
    include 'template/login_footer.php';
?>