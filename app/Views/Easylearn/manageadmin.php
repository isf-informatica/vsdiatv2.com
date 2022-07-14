<?php 
    include 'template/login_header.php';
?>
    
<!-- Modal add Admin-->
<div class="modal fade none-border add-category" id="add_admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Admin</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_admin_form">
                    
                    <?php $session->set('manage_admin_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_admin_form_token' name="manage_admin_form_token" value="<?=$session->get('manage_admin_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_name">Admin Name :</label>
                                <input type="text" class="form-control form-control-lg" id="admin_name">

                                <div class='d-none bg-danger check_admin_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Admin name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_phone">Phone Number :</label>
                                <input type="text" class="form-control form-control-lg" id="admin_phone">

                                <div class='d-none bg-danger check_admin_phone' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Phone Number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth (dd-mm-yyyy)</label>
                                <input type="text" autocomplete="off" class="form-control form-control-flush date" placeholder="dd-mm-yyyy" data-provide="datepicker" id="admin_dob">
                                
                                <div class="d-none bg-danger check_admin_dob" style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i>Invalid Date of birth
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ichack-input">
                                <label for="Gender">Gender</label><br>
                                <input class="flat-red" type="radio" id="Male" name="admin_gender" value="Male">
                                <label for="Male">Male</label> &emsp;

                                <input class="flat-red" type="radio" id="Female" name="admin_gender" value="Female">
                                <label for="Female">Female</label> &emsp;

                                <input class="flat-red" type="radio" id="Others" name="admin_gender" value="Others">
                                <label for="Others">Others</label><br>

                                <div class="d-none bg-danger check_admin_gender" style="font-size:12px; padding-left: 20px;">
                                    <i class="fas fa-times-circle"></i>Please Select gender
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="admin_email">Email :</label>
                                <input type="text" class="form-control form-control-lg" id="admin_email">

                                <div class='d-none check_admin_email' style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="admin_password">Password :</label>
                                <input type="password" class="form-control form-control-lg" id="admin_password">

                                <div class='d-none bg-danger check_admin_password' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Password
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_image">Profile Image :</label>
                                <input type="file" class="form-control form-control-lg" id="admin_image" accept='image/png, image/gif, image/jpeg'>

                                <div class='d-none bg-danger check_admin_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="admin_document">Verification Document :</label>
                                <input type="file" class="form-control form-control-lg" id="admin_document" accept='application/pdf'>

                                <div class='d-none bg-danger check_admin_document' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Document Type
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_type">Admin Region Type :</label>
                                <select id="region_type" class="form-control form-control-lg">
                                    <option value='Country'> Country </option>
                                    <option value='State'> State </option>
                                    <option value='City'> City </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_country">Select Country :</label>
                                <select id="region_country" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_state">Select State :</label>
                                <select id="region_state" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="region_city">Select City :</label>
                                <select id="region_city" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="admin_description">Description :</label>
                                <textarea class="form-control" id="admin_description" rows="4" maxlength="255" placeholder="Description" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="waves-effect waves-light btn btn-secendary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="waves-effect waves-light btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class='row d-flex justify-content-center'>
        <div class='col-12'>
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="waves-effect waves-light btn btn-info"> <i class="fas fa-backward"> </i>&nbsp;&nbsp;Back </a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="waves-effect waves-light btn btn-primary" data-toggle="modal" data-target="#add_admin_modal">Add Admin</a>
                            </div>
                        </div>
                    </div>
                
                    <h4 class="text-center text-dark bold">Admins List</h4>
                    <div class="table-responsive p-3">
                        <table id="admin_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Region </th>
                                    <th> Country </th>
                                    <th> State </th>
                                    <th> City </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<div class="modal fade show" id="view_admin_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel" style="color:#3c6fd0;">Admin Information: </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-5 align-self-center">
                        <div class="text-center">
                            <img src="" class="img admin_image" style="height: 200px; width: 200px; border-radius:50%;" alt="">
                        </div>

                        <div class="text-center m-3">
                            <h4><b class="admin_name">Ravi Shanker</b></h4>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 mt-3">
                        <p style="padding-left:5px;"><i class="fa fa-solid fa-user"></i> &nbsp; <b>About</b></p>
                        <hr class="MentorHrTag">

                        <div class="row">
                            <div class="col-4">
                                <b>Phone Number:</b>
                            </div>
                            <div class="col-8 admin_phone">
                                 
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Gender:</b>
                            </div>
                            <div class="col-8 admin_gender">
                                Male
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Date of birth:</b>
                            </div>
                            <div class="col-8 admin_dob">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Email:</b>
                            </div>
                            <div class="col-8 admin_email">
                                RaviShankar@gmail.com
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Description:</b>
                            </div>
                            <div class="col-8">
                                <p class="admin_descp">
                                    Video provides a powerful way to help you prove your point. When you click
                                    Online
                                    Video, you can paste in the embed code for the video you want to add.
                                </p>
                            </div>
                        </div>
                        <hr class="MentorHrTag">

                        <div class="row">
                            <div class="col-4">
                                <b>Region Type:</b>
                            </div>
                            <div class="col-8 region_type">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Region Country:</b>
                            </div>
                            <div class="col-8 region_country">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Region State:</b>
                            </div>
                            <div class="col-8 region_state">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-4">
                                <b>Region City:</b>
                            </div>
                            <div class="col-8 region_city">
                            </div>
                        </div>
                        <br>

                        <hr class="MentorHrTag">
                    </div>

                    <div class="col-12 mt-3">
                        <div class='d-flex justify-content-center p-5'>
                            <a href="#" class="btn btn-rounded btn-info edit-admin"> 
                                <i class="ti-pencil"> Edit </i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Admin-->
<div class="modal fade none-border add-category" id="edit_admin_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Admin</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_admin_form">
                    
                    <?php $session->set('edit_admin_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_admin_form_token' name="edit_admin_form_token" value="<?=$session->get('edit_admin_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_admin_name">Admin Name :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_admin_name">

                                <div class='d-none bg-danger check_edit_admin_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Admin name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_admin_phone">Phone Number :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_admin_phone">

                                <div class='d-none bg-danger check_edit_admin_phone' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Phone Number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_admin_image">Profile Image :</label>
                                <input type="file" class="form-control form-control-lg" id="edit_admin_image" accept='image/png, image/gif, image/jpeg'>

                                <div class='d-none bg-danger check_edit_admin_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_region_type">Admin Region Type :</label>
                                <select id="edit_region_type" class="form-control form-control-lg">
                                    <option value='Country'> Country </option>
                                    <option value='State'> State </option>
                                    <option value='City'> City </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_region_country">Select Country :</label>
                                <select id="edit_region_country" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_region_state">Select State :</label>
                                <select id="edit_region_state" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_region_city">Select City :</label>
                                <select id="edit_region_city" class="form-control form-control-lg">

                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_admin_description">Description :</label>
                                <textarea class="form-control" id="edit_admin_description" rows="4" maxlength="255" placeholder="Description" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="waves-effect waves-light btn btn-secendary" data-dismiss="modal"> Close </button>
                        <button type="submit"  class="waves-effect waves-light btn btn-primary"> Edit </button>
                        <button type="button" id='delete_admin' class="waves-effect waves-light btn btn-danger"> Delete </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Admin.js"></script>