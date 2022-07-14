<?php include 'template/login_header.php'; ?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">   
                                <a href="dashboard" class="btn btn-info active" ><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Attendance List</h4>
                    <div class="table-responsive p-3">
                        <table id="attendance_list" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Schedule Name</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Total Students</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js?<?=date("Ymd") ?>"></script>
<?php include 'template/login_footer.php'; ?>