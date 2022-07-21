<?php 
    include 'template/login_header.php'; 
?>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-12">
            <div class='box'>
                <div class='box-body'>
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="text-center text-dark bold">Exam Result List</h4>

                    <div class="table-responsive p-3">
                        <table id="exam_result_list" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Exam Title</th>
                                    <th>Exam Category</th>
                                    <th>Exam Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<section>
    
<script src="<?=base_url(); ?>/public/easylearn/js/exam.js"></script>
<?php include 'template/login_footer.php'; ?>
