<?php 
    include 'template/login_header.php';
?>

<!-- Modal add features-->
<div class="modal fade none-border add-category" id="add_features_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Features</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                <form class="p-t10" id="manage_features_form">
                    <?php $session->set('manage_features_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_features_form_token' name="add_features" value="<?=$session->get('manage_features_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Feature :</label>
                                <input type="text" class="form-control form-control-lg" id="features_name">

                                <div class='d-none bg-danger check_features_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Feature name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Feature Image :</label>
                                <input type="file" class="form-control form-control-lg" id="features_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_features_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add featuress image
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="features_Description">Description :</label>
                                <textarea class="form-control" id="features_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_features_descp' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit"  class="btn btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12" >
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_features_modal">Add Features</a>
                            </div>
                        </div>
                    </div>
                
                    <h4 class="text-center text-dark bold">Features List</h4>
                    <div class="table-responsive p-3">
                        <table id="features_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Image</th>
                                    <th >Feature</th>
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

<!-- Modal edit features -->
<div class="modal fade none-border add-category" id="edit_features_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit features</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_features_form">
                    <?php $session->set('edit_features_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_features_form_token' name="edit_features" value="<?=$session->get('edit_features_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Feature :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_features_name">
                                
                                <div class='d-none bg-danger check_edit_features_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Feature name cannot be blank
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Feature Image :<span id="link_img_path"></span></label>
                                <input type="file" class="form-control form-control-lg" id="edit_features_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_edit_features_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add featuress image
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="features_descp">Description :</label>
                                <textarea class="form-control" id="edit_features_descp" rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_edit_features_descp' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" id='delete_features' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
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

<script src="<?=base_url(); ?>/public/Easylearn/js/Configurations.js"></script>