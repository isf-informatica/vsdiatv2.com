<?php 
    include 'template/login_header.php';
?>

<!-- Modal add testimonial-->
<div class="modal fade none-border add-category" id="add_testimonial_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Testimonials</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_testimonial_form">
                    <?php $session->set('manage_testimonial_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_testimonial_form_token' name="add_testimonial" value="<?=$session->get('manage_testimonial_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name :</label>
                                <input type="text" class="form-control form-control-lg" id="testimonial_name">
                                
                                <div class='d-none bg-danger check_testimonial_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Job Role">Job Role :</label>
                                <input type="text" class="form-control form-control-lg" id="testimonial_job_role">
                                
                                <div class='d-none bg-danger check_testimonial_job_role' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a job role
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" class="form-control form-control-lg" id="testimonial_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_testimonial_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add Testimonials image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email ID">Company Website :</label>
                                <input type="text" class="form-control form-control-lg" id="testimonial_companywebsite" placeholder="Website URL">
                                
                                <div class='d-none bg-danger check_testimonial_companywebsite' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid email
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="testimonial_description">Description :</label>
                                <textarea class="form-control" id="testimonial_description" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_testimonial_description' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit"  class="btn btn-primary waves-effect waves-light">Add</button>
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_testimonial_modal">Add Testimonial</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Testimonial List</h4>
                    <div class="table-responsive p-3">
                        <table id="testimonial_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Image</th>
                                    <th >Name</th>
                                    <th >Job Role</th>
                                    <th >Company Website</th>
                                </tr>
                            </thead>
                        
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit testimonial -->
<div class="modal fade none-border add-category" id="edit_testimonial_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Testimonials</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_testimonial_form">
                    <?php $session->set('edit_testimonial_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_testimonial_form_token' name="edit_testimonial" value="<?=$session->get('edit_testimonial_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_testimonial_name">
                                
                                <div class='d-none bg-danger check_edit_testimonial_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Job Role">Job Role :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_testimonial_job_role">
                                
                                <div class='d-none bg-danger check_edit_testimonial_job_role' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a Job role
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Image :<span id="link_img_path"></span></label>
                                <input type="file" class="form-control form-control-lg" id="edit_testimonial_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_edit_testimonial_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add Testimonials image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email ID">Company Website :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_testimonial_companywebsite" placeholder="Website URL">
                                
                                <div class='d-none bg-danger check_edit_testimonial_companywebsite' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a valid email
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="testimonial_description">Description :</label>
                                <textarea class="form-control" id="edit_testimonial_description" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_edit_testimonial_description' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter description
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" id='delete_testimonial' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
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