<?php 
    include 'template/login_header.php';

    $settings = json_decode(get_settings_category(), true)['data'];
?>
    
<!-- Modal add Settings-->
<div class="modal fade none-border add-category" id="add_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Settings</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                    <li class="nav-item mt-20">
                        <a class="nav-link active" style='border:1px solid black;border-radius: 20px;'
                            data-toggle="tab" href="#first-stage" role="tab">
                            <i class="fa fa-solid fa-tools"></i> &nbsp; Add Value</span>
                        </a>
                    </li>
                    &emsp;

                    <li class="nav-item mt-20">
                        <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
                            href="#final-stage" role="tab">
                            <i class="fa fa-solid fa-cog"></i> &nbsp; Add Setting</span>
                        </a>
                    </li>
                </ul>

                
                <div class="tab-content">
                    <div class="tab-pane active" id="first-stage" role="tabpanel">
                        <br><br>
                        <form class="p-t10" id="add_setting_value_form">
                            
                            <?php $session->set('manage_settings_value_form_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='manage_settings_value_form_token' name="add_settings" value="<?=$session->get('manage_settings_value_form_token'); ?>">

                            <div class="row p-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Setting Name :</label>
                                        <select name="setting_name_drop" id="setting_name_drop" class="form-select form-control">
                                            <?php if($settings != 'False'){ foreach($settings as $setting){ ?>
                                                <option value="<?=$setting['unique_id']?>"><?=$setting['category_name']?></option>
                                            <?php } }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Value :</label>
                                        <input type="text" class="form-control form-control-lg" id="setting_value">
                                        <div class='d-none bg-danger check_setting_value' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Setting name cannot be blank</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="setting_Purpose">Purpose :</label>
                                        <textarea class="form-control" id="setting_purpose" rows="4" maxlength="255" placeholder="Purpose" style="height: 80px;resize: none;"></textarea>
                                        <div class='d-none bg-danger check_setting_purpose' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Enter Description</div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                                <button type="submit"  class="btn btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="final-stage" role="tabpanel">
                        <br><br>
                        <form class="p-t10" id="add_category_form">
                            
                            <?php $session->set('manage_settings_form_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='manage_settings_form_token' name="add_settings" value="<?=$session->get('manage_settings_form_token'); ?>">

                            <div class="row p-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Name">Setting Name :</label>
                                        <input type="text" class="form-control form-control-lg" id="setting_name">
                                        <div class='d-none bg-danger check_setting_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Setting name cannot be blank</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="setting_Description">Description :</label>
                                        <textarea class="form-control" id="setting_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                        <div class='d-none bg-danger check_setting_descp' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Enter Description</div>
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
    </div>
</div>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12" >
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_setting_modal">Add Setting</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Setting List</h4>

                    <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                        <li class="nav-item mt-20">
                            <a class="nav-link active" style='border:1px solid black;border-radius: 20px;'
                                data-toggle="tab" href="#first-stage1" role="tab">
                                <i class="fa fa-solid fa-tools"></i> &nbsp; Setting List</span>
                            </a>
                        </li>
                        &emsp;
                        <li class="nav-item mt-20">
                            <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
                                href="#final-stage1" role="tab">
                                <i class="fa fa-solid fa-cog"></i> &nbsp; Category List</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="first-stage1" role="tabpanel">
                            <div class="table-responsive p-3">
                                <table id="setting_value_list" class="table text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Sr. No. </th>
                                            <th> Setting Name </th>
                                            <th> Value </th>
                                            <th> Purpose </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="final-stage1" role="tabpanel">
                            <div class="table-responsive p-3">
                                <table id="setting_list" class="table text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Sr. No. </th>
                                            <th> Setting Name </th>
                                            <th> Description </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit setting -->
<div class="modal fade none-border add-category" id="edit_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Setting</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_setting_form">
                    <?php $session->set('edit_setting_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_setting_form_token' name="edit_security" value="<?=$session->get('edit_setting_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Setting Name :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_setting_name">
                        <div class='d-none bg-danger check_edit_setting_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Setting name cannot be blank</div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="setting_Description">Description :</label>
                                <textarea class="form-control" id="edit_setting_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                <div class='d-none bg-danger check_edit_setting_descp' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Enter Description</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" id='delete_setting' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn btn-primary edit_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit Value setting -->
<div class="modal fade none-border add-category" id="edit_setting_value_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Setting</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_setting_value_form">
                    <?php $session->set('edit_setting_value_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_setting_value_form_token' name="edit_security" value="<?=$session->get('edit_setting_value_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Setting Name :</label>
                                <select name="edit_setting_name_drop" id="edit_setting_name_drop" class="form-select form-control">
                                    <?php if($settings != 'False'){ foreach($settings as $setting){ ?>
                                        <option value="<?=$setting['unique_id']?>"><?=$setting['category_name']?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Value :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_setting_value">
                                <div class='d-none bg-danger check_edit_setting_value' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Setting name cannot be blank</div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_setting_purpose">Purpose :</label>
                                <textarea class="form-control" id="edit_setting_purpose" rows="4" maxlength="255" placeholder="Purpose" style="height: 80px;resize: none;"></textarea>
                                <div class='d-none bg-danger check_edit_setting_purpose' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Enter Description</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" id='edit_delete_setting' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn btn-primary edit_value_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Configurations.js"></script>