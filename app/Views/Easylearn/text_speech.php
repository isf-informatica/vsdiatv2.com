<?php 
    include 'template/login_header.php';
?>

<style>
    .audio_record-icon
    {
        font-size: 30px;
        cursor: pointer;
        padding: 1px;
    }

    .audio_record-icon.active
    {
        color : #228B22;
    }

    #play_button
    {
        font-size: 25px;
    }

    label {
        font-weight: bold;
    }
</style>

<section>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">

                <div class="panel pb-25">
                    <div class="text-start p-3">
                        <a href="dashboard" class="btn btn-info active"><i
                                class="fas fa-backward"></i>&nbsp;&nbsp;Back</a>
                    </div>
                    <div class="text-center">
                        <h3>Text & Speech</h3>
                    </div>

                    <ul class="nav nav-tabs customtab2 d-flex justify-content-center" role="tablist">
                        <li class="nav-item mt-20">
                            <a class="nav-link active" style='border:1px solid black;border-radius: 20px;'
                                data-toggle="tab" href="#first-stage" role="tab">
                                <i class="fas fa-text"></i> &nbsp; <i class="fas fa-long-arrow-alt-right"></i> &nbsp; <i class="fas fa-microphone"></i> &nbsp; Text to Speech </span>
                            </a>
                        </li>
                        &emsp;
                        <li class="nav-item mt-20">
                            <a class="nav-link" style='border:1px solid black; border-radius: 20px;' data-toggle="tab"
                                href="#final-stage" role="tab">
                                <i class="fas fa-microphone"></i> &nbsp; <i class="fas fa-long-arrow-alt-right"></i> &nbsp; <i class="fas fa-text"></i> &nbsp; Speech to Text </span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="first-stage" role="tabpanel">
                            <div class="row justify-content-center mt-25">
                                <div class="col-md-11">
                                    <div class="form-label-group">
                                        <label> Enter Text</label>
                                        <textarea type="text" rows="4" class="form-control form-control-flush" id="text_speech_textarea" placeholder="Enter text to convert into speech"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-20 text-center">
                                    <div class="form-group">
                                        <audio controls='controls' id='text_speech_audio' autoplay> <source src=''> </audio>
                                    </div>
                                </div>

                                <div class="col-md-3 mt-10">
                                    <div class="form-label-group">
                                        <button type="button" id='text_to_speech' class="form-control form-control-flush btn btn-primary">Convert</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="final-stage" role="tabpanel">
                            <div class="row d-flex justify-content-center mt-25">
                                <div class="col-lg-5 align-self-center p-5 m-10" style='border: 1px solid #696e76;'>
                                    <div class='row justify-content-center'>
                                        <div class='col-2 text-center align-self-center'>
                                            <label for="audio_record-icon" class="player-icon audio_record-icon">
                                                <i class="fas fa-microphone"></i>
                                            </label>
                                        </div>

                                        <div class='col-4 text-center align-self-center'>
                                            <div class="current-time" id="current_time">00:00:00</div>
                                        </div>

                                        <div class='col-2 text-center align-self-center'>
                                            <a href="#" class="player-icon play" id="play_button"><i class="fas fa-play"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class='col-lg-1'></div>

                                <div class="col-lg-5 align-self-center m-10" style='padding: 18px; border: 1px solid #696e76;'>
                                    <input  type="file" id="choose_audio"  accept="audio/*"/>
                                </div>

                                <div class="col-lg-3 mt-40">
                                    <div class="form-label-group">
                                        <button type="button" id='speech_to_text' class="form-control form-control-flush btn btn-primary">Convert</button>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-20">
                                    <div class="form-label-group m-20">
                                        <textarea type="text" rows="4" class="form-control form-control-flush" id="speech_text_textarea" placeholder="converted Text from speech" disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-center mt-20 mb-20">
                                    <b class='confidence'> </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/login_footer.php';?>

<script src="<?=base_url(); ?>/public/Easylearn/js/Classroom.js?<?=date("Ymd") ?>"></script>