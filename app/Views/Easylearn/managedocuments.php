<?php 
    include 'template/login_header.php';
?>

<!-- Modal add document-->
<div class="modal fade none-border add-category" id="add_document_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Project Document</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_document_form">
                    <?php $session->set('manage_document_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_document_form_token' name="add_document" value="<?=$session->get('manage_document_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Document Name :</label>
                                <input type="text" class="form-control form-control-lg" id="document_name">
                                
                                <div class='d-none bg-danger check_document_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Document name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Document Image :</label>
                                <input type="file" class="form-control form-control-lg" id="document_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_document_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add documents image
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document_link">Document Link :</label>
                                <input type="text" class="form-control form-control-lg" id="document_link">
                                
                                <div class='d-none bg-danger check_document_link' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter link
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_document_modal">Add Document</a>
                            </div>
                        </div>
                    </div>
                
                    <h4 class="text-center text-dark bold">Document List</h4>
                    <div class="table-responsive p-3">
                        <table id="document_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >Document Name</th>
                                    <th >Image</th>
                                    <th >Document Link</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit document -->
<div class="modal fade none-border add-category" id="edit_document_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Project Document</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_document_form">
                    <?php $session->set('edit_document_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_document_form_token' name="edit_document" value="<?=$session->get('edit_document_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Document Name :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_document_name">
                                
                                <div class='d-none bg-danger check_edit_document_name' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Document name cannot be blank
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6" id='image'>
                            <div class="form-group">
                                <label for="image">Document Image :<span id="link_img_path"></span></label>
                                <input type="file" class="form-control form-control-lg" id="edit_document_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_edit_document_image' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add documents image
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document_link">Document Link :</label>
                                <textarea class="form-control" id="edit_document_link" rows="4" maxlength="255" placeholder="link" style="height: 80px;resize: none;"></textarea>
                                
                                <div class='d-none bg-danger check_edit_document_link' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter link
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" id='delete_document' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
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