<?php 
    include 'template/header.php'; 
    $captcha = json_decode(get_security_name('Captcha') , true)['data']['status'];

    if($captcha == 1){
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LeTr3MeAAAAABZ8Bv4UlIEPnntleUGtD0IKKCoJ"></script>

<?php } ?>

<section class="py-2 py-md-10" style="background-color:#fffdfb;position:relative">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 align-self-center">
                <div class='m-3 pe-xl-7'>
                    <img src="<?=base_url(); ?>/public/Easylearn/assets/login-asset-1.svg" alt="" class="w-100">
                </div>
            </div>

            <div class="col-12 col-lg-5 ">
                <div class='login-box m-3 '>
                    <h3 class="text-center m-5">Log In To Your Easylearn Account</h3>
                    <form class="" id='login_form'>

                        <?php $session->set('login_token', md5(uniqid(mt_rand(), true))); ?>
                        <input type="hidden" id='login_token' name="login_token"
                            value="<?=$session->get('login_token'); ?>">
                        
                        <!-- Captcha -->
                        <input type="hidden" id='captcha' name="captcha" value="<?=$captcha ?>">

                        <!-- Email -->
                        <div class="form-group mb-5">
                            <label for="login_email">Email</label>
                            <input type="email" class="form-control" id="login_email" placeholder="Email">
                            <div class='d-none check_login_email' style='font-size: 12px; padding-left: 20px;'>
                                Enter Valid Name </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label for="login_password">Password</label>
                            <input type="password" class="form-control" id="login_password" placeholder="**********">
                            <div class='d-none check_login_password' style='font-size: 12px; padding-left: 20px;'>
                                Enter Valid Name </div>
                        </div>

                        <?php if($captcha == 1){ ?>
                        <div class="form-group mb-5 d-flex justify-content-center">
                            <div class="g-recaptcha" data-sitekey="6Le6f3keAAAAAL0DcW1QrHjGP2YQF0d6pjTejLJ3"></div>
                        </div>
                        <?php } ?>

                        <div class="d-flex align-items-center mb-5 font-size-sm">
                            <div class="form-check">
                                <input class="form-check-input text-gray-800" type="checkbox" id="autologin_check">
                                <label class="form-check-label text-gray-800" for="autologin_check">
                                    Remember me
                                </label>
                            </div>

                            <div class="ms-auto">
                                <a class="text-gray-800" data-bs-toggle="collapse" href="#" id="forgetpwd" role="button"
                                    aria-expanded="false" aria-controls="collapseForgotPassword">Forgot Password?</a>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary" type="submit">
                            LOGIN
                        </button>
                    </form>

                    <p class="mt-5 font-size-sm text-center">
                        Don't have an account? <a class="text-underline" href="signup" role="button"
                            aria-expanded="false">Sign up</a>
                    </p>
                </div>

                <div class='otp-box m-3' style="display:none;">
                    <h3 class="text-center m-5">Enter Your OTP</h3>
                    <h4 class="text-center m-5">Please check your Authenticator for OTP</h4>

                    <form class="" id='otp_form'>
                        <div class="form-group mb-5">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control otp" id="otp" placeholder="0 0 0 0 0 0">
                        </div>

                        <div class="form-group mb-5">
                            <button class="btn btn-block btn-primary" type="submit">
                                SUBMIT
                            </button>
                        </div>
                    </form>
                </div>

                <div class='forget-box m-3' style="display:none;">
                    <h3 class="text-center m-5">Enter Your Email</h3>
                    <form class="" id='forgot_form'>
                        <div class="form-group mb-5">
                            <label for="forgot">Email</label>
                            <input type="email" class="form-control forgot" id="forgot_email" placeholder="Email">
                            <div class='d-none check_forgot_email' style='font-size: 12px; padding-left: 20px;'>
                                Enter Valid Email </div>
                        </div>
                        <div class="form-group mb-5">
                            <button class="btn btn-block btn-primary" type="submit">
                                SUBMIT
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class='forgot-otp-box m-3' style="display:none;">
                    <!-- <h4 class="m-5">Email:</h4><span class="forget_email"></span> -->
                    <h3 class="text-center m-5">Enter Your OTP</h3>
                    <h4 class="text-center m-5">Please check your Email for OTP</h4>

                    <form class="" id='forget_otp_form'>
                        <div class="form-group mb-5">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control otp" id="forgot_otp" placeholder="0 0 0 0 0 0">
                        </div>

                        <div class="form-group mb-5">
                            <button class="btn btn-block btn-primary" type="submit">
                                SUBMIT
                            </button>
                        </div>

                        <p class="mt-5 font-size-sm text-center">
                            Didn't recieve OTP? <a class="text-gray-800" data-bs-toggle="collapse" href="#"
                                id="resendotp" role="button" aria-expanded="false"
                                aria-controls="collapseForgotPassword">Resend OTP</a>
                        </p>
                    </form>
                </div>

                <div class='new_pwd-box m-3' style="display:none">

                    <h3 class="text-center m-5">Change Your Password</h3>
                    <h5 class="m-5">Email : <span class="frgt_email"></span></h5>

                    <form class="" id='new_pwd_form'>

                        <?php $session->set('edit_new_pwd_token', md5(uniqid(mt_rand(), true))); ?>
                        <input type="hidden" id='edit_new_pwd_token' name="edit_newpwd" value="<?=$session->get('edit_new_pwd_token'); ?>">

                        <div class="form-group mb-5">
                            <label for="new_pwd">Enter New Password</label>
                            <input type="password" class="form-control new_pwd" id="new_pwd" placeholder="Enter New Password">

                            <div class="form-group mb-5">
                                <label for="conf_pwd">Confirm Your Password</label>
                                <input type="password" class="form-control conf_pwd" id="conf_pwd" placeholder="Confirm Password">
                                <div class='d-none check_new_pwd' style='font-size: 12px; padding-left: 20px;'>
                                    Password does not match 
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <button class="btn btn-block btn-primary" type="submit">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/footer.php'; ?>