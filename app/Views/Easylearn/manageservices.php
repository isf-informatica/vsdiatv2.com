<?php 
    include 'template/login_header.php';
?>

<!-- Modal add services-->
<div class="modal fade none-border add-category" id="add_services_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Services</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_services_form">
                    <?php $session->set('manage_services_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_services_form_token' name="add_services" value="<?=$session->get('manage_services_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Service :</label>
                                <input type="text" class="form-control form-control-lg" id="services_name">

                                <div class='d-none bg-danger check_services_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Service name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Service Image :</label>
                                <input type="file" class="form-control form-control-lg" id="services_image" accept="image/*" placeholder="Image">

                                <div class='d-none bg-danger check_services_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add Servicess image
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="services_Description">Description :</label>
                                <textarea class="form-control" id="services_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_services_descp' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn btn-primary waves-effect waves-light">Add</button>
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_services_modal">Add Services</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Services List</h4>
                    <div class="table-responsive p-3">
                        <table id="services_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Image</th>
                                    <th >Service</th>
                                    <th >Description</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit services -->
<div class="modal fade none-border add-category" id="edit_services_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Services</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="p-t10" id="edit_services_form">
                    <?php $session->set('edit_services_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_services_form_token' name="edit_services" value="<?=$session->get('edit_services_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Service :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_services_name">
                                
                                <div class='d-none bg-danger check_edit_services_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Service name cannot be blank
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Service Image :<span id="link_img_path"></span></label>
                                <input type="file" class="form-control form-control-lg" id="edit_services_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_edit_services_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add Servicess image
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="services_descp">Description :</label>
                                <textarea class="form-control" id="edit_services_descp" rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_edit_services_descp' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" id='delete_services' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
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