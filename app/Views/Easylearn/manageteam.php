<?php 
    include 'template/login_header.php';
?>

<!-- Modal add team-->
<div class="modal fade none-border add-category" id="add_team_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Teams</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_team_form">
                    <?php $session->set('manage_team_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_team_form_token' name="add_team" value="<?=$session->get('manage_team_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name :</label>
                                <input type="text" class="form-control form-control-lg" id="team_name">
                                
                                <div class='d-none bg-danger check_team_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Job Role">Job Role :</label>
                                <input type="text" class="form-control form-control-lg" id="team_job_role">
                                
                                <div class='d-none bg-danger check_team_job_role' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a job role
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <br>
                                <label for="">Social Media:&emsp;</label>
                                <div class='d-none bg-danger check_social_media' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Select at least one social media
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="linkedin" value="linkedin">
                                    <label class="form-check-label" for="linkedin">Linkedin</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="facebook" value="facebook">
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="instagram" value="instagram">
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="twitter" value="twitter">
                                    <label class="form-check-label" for="twitter">Twitter</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <br>
                                <label for="linkedin">LinkedIn:</label>
                                <input type="text" class="form-control linkedin" id="linkedin_txt" disabled>
                                
                                <div class='d-none bg-danger check_linkedin_txt' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a link
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <br>
                                <label for="facebook">Facebook:</label>
                                <input type="text" class="form-control facebook" id="facebook_txt" disabled>

                                <div class='d-none bg-danger check_facebook_txt' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a link
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="instagram">Instagram:</label>
                                <input type="text" class="form-control instagram" id="instagram_txt" disabled>

                                <div class='d-none bg-danger check_instagram_txt' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a link
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="twitter">Twitter:</label>
                                <input type="text" class="form-control twitter" id="twitter_txt" disabled>

                                <div class='d-none bg-danger check_twitter_txt' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a link
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" class="form-control form-control-lg" id="team_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_team_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add teams image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email ID">Email ID :</label>
                                <input type="text" class="form-control form-control-lg" id="team_email_id">
                                
                                <div class='d-none bg-danger check_team_email_id' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid email
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Number 1">Number 1 :</label>
                                <input type="text" placeholder="+91 XXXXXXXX" class="form-control form-control-lg" id="team_number_1">
                                
                                <div class='d-none bg-danger check_team_number_1' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Number 2">Number 2 :</label>
                                <input type="text" placeholder="+91 XXXXXXXX" class="form-control form-control-lg" id="team_number_2">
                                
                                <div class='d-none bg-danger check_team_number_2' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type :</label>
                                <select id="team_type" class="form-control form-control-lg">
                                    <option value='Director'>Director</option>
                                    <option value='Employee'>Employee</option>
                                    <option value='Advisor'>Advisor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="team_about">About :</label>
                                <textarea class="form-control" id="team_about" rows="4" maxlength="255" placeholder="About" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_team_about' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter about
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit"  class="btn btn btn-primary waves-effect waves-light">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="manageconfigurations" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_team_modal">Add Team</a>
                            </div>
                        </div>
                    </div>
            
                    <h4 class="text-center text-dark bold">Team List</h4>
                    <div class="table-responsive p-3">
                        <table id="team_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Image</th>
                                    <th >Name</th>
                                    <th >Job Role</th>
                                    <th >Email ID</th>
                                    <th >Type</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit team -->
<div class="modal fade none-border add-category" id="edit_team_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Teams</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_team_form">
                    <?php $session->set('edit_team_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_team_form_token' name="edit_team" value="<?=$session->get('edit_team_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_team_name">
                                
                                <div class='d-none bg-danger check_edit_team_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Job Role">Job Role :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_team_job_role">
                                
                                <div class='d-none bg-danger check_edit_team_job_role' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a job role
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <br>
                                <label for="">Social Media:&emsp;</label>
                                <div class='d-none bg-danger check_social_media' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Select at least one social media
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="edit_linkedin" value="linkedin">
                                    <label class="form-check-label" for="edit_linkedin">Linkedin</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="edit_facebook" value="facebook">
                                    <label class="form-check-label" for="edit_facebook">Facebook</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="edit_instagram" value="instagram">
                                    <label class="form-check-label" for="edit_instagram">Instagram</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input req_checkbox" type="checkbox" id="edit_twitter" value="twitter">
                                    <label class="form-check-label" for="edit_twitter">Twitter</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <br>
                                    <label for="edit_linkedin">LinkedIn:</label>
                                    <input type="text" class="form-control edit_linkedin" id="edit_linkedin_txt" disabled>
                                    
                                    <div class='d-none bg-danger check_edit_linkedin_txt' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i>Enter a link
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <br>
                                    <label for="edit_facebook">Facebook:</label>
                                    <input type="text" class="form-control edit_facebook" id="edit_facebook_txt" disabled>
                                    
                                    <div class='d-none bg-danger check_edit_facebook_txt' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i>Enter a link
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <label for="edit_instagram">Instagram:</label>
                                    <input type="text" class="form-control edit_instagram" id="edit_instagram_txt" disabled>
                                        
                                    <div class='d-none bg-danger check_edit_instagram_txt' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i>Enter a link
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group">
                                    <label for="edit_twitter">Twitter:</label>
                                    <input type="text" class="form-control edit_twitter" id="edit_twitter_txt" disabled>
                                    
                                    <div class='d-none bg-danger check_edit_twitter_txt' style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i>Enter a link
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Image :<span id="link_img_path"></span></label>
                                <input type="file" class="form-control form-control-lg" id="edit_team_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_edit_team_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add teams image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email ID">Email ID :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_team_email_id">
                                
                                <div class='d-none bg-danger check_edit_team_email_id' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid email
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Number 1">Number 1 :</label>
                                <input type="text" placeholder="+91 XXXXXXXX" class="form-control form-control-lg" id="edit_team_number_1">
                                
                                <div class='d-none bg-danger check_edit_team_number_1' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Number 2">Number 2 :</label>
                                <input type="text" placeholder="+91 XXXXXXXX" class="form-control form-control-lg" id="edit_team_number_2">
                                
                                <div class='d-none bg-danger check_edit_team_number_2' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type :</label>
                                <select id="edit_team_type" class="form-control form-control-lg">
                                    <option value='Director'> Director </option>
                                    <option value='Employee'>Employee</option>
                                    <option value='Advisor'>Advisor</option>
                                </select>

                                <div class='d-none bg-danger check_edit_team_type' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>select type
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="team_about">About :</label>
                                <textarea class="form-control" id="edit_team_about" rows="4" maxlength="255" placeholder="About" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_edit_team_about' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter about
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" id='delete_team' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit"  class="btn btn btn-primary edit_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="view_img_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <img src="" id="view_image" alt="" class="img img-responsive" style="width:100%;">
            </div>

        </div>
    </div>
</div>

<?php include 'template/login_footer.php'?>
<script src="<?=base_url(); ?>/public/Easylearn/js/configurations.js"></script>