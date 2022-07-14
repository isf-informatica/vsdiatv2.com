<?php 
    include 'template/login_header.php';
?>

<!-- Modal add newsfeed-->
<div class="modal fade none-border add-category" id="add_newsfeed_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage NewsFeed</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_newsfeed_form">
                    <?php $session->set('manage_newsfeed_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_newsfeed_form_token' name="add_newsfeed" value="<?=$session->get('manage_newsfeed_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Name">NewsFeed Headline :</label>
                                <input type="text" class="form-control form-control-lg" id="newsfeed_headline" placeholder="NewsFeed Headline">
                                
                                <div class='d-none bg-danger check_newsfeed_headline' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Newsfeed headline cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="newsfeed_Description">NewsFeed RSS Link :</label>
                                <input type="text" class="form-control form-control-lg" id="newsfeed_link" placeholder="NewsFeed RSS Link">
                                
                                <div class='d-none bg-danger check_newsfeed_link' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter a link
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_newsfeed_modal">Add newsfeed</a>
                            </div>
                        </div>
                    </div>
            
                    <h4 class="text-center text-dark bold">NewsFeed List</h4>
                    <div class="table-responsive p-3">
                        <table id="newsfeed_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th >NewsFeed Headline</th>
                                    <th >NewsFeed RSS Link</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit newsfeed -->
<div class="modal fade none-border add-category" id="edit_newsfeed_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit NewsFeed</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_newsfeed_form">
                    <?php $session->set('edit_newsfeed_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_newsfeed_form_token' name="edit_newsfeed" value="<?=$session->get('edit_newsfeed_form_token'); ?>">

                    <div class="row p-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Name">NewsFeed Headline :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_newsfeed_headline" placeholder="NewsFeed Headline">
                                
                                <div class='d-none bg-danger check_edit_newsfeed_headline' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>newsfeed_headline name cannot be blank
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="newsfeed_link">NewsFeed RSS Link :</label>
                                <input type="text" class="form-control form-control-lg" id="edit_newsfeed_link" placeholder="NewsFeed RSS Link">
                                
                                <div class='d-none bg-danger check_edit_newsfeed_link' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Enter Description
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                          <button type="button" id='delete_newsfeed' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                          <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                          <button type="submit"  class="btn btn-primary edit_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'template/login_footer.php'?>

<script src="<?=base_url(); ?>/public/Easylearn/js/configurations.js"></script>