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
                    <h3>Mentor Requests</h3>
                </div>

                <div class="table-responsive">
                    <table id="mentor_requests" class="table p-5" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Mentor Name</th>
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">Field of Expertise</th>
                                <th scope="col">Experience (Yrs)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade show" id="viewmentor" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel" style="color:#3c6fd0;">Mentor Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size:25px;">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 50px;">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="text-center">
                                <img src="" class="img border border-primary mentor_image" style="height: 200px; width: 200px; border-radius:50%; padding: 5px;" alt="">
                            </div>

                            <div class="text-center m-3">
                                <h4><b class="m_name">Ravi Shanker</b></h4>
                                <p class="m_expt">Product Developer</p>
                                <a href="" type="button" class="btn m_resume mb-2 btn-info"><i class="fa fa-solid fa-file"></i> Resume</a>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-md mentor_approve btn-primary">
                                    Approve
                                </button>&emsp;

                                <button type="button" class="btn btn-md mentor_disapprove btn-danger">
                                    Disapprove
                                </button>
                            </div>
                        </div>

                        <div class="col-12 col-lg-7 mt-3">
                            <p style="padding-left:5px;"><i class="fa fa-solid fa-user"></i> &nbsp; <b>About</b></p>
                            <hr class="MentorHrTag">

                            <div class="row">
                                <div class="col-3">
                                    <b >Experience: </b>
                                </div>

                                <div class="col-9">
                                    <span class="m_exp">2</span>
                                </div>
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-3">
                                    <b>Skills:</b>
                                </div>

                                <div class="col-9">
                                    <ul class="list-unstyled m_skils">
                                        <li>Designer</li>
                                        <li>Programmer</li>
                                        <li>Coral Draw</li>
                                        <li>Coral Draw</li>
                                    </ul>
                                </div>   
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-3">
                                    <b>Phone:</b>
                                </div>

                                <div class="col-9 m_contact">
                                    +91 7678675767
                                </div>
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-3">
                                    <b>Email:</b>
                                </div>

                                <div class="col-9 m_email">
                                    RaviShankar@gmail.com
                                </div>
                            </div>
                            <br>

                            <hr class="MentorHrTag">
                            <div class="row">
                                <div class="col-3">
                                    <b>DOB:</b>
                                </div>

                                <div class="col-9 m_dob">
                                    30-02-2022
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <b>Address:</b>
                                </div>

                                <div class="col-9 m_addr">
                                    Video provides a powerful way to help you prove your point. When you click Online
                                    Video, you can paste in the embed code for the video you want to add.
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-3">
                                    <b>Description:</b>
                                </div>

                                <div class="col-9">
                                    <p class="m_descp">
                                        Video provides a powerful way to help you prove your point. When you click Online
                                        Video, you can paste in the embed code for the video you want to add.    
                                    </p>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url(); ?>/public/Easylearn/js/Approve.js"></script>

<?php 
    include 'template/login_footer.php';
?>