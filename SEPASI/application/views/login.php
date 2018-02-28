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

<body style="background-image='url(<?php echo base_url();?>uploads/Background/server-image.jpg)'; 
			height:100%; width:100%;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Masuk</h3>
                    </div>
                    <div class="panel-body">
						<form method="POST" action="<?php echo base_url();?>index.php/Login/authentication" enctype="multipart/form-data">
							<fieldset>
                                <div class="form-group">
									<label>Username</label>
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
									<label>Password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<input type="submit" name="submit" value="Login" class="btn btn-lg btn-primary btn-block">
                            </fieldset>
                        </form>
						<div class="text-center" style="padding-top:15px;">
							<a class="d-block small" href="#">Forgot Password?</a>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
