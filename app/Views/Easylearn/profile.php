<?php 
    include 'template/login_header.php';

    $profile = json_decode(profile_by_id($session->get('user')['id']), true);
?>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <div class="overflow-hidden">
                        <div class="row no-gutters p-5">
                            <div class="col-12 p-3">
                                <a href='dashboard' class="btn btn-rounded btn-info"  style="float:left"> <i class='ti-control-backward'> Back </i> </a>
                            </div>

                            <div class="col-12 col-xxl-6 align-self-center">
                                <div class="p-3 m-5 text-center " style="color:#0f1849;">
                                    <div class="mb-4"> 
                                        <img src="<?=$profile['data']['profile_image']; ?>" class="img-radius" alt="User-Profile-Image" style="border-radius: 100px; width:200px; height:200px;"> 
                                    </div>

                                    <h6 class="font-weight-bold"><?=ucwords($profile['data']['username']); ?></h6>
                                    <p class='p'><?=$profile['data']['permissions']; ?></p> <i class="mt-2"></i>
                                </div>
                            </div>

                            <div class="col-12 col-xxl-6">
                                <div class="p-3">
                                    <form id='profile_form'>
                                        <?php $session->set('profile_token', md5(uniqid(mt_rand(), true))); ?>
                                        <input type="hidden" id='profile_token' name="profile_token" value="<?=$session->get('profile_token'); ?>">

                                        <h6 class="mb-4 pb-2 border-bottom font-weight-bold">Information</h6>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="mb-2 font-weight-bold p">Email</p>
                                                <h6 class="text-muted font-weight-normal"><?=$profile['data']['email'] ?></h6>
                                            </div>

                                            <div class="col-lg-6">
                                                <p class="mb-2 font-weight-bold p">Phone</p>
                                                <h6 class="text-muted font-weight-normal profile_phone"><?=$profile['data']['contact_number'] ?></h6>

                                                <input id='profile_phone' type='text' class='form-control d-none' value="<?=$profile['data']['contact_number'] ?>">

                                                <div class='d-none bg-danger check_profile_phone' style='font-size: 12px; padding-left: 20px;'> 
                                                    <i class="fas fa-times-circle"></i> Enter Valid Phone Number 
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mt-3 d-none">
                                                <p class="mb-2 font-weight-bold p">Profile Image</p>
                                                <input id='profile_image' type='file' class='form-control' accept='image/*'>

                                                <div class='d-none bg-danger check_profile_image' style='font-size: 12px; padding-left: 20px;'> 
                                                    <i class="fas fa-times-circle"></i> Choose valid image 
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mt-3">
                                                <p class="mb-2 font-weight-bold p">Description</p>
                                                <h6 class="text-muted font-weight-normal profile_description"><?=$profile['data']['description'] ?></h6>
                                                
                                                <textarea id="profile_description" class='form-control resize d-none' rows='4' maxlength='500'><?=$profile['data']['description'] ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <h6 class="mb-4 mt-3 pb-2 border-bottom font-weight-bold">Configurations</h6>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="mb-2 font-weight-bold p">Layout Preference</p>
                                                <h6 class="text-muted font-weight-normal profile_layout"><?=$profile['data']['layout_pref'] ?></h6>
                                                
                                                <select id="profile_layout" class='d-none form-control'>
                                                    <option value='Menu'> Menu Layout </option>
                                                    <option value='Button'> Button Layout </option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6">
                                                <p class="mb-2 font-weight-bold p">Language Preference</p>
                                                <h6 class="text-muted font-weight-normal profile_language"><?=$profile['data']['language_pref'] ?></h6>
                                                
                                                <select id="profile_language" class='d-none form-control'>
                                                    <option value='English'> English </option>
                                                    <option value='Hindi'> Hindi </option>
                                                    <option value='Marathi'> Marathi </option>
                                                </select>
                                            </div>
                                        </div>

                                        <h6 class="mb-4 mt-3 pb-2 border-bottom font-weight-bold"></h6>

                                        <div class="row">
                                            <div class="col-lg-10 col-md-12">
                                                <div class='d-flex justify-content-center'>
                                                    <a class="btn btn-rounded btn-info edit-profile waves-effect waves-light"> <i class="ti-pencil"> Edit </i> </a>

                                                    <div class='d-none'>
                                                        <a class="btn btn-rounded btn-danger cancel-profile waves-effect waves-light mt-3"> <i class="ti-trash"> Cancel </i> </a>
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button class="btn btn-rounded btn-success save-profile waves-effect waves-light mt-3"> <i class="ti-save-alt"> Save </i> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#profile_layout').val('<?=$profile['data']['layout_pref'] ?>');
    $('#profile_language').val('<?=$profile['data']['language_pref'] ?>');
</script>

<?php include 'template/login_footer.php'?>