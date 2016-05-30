<!DOCTYPE html>
<html lang="en">

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
	
	<style>
		.edit{
			text-align:right;
			padding-right:15%;
		}
		table{
			margin-bottom:20px;
		}
		table td{
			padding-left:5px;
			padding-right:5px;
		}
		.panel-body{
			padding-bottom:0%;
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
                <a class="navbar-brand">SISTEM PENYIMPANAN MAKALAH PKL dan TA</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama;?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $linkKeluar;?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                        <li>
                            <a href="<?php echo base_url()."index.php/Home"?>"><i class="fa fa-clock-o fa-fw"></i> Aktifitas</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tables <span class="fa arrow"></a>
							<ul class="nav nav-second-level">
                                <li class="active">
                                    <a href="<?php echo base_url()."index.php/Tabel_TA"?>">Tabel Makalah TA</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/Tabel_PKL"?>">Tabel Laporan PKL</a>
                                </li>
							</ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Forms <span class="fa arrow"></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url()."index.php/Form_TA"?>">Form TA</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/Form_PKL"?>">Form PKL</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
			<?php foreach ($row as $row){?> 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $row->name;?> </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="edit">
									<ul>
										<a href="<?php echo base_url()."index.php/Form_TA/index/".$nim;?>"
											style="border-right: 1px solid black; padding-right:12px;">Edit</a>
										<a href="#" style="padding-left:7px;">Delete</a>
									</ul>
								</div>
								<!-- /.edit-->
								<div class="foto">
									<img src="" width="112.5px" height="150px" style="float:right; margin-right:10px; margin-bottom:15px;">
								</div>
								<!-- /.foto-->
								<table>
									<tr>
										<td><b> NIM </b></td>
										<td><b> : </b></td>
										<td><?php echo $row->nim;?></td>
									</tr>
									<tr>
										<td><b>Nama</b></td>
										<td><b> : </b></td>
										<td><?php echo $row->name;?></td>
									</tr>
									<tr>
										<td><b>Judul Laporan / Makalah</b></td>
										<td><b> : </b></td>
										<td><?php echo $row->judul;?></td>
									</tr>
									<tr>
										<td><b>Dosen Pembimbing</b></td>
										<td><b> : </b></td>
										<td><?php echo $row->nama_dosen;?></td>
									</tr>
									<tr>
										<td><b>Angkatan</b></td>
										<td><b> : </b></td>
										<td><?php echo $row->angkatan;?></td>
									</tr>
									<tr>
										<td><b>File Yang Terupload</b></td>
										<td><b> : </b></td>
										<td> </td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>
											<li><a href="#">Microsoft Word</a></li>
											<li><a href="#">PDF</a></li>
											<li><a href="#">Microsoft Power Point</a></li>
											<li><a href="#">Source Code</a></li>
										</td>
									</tr>
								</table>
								<!-- /.table-->
								
								<div class="pdf">
									<object width="100%" height="1150px" type="application/pdf" data="Pembahasan UAS RPL.pdf" id="pdf_content">
										<p>Insert your error message here, if the PDF cannot be displayed.</p>
									</object>
								</div>
								<!-- /.pdf-->
							</div>
							<!-- /.panel-body-->
						</div>
						<!-- /.panel panel-default-->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->
			<?php }?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
