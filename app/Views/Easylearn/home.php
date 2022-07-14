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
                    Learn From <span class="text-orange fw-bold">Easylearn</span>
                </h1>

                <!-- Text -->
                <p class="lead pe-md-8 text-capitalize" data-aos="fade-up" data-aos-duration="200">
                    Technology is bringing a massive wave of evolution on learning things in different ways.
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

            <div class='col-md mb-2 mb-md-0 gridPics'>
                <div class='gridItem tm2'>
                    <img class='gridImg imgborder' src='<?=$aboutus['data']['vision_image']; ?>'>
                    <p>Vision</p>
                    <br>
                    <span class='font-size-10'>
                        <?=$aboutus['data']['vision']; ?>
                    </span>
                </div>
                <br>

                <div class='gridItem tm2'>
                    <img class='gridImg imgborder' src='<?=$aboutus['data']['mission_image']; ?>'>
                    <p>Mission</p>
                    <br>
                    <span class='font-size-10'>
                        <?=$aboutus['data']['mission']; ?>
                    </span>
                </div>

                <div class='gridItem tm2'>
                    <img class='gridImg imgborder' src='<?=$aboutus['data']['values_image']; ?>'>
                    <p>Values</p>
                    <br>
                    <span id='values' class='font-size-10'>
                        <?=$aboutus['data']['value_s']; ?>
                    </span>
                </div>
            </div>

            <div class="col-12">
                <div class="message-box" style="font-size: 18px; padding-top: 40px;">
                    <p style="text-align:justify">
                    <div style="text-align:justify; white-space: pre; white-space: pre-line;">
                        <?=$aboutus['data']['aboutus_description2']; ?>
                    </div>
                    <a style="color:blue;cursor:pointer" data-bs-toggle="modal" data-bs-target="#modalExample">Demo</a>
                    today
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .someClass{
        min-height:100%;
        display:table;
    }

</style>

