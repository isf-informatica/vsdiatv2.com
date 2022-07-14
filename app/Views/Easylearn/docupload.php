<?php include 'template/login_header.php'?>

<section class="content">
    <div class="row d-flex justify-content-center" >
        <div class="col-md-10">
            <div class="box">
                <div class="box-body">
                    <div class="text-center h4">
                        Hi <?=$session->get('user')['username']; ?>! 
                    </div>
                    <hr>

                    <p class="text-md">
                        Upload your verified documents to continue working with our system <br>Note: file must be PDF/JPEG.
                    </p>
                    
                    <form id='docuploadform' class="mt-3">
                        <div class="form-group">
                            <div class="row">
                                <div class='col-lg-6'>
                                    <div class="mb-3">
                                        <label for="unifile" class="form-label">University Affiliation Certificate</label>
                                        <input class="form-control" name="unifile" accept="application/pdf" type="file" id="unifile" >
                                    </div>
                                </div>

                                <div class='col-lg-6'>
                                    <div class="mb-3">
                                        <label for="principlefile" class="form-label">Principal's Letter</label>
                                        <input class="form-control" name="principlefile" accept="application/pdf" type="file" id="principlefile" >
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class='col-12 text-center mt-3'>
                                    <button type="button" class="btn btn-secondary btn-sm logout">Logout</button>
                                    <button type="button" class="btn btn-primary btn-sm docupload">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'template/login_footer.php'?>