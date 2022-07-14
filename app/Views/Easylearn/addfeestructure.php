<?php
include 'template/login_header.php';

$terms = json_decode(get_settings_name('terms'), true)['data'][0]['value'];

if ($session->get('user')['permissions'] == 'School' || $session->get('user')['permissions'] == 'Jr College') {

    $batches = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], 0), true);

} elseif ($session->get('user')['permissions'] == 'Classroom') {

    $batches = json_decode(get_batches($session->get('user')['permissions'], $session->get('user')['reg_id'], $session->get('classroom_id')), true);

}

?>

<section class="content">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <div class="panel">
                        <div class="text-start p-3">
                            <a href="feeStructure" class="btn btn-info active">
                                <i class="fas fa-backward"></i>&nbsp;&nbsp;Back
                            </a>
                        </div>

                        <div class="text-center">
                            <h3>Add Fee Structure</h3>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-lg-5">
                                <div class="form-group">
                                    <label for="batch">Batches</label>
                                    <select name="" id="batch" class="form-control form-select">
                                        <?php foreach ($batches['data'] as $bat) {?>
                                        <option value="<?=$bat['id']?>"><?=$bat['batch_name']?></option>
                                        <?php }?>
                                    </select>
                                    <div class='d-none btn-danger' style='font-size: 12px; padding-left: 20px;'> Enter
                                        Valid Name </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-5">
                                <div class="form-group">
                                    <label for="term">Terms</label>
                                    <select name="" id="term" class="form-control form-select">
                                        <?php for ($i = 1; $i <= $terms; $i++) {?>
                                        <option value="<?=$i?>">Term <?=$i?></option>
                                        <?php }?>

                                    </select>
                                    <div class='d-none btn-danger' style='font-size: 12px; padding-left: 20px;'> Enter
                                        Valid Name </div>
                                </div>
                            </div>

                        </div>

                        <div class="table-responsive p-3">
                            <label for="add_fee_structure_tbl">Details :</label>
                            <table id="add_fee_structure_tbl" class="table text-center" style="width:100%">
                                <thead>

                                    <tr>
                                        <form id="add_particulars">
                                            <td>#</td>
                                            <td><input type="text" class="form-control" placeholder="Particulars"
                                                    id="particulars">
                                                <div class='d-none btn-danger check_particulars'
                                                    style='font-size: 12px; padding-left: 20px;'> Invalid Particulars
                                                </div>
                                            </td>
                                            <td><input type="number" class="form-control" placeholder="Price"
                                                    id="price">
                                                <div class='d-none btn-danger check_price'
                                                    style='font-size: 12px; padding-left: 20px;'> Invalid Price
                                                </div>
                                            </td>
                                            <td><input type="submit" id="add_btn" class="add-btn btn btn-info btn-md"
                                                    value="Add">
                                            </td>
                                        </form>
                                    </tr>

                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Particulars</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <td colspan="2"><b>Total</b></td>
                                        <td>
                                            <p><span class="total_price"></span> <span>Rs</span></p>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="form-label-group text-center">
                                    <a href="" class="btn btn-rounded btn-info"> <i class="fas fa-times"> Cancel </i>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type='button' class="btn btn-rounded btn-success save_fee_structure"> <i
                                            class="fas fa-save"> Save </i> </button>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include 'template/login_footer.php';?>
<script src="<?=base_url(); ?>/public/Easylearn/js/mis.js?<?=date("Ymd") ?>"></script>