<!-- TESTIMONIAL
    ================================================== -->
    <section class="pt-5 pt-md-11 pb-9 bg-white">
    <div class="container">
        <div class="text-center mb-2" data-aos="fade-up">
            <h1 class="mb-1">What our Customers have to say</h1>
            <p class="font-size-lg text-capitalize mb-0">Discover your perfect program in our courses.</p>
        </div>

        <div class="mx-n4"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true, "adaptiveHeight": false}'>
            <?php foreach($testimonials['data'] as $testimonial){ ?>
            <div class="col-12 col-md-6 col-xl-4 py-md-7 py-3 someClass" data-aos="fade-up" data-aos-delay="50" style="padding-right:15px;padding-left:15px;">
                <!-- Card -->
                <div class="card border shadow p-2 sk-fade h-100" style="display:table-cell">
                    <!-- Image -->
                    <div class="card-zoom">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-custom me-5">
                                <img src="<?=$testimonial['testimonial_image'] ?>" alt="..."
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="media-body">
                                <h5 class="mb-0"><?=$testimonial['testimonial_name'] ?> </h5>
                                <a href='<?=$testimonial['testimonial_companywebsite'] ?>'>
                                    <?=$testimonial['testimonial_jobrole'] ?> </a>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pb-0">
                        <p class="mb-0 text-capitalize">“ <?=$testimonial['testimonial_description'] ?> “</p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Project Documents
    ================================================== -->
<section class="py-5 py-md-11">
    <div class="container">
        <div class="row align-items-end mb-md-7 mb-4" data-aos="fade-up">
            <div class="col-md mb-4 mb-md-0">
                <h1 class="mb-1">Project Documents</h1>
            </div>
        </div>

        <div class="row d-flex justify-content-center row-cols-2 row-cols-lg-3 row-cols-xl-4">

            <?php foreach($project_documents['data'] as $project_document){ ?>
            <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                <!-- Card -->
                <a href="<?=$project_document['document_link']; ?>" target='_blank'
                    class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                    <!-- Image -->
                    <div class="position-relative text-light">
                        <img style='width: 100%; height: 100%;'
                            src='<?=$project_document['document_image']; ?>'>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pb-0 pt-6">
                        <h5 class="mb-0 line-clamp-1"> <?=$project_document['document_name'] ?> </h5>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Product Features
    ================================================== -->
<section class="pt-5 pb-9 py-md-11 bg-white">
    <div class="container">
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-md mb-2 mb-md-0">
                <h1 class="mb-1">Product Features</h1>
            </div>
        </div>

        <div class="mx-n4"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            <?php foreach($product_features['data'] as $product_feature){ ?>
            <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="100"
                style="padding-right:15px;padding-left:15px;">
                <!-- Card -->
                <div class="card border shadow p-2 sk-fade">
                    <!-- Image -->
                    <div class="card-zoom position-relative">
                        <a href="#" class="card-img sk-thumbnail d-block">
                            <img class="rounded shadow-light-lg"
                                src="<?=$product_feature['feature_image']; ?>" alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                        <!-- Preheading -->
                        <a href="#"><span class="mb-1 d-inline-block text-gray-800"> <?=$product_feature['feature']; ?>
                            </span></a>

                        <!-- Heading -->
                        <div class="position-relative">
                            <a href="#" class="d-block stretched-link">
                                <h6 class="h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-8">
                                    <?=$product_feature['feature_description']; ?>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- ISF Services
    ================================================== -->
<section class="pt-5 pb-9 py-md-11">
    <div class="container">
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-md mb-2 mb-md-0">
                <h1 class="mb-1">ISF Services</h1>
            </div>
        </div>

        <div class="mx-n4"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            <?php foreach($isf_services['data'] as $isf_service){ ?>
            <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7" data-aos="fade-up" data-aos-delay="100"
                style="padding-right:15px;padding-left:15px;">
                <!-- Card -->
                <div class="card border shadow p-2 sk-fade">
                    <!-- Image -->
                    <div class="card-zoom position-relative">
                        <a href="#" class="card-img sk-thumbnail d-block">
                            <img class="rounded shadow-light-lg" src="<?=$isf_service['service_image']; ?>"
                                alt="...">
                        </a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                        <!-- Preheading -->
                        <a href="#"><span class="mb-1 d-inline-block text-gray-800"> <?=$isf_service['service']; ?>
                            </span></a>

                        <!-- Heading -->
                        <div class="position-relative">
                            <a href="#" class="d-block stretched-link">
                                <h6 class="h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-10">
                                    <?=$isf_service['service_description']; ?>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Team
    ================================================== -->
<section class="py-5 py-md-11 bg-white">
    <div class="container">
        <div class="row align-items-end mb-3 mb-md-5" data-aos="fade-up">
            <div class="col-md mb-4 mb-md-0">
                <h1 class="mb-1">Team</h1>
            </div>
        </div>

        <div class="mx-n3 mx-md-n4"
            data-flickity='{"pageDots": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            <?php foreach($teams['data'] as $team){ ?>
            <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                data-aos-delay="50">
                <div class="card border shadow p-2 lift">
                    <!-- Image -->
                    <div class="card-zoom position-relative" style="max-width: 250px;">
                        <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                            <ul class="nav mx-n4 justify-content-center">
                                <li class="nav-item px-4">
                                    <a target='_blank' href="<?=$team['facebook'] ?>" class="d-block text-white">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a target='_blank' href="<?=$team['twitter'] ?>" class="d-block text-white">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a target='_blank' href="<?=$team['instagram'] ?>" class="d-block text-white">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="nav-item px-4">
                                    <a target='_blank' href="<?=$team['linkedin'] ?>" class="d-block text-white">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <a href="#" class="card-img sk-thumbnail img-ratio-4 card-hover-overlay d-block"><img
                                class="rounded shadow-light-lg img-fluid" src="<?=$team['image_path'] ?>"
                                alt="..."></a>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-3 pt-4 pb-1">
                        <a href="#" class="d-block">
                            <h5 class="mb-0"> <?=$team['name'] ?> </h5>
                        </a>
                        <span class="font-size-d-sm"> <?=$team['job_role'] ?> </span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Customer Benefits
    ================================================== -->
    <section class="pt-5 pb-9 py-md-11">
    <div class="container">
        <div class="row align-items-center mb-5" data-aos="fade-up">
            <div class="col-md mb-2 mb-md-0">
                <h1 class="mb-1">Customer Benefits</h1>
            </div>
        </div>

        <div class="mx-n4"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            <?php foreach($customer_benefits['data'] as $customer_benefit){ ?>
            <div class="col-12 col-md-6 col-xl-4 pb-4 pb-md-7 someClass" data-aos="fade-up" data-aos-delay="100"
                style="padding-right:15px;padding-left:15px;">
                <!-- Card -->
                <div class="card border shadow p-2 sk-fade h-100" style="display:table-cell">
                    <!-- Footer -->
                    <div class="card-footer px-2 pb-2 mb-1 pt-4 position-relative">
                        <!-- Preheading -->
                        <a href="#"><span class="mb-1 d-inline-block text-gray-800"> <?=$customer_benefit['benefit']; ?>
                            </span></a>

                        <!-- Heading -->
                        <div class="position-relative">
                            <a href="#" class="d-block stretched-link">
                                <h6 class="h-md-48 h-lg-58 me-md-6 me-lg-10 me-xl-4 mb-15">
                                    <?=$customer_benefit['benefit_description']; ?>
                                </h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Pricing
    ================================================== -->
<section class="py-5 py-md-11">
    <div class="container">
        <div class="row align-items-end mb-md-7 mb-4" data-aos="fade-up">
            <div class="col-md mb-4 mb-md-0">
                <h1 class="mb-1">Pricing</h1>
            </div>
        </div>

        <div class="row d-flex justify-content-center row-cols-2 row-cols-lg-3 row-cols-xl-4">
            <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                <!-- Card -->
                <a href="individualpricing" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                    <!-- Image -->
                    <div class="position-relative text-light">
                        <img style='width: 100%; height: 100%;'
                            src='<?=base_url().'/public/Easylearn/images/individualpricing.jpeg' ?>'>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pb-0 pt-6">
                        <h5 class="mb-0 line-clamp-1"> Individual </h5>
                    </div>
                </a>
            </div>

            <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                <!-- Card -->
                <a href="grouppricing" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                    <!-- Image -->
                    <div class="position-relative text-light">
                        <img style='width: 100%; height: 100%;'
                            src='<?=base_url().'/public/Easylearn/images/grouppricing.jpeg' ?>'>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pb-0 pt-6">
                        <h5 class="mb-0 line-clamp-1"> Group </h5>
                    </div>
                </a>
            </div>

            <div class="col mb-md-6 mb-4 px-2 px-md-4" data-aos="fade-up" data-aos-delay="50">
                <!-- Card -->
                <a href="universitypricing" class="card icon-category border shadow-dark p-md-5 p-3 text-center lift">
                    <!-- Image -->
                    <div class="position-relative text-light">
                        <img style='width: 100%; height: 100%;'
                            src='<?=base_url().'/public/Easylearn/images/universitypricing.jpeg' ?>'>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer px-0 pb-0 pt-6">
                        <h5 class="mb-0 line-clamp-1"> University </h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include 'template/footer.php'?>