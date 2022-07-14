<?php 
    include 'template/login_header.php';

    $student = json_decode(student_detail_by_uniqueid($_GET['id']), true);
?>

<style>
    label{
        font-weight: bold;
    }
    
    textarea{
        resize: none;
    }

    .DownloadTemplate{
        border-radius: 15px;
    }

    .iti-flag{
        margin-top: 10px !important;
    }

    .divider{
        margin:0;
    }
</style>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <div class="panel">
                        <div class="text-start p-3">   
                            <a href="manageStudents" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                        </div>  

                        <div class="text-center"><h3>Student Details</h3></div>

                        <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                            <div class="panel-body"><h5 style="font-size: 15px;">Student's Information:</h5></div>
                        </div>

                        </br>
                        <form id="edit_student">
                            <fieldset>
                                <div class="row justify-content-center">
                                    <?php $session->set('edit_student_token', md5(uniqid(mt_rand(),true))); ?>
                                    <input type="hidden" id='edit_student_token' name="edit_student_token" value="<?=$session->get('edit_student_token'); ?>">
                                    
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_name">Student Name</label>
                                            <input type="text" class="form-control form-control-flush" id="student_name" placeholder="Student Name"  value="<?=$student['data']['student_name']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_StudentName" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Student name
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>
                                    
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="Gender">Gender</label><br>

                                            <?php if($student['data']['student_gender'] == 'Male'){ ?>
                                            <input type="radio" id="Male" name="AllGender" value="Male" checked disabled>
                                            <label for="Male">Male</label> &emsp;
                                            <?php } ?>

                                            <?php if($student['data']['student_gender'] == 'Female'){ ?>
                                            <input type="radio" id="Female" name="AllGender" value="Female" checked disabled>
                                            <label for="Female">Female</label> &emsp;
                                            <?php } ?>

                                            <?php if($student['data']['student_gender'] == 'Others'){ ?>
                                            <input type="radio" id="Others" name="AllGender" value="Others" checked disabled>
                                            <label for="Others">Others</label><br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                        
                                <div class="row justify-content-center">

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                        <label>Date of Birth (dd-mm-yyyy)</label>
                                            <input type="text" autocomplete="off" class="form-control form-control-flush date" placeholder="dd-mm-yyyy" id="student_dob" value="<?=date("d-m-Y",strtotime($student['data']['student_dob']))?>" readonly disable>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_nationality">Nationality</label>
                                            <input type="text" class="form-control form-control-flush" id="student_nationality" placeholder="Nationality" value="<?=$student['data']['student_nationality']?>" readonly disable>
                                        </div>
                                    </div> 
                                </div>

                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_emailid">Email ID</label>
                                            <input type="text" class="form-control form-control-flush" id="student_emailid" placeholder="Email ID" value="<?=$student['data']['student_emailid']?>" readonly disable>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_contactno">Contact Number</label>
                                            <input type="text" class="form-control form-control-flush" id="student_contactno" placeholder="+91 XXXXXXXX" style="padding-left: 45px;" value="<?=$student['data']['student_contactno']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_StudentContactNo" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Contact number
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_rollno">Roll Number</label>
                                            <input type="text" class="form-control form-control-flush" id="student_rollno" placeholder="Roll No" value="<?=$student['data']['student_rollno']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_StudentRollNo" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Roll number
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="student_bloodgroup">Blood Group</label>
                                            <input type="text" class="form-control form-control-flush" id="student_bloodgroup" placeholder="Eg: O+" value="<?=$student['data']['student_bloodgroup']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_StudentBloodgroup" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Blood group
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-lg-11">
                                        <div class="form-label-group">
                                            <label for="student_description">Description</label>
                                            <textarea type="text" rows="4" class="form-control form-control-flush" id="student_description" placeholder="Description" rows='3' maxlength='500' required> <?=$student['data']['student_description']?> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="panel panel-secondary" style="background-color: rgba(38, 38, 38, 0.1);">
                                    <div class="panel-body"><h5 style="font-size: 15px;">Parents's Information:</h5></div>
                                </div>
                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="parent_name">Parent Name</label>
                                            <input type="text" class="form-control form-control-flush" id="parent_name" placeholder="Parent Name" value="<?=$student['data']['parent_name']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_ParentName" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Parent name
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="parent_emailid">Email ID</label>
                                            <input type="text" class="form-control form-control-flush" id="parent_emailid" placeholder="Email" value="<?=$student['data']['parent_emailid']?>" readonly disable>
                                            
                                            <div class="d-none edit_check_ParentEmailID" style="font-size:12px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="parent_contactno">Parent Contact Number</label>
                                            <input type="text" class="form-control form-control-flush" id="parent_contactno" placeholder="+91 XXXXXXXX" style="padding-left: 45px;" value="<?=$student['data']['parent_contactno']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_ParentContact" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Parent contact
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1"></div>

                                    <div class="col-lg-5">
                                        <div class="form-label-group">
                                            <label for="parent_occupation">Parent Occupation</label>
                                            <input type="text" class="form-control form-control-flush" id="parent_occupation" placeholder="Occupation" value="<?=$student['data']['parent_occupation']?>" required>
                                            
                                            <div class="d-none bg-danger edit_check_ParentOccupation" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Parent occupation
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row justify-content-center">
                                    <div class="col-lg-11">
                                        <div class="form-label-group">
                                            <label for="parent_address">Address</label>
                                            <textarea type="text" rows="4" class="form-control form-control-flush" id="parent_address" placeholder="Address"rows='3' maxlength='500' required><?=$student['data']['parent_address']?> </textarea>
                                            
                                            <div class="d-none bg-danger edit_check_ParentAddress" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Invalid Address
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-label-group text-center">
                                            <a href="manageStudents" class="btn btn-rounded btn-info"> <i class="fas fa-times"> &nbsp;Cancel </i> </a>
                                            &nbsp;&nbsp;&nbsp;
                                            <button type='button' class="btn btn-rounded btn-danger delete-student"> <i class="fas fa-trash"> &nbsp;Delete </i> </button>
                                            &nbsp;&nbsp;&nbsp;
                                            <button type='submit' class="btn btn-rounded btn-success"> <i class="fas fa-save"> &nbsp;Save </i> </button>                                    
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include 'template/login_footer.php';?>

<script src="<?=base_url(); ?>/public/Easylearn/js/Student.js?<?=date("Ymd") ?>"></script>