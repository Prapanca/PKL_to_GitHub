<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aktifitas</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

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

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>resource/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
				"order": [[ 0, "desc" ],[ 1, "desc" ]]
        });
    });
    </script>

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
						<?php if($this->session->userdata('login')=='admin'){ ?>
							<li><a href="<?php echo base_url()."index.php/Admin/profil_admin"?>"> <i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li><a href="<?php echo base_url()."index.php/TA_Controllers/semester"?>"><i class="fa fa-gear fa-fw"></i> Semester</a>
							</li>
						<?php } ?>
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
                        <li>
                            <a href="#" ><i class="fa fa-table fa-fw"></i> Tables<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li class="hidden">
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
                                <li>
                                    <a href="<?php echo base_url()."index.php/PKL_Controllers/form_pkl"?>">Form PKL</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/TA_Controllers/form_ta"?>">Form TA</a>
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
						<?php if($this->session->userdata('login')=='kajur'){ ?>
						<li>
                            <a href="<?php echo base_url()."index.php/Aktifitas"?>"><i class="fa fa-clock-o fa-fw"></i> Aktifitas</a>
                        </li>
						<?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			<?php if($this->session->userdata('login')=='kajur'){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Aktifitas</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Aktifitas Sistem Pengelolaan Skripsi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Aktifitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach ($row as $row){?>
                                        <tr>
                                            <td><?php echo date("d-M-Y", strtotime($row->waktu));?></td>
                                            <td><?php echo date("h:i:sa", strtotime($row->waktu));?></td>
                                            <td><?php echo $row->id_admin;?></td>
                                            <td><?php echo $row->aksi.$row->nim; ?></td>
                                        </tr>
									<?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php } ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>