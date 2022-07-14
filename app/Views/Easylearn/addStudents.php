<?php 
    include 'template/login_header.php';
?>
<style>
    label {
        font-weight: bold;
    }

    textarea {
        resize: none;
    }

    .DownloadTemplate {
        border-radius: 15px;
    }

    .iti-flag {
        margin-top: 10px !important;
    }

    .divider {
        margin: 0;
    }
</style>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <div class="panel">
                        <div class="text-start p-3">
                            <a href="manageStudents" class="btn btn-info active">
                                <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                            </a>
                        </div>

                        <div class="text-center">
                            <h3>Add Students</h3>
                        </div>

                        <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                            <li class="nav-item mt-20">
                                <a class="nav-link active" style='border:1px solid black;border-radius: 20px;' data-toggle="tab" href="#first-stage" role="tab">
                                    <i class="fa fa-solid fa-user"></i> Single Student</span>
                                </a>
                            </li>
                            &emsp;

                            <li class="nav-item mt-20">
                                <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab" href="#final-stage" role="tab">
                                    <i class="fa fa-solid fa-users"></i> Multiple Students</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="first-stage" role="tabpanel">
                                <br><br>
                                <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                                    <div class="panel-body">
                                        <h5 style="font-size: 15px;">Student's Information: </h5>
                                    </div>
                                </div>
                                </br>

                                <form id="Single_AddStudent">
                                    <fieldset>
                                        <div class="row justify-content-center">

                                            <?php $session->set('student_add_token', md5(uniqid(mt_rand(),true))); ?>
                                            <input type="hidden" id='student_add_token' name="student_add_token" value="<?=$session->get('student_add_token'); ?>">
                                        
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentName">Student Name</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentName" placeholder="Student Name">
                                                
                                                    <div class="d-none bg-danger check-StudentName" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter Valid Name
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentEmailID">Email ID</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentEmailID" placeholder="Email ID">
                                                    
                                                    <div class="d-none check-StudentEmailID" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter Valid Email Id
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-11">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentDescription">Description</label>
                                                    <textarea type="text" rows="4" class="form-control form-control-flush" id="Single_StudentDescription" placeholder="Description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <button type="submit"  class="btn btn btn-primary waves-effect waves-light">Add Student</button>
                                        </div>
                                    </fieldset>
                                    <br>
                                </form>
                            </div>

                            <div class="tab-pane" id="final-stage" role="tabpanel">
                                <br><br>
                                <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                                    <div class="panel-body">
                                        <h5 style="font-size: 15px;">Add Multiple Students</h5>
                                    </div>
                                </div>
                                <br>

                                <div class="row justify-content-start">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11">
                                        <div class="form-label-group">
                                            <label>Download Template : - </label>&nbsp; &nbsp;

                                            <a href="Download_Student_Template" class="btn btn-primary DownloadTemplate">
                                                <i class="fa fa-solid fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <br>

                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-label-group">
                                        <label>Choose File Below</label>
                                        <input type="file" class="dropify" id="Multiple_Student" data-height="200" accept=".csv"/>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row justify-content-center pb-15">
                                <button type="button" id='Multiple_StudentAdd' class="btn btn btn-primary waves-effect waves-light">Add Student</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php';?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js?<?=date("Ymd") ?>"></script>