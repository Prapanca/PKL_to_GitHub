<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mengelola Profil</title>

	<!-- CSS Tambahan / Input NIM -->
    <link href="<?php echo base_url();?>resource/jquery-ui-1.11.4/jquery-ui.min.css" rel="stylesheet">
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>resource/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>resource/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <!-- jQuery -->
    <script src="<?php echo base_url();?>resource/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>
	
	<!-- jquery Tambahan / Input NIM -->
    <script src="<?php echo base_url();?>resource/jquery-ui-1.11.4/jquery-ui.min.js"></script>
	
	<style>
		.button{
			background-color:gray;
			color:white;
		}
		.button:hover{
			background-color:white;
			color:black;
		}
		img{
			width:80px;
			height:100px;
			float:right;
			margin-right:15%;
		}
	</style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">SISTEM PENGELOLAAN SKRIPSI</a>
            </div>
            <!-- /.navbar-header -->
			
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i>Semester <b><?php echo $status_smt; ?></b>
										<b><?php echo $thn_ajaran; ?></b>
							</i> |
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama;?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url()."index.php/Admin/profil_admin"?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url()."index.php/TA_Controllers/semester"?>"><i class="fa fa-gear fa-fw"></i> Semester</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $linkKeluar;?>"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<?php if($this->session->userdata('login')=='kajur'){ ?>
						<li>
                            <a href="<?php echo base_url()."index.php/Aktifitas"?>"><i class="fa fa-clock-o fa-fw"></i> Aktifitas</a>
                        </li>
						<?php } ?>
                        <li>
                            <a href="#" ><i class="fa fa-table fa-fw"></i> Tables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="hidden" >
                                    <a href="<?php echo base_url()."index.php/PKL_Controllers/tabel_pkl"?>">Tabel Laporan PKL</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/TA_Controllers/tabel_ta"?>">Tabel Skripsi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php if($this->session->userdata('login')=='admin'){ ?>
                        <li>
                            <a href="#" ><i class="fa fa-edit fa-fw"></i> Forms <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="hidden" >
                                    <a href="<?php echo base_url()."index.php/PKL_Controllers/form_pkl"?>">Form PKL</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/TA_Controllers/form_ta"?>">Form Skripsi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php } ?>
						<?php if($this->session->userdata('login')=='kajur'){ ?>
						<li>
                            <a href="<?php echo base_url()."index.php/ReportTA_Controllers/report_ta"?>"><i class="fa fa-dashboard fa-fw"></i> Report</a>
                        </li>
						<?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
                <div class="col-lg-12">
                    <h1 class="page-header"> Profil Admin dan Ketua Departemen</h1>
                </div>
                <!-- /.col-lg-12 -->
				<div class="col-lg-10">
					<div class="panel panel-default">
						<div class="panel-heading">
							<p style="font-size:28px">Form Data Admin</p>
						</div>
						<div class="panel-body">
							<div class="foto">
								<?php 
								if ($data[1]->foto == ''){
								?>
										<img src="<?php echo base_url("resource/foto_profil/Foto_Profil.jpg");?>">
								<?php
									} else{
								?>
										<img src="<?php echo base_url().'/uploads/'.$data[1]->status.'/'.$data[1]->foto;?>">
								<?php
									}
								?>
							</div>
							<div class="form-group">
								<label>NAMA LENGKAP :</label>
							</div>
							<div class="form-group">
								<span style="padding-left: 30px;"><?php echo $data[1]->name;?></span>
							</div>
							<div class="form-group">
								<label>NIP :</label>
							</div>
							<div class="form-group">
								<span style="padding-left: 30px;"> <?php echo $data[1]->nip;?></span>
							</div>
							
							<div style="text-align:right;">
								<a href="<?php echo base_url("index.php/Admin/profil/2");?>">
									<button class="btn btn-primary"> Edit </button>
								</a>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<div class="col-lg-10">
					<div class="panel panel-default">
						<div class="panel-heading">
							<p style="font-size:28px">Form Data Ketua Departemen</p>
						</div>
						<div class="panel-body">
							<div class="foto">
								<?php 
								if ($data[0]->foto == ''){
								?>
										<img src="<?php echo base_url("resource/foto_profil/Foto_Profil.jpg");?>">
								<?php
									} else{
								?>
										<img src="<?php echo base_url()."/uploads/".$data[0]->id_admin."/".$data[0]->foto;?>">	
								<?php
									}
								?>
							</div>
							<div class="form-group">
								<label>NAMA LENGKAP :</label>
							</div>
							<div class="form-group">
								<span style="padding-left: 30px;"> <?php echo $data[0]->name;?></span>
							</div>
							<div class="form-group">
								<label>NIP :</label>
							</div>
							<div class="form-group">
								<span style="padding-left: 30px;"><?php echo $data[0]->nip;?></span>
							</div>
							<div style="text-align:right;">
								<a href="<?php echo base_url("index.php/Admin/profil/1");?>">
									<button class="btn btn-primary"> Edit </button>
								</a>
							</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
