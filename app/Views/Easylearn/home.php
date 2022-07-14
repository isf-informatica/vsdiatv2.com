<?php 
include 'template/header.php';
    $aboutus           = json_decode(aboutus_getdata(), true);
    $testimonials      = json_decode(testimonials_getdata(), true);
    $project_documents = json_decode(project_documents_getdata(), true);
    $product_features  = json_decode(product_features_getdata(), true);
    $isf_services      = json_decode(isf_services_getdata(), true);
    $teams             = json_decode(team_getdata(), true);
    $customer_benefits = json_decode(customer_benefits_getdata(), true);
?>

<!-- HERO
    ================================================== -->
<section class="py-4 py-md-13 position-relative bg-white">
    <!-- Cursor position parallax -->
    <div class="position-absolute right-0 left-0 top-0 bottom-0">
        <div class="cs-parallax">
            <div class="cs-parallax-layer" data-depth="0.1">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-01.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.3">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-02.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.2">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-03.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.2">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-04.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.4">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-05.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.3">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-06.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.2">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-07.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.2">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-08.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.4">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-09.svg"
                    alt="Layer">
            </div>
            <div class="cs-parallax-layer" data-depth="0.3">
                <img class="img-fluid" src="<?=base_url(); ?>/public/Easylearn/images/parallax/layer-10.svg"
                    alt="Layer">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center p-5">
            <div class="col-12 col-md-5 col-lg-6 order-md-2" data-aos="fade-in" data-aos-delay="50">
                <!-- Image -->
                <img src="<?=base_url(); ?>/public/Easylearn/images/illustrations/illustration-1.png"
                    class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0" alt="...">
            </div>
            <div class="col-12 col-md-7 col-lg-6 order-md-1 px-md-0">
                <!-- Heading -->
                <h1 class="display-2" data-aos="fade-left" data-aos-duration="150">
                    Learn From <span class="text-orange fw-bold">VSD-IAT</span>
                </h1>

                <!-- Text -->
                <p class="lead pe-md-8 text-capitalize" data-aos="fade-up" data-aos-duration="200">
                    VSD – Intelligent Assessment Technology (VSD-IAT) is expertly built training platform and is suited for designer requirements.                
                </p>

                <!-- Buttons -->
                <a href="<?=$aboutus['data']['demovideo_path']; ?>"
                    class="btn btn-primary btn-wide lift d-none d-lg-inline-block" target='_blank'
                    data-aos-duration="200" data-aos="fade-up">WATCH VIDEO</a>
                <a href="login" class="btn btn-wide btn-slide slide-primary shadow mb-4 mb-md-0 me-md-5" data-aos-duration="200"
                    data-aos="fade-up">LOGIN</a>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<!-- About Us
    ================================================== -->
<section class="pt-5 pb-9 py-md-11">
    <div class="container">
        <div class="row  align-items-center mb-5" data-aos="fade-up">
            <div class="col-md mb-2 mb-md-0">
                <h1 class="mb-1" style='font-weight: bold;'>
                    <?=$aboutus['data']['heading']; ?>
                </h1>

                <div class="message-box" style="font-size: 18px;">
                    <div style="text-align:justify; white-space: pre; white-space: pre-line;">
                        <?=$aboutus['data']['aboutus_description1']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/footer.php'?>