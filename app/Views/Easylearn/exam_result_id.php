<?php 
    include 'template/login_header.php'; 

    $exam = json_decode(exam_detail_id($_GET['id']), true)['data'];
?>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="Exam_result" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Exam Result List</h4>

                    <div class="row justify-content-center m-20">
                        <div class="col-xl-8 mx-xl-auto">
                            <div class="d-flex flex-wrap align-items-center justify-content-center mb-5 mb-md-3">
                                <div id="graph">
                                </div>
                            </div>

                            <h1 class="text-center mb-10"> <?=$exam['exam_title']; ?> </h1>
                            <div class="text-center mb-30"> <?=$exam['course_name']; ?> </div>

                            <div class="row mb-30 justify-content-center align-items-center">
                                <div class="col-12 col-md-auto mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 d-flex">
                                            <i class="fas fa-users" style='font-size: 20px;'></i>
                                        </div> &nbsp;&nbsp;&nbsp;
                                        <div class="total_response"> Total Response </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-auto mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 d-flex">
                                            <i class="fas fa-check" style='font-size: 20px;'></i>
                                        </div> &nbsp;&nbsp;&nbsp;
                                        <div class="average_right_marks"> Average Right Marks </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-auto mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 d-flex">
                                            <i class="fas fa-times" style='font-size: 20px;'></i>
                                        </div> &nbsp;&nbsp;&nbsp;
                                        <div class="average_wrong_marks"> Average Wrong Marks </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive p-3">
                        <table id="exam_result_list" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Student Name</th>
                                    <th>Total Marks</th>
                                    <th>Obtained Marks</th>
                                    <th>Submition Date</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url(); ?>/public/easylearn/js/exam.js"></script>
<?php include 'template/login_footer.php'; ?>