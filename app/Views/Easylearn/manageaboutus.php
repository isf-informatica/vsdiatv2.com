<?php 
    include 'template/login_header.php';
?>
<style>
    label {
        font-weight: bold;
    }

    textarea {
        resize: none;
    }

    .DownloadTemplate {
        border-radius: 15px;
    }

    .iti-flag {
        margin-top: 10px !important;
    }

    .divider {
        margin: 0;
    }

    .form-group{
    margin-bottom: 2rem;
    }
</style>

<section class="content">
    <div class="row" style="margin-top: 2%;">
        <div class="col-md-2"></div>
        
        <div class="col-xl-8">
            <div class="box">
                <div class="text-start p-3">
                    <a href="manageconfigurations" class="btn btn-info active">
                        <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                    </a>
                </div>

                <div class="box-header with-border">
                    <div class="text-center">
                        <h3>Manage About Us</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>

                    <div class="col-md-12">
                        <div class="example-box-wrapper">
                            <form class="p-t10" id="manage_aboutus_form">
                                <?php $session->set('manage_aboutus_form_token', md5(uniqid(mt_rand(), true))); ?>
                                <input type="hidden" id='manage_aboutus_form_token' name="add_coupon"value="<?=$session->get('manage_aboutus_form_token'); ?>">
                                
                                <div class="row" style='padding: 20px;'>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="heading">Heading :</label>
                                            <input type="text" class="form-control form-control-flush" id="heading" placeholder="Heading">

                                            <div class="d-none bg-danger check_heading" style="font-size:12px; padding-left: 20px;">
                                                <i class="fas fa-times-circle"></i>Enter a heading
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vision_image">Vision Image : <span id="link_vision_img"></span></label>
                                            <input type="file" class="form-control form-control-flush" id="vision_image" accept="image/*" placeholder="">
                                            
                                            <div class='d-none bg-danger check_vision_image' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Add vision image
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="vision">Vision :</label>
                                            <input type="text" class="form-control form-control-flush" id="vision" placeholder="Vision" value=''>

                                            <div class='d-none bg-danger check_vision' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Enter a vision
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mission_image">Mission Image : <span id="link_mission_img"></span></label>
                                            <input type="file" class="form-control form-control-flush" id="mission_image" accept="image/*" placeholder="Mission Image">
                                            
                                            <div class='d-none bg-danger check_mission_image' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Add mission image
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="mission">Mission :</label>
                                            <input type="text" class="form-control form-control-flush" id="mission"placeholder="Mission" value=''>

                                            <div class='d-none bg-danger check_mission' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Enter a mission
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="values_image">Values Image : <span id="link_values_img"></span></label>
                                            <input type="file" class="form-control form-control-flush" id="values_image" accept="image/*" placeholder="Values Image">
                                            
                                            <div class='d-none bg-danger check_values_image' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Add values image
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="values">Values :</label>
                                            <input type="text" class="form-control form-control-flush" id="value_s" placeholder="Values" value=''>
                                            
                                            <div class='d-none bg-danger check_value_s' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Enter Values
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="aboutus_description1">Description 1:</label>
                                            <textarea class="form-control form-control-lg" id="aboutus_description1" rows="7" placeholder="Description 1" style="resize: both; overflow: auto;"></textarea>
                                            
                                            <div class='d-none bg-danger check_aboutus_description1' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Enter Description
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="aboutus_description2">Description 2:</label>
                                            <textarea class="form-control form-control-lg" id="aboutus_description2" rows="7" placeholder="Description 2" style="resize: both; overflow: auto;"></textarea>
                                            
                                            <div class='d-none bg-danger check_aboutus_description2' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Enter Description</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="demoVideo_path">Demo Video Path : <span id="link_demovideo_vdo"></label>
                                            <input type="text" class="form-control form-control-flush" id="demovideo_path" accept="image/*" placeholder="Demo Video Path" value=''>
                                            
                                            <div class='d-none bg-danger check_demovideo_path' style='font-size: 12px; padding-left: 20px;'>
                                                <i class="fas fa-times-circle"></i>Add a video link
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" id="add_about_us" class="btn btn btn-primary d-none">Add</button>
                                    <button type="button" id="update_about_us" class="btn btn btn-primary d-none">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="view_img_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="view_image" alt="" class="img img-responsive" style="width:100%;">

                <video width="100%" autoplay id="vid">
                    <source src="movie.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php'?>

<script src="<?=base_url(); ?>/public/Easylearn/js/Configurations.js"></script>