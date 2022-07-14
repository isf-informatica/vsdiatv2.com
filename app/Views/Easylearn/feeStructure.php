<?php 
	include 'template/login_header.php'; ?>



<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class='row'>
                        <div class='col-6'>
                            <div class="text-start p-3">
                                <a href="dashboard" class="btn btn-info active"><i class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                            </div>
                        </div>

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <a href="addfeestructure" class="btn btn-primary">Add Fee Structure</a>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-center text-dark bold">Fee Structure</h4>
                    <div class="table-responsive p-3">
                        <table id="batch_fee_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Batch Name</th>
                                    <th>Terms</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="view_feestructure" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Fee Structure Details</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <p>Batch Name : <span class="batch_nm"></span></p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p>Term : <span class="term"></span></p>
                    </div>

                </div>
            	<div class="table-responsive p-3">
                    <label for="fee_structure_list">Details :</label>
                    <table id="fee_structure_list" class="table text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Particulars</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="tbody_fee">

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td class="total_price"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
	include 'template/login_footer.php'; ?>
<script src="<?=base_url(); ?>/public/Easylearn/js/mis.js?<?=date("Ymd") ?>"></script>
