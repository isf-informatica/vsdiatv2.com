<?php 
    include 'template/login_header.php';
?>

<!-- Modal add slider-->
<div class="modal fade none-border add-category" id="add_slider_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Manage Slider</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="manage_slider_form">
                    <?php $session->set('manage_slider_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='manage_slider_form_token' name="add_slider" value="<?=$session->get('manage_slider_form_token'); ?>">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Type">Slider Type :</label>
                                <select id="slider_type" class="form-control form-control-lg">
                                    <option value='image'> Image </option>
                                    <option value='video'> Video </option>
                                </select>

                                <div class='d-none bg-danger check_slider_type' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Select type
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 slider_image">
                            <div class="form-group">
                                <label for="image">Image :</label>
                                <input type="file" class="form-control form-control-lg" id="slider_image" accept="image/*" placeholder="Image">
                                
                                <div class='d-none bg-danger check_slider_image check_slider' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add image
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 slider_video d-none">
                            <div class="form-group">
                                <label for="slider_video">Slider Video Link : <span id="link_demovideo_vdo"></label>
                                <input type="text" class="form-control form-control-lg" id="slider_video" accept="image/*" placeholder="Slider Video Link" value=''>
                                
                                <div class='d-none bg-danger check_slider_video check_slider' style='font-size: 12px; padding-left: 20px;'>
                                    <i class="fas fa-times-circle"></i>Add a video link
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
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_slider_modal">Add slider</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Slider List</h4>

                    <div class="table-responsive p-3">
                        <table id="slider_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th >Sr. No.</th>
                                    <th>Slider Type</th>
                                    <th >Slider Image/Video</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>

<!-- Modal edit slider -->
<div class="modal fade none-border add-category" id="edit_slider_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Edit slider</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_slider_form">
                    <?php $session->set('edit_slider_form_token', md5(uniqid(mt_rand(), true))); ?>
                    <input type="hidden" id='edit_slider_form_token' name="edit_slider" value="<?=$session->get('edit_slider_form_token'); ?>">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Type">Slider Type :</label>
                            <select id="edit_slider_type" class="form-control form-control-lg">
                                <option value='image'> Image </option>
                                <option value='video'> Video </option>
                            </select>

                            <div class='d-none bg-danger check_edit_slider_type' style='font-size: 12px; padding-left: 20px;'>
                                <i class="fas fa-times-circle"></i>Select type
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 edit_image">
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control form-control-lg" id="edit_slider_image" accept="image/*" placeholder="Image">
                            
                            <div class='d-none bg-danger check_edit_slider_image' style='font-size: 12px; padding-left: 20px;'>
                                <i class="fas fa-times-circle"></i>Add image
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 edit_slider_video">
                        <div class="form-group">
                            <label for="demoVideo_path">Slider Video Link : <span id="link_demovideo_vdo"></label>
                            <input type="text" class="form-control form-control-lg" id="edit_slider_video" accept="image/*" placeholder="Slider Video Link" value=''>
                            
                            <div class='d-none bg-danger check_edit_slider_video' style='font-size: 12px; padding-left: 20px;'>
                                <i class="fas fa-times-circle"></i>Add a video link
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" id='delete_slider' data-id="" class="btn btn-danger waves-effect waves-light">Delete</button>
                        <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn btn-primary edit_btn waves-effect waves-light">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="view_vid_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <video width="100%" autoplay id="view_vid">
                    <source src="movie.mp4" type="video/mp4">
                </video>
            </div>   
        </div>
    </div>
</div>


<?php include 'template/login_footer.php'?>

<script src="<?=base_url(); ?>/public/Easylearn/js/Configurations.js"></script>