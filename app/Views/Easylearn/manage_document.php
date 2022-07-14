<?php include 'template/login_header.php'; 
    $docs = json_decode(getdocuments($session->get('user')['id']),true);
?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class='row'>
                <div class='col-6'>
                    <div class="text-start p-3">
                        <a href="dashboard" class="btn btn-info active">
                            <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                        </a>
                    </div>
                </div>

                <div class='col-6'>
                    <div style='text-align: right' class='p-3'>
                        <button class="btn btn-primary" id="add_doc_btn">Add Document</button>
                    </div>
                </div>

                <div class="col-12">
                    <h2 class="text-center">Documents</h2>
                </div>
            </div>

            <div class="row justify-content-center">

                <?php if($docs['data']!='FALSE'){ 
                    foreach($docs['data'] as $dat){ ?>

                <div class="col-4">
                    <div class="box pull-up">
                        <div class="box-body">
                            <div class="d-flex align-items-center">
                                <div class="mr-15 bg-primary-light h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Library font-size-24">
                                        <span class="path1"></span><span class="path2"></span>
                                    </span>
                                </div>

                                <div class="d-flex flex-column font-weight-500" style="width:100%;">
                                    <?=$dat['doc_name']?>

                                    <div class="row justify-content-between">
                                        <div class="align-self-center">
                                            <span class="text-mute small"><?=$dat['added_on']?></span>
                                        </div>

                                        <div class="p-5">
                                            <span class="text-fade">
                                                <a href="#" id="<?=$dat['documents']?>" class="view_pdf">
                                                    <i class="fas fa-download" id=""></i>
                                                </a>&nbsp;

                                                <a href="#" id="<?=$dat['id']?>" class="del_doc">
                                                    <i class="fas fa-trash-alt mx-5"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } }else{?>
                    <div class="col-12 text-center p-5"><h2>No Data</h2></div>
                <?php }?>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="add_doc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Documents</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="add_doc_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('doc_token', md5(uniqid(mt_rand(),true))); ?>
                        <input type="hidden" id='doc_token' name="doc_token" value="<?=$session->get('doc_token'); ?>">

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="doc_nm">Document Name :</label>
                                <input type="text" class="form-control form-control-flush" id="doc_nm" placeholder="Document Name">
                                
                                <div class='d-none bg-danger check-doc_nm' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Document Name
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="document_file">Document:</label>
                                <input type="file" class="form-control form-control-flush" id="document_file">

                                <div class='d-none bg-danger check-document_file' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Choose Valid Document
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn btn-primary upload_doc" id="upload_doc">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js"></script>