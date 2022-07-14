<?php include 'template/login_header.php';?>

<section class="content">
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

                        <div class='col-6'>
                            <div style='text-align: right' class='p-3'>
                                <button class="btn btn-primary" id="add_news_btn">Add News</button>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center text-dark bold">News</h3>
                    <div class="table-responsive p-3">
                        <table id="news_list" class="table text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Image</th>
                                    <th>Topic</th>
                                    <th>News</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade none-border add-category" id="add_news_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add News</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="add_news_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('news_token', md5(uniqid(mt_rand(), true)));?>
                        <input type="hidden" id='news_token' name="news_token"
                            value="<?=$session->get('news_token');?>">

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="topic">Topic :</label>
                                <input type="text" class="form-control form-control-flush" id="topic"
                                    placeholder="Topic">
                                <div class='d-none bg-danger check-news_name'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="news_img">Image :</label>
                                <input type="file" class="form-control form-control-flush" id="news_img"
                                    accept="image/*">
                                <div class='d-none bg-danger check-news_img'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="news_text">News :</label>
                                <textarea class="form-control" id="news_text" rows="4" maxlength="255"
                                    placeholder="News" style="height: 80px;resize: none;"></textarea>
                                <div class="d-none bg-danger check-news_text"
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="start_date">Start Date :</label>
                                <input type="text" class="form-control form-control-flush" id="start_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-start_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="end_date">End Date :</label>
                                <input type="text" class="form-control form-control-flush" id="end_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-end_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn btn-primary add_news" id="add_news">Add
                                News</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade none-border add-category show" id="edit_news_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Add News</strong></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="p-t10" id="edit_news_form">
                    <div class="row justify-content-center m-20">

                        <?php $session->set('edit_news_token', md5(uniqid(mt_rand(), true)));?>
                        <input type="hidden" id='edit_news_token' name="edit_news_token"
                            value="<?=$session->get('edit_news_token');?>">

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_topic">Topic :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_topic"
                                    placeholder="Topic">
                                <div class='d-none bg-danger check-edit_topic'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_news_img">Image :</label>
                                <input type="file" class="form-control form-control-flush" id="edit_news_img"
                                    accept="image/*">
                                <div class='d-none bg-danger check-edit_news_img'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-label-group">
                                <label for="edit_news_text">News :</label>
                                <textarea class="form-control" id="edit_news_text" rows="4" maxlength="255"
                                    placeholder="News" style="height: 80px;resize: none;"></textarea>
                                <div class="d-none bg-danger check-edit_news_text"
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_start_date">Start Date :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_start_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-edit_start_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-label-group">
                                <label for="edit_end_date">End Date :</label>
                                <input type="text" class="form-control form-control-flush" id="edit_end_date"
                                    data-provide="datepicker" autocomplete="off" placeholder="dd-mm-yyyy">
                                <div class='d-none bg-danger check-edit_end_date'
                                    style='font-size: 12px; padding-left: 20px;'>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">

                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn btn-primary edit_news" id="edit_news">Edit</button>
                            <button type="button" class="btn del_btn"
                                style="background-color:red;color:white">Delete</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php';?>
<script src="<?=base_url();?>/public/Easylearn/js/media.js?<?=date("Ymd")?>"></script>