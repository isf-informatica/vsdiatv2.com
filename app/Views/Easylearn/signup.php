<?php 
    include 'template/header.php'; 

    $board_type = json_decode(get_settings_name('School Board Type') , true)['data'];
    $school_type = json_decode(get_settings_name('School Type') , true)['data'];
    $school_medium = json_decode(get_settings_name('School Medium') , true)['data'];

?>

<section class="py-2 py-md-10 position-relative" style="background-color:#f2eded">
    <div class="container p-5">
        <div class="row d-flex justify-content-center  mb-7">
            <div class="col-lg-8">
                <h2 class="fw-bold text-center mb-1 mt-2" id="modalExampleTitle">
                    Register yourself at Easylearn
                </h2>

                <!-- Text -->
                <p class="font-size-lg text-center text-muted mb-6 mb-md-8 mt-2">
                    Register yourself as School, group or mentor
                </p>

                <div class="nav justify-content-center tab-nav-1" id="pills-tab" role="tablist">
                    <a class="btn-sm btn-pill me-1 mb-1 text-dark fw-medium px-6 active" id="pills-school-tab"
                        data-bs-toggle="tab" href="#pills-school" role="tab" aria-controls="pills-school"
                        aria-selected="true">
                        School
                    </a>

                    <a class="btn-sm btn-pill me-1 mb-1 text-dark fw-medium px-6" id="pills-jr-college-tab"
                        data-bs-toggle="tab" href="#pills-jr-college" role="tab" aria-controls="pills-jr-college"
                        aria-selected="true">
                        Jr. College
                    </a>

                    <a class="btn-sm btn-pill me-1 mb-1 text-dark fw-medium px-6" id="pills-group-tab"
                        data-bs-toggle="tab" href="#pills-group" role="tab" aria-controls="pills-group"
                        aria-selected="false">
                        Group
                    </a>

                    <a class="btn-sm btn-pill me-1 mb-1 text-dark fw-medium px-6" id="pills-mentor-tab"
                        data-bs-toggle="tab" href="#pills-mentor" role="tab" aria-controls="pills-mentor"
                        aria-selected="false">
                        Mentor
                    </a>
                </div>

                <div class="tab-content flickity-tab p-3 m-3" id="pills-tabContent">
                    <!-- School -->
                    <div class="tab-pane fade show active" id="pills-school" role="tabpanel"
                        aria-labelledby="pills-school-tab">
                        <form class="mb-5" id='school_register'>

                            <?php $session->set('school_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='school_token' name="school_token" value="<?=$session->get('school_token'); ?>">

                            <div class="row">
                                <div class="col-12">
                                    <!-- School name -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="school_name"
                                            placeholder="School Name" style='padding-left: 20px;'>
                                        <label for="school_name" style='padding-left: 20px;'>School Name</label>

                                        <div class='d-none bg-danger check_institute_name'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Name
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- School name -->
                                    <div class="form-label-group">
                                        <select id="school_type" class="form-control form-control-lg">
                                            <?php foreach($school_type as $type){ ?>
                                            <option value='<?=$type['value']; ?>'> <?=$type['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="school_type" style='padding-left: 20px;'>School Type</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-label-group">
                                        <select id="board_type" class="form-control form-control-lg">
                                            <?php foreach($board_type as $board){ ?>
                                            <option value='<?=$board['value']; ?>'> <?=$board['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="board_type" style='padding-left: 20px;'>Board Type</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--School Code-->
                                    <div class="form-label-group">
                                        <select id="school_medium" class="form-control form-control-lg">
                                            <?php foreach($school_medium as $medium){ ?>
                                            <option value='<?=$medium['value']; ?>'> <?=$medium['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="school_medium" style='padding-left: 20px;'>School Medium</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--School Code-->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="school_code"
                                            placeholder="School Code" style='padding-left: 20px;'>
                                        <label for="school_code" style='padding-left: 20px;'>School Code</label>

                                        <div class='d-none bg-danger check_school_code'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Code
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-1"> </div>
                                <div class="col-12 col-md-5">
                                    <div class="switch-container">
                                        <div class="switch-holder">
                                            <div class="switch-label">
                                                <span>Is Co-ed</span>
                                            </div>

                                            <div class="switch-toggle">
                                                <input type="checkbox" id="is_coed">
                                                <label for="is_coed"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--School Code-->
                                    <div class="form-label-group">
                                        <select id="school_gender_type" class="form-control form-control-lg">
                                            <option value='Boys'> Boy's Only </option>
                                            <option value='Girls'> Girl's Only </option>
                                        </select>

                                        <label for="school_gender_type" style='padding-left: 20px;'>gender Type</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- School Logo -->
                                    <div class="form-label-group">
                                        <input type="file" class="form-control form-control-flush" id="school_logo"
                                            placeholder="School Logo" accept='image/*' style='padding-left: 15px;'>
                                        <label for="school_logo" style='padding-left: 20px;'>School Logo</label>

                                        <div class='d-none bg-danger check_school_logo'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Image
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- School Image -->
                                    <div class="form-label-group">
                                        <input type="file" class="form-control form-control-flush" id="school_image"
                                            placeholder="School Image" accept='image/*' style='padding-left: 15px;'>
                                        <label for="school_image" style='padding-left: 20px;'>School Image</label>

                                        <div class='d-none bg-danger check_school_image'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Image
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Contact Number 1 -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="school_contactnumber1">

                                        <div class='d-none bg-danger check_school_contactnumber1'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Contact Number
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- Contact Number 2 -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="school_contactnumber2">

                                        <div class='d-none bg-danger check_school_contactnumber2'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Contact Number
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!--Classroom Description -->
                                    <div class="form-label-group">
                                        <textarea class="form-control" id="school_description"
                                            placeholder="School Description" style="resize:none;"></textarea>
                                        <label for="school_description">School Description</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Administrator Name -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="school_administratorname" placeholder="Administrator Name"
                                            style='padding-left: 20px;'>
                                        <label for="school_administratorname" style='padding-left: 20px;'>Administrator
                                            Name</label>

                                        <div class='d-none bg-danger check_school_administratorname'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Name
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- Administrator Email -->
                                    <div class="form-label-group">
                                        <input type="email" class="form-control form-control-flush"
                                            id="school_administratoremail" placeholder="Administrator Email"
                                            style='padding-left: 20px;'>
                                        <label for="school_administratoremail" style='padding-left: 20px;'>Administrator
                                            Email</label>

                                        <div class='d-none bg-danger check_school_administratoremail'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Email
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Password-->
                                    <div class="form-label-group">
                                        <input type="password" class="form-control form-control-flush"
                                            id="school_password" placeholder="Password" style='padding-left: 20px;'>
                                        <label for="school_password" style='padding-left: 20px;'>Password</label>

                                        <div class='d-none bg-danger check_school_password'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Password
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--Confirm Password-->
                                    <div class="form-label-group">
                                        <input type="password" class="form-control form-control-flush"
                                            id="school_confirmpassword" placeholder="Confirm Password"
                                            style='padding-left: 20px;'>
                                        <label for="school_confirmpassword" style='padding-left: 20px;'>Confirm
                                            Password</label>

                                        <div class='d-none bg-danger check_school_confirmpassword'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Password
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control form-control-flush " id="school_addressline1"
                                            placeholder="Address line 1"
                                            style="resize:none;padding-left: 20px;"></textarea>
                                        <label for="school_addressline1" style="padding-left: 20px;">Address line
                                            1</label>

                                        <div class='d-none bg-danger check_school_addressline1'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Address
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control form-control-flush " id="school_addressline2"
                                            placeholder="Address line 2"
                                            style="resize:none;padding-left: 20px;"></textarea>
                                        <label for="school_addressline2" style="padding-left: 20px;">Address line
                                            2</label>

                                        <div class='d-none bg-danger check_school_addressline2'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Address
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="school_country" class="form-control form-control-lg">

                                        </select>
                                        <label for="school_country" style="padding-left: 20px;">Country</label>
                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="school_state" class="form-control form-control-lg">

                                        </select>
                                        <label for="school_state" style="padding-left: 20px;">State</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="school_city" class="form-control form-control-lg">

                                        </select>
                                        <label for="school_city" style="padding-left: 20px;">Town/City</label>
                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="school_postal_code" placeholder="school_postal_code" 
                                            style="padding-left: 20px;">
                                        <label for="group_" style="padding-left: 20px;">Postal Code</label>

                                        <div class='d-none bg-danger check_school_postal_code'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Postal Code
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!-- Submit -->
                                    <button type= "submit" class="btn btn-block btn-primary mt-3 lift">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Jr College -->
                    <div class="tab-pane fade" id="pills-jr-college" role="tabpanel"
                        aria-labelledby="pills-jr-college-tab">
                        <form class="mb-5" id='jr_college_register'>

                            <?php $session->set('jr_college_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id='jr_college_token' name="jr_college_token" value="<?=$session->get('jr_college_token'); ?>">

                            <div class="row">
                                <div class="col-12">
                                    <!-- Jr College name -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="jr_college_name"
                                            placeholder="Jr College Name" style='padding-left: 20px;'>
                                        <label for="jr_college_name" style='padding-left: 20px;'>Jr College Name</label>

                                        <div class='d-none bg-danger check_jr_college_name'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Name
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- Jr College Type name -->
                                    <div class="form-label-group">
                                        <select id="college_type" class="form-control form-control-lg">
                                            <?php foreach($school_type as $type){ ?>
                                            <option value='<?=$type['value']; ?>'> <?=$type['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="college_type" style='padding-left: 20px;'>College Type</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-label-group">
                                        <select id="college_board_type" class="form-control form-control-lg">
                                            <?php foreach($board_type as $board){ ?>
                                            <option value='<?=$board['value']; ?>'> <?=$board['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="college_board_type" style='padding-left: 20px;'>Board Type</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Jr College Code-->
                                    <div class="form-label-group">
                                        <select id="jr_college_medium" class="form-control form-control-lg">
                                            <?php foreach($school_medium as $medium){ ?>
                                            <option value='<?=$medium['value']; ?>'> <?=$medium['value']; ?> </option>
                                            <?php } ?>
                                        </select>

                                        <label for="jr_college_medium" style='padding-left: 20px;'>Jr College Medium</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--jr College Code-->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="jr_college_code"
                                            placeholder="Jr College Code" style='padding-left: 20px;'>
                                        <label for="jr_college_code" style='padding-left: 20px;'>Jr College Code</label>

                                        <div class='d-none bg-danger check_jr_college_code'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Code
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-1"> </div>
                                <div class="col-12 col-md-5">
                                    <div class="switch-container">
                                        <div class="switch-holder">
                                            <div class="switch-label">
                                                <span>Is Co-ed</span>
                                            </div>

                                            <div class="switch-toggle">
                                                <input type="checkbox" id="jr_college_is_coed">
                                                <label for="jr_college_is_coed"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--Jr College Code-->
                                    <div class="form-label-group">
                                        <select id="jr_college_gender_type" class="form-control form-control-lg">
                                            <option value='Boys'> Boy's Only </option>
                                            <option value='Girls'> Girl's Only </option>
                                        </select>

                                        <label for="jr_college_gender_type" style='padding-left: 20px;'>gender Type</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- Jr College Logo -->
                                    <div class="form-label-group">
                                        <input type="file" class="form-control form-control-flush" id="jr_college_logo"
                                            placeholder="Jr College Logo" accept='image/*' style='padding-left: 15px;'>
                                        <label for="jr_college_logo" style='padding-left: 20px;'>Jr College Logo</label>

                                        <div class='d-none bg-danger check_jr_college_logo'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Image
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- Jr College Image -->
                                    <div class="form-label-group">
                                        <input type="file" class="form-control form-control-flush" id="jr_college_image"
                                            placeholder="Jr College Image" accept='image/*' style='padding-left: 15px;'>
                                        <label for="jr_college_image" style='padding-left: 20px;'>College Image</label>

                                        <div class='d-none bg-danger check_jr_college_image'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Image
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Contact Number 1 -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="jr_college_contactnumber1">

                                        <div class='d-none bg-danger check_jr_college_contactnumber1'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Contact Number
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- Contact Number 2 -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="jr_college_contactnumber2">

                                        <div class='d-none bg-danger check_jr_college_contactnumber2'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Contact Number
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!--Jr College Code-->
                                    <div class="form-label">
                                        <label for="jr_college_stream" style='padding-left: 20px; color: #77838f'>College Stream</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-label">
                                        <input class="form-check-input text-gray-800" type="checkbox" id="arts" value="arts" name="jr_clg_stream">&nbsp;
                                        <label class="form-check-label text-gray-800" for="arts">
                                            Arts
                                        </label>&emsp;

                                        <input class="form-check-input text-gray-800" type="checkbox" id="science" value="science" name="jr_clg_stream">&nbsp;
                                        <label class="form-check-label text-gray-800" for="science">
                                            Science
                                        </label>&emsp;

                                        <input class="form-check-input text-gray-800" type="checkbox" id="commerce" name="jr_clg_stream" value="commerce"> &nbsp;
                                        <label class="form-check-label text-gray-800" for="commerce">
                                            Commerce
                                        </label>&emsp;

                                        <input class="form-check-input text-gray-800" type="checkbox" id="diploma" name="jr_clg_stream" value="diploma">&nbsp;
                                        <label class="form-check-label text-gray-800" for="diploma">
                                            Diploma
                                        </label>&emsp;

                                    </div>
                                    <div class='d-none bg-danger check_jr_college_stream'
                                        style='font-size: 12px; padding-left: 20px;'>
                                        <i class="fas fa-times-circle"></i>Invalid Stream
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-label">
                                        <div class="d-none bg-danger check_streamr" style="font-size:12px; padding-left: 20px;">
                                            <i class="fas fa-times-circle"></i>Please Select Stream
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!--Classroom Description -->
                                    <div class="form-label-group">
                                        <textarea class="form-control" id="jr_college_description"
                                            placeholder="Jr College Description" style="resize:none;"></textarea>
                                        <label for="jr_college_description">Jr College Description</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Administrator Name -->
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="jr_college_administratorname" placeholder="Administrator Name"
                                            style='padding-left: 20px;'>
                                        <label for="jr_college_administratorname" style='padding-left: 20px;'>Administrator
                                            Name</label>

                                        <div class='d-none bg-danger check_jr_college_administratorname'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Name
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!-- Administrator Email -->
                                    <div class="form-label-group">
                                        <input type="email" class="form-control form-control-flush"
                                            id="jr_college_administratoremail" placeholder="Administrator Email"
                                            style='padding-left: 20px;'>
                                        <label for="jr_college_administratoremail" style='padding-left: 20px;'>Administrator
                                            Email</label>

                                        <div class='d-none bg-danger check_jr_college_administratoremail'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Email
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!--Password-->
                                    <div class="form-label-group">
                                        <input type="password" class="form-control form-control-flush"
                                            id="jr_college_password" placeholder="Password" style='padding-left: 20px;'>
                                        <label for="jr_college_password" style='padding-left: 20px;'>Password</label>

                                        <div class='d-none bg-danger check_jr_college_password'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Password
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <!--Confirm Password-->
                                    <div class="form-label-group">
                                        <input type="password" class="form-control form-control-flush"
                                            id="jr_college_confirmpassword" placeholder="Confirm Password"
                                            style='padding-left: 20px;'>
                                        <label for="jr_college_confirmpassword" style='padding-left: 20px;'>Confirm
                                            Password</label>

                                        <div class='d-none bg-danger check_jr_college_confirmpassword'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Password does not match!
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control form-control-flush " id="jr_college_addressline1"
                                            placeholder="Address line 1"
                                            style="resize:none;padding-left: 20px;"></textarea>
                                        <label for="jr_college_addressline1" style="padding-left: 20px;">Address line
                                            1</label>

                                        <div class='d-none bg-danger check_jr_college_addressline1'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Address
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-label-group">
                                        <textarea class="form-control form-control-flush " id="jr_college_addressline2"
                                            placeholder="Address line 2"
                                            style="resize:none;padding-left: 20px;"></textarea>
                                        <label for="jr_college_addressline2" style="padding-left: 20px;">Address line
                                            2</label>

                                        <div class='d-none bg-danger check_jr_college_addressline2'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Address
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="jr_college_country" class="form-control form-control-lg">

                                        </select>
                                        <label for="jr_college_country" style="padding-left: 20px;">Country</label>
                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="jr_college_state" class="form-control form-control-lg">

                                        </select>
                                        <label for="jr_college_state" style="padding-left: 20px;">State</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <select id="jr_college_city" class="form-control form-control-lg">

                                        </select>
                                        <label for="jr_college_city" style="padding-left: 20px;">Town/City</label>
                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="jr_college_postal_code" placeholder="jr_college_postal_code" 
                                            style="padding-left: 20px;">
                                        <label for="jr_college_postal_code" style="padding-left: 20px;">Postal Code</label>

                                        <div class='d-none bg-danger check_jr_college_postal_code'
                                            style='font-size: 12px; padding-left: 20px;'>
                                            <i class="fas fa-times-circle"></i>Invalid Postal Code
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <!-- Submit -->
                                    <button type= "submit" class="btn btn-block btn-primary mt-3 lift">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="tab-pane fade show" id="pills-group" role="tabpanel" aria-labelledby="pills-group-tab">
                        <form class="md5" id="group-register">

                            <?php $session->set('group_token', md5(uniqid(mt_rand(), true))); ?>
                            <input type="hidden" id="group-register" class="group-register"
                                value="<?=$session->get('group-token'); ?>">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush" id="incubatorName"
                                            placeholder="Incubator Name"  style="padding-left: 20px;">
                                        <label for="group_incubatorName" style="padding-left: 20px;">Incubator
                                            Name</label>
                                        <div class='d-none check_group_incubatorName'
                                            style='font-size: 12px; padding-left: 20px;'>Incubator Name </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">

                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="incubatorContactNo1" placeholder="incubatorContactNo1" 
                                            style="padding-left: 20px;">
                                        <label for="group_incubatorContactNo1" style="padding-left: 20px;">Contact
                                            No1</label>
                                        <div class='d-none check_group_incubatorContactNo1'
                                            style='font-size: 12px; padding-left: 20px;'>Enter valid Contact No1
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class="col-12 col-md-6">

                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="incubatorContactNo2" placeholder="incubatorContactNo2" 
                                            style="padding-left: 20px;">
                                        <label for="group_incubatorContactNo2" style="padding-left: 20px;"> Contact
                                            No2</label>
                                        <div class='d-none check_group_incubatorContactNo1'
                                            style='font-size: 12px; padding-left: 20px;'>Enter valid Contact No2
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">

                                    <div class="form-label-group">
                                        <input type="text" class="form-control form-control-flush"
                                            id="incubatorGroupName" placeholder="Group Name" 
                                            style="padding-left: 20px;">
                                        <label for="group_" style="padding-left: 20px;">Group Name</label>
                                        <div class='d-none check_group_incubatorGroupName'
                                            style='font-size: 12px; padding-left: 20px;'>GroupName</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">

                                    <div class="form-label-group">
                                        <input type="file" class="form-control form-control-flush" id="incubatorImage"
                                            type="file" accept="image/*"  style="padding-left: 15px;">
                                        <label for="group_" style="padding-left: 20px;">Image</label>
                                        <div class='d-none check_group_incubatorImage'
                                            style='font-size: 12px; padding-left: 20px;'> Image</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-label-group">
                                            <textarea class="form-control" id="group_description"
                                                placeholder="Group description" style="resize:none;"
                                                ></textarea>
                                            <label for="group_group_description">Group description</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

                                        <div class="form-label-group">
                                            <input type="text" class="form-control form-control-flush"
                                                id="group_incubatorAdminName" placeholder="Administrator Name" 
                                                style="padding-left: 20px;">
                                            <label for="group_incubatorAdminName"
                                                style="padding-left: 20px;">Administrator Name</label>
                                            <div class='d-none check_group_incubatorAdminName'
                                                style='font-size: 12px; padding-left: 20px;'>Administrator Name
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

                                        <div class="form-label-group">
                                            <input type="email" class="form-control form-control-flush"
                                                id="group_incubatorAdminEmail" placeholder="Administrator Email"
                                                 style="padding-left: 20px;">
                                            <label for="group_incubatorAdminEmail"
                                                style="padding-left: 20px;">Administrator Email</label>
                                            <div class='d-none check_group_incubatorAdminEmail"'
                                                style='font-size: 12px; padding-left: 20px;'> </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <!--Password-->
                                        <div class="form-label-group">
                                            <input type="password" class="form-control form-control-flush"
                                                id="group_password" placeholder="Password" 
                                                style="padding-left: 20px;">
                                            <label for="group_password" style="padding-left: 20px;">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <!--Confirm Password-->
                                        <div class="form-label-group">
                                            <input type="password" class="form-control form-control-flush"
                                                id="group_confirmpassword" placeholder="Confirm Password" 
                                                style="padding-left: 20px;">
                                            <label for="group_confirmpassword" style="padding-left: 20px;">Confirm
                                                Password</label>
                                            <div class='d-none check_group_password'
                                                style='font-size: 12px; padding-left: 20px;'>Password does not
                                                match!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- 3rd Tab Starts -->
                    <div class="tab-pane fade show" id="pills-mentor" role="tabpanel" aria-labelledby="pills-mentor-tab">
                        <form class="md5" id="mentor-register">
                            <?php $session->set('mentor_token', md5(uniqid(mt_rand(),true))); ?>
                            <input type="hidden" id='mentor_token' name="mentor_token" value="<?=$session->get('mentor_token'); ?>">

                            <div class="row">
                                <div class="form-mentor">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-label-group">
                                                <input type="text" class="form-control form-control-flush" id="mentorName" placeholder="Mentor Name"  style="padding-left: 20px;">
                                                <label for="group_mentorName" style="padding-left: 20px;">Mentor Name</label>

                                                <div class='d-none bg-danger check_mentor_mentorName' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Name
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div class="form-label-group">
                                                <input type="number" class="form-control form-control-flush" id="mentoryearsofexperience" placeholder="Years of Experience" min=1 style="padding-left: 20px;">
                                                <label for="mentor_yearsofexperience" style="padding-left: 20px;">Years of Experience</label>
                                                
                                                <div class='d-none bg-danger check_mentor_yearsofexperience' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Experience
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="text" autocomplete="off" class="form-control form-control-flush date" placeholder="Date of Birth" data-provide="datepicker" id="mentordateofbirth"  style="padding-left: 20px;">
                                                        <label style="padding-left: 20px;">Date of Birth</label>

                                                        <div class='d-none bg-danger check-mentor-dateofbirth' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Invalid Date of Birth
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="text" class="form-control form-control-flush" id="fieldofexperience" placeholder="Field of Experience" style="padding-left: 20px;">
                                                        <label style="padding-left: 20px;">Field of Experience</label>
    
                                                        <div class='d-none bg-danger check-mentor-fieldofexperience' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Invalid Field of Experience
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <label for="mentor_skills">Please Add Skills(press enter to make tag)</label>
                                            <div class="form-label-group">
                                                <input class="form-control form-control-flush" id="mentor_skills" placeholder="Add Your Skills" style="resize:none;" >

                                                <div class='d-none bg-danger check-mentor_skills' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Skills
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <textarea class="form-control form-control-flush " id="mentor_mentorbriefdescription" placeholder="Brief Description About Yourself" style="resize:none;padding-left: 20px;" ></textarea>
                                                <label for="mentor_mentordescription" style="padding-left: 20px;">Brief Description About Yourself</label>

                                                <div class='d-none bg-danger check-mentor-mentorbriefdescription' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Description
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class=" col-md-12">
                                            <div class="form-label-group">
                                                <input type="email" class="form-control form-control-flush" id="mentor_incubatorAdminEmail" placeholder="Administrator Email"  style="padding-left: 20px;">
                                                <label for="group_incubatorAdminEmail" style="padding-left: 20px;">Mentor Email</label>

                                                <div class='d-none bg-danger check_mentor_incubatorAdminEmail' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Mentor Email
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class=" col-md-6">
                                                    <!--Password-->
                                                    <div class="form-label-group">
                                                        <input type="password" class="form-control form-control-flush" id="mentor_password" placeholder="Password"  style="padding-left: 20px;">
                                                        <label for="mentor_password" style="padding-left: 20px;">Password</label>

                                                        <div class='d-none bg-danger check_mentor_password' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Invalid Password
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!--Confirm Password-->
                                                    <div class="form-label-group">
                                                        <input type="password" class="form-control form-control-flush" id="mentor_confirmpassword" placeholder="Confirm Password"  style="padding-left: 20px;">
                                                        <label for="mentor_confirmpassword" style="padding-left: 20px;">Confirm Password</label>
                                                        
                                                        <div class='d-none bg-danger check_mentor_confirm_password' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Password does not match!
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="text" class="form-control form-control-flush" id="mentor_ContactNo1">

                                                        <div class='d-none bg-danger check_mentor_mentorContactNo1' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Enter valid Contact No
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="text" class="form-control form-control-flush" id="mentor_ContactNo2">

                                                        <div class='d-none bg-danger check_mentor_mentorContactNo2' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i> Enter valid Contact No
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <textarea class="form-control form-control-flush " id="mentor_addressline1" placeholder="Address line 1" style="resize:none;padding-left: 20px;"></textarea>
                                                <label for="mentor_mentor_description" style="padding-left: 20px;">Address line 1</label>

                                                <div class='d-none bg-danger check_mentor_addressline1' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Address Line
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <textarea class="form-control form-control-flush " id="mentor_addressline2" placeholder="Address line 2" style="resize:none;padding-left: 20px;"></textarea>
                                                <label for="mentor_mentor_description" style="padding-left: 20px;">Address line 2</label>

                                                <div class='d-none bg-danger check_mentor_addressline2' style='font-size: 12px; padding-left: 20px;'>
                                                    <i class="fas fa-times-circle"></i> Invalid Address Line
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class=" col-md-6">
                                                    <div class="form-label-group">
                                                        <select id="mentor_country" class="form-control form-control-lg">

                                                        </select>
                                                        <label for="mentor_country" style="padding-left: 20px;">Country</label>
                                                    </div>
                                                </div>

                                                <div class=" col-md-6">
                                                    <div class="form-label-group">
                                                        <select id="mentor_state" class="form-control form-control-lg">

                                                        </select>
                                                        <label for="mentor_state" style="padding-left: 20px;">State</label>
                                                    </div>
                                                </div>

                                                <div class=" col-md-6">
                                                    <div class="form-label-group">
                                                        <select id="mentor_city" class="form-control form-control-lg">

                                                        </select>
                                                        <label for="mentor_city" style="padding-left: 20px;">Town/City</label>
                                                    </div>
                                                </div>

                                                <div class=" col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="text" class="form-control form-control-flush" id="mentor_postal_code" placeholder="mentor_postal_code"  style="padding-left: 20px;">
                                                        <label for="mentor_postal_code" style="padding-left: 20px;">Postal Code</label>

                                                        <div class='d-none bg-danger check_mentor_postal_code' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i>Invalid Postal Code
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="file" class="form-control form-control-flush" id="mentor_photo_Uplode" placeholder="Photo Uplode" type="file" accept="image/*" style="padding-left: 15px;">
                                                        <label for="mentor_photo_uplode" style="padding-left: 20px;">Photo Upload</label>

                                                        <div class='d-none bg-danger check_mentor_photo_Uplode' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i>Invalid Photo
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-label-group">
                                                        <input type="file" class="form-control form-control-flush" id="mentor-resume-uplode" placeholder="Resume Uplode" type="file" accept="application/pdf" style="padding-left: 15px;">
                                                        <label for="mentor_resume_uplode" style="padding-left: 20px;">Resume Upload</label>

                                                        <div class='d-none bg-danger check_mentor-resume-uplode' style='font-size: 12px; padding-left: 20px;'>
                                                            <i class="fas fa-times-circle"></i>Invalid File
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-block btn-primary mt-3 lift" id="MentorRegister">
                                                Register
                                            </button>
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
</section>

<?php include 'template/footer.php'; ?>