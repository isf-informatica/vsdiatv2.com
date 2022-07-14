<?php include 'template/login_header.php';
    $training_material = json_decode(get_training_material(),true)['data'];
?>
<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class='box'>
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active"><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <button class="btn btn-primary" id="add_tm_btn">Add Training Material</button>
                            </div>
                        </div>

                        <div class="col-12">
                            <h2 class="text-center">Training Material's</h2>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-4">
                        <div class="col-10">
                            <div class="row tm_list d-flex justify-content-center fx-element-overlay">

                                <?php if($training_material != 'False'){ 
                                    
                                    foreach($training_material as $dat){ ?>

                                <div class="col-lg-6 col-xl-4 p-15">
                                    <div class="box border shadow" style="height:100%;">
                                        <div class="fx-card-item">
                                            <div class="fx-card-avatar fx-overlay-1">

                                                <img src="<?=$dat['training_image']?>" class="bbrr-0 bblr-0 my-5" style="width:100%;height:150px;object-fit:fill;">
                                                <div class="fx-overlay">
                                                    <ul class="fx-info">
                                                        <li>
                                                            <a class="btn no-border btn-info btn-sm view_pdf" id="<?=$dat['training_material']?>" href="javascript:void(0);" style="font-weight:500;">
                                                                View More
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="fx-card-content px-5">
                                                <a href="#" id="<?=$dat['training_id']?>" style="text-decoration:none;" class="tm_card">
                                                    <h5 class="box-title mb-0"><?=$dat['document_name']?></h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php }} else{ ?>
                                <div class="col-12 text-center">
                                    <h3><b>No Data</b></h3>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="add_tm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add Training Material</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="add_tm_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('tm_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='tm_token' name="tm_token" value="<?=$session->get('tm_token'); ?>">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="doc_nm">Document Name :</label>
                                <input type="text" class="form-control form-control-flush" id="doc_nm" placeholder="Document Name">

                                <div class='d-none bg-danger check-doc_nm' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="tm_img">Training Image:</label>
                                <input type="file" class="form-control form-control-flush" id="tm_img" accept="image/*">

                                <div class='d-none bg-danger check-tm_img' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="training_material">Training Material:</label>
                                <input type="file" class="form-control form-control-flush" id="training_material" accept="application/pdf">
                                
                                <div class='d-none bg-danger check-training_material' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Training Material
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="training_descp">Training Description:</label>
                                <textarea name="" id="training_descp" rows="4" class="training_descp form-control form-control-flush" placeholder="Description" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn btn-primary add_tm" id="add_tm">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border add-category" id="edit_tm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit Training Material</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_tm_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('edit_tm_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='edit_tm_token' name="edit_tm_token" value="<?=$session->get('edit_tm_token'); ?>">

                        <input type="hidden" id='tm_id' name="tm_id" value="">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_doc_nm">Document Name :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_doc_nm" placeholder="Document Name">

                                <div class='d-none bg-danger check-edit_doc_nm' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_tm_img">Training Image:</label>
                                <input type="file" class="form-control form-control-flush" id="edit_tm_img" accept="image/*">

                                <div class='d-none bg-danger check-edit_tm_img' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_training_material">Training Material:</label>
                                <input type="file" class="form-control form-control-flush" id="edit_training_material" accept="application/pdf">
                                
                                <div class='d-none bg-danger check-edit_training_material' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i> Invalid Material
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_training_descp">Training Description:</label>
                                <textarea name="" id="edit_training_descp" cols="" rows="4" class="edit_training_descp form-control form-control-flush" placeholder="Description" style='resize: none;'></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn waves-effect waves-light" data-dismiss="modal" style="background-color:red;color:white">Close</button>
                        <button type="submit" class="btn btn btn-primary edit_tm" id="add_tm">Edit</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light del_tm" id="del_tm">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'template/login_footer.php';?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js"></script>