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
                                                    <label for="Gender">Gender</label><br>

                                                    <input type="radio" id="Male" name="AllGender" value="Male">
                                                    <label for="Male">Male</label> &emsp;

                                                    <input type="radio" id="Female" name="AllGender" value="Female">
                                                    <label for="Female">Female</label> &emsp;

                                                    <input type="radio" id="Others" name="AllGender" value="Others">
                                                    <label for="Others">Others</label><br>

                                                    <div class="d-none bg-danger check-StudentGender" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Please Select gender
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label>Date of Birth (dd-mm-yyyy)</label>
                                                    <input type="text" autocomplete="off" class="form-control form-control-flush date" placeholder="dd-mm-yyyy" data-provide="datepicker" id="SingleStudentDOB">
                                                    
                                                    <div class="d-none bg-danger check-StudentDob" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Choose Valid Date of birth
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentNationality">Nationality</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentNationality" placeholder="Nationality">
                                                    
                                                    <div class="d-none bg-danger check-StudentNationality" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Nationality
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentEmailID">Email ID</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentEmailID" placeholder="Email ID">
                                                    
                                                    <div class="d-none check-StudentEmailID" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter Valid Email Id
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentContactNo">Contact Number</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentContactNo" placeholder="+91 XXXXXXXX" style="padding-left: 45px;">
                                                    
                                                    <div class="d-none bg-danger check-StudentContactNo" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Contact number
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentRollNo">Roll Number</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentRollNo" placeholder="Roll No">
                                                    
                                                    <div class="d-none bg-danger check-StudentRollNo" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Roll number
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>

                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_StudentBloodGroup">Blood Group</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_StudentBloodGroup" placeholder="Eg: O+">
                                                    
                                                    <div class="d-none bg-danger check-StudentBloodgroup" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter Valid Blood group
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_Studentimage">Student Image</label>
                                                    <input type="file" class="form-control form-control-flush" id="Single_Studentimage" placeholder="Student Image" accept="image/*">
                                                    
                                                    <div class="d-none bg-danger check-Single_Studentimage" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Choose Valid Image
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"> </div>

                                            <div class="col-lg-5"> </div>
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

                                        <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                                            <div class="panel-body">
                                                <h5 style="font-size: 15px;">Parents's Information: </h5>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_ParentName">Parent Name</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_ParentName" placeholder="Parent Name">
                                                    
                                                    <div class="d-none bg-danger check-ParentName" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Parent name
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>
                                            
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_ParentEmailID">Email ID</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_ParentEmailID" placeholder="Email">
                                                    
                                                    <div class="d-none bg-danger check-ParentEmailID" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Email Id
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_ParentContactNo">Parent Contact Number</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_ParentContactNo" placeholder="+91 XXXXXXXX" style="padding-left: 45px;">
                                                    
                                                    <div class="d-none bg-danger check-ParentContact" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Parent contact
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-1"></div>
                                            
                                            <div class="col-lg-5">
                                                <div class="form-label-group">
                                                    <label for="Single_ParentOccupation">Parent Occupation</label>
                                                    <input type="text" class="form-control form-control-flush" id="Single_ParentOccupation" placeholder="Occupation">
                                                    
                                                    <div class="d-none bg-danger check-ParentOccupation" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter Valid Parent occupation
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row justify-content-center">
                                            <div class="col-lg-11">
                                                <div class="form-label-group">
                                                    <label for="Single_ParentAddress">Address</label>
                                                    <textarea type="text" rows="4" class="form-control form-control-flush" id="Single_ParentAddress" placeholder="Address"></textarea>
                                                    
                                                    <div class="d-none bg-danger check-ParentAddress" style="font-size:12px; padding-left: 20px;">
                                                        <i class="fas fa-times-circle"></i>Enter valid Address
                                                    </div>
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