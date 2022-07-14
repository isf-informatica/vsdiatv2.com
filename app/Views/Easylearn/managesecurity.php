<?php 
    include 'template/login_header.php';
?>
    
<!-- Modal add security-->
<div class="modal fade none-border add-category" id="add_security_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Security</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_security_form">
                    
                    <?php $session->set('manage_security_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_security_form_token' name="add_security" value="<?=$session->get('manage_security_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Security :</label>
                                <input type="text" class="form-control form-control-lg" id="security_name">

                                <div class='d-none bg-danger check_security_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Security name cannot be blank
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="security_Description">Description :</label>
                                <textarea class="form-control" id="security_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
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
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>

                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="manageconfigurations" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_security_modal">Add Security</a>
                            </div>
                        </div>
                    </div>
                
                    <h4 class="text-center text-dark bold">Security List</h4>
                    <div class="table-responsive p-3">
                        <table id="security_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Sr. No. </th>
                                    <th> Security </th>
                                    <th> Description </th>
                                    <th> Status </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit security -->
<div class="modal fade none-border add-category" id="edit_security_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Security</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_security_form">
                    <?php $session->set('edit_security_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_security_form_token' name="edit_security" value="<?=$session->get('edit_security_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Security :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_security_name">

                                <div class='d-none bg-danger check_edit_security_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Security name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="security_descp">Description :</label>
                                <textarea class="form-control" id="edit_security_descp" rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" id='delete_security' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn btn-primary edit_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
<?php include 'template/login_footer.php'?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Configurations.js"></script>