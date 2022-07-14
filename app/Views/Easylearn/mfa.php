<?php 
    include 'template/login_header.php';
?>

<section class="content">
    <div class='row d-flex justify-content-center'>
        <div class='col-xl-10'>
            <div class='box'>
                <div class='box-body'>
                    <div class="d-flex align-items-start">
                        <h5 class="modal-title h4" id="myLargeModalLabel"><i class="fas fa-unlock-alt"></i>   2 Factor
                            Authentication (2FA)</h5>
                    </div>

                    <div class="d-flex align-items-start mt-4">
                        <div>To protect your account and money from fraud, we require every member to set up 2FA. This
                            requires the use of a Time-based One Time Password (TOTP).</div>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <div>The TOTP app will provide you with security codes that are required to execute transactions
                            from within the portal. We currently support the following 3 authenticator applications.</div>
                    </div>

                    <div class="d-flex align-items-start mt-3">
                        <div>Visit your App Store and download one of the supported TOTP Apps shown below:</div>
                    </div>

                    <div class="row gx-0 justify-content-center mt-4 d-none d-md-flex">
                        <div class='col-3 text-center'>
                            <img src='<?=base_url(); ?>/public/Easylearn/images/icons/google_authenticator.svg'
                                style='width: 70px; height: 70px;'>
                            <div class='mt-2'>Google Authenticator</div>
                        </div>

                        <div class='col-1 text-center align-self-center'>
                            <div class="divider-container">
                                <hr class="MuiDivider-root MuiDivider-vertical">
                                <hr class="MuiDivider-root MuiDivider-vertical">
                            </div>
                        </div>

                        <div class='col-3 text-center'>
                            <img src='<?=base_url(); ?>/public/Easylearn/images/icons/twilio_authy.svg'
                                style='width: 70px; height: 70px;'>
                            <div class='mt-2'>Twilio Authy</div>
                        </div>

                        <div class='col-1 text-center align-self-center'>
                            <div class="divider-container">
                                <hr class="MuiDivider-root MuiDivider-vertical">
                                <hr class="MuiDivider-root MuiDivider-vertical">
                            </div>
                        </div>

                        <div class='col-3 text-center'>
                            <img src='<?=base_url(); ?>/public/Easylearn/images/icons/microsoft_authenticator.svg'
                                style='width: 70px; height: 70px;'>
                            <div class='mt-2'>Microsoft Authenticator</div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h6 class="mb-4 mt-3 pb-2 border-bottom font-weight-bold"></h6>
                    </div>

                    <div class='row'>
                        <div class='col-xl-4 text-center mb-15'>
                            <div style='position: relative'>
                                <img class='secret_qr' src='' style='width: 200px; height: 200px;'>

                                <img style='background: #fff;position: absolute; width: 50px; height: 50px; top: 0; bottom: 0; left: 0; right: 0; margin: auto;'
                                    src='<?=base_url(); ?>/public/Easylearn/images/fav.png'>
                            </div>

                            <div class='mt-3 secret_key d-none d-md-block'>

                            </div>
                        </div>

                        <div class='col-xl-8 align-self-center'>
                            <div>When a TOTP app has been installed, please scan this QR code with your chosen authenticator
                                app and enter the 6 digit code to confirm the set up is complete.</div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="mfa_code" placeholder="0 0 0 0 0 0">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="waves-effect waves-light btn btn-primary mb-5" id="mfa_button"> Confirm </button>
                                </div>
                            </div>
                        </div>

                        <div class='col-md-12 mt-3'>
                            Note :- If QR Scaning not worked enter code manually
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $.ajax({
        url: 'easylearn/Dashboard_Controller/generate_qr',
        type: 'POST',
        success: function(response) {
            response = JSON.parse(response);

            $('.secret_qr').attr('src', response['url']);
            $('.secret_key').html(response['secret']);
        },
        error: function(response) {
            console.log(response);
        }
    });
</script>

<?php include 'template/login_footer.php'?>