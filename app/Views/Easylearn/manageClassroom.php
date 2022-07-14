<?php 
    include 'template/login_header.php';
?>

<!-- Modal add Classroom-->
<div class="modal fade none-border add-category" id="add_classroom_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Classroom</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_classroom_form">
                    <?php $session->set('manage_classroom_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_classroom_form_token' name="add_classroom" value="<?=$session->get('manage_classroom_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Name">Classroom Name :</label>
                                <input type="text" class="form-control form-control-lg" id="classroom_name" placeholder="Classroom Name">
                                
                                <div class='d-none bg-danger d-md-inline-flex check_classroom_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Classroom name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Classroom Image :</label>
                                <input type="file" class="form-control form-control-lg" id="classroom_image" accept="image/*">
                                
                                <div class='d-none bg-danger check_classroom_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Classroom image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Phone Number :</label>
                                <input type="text" class="form-control form-control-lg" id="classroom_phone" placeholder="Phone No.">
                                
                                <div class='d-none bg-danger check_classroom_phone' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Classroom Phone Number
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Administrator Name :</label>
                                <input type="text" class="form-control form-control-lg" id="administrator_name" placeholder="Administrator Name">
                                
                                <div class='d-none bg-danger check_administrator_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Administrator Name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Administrator Email :</label>
                                <input type="text" class="form-control form-control-lg" id="administrator_email" placeholder="Administrator Email">
                                
                                <div class='d-none bg-danger check_administrator_email' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Administrator Email
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Name">Administrator Password :</label>
                                <input type="text" class="form-control form-control-lg" id="administrator_password" placeholder="Administrator Password">
                                
                                <div class='d-none bg-danger check_administrator_password' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Administrator Password
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="benefits_Description">Description :</label>
                                <textarea class="form-control" id="classroom_descp" rows="4" maxlength="255" placeholder="Description" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_classroom_descp' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Invalid Description
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
                        <div class='col-md-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_classroom_modal">Add Classroom</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Classroom List</h4>
                    <div class="table-responsive p-3">
                        <table id="classroom_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Classroom Name</th>
                                    <th >Administrator Name</th>
                                    <th >Administrator Email</th>
                                    <th >Description</th>
                                    <th >Assign Classroom</th>
                                    <th >Assign Courses</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<div class="modal fade" id="edit_classroom_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class='col-11 modal-title text-center' id="staticBackdropLabel"><b>Classroom Details</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 50px;background-image: linear-gradient(to top, #f6ebe3bb, #f6f4fdcc);">
                <form class="p-t10" id="edit_classroom">
                    <div class="row">
                        <?php $session->set('edit_classroom_token', md5(uniqid(mt_rand(),true))); ?>
                            <input type="hidden" id='edit_classroom_token' name="edit_classroom_token" value="<?=$session->get('edit_classroom_token'); ?>">
                        <div class="col-lg-5 pl-5">
                            <img id="cls_img" src="<?=base_url(); ?>/public/Easylearn/images/channels.png"
                                class="img img-responsive border border-3 border-dark"
                                style="width:100%;border-radius:10px;padding: 10px">
                            <div class="row mb-3 mt-5 input_class d-none">
                                <div class="col-md-12">
                                    <b>Classroom Image</b>
                                    <input type="file" class="px-4 form-control form-control-flush input_class d-none" accept="image/*" id="edit_classroom_img">
                                    <div class='d-none bg-danger check_edit_cls_image' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Invalid Classroom Image</div>
                                </div>
                            </div>       
                        </div>

                        <div class="col-lg-7 align-self-center order-2 order-md-1  mt-3">
                            <div class="row mb-3">
                                <div class="col-md-6"><b>Classroom Name :</b></div>
                                <div class="col-md-6">
                                    <span class="cls_name cls_span"></span>
                                    <input id='cls_name' type='text' class='form-control input_class d-none'>
                                    <div class='d-none bg-danger check_edit_cls_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Invalid Classroom Name</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><b>Administration Name :</b></div>
                                <div class="col-md-6">
                                    <span class="adm_name cls_span"></span>
                                    <input id='adm_name' type='text' class='form-control input_class d-none'>
                                    <div class='d-none bg-danger check_edit_adm_name' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Invalid Administration Name</div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6"><b>Email :</b></div>
                                <div class="col-md-6">
                                    <span class="cls_email"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6"><b>Phone Number :</b></div>
                                <div class="col-md-6">
                                    <span class="cls_phone cls_span"></span>
                                    <input id='cls_phone' type='text' class='form-control input_class d-none'>
                                    <div class='d-none bg-danger check_edit_cls_phone' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Invalid Phone Number</div>
                                </div>
                            </div>

                             <div class="row mb-3">
                                <div class="col-md-6"><b>Administration Description :</b></div>
                                <div class="col-md-6">
                                    <span class="cls_desc cls_span"></span>
                                    <textarea class="form-control input_class d-none" id='cls_desc' rows="4" maxlength="255" placeholder="descp" style="height: 80px;resize: none;"></textarea>
                                    <div class='d-none bg-danger check_edit_cls_desc' style='font-size: 12px; padding-left: 20px;'><i class="fas fa-times-circle"></i>Invalid Description</div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class='d-flex justify-content-center p-5'>
                        <a class="btn btn-rounded btn-info edit-classroom"> <i class="ti-pencil"> Edit </i> </a>
                        &nbsp;&nbsp;&nbsp;
                        <div class='d-none'>
                            <a class="btn btn-rounded btn-warning cancel-classroom"> <i class="ti-close"> Cancel </i> </a>
                            &nbsp;&nbsp;
                             <a class="btn btn-rounded btn-danger delete-classroom" data-id=""> <i class="ti-trash"> Delete </i> </a>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-rounded btn-success save-classroom" data-id=""> <i class="ti-save-alt"> Save </i> </button>
                        </div>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js"></script>