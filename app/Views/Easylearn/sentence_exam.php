<?php 
    include 'template/login_header.php';
?>

<style>
.btn-blue-soft {
    background-color: rgba(25, 110, 205, 0.1);
    color: #196ecd;
}

.bg-orange-40 {
    background-color: rgba(255, 199, 139, 0.4);
}

.btn-slide {
    background-size: 200% 100% !important;
    background-position: right bottom !important;
    -webkit-transition: all 0.5s ease;
    transition: all 0.5s ease;
    -webkit-transition-property: inherit !important;
    transition-property: inherit !important;
}

.slide-primary {
    background: -webkit-gradient(linear, right top, left top, color-stop(50%, transparent), color-stop(50%, #090761));
    background: linear-gradient(to left, transparent 50%, #090761 50%);
    border: 1px solid #090761;
    border-left: 6px solid #090761;
    color: #090761;
}

.btn-slide:focus,
.btn-slide:hover {
    background-position: left bottom !important;
}

.slide-primary:focus,
.slide-primary:hover {
    color: #fff !important;
}

.p-2 {
    padding: 0.5rem !important;
}

.py-4 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.px-5 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}

.me-auto {
    margin-right: auto !important;
}

.d-flex {
    display: flex !important;
}

.font-size-sm {
    font-size: 0.875rem !important;
}

.fw-normal {
    font-weight: 400 !important;
}

.me-5 {
    margin-right: 1.5rem !important;
}

dl,
ol,
ul {
    margin-top: 0;
    margin-bottom: 1rem;
}

.ms-4 {
    margin-left: 1rem !important;
}

.dark-skin .slide-primary {
    background: -webkit-gradient(linear, right top, left top, color-stop(50%, transparent), color-stop(50%, #0052CC));
    background: linear-gradient(to left, transparent 50%, #0052CC 50%);
    border: 1px solid #0052CC;
    border-left: 6px solid #0052CC;
    color: #fff;
}
</style>

<section class="content">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">

                <div class="box">
                    <div class="box-body">
                        <div class='row'>
                            <div class='col-6'>
                                <div class="text-start p-3">
                                    <a href="dashboard" class="btn btn-info active"><i
                                            class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-center text-dark bold">Sentence Exam List</h4>

                        <div class="container mb-3 overflow-auto">
                            <div class="row exam_list_holder">
                                <div class="col-md-12 d-none exam_list">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                            <div class="text-secondary d-flex">
                                                <svg width="14" height="18" viewBox="0 0 14 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.5717 0H4.16956C4.05379 0.00594643 3.94322 0.0496071 3.85456 0.124286L0.413131 3.57857C0.328167 3.65957 0.280113 3.77191 0.280274 3.88929V16.8514C0.281452 17.4853 0.794988 17.9988 1.42885 18H12.5717C13.1981 17.9989 13.7086 17.497 13.7203 16.8707V1.14857C13.7191 0.514714 13.2056 0.00117857 12.5717 0ZM8.18099 0.857143H10.6988V4.87714L9.80527 3.45214C9.76906 3.39182 9.71859 3.3413 9.65827 3.30514C9.45529 3.18337 9.19204 3.24916 9.07027 3.45214L8.18099 4.87071V0.857143ZM3.7367 1.46786V2.66143C3.73552 3.10002 3.38029 3.45525 2.9417 3.45643H1.74813L3.7367 1.46786ZM12.8546 16.86C12.8534 17.0157 12.7274 17.1417 12.5717 17.1429H1.42885C1.42665 17.1429 1.42445 17.143 1.42226 17.143C1.26486 17.1441 1.13635 17.0174 1.13527 16.86V4.32214H2.9417C3.85793 4.31979 4.60006 3.57766 4.60242 2.66143V0.857143H7.31527V5.23286C7.31345 5.42593 7.37688 5.61391 7.49527 5.76643C7.67533 5.99539 7.98036 6.08561 8.25599 5.99143L8.28813 5.98071C8.49272 5.89484 8.66356 5.7443 8.77456 5.55214L9.44099 4.48071L10.1074 5.55214C10.2184 5.7443 10.3893 5.89484 10.5938 5.98071C10.8764 6.0922 11.1987 6.00509 11.3867 5.76643C11.5051 5.61391 11.5685 5.42593 11.5667 5.23286V0.857143H12.5717C12.7266 0.858268 12.8523 0.982982 12.8546 1.13786V16.86Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.7761 14.3143H3.22252C2.98584 14.3143 2.79395 14.5062 2.79395 14.7429C2.79395 14.9796 2.98584 15.1715 3.22252 15.1715H10.7761C11.0128 15.1715 11.2047 14.9796 11.2047 14.7429C11.2047 14.5062 11.0128 14.3143 10.7761 14.3143Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.7761 12.2035H3.22252C2.98584 12.2035 2.79395 12.3954 2.79395 12.6321C2.79395 12.8687 2.98584 13.0606 3.22252 13.0606H10.7761C11.0128 13.0606 11.2047 12.8687 11.2047 12.6321C11.2047 12.3954 11.0128 12.2035 10.7761 12.2035Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.7761 10.0928H3.22252C2.98584 10.0928 2.79395 10.2847 2.79395 10.5213C2.79395 10.758 2.98584 10.9499 3.22252 10.9499H10.7761C11.0128 10.9499 11.2047 10.758 11.2047 10.5213C11.2047 10.2847 11.0128 10.0928 10.7761 10.0928Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M10.7761 7.98218H3.22252C2.98584 7.98218 2.79395 8.17407 2.79395 8.41075C2.79395 8.64743 2.98584 8.83932 3.22252 8.83932H10.7761C11.0128 8.83932 11.2047 8.64743 11.2047 8.41075C11.2047 8.17407 11.0128 7.98218 10.7761 7.98218Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </div>

                                            <div class="ms-4">
                                                Introduction to the course
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center overflow-md-visible flex-shrink-all">
                                            <div
                                                class="badge text-dark-70 bg-orange-40 me-5 font-size-sm fw-normal py-2">
                                                3
                                                question</div>
                                            <div class="badge btn-blue-soft me-5 font-size-sm fw-normal py-2">30 min
                                            </div>
                                            <a href="Ielts_reading_exams" target='_blank'
                                                class="badge p-2 btn btn-slide slide-primary shadow"
                                                style='font-size: 16px;' data-aos-duration="200" data-aos="fade-up"><b>
                                                    Start Test </b>
                                                <!-- Icon -->
                                                <svg width="14" height="16" viewBox="0 0 14 16"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.8704 6.15374L3.42038 0.328572C2.73669 -0.0923355 1.9101 -0.109836 1.20919 0.281759C0.508282 0.673291 0.0898438 1.38645 0.0898438 2.18929V13.7866C0.0898438 15.0005 1.06797 15.9934 2.27016 16C2.27344 16 2.27672 16 2.27994 16C2.65563 16 3.04713 15.8822 3.41279 15.6591C3.70694 15.4796 3.79991 15.0957 3.62044 14.8016C3.44098 14.5074 3.05697 14.4144 2.76291 14.5939C2.59188 14.6982 2.42485 14.7522 2.27688 14.7522C1.82328 14.7497 1.33763 14.3611 1.33763 13.7866V2.18933C1.33763 1.84492 1.51713 1.53907 1.81775 1.3711C2.11841 1.20314 2.47294 1.21064 2.76585 1.39098L12.2159 7.21615C12.4999 7.39102 12.6625 7.68262 12.6618 8.01618C12.6611 8.34971 12.4974 8.64065 12.2118 8.81493L5.37935 12.9983C5.08548 13.1783 4.9931 13.5623 5.17304 13.8562C5.35295 14.1501 5.73704 14.2424 6.03092 14.0625L12.8625 9.87962C13.5166 9.48059 13.9081 8.78496 13.9096 8.01868C13.9112 7.25249 13.5226 6.55524 12.8704 6.15374Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script src="<?=base_url(); ?>/public/easylearn/js/student_exam.js"></script>

<?php 
    include 'template/login_footer.php';
?>