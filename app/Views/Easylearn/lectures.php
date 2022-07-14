<?php 
    include 'template/login_header.php';  
?>
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

                    <div class='row'>
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div id="schedule_calendar">  
                                                        
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

<?php include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/vendor_components/moment/min/moment.min.js"></script>
<script src="<?=base_url(); ?>/public/Easylearn/vendor_components/fullcalendar/main.min.js"></script>
<script src="<?=base_url(); ?>/public/Easylearn/js/Schedule.js"></script>