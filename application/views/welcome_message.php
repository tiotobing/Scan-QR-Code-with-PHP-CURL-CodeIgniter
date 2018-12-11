<!DOCTYPE html>
<html>
<head>
    <title>Scan Code QR</title>
</head>
<script src="http://code.jquery.com/jquery-2.2.1.min.js">
</script>

<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css');?>" type="text/css">
<style type="text/css">
    .center {
        position: absolute;
        margin-top: -100px;
        margin-left: -200px;
        left: 50%;
        top: 50%;
        width: 400px;
        height: 220px;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }

    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font: 14px arial;
    }
</style>
<script>
    $(document).ready(function() {
        $(".preloader").fadeOut();
    })
</script>

<body>

    <div class="preloader">
        <div class="loading">
            <img src="<?php echo base_url('assets/images/wait.gif'); ?>" width="70px">
        </div>
    </div>
    <center><br><br><br><br>
        <img src="assets/images/code.gif">
    </center>
    <div align="center" class="center">
        <p align="center">
            <h1>Scan Code QR</h1>
            <hr>
            <font face="verdana" size="4" color="black">

                <form method="GET" id="frmSubmit">
                    <input type="text" name="scan" autofocus="autofocus" class="form-control" style="width:380px"><br>
                    <!-- <input type="submit" name="submit" id="buttonSubmit" value="Submit"> -->
                    <button type="button" id="buttonSubmit" name="button">Submit</button>
                </form>
                <hr>
                <a href="<?php echo site_url('scan/');?>" class="btn btn-primary" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i>List Data</a>
    </div>

    </div>
    </font>
    </div>
    <script>
        $(document).ready(function() {
            $("#buttonSubmit").click(function() {
                $("#buttonSubmit").prop('disabled', true);
                $(".preloader").fadeIn();
                $('#frmSubmit').submit();
            });
        })
    </script>
</body>

</html>