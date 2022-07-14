<?php 
    $session = \Config\Services::session();
    $meet = $_GET['id'];
?>

<html itemscope itemtype="http://schema.org/Product" prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src='https://meet.jit.si/external_api.js'></script>
        <script src="https://www.isfvideoconferences.com/external_api.js"> </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <script>
            const domain = "isfvideoconferences.com";

            const options = {
                roomName: "<?php echo $meet; ?>",
                subject: "Lecture",
                user : "<?=$session->get('user')['username'];?>",
                parentNode: undefined,
                configOverwrite: {},
                interfaceConfigOverwrite: {
                    filmStripOnly: false
                }
            }

            const api = new JitsiMeetExternalAPI(domain, options);
        </script>
    </body>
</html>

<script>
    //Record Schedule Attendance
    setInterval( function() {
        var unique_id  = (location.search.split(name + '=')[1] || '').split('&')[0];

        $.ajax({
            url: 'Easylearn/Classroom_Controller/record_schedule_attendance',
            type: 'POST',
            data: {
                'unique_id' : unique_id
            },
            success: function (response) 
            {

            },
            error: function (response) 
            {
                console.log(response);
            }
        });
    }, 60000);
</script>
