<!DOCTYPE html>
<html style="height:100%;" lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>resource/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>resource/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	
    <!-- jQuery -->
    <script src="<?php echo base_url();?>resource/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>

</head>

<body style="background-image:url('http://sikta.if.undip.ac.id/resources/mystyle/image/abstract/abstractsdark6.jpg');
			height:100%; width:100%; background-repeat: no-repeat; background-position: center;
            background-size: cover;">
    <div style="background-color: rgba(0,0,0,0.4); background-repeat: no-repeat; position: fixed; 
            top: 0; bottom: 0; right: 0; left: 0;">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top: 40%;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Hapus Password</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading text-center">
                            <b style="font-size: 25px;">Lupa Password ?</b>
                            <p style="font-size: 15px;">Silahkan masukkan alamat email yang terdaftar, dan kami akan mengirim instruksi untuk merubah password anda.</p>
                        </div>
						<form method="POST" action="<?php echo base_url();?>index.php/Login/lupaPassword" enctype="multipart/form-data">
							<fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Masukkan alamat email" name="email" type="email" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<input type="submit" name="submit" value="Hapus Password" class="btn btn-lg btn-primary btn-block">
                            </fieldset>
                        </form>
						<div class="text-center" style="padding-top:15px;">
							<a class="d-block small" href="<?php echo base_url()."index.php/Login/index"?>"> Halaman Masuk </a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
