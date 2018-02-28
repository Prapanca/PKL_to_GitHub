<?php
function get_mengumpulkan($semester, $thn){
	$ci =& get_instance();
	$query_all = "SELECT * FROM makalah_ta";
	$q_all = $ci->db->query($query_all);
	
	$query = "SELECT * FROM makalah_ta
				WHERE makalah_ta.thn_ajaran='$thn'
				AND makalah_ta.semester='$semester'";
	$q = $ci->db->query($query);
	$data['total_mengumpulkan'] = $q->num_rows();
	//$data['belum_mengumpulkan'] = ($q_all->num_rows()) - $data['total_mengumpulkan'];
	return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Report Skripsi Mahasiswa</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url();?>resource/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>resource/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>resource/bower_components/morrisjs/morris.css" rel="stylesheet">

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

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url();?>resource/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url();?>resource/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url();?>resource/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>resource/dist/js/sb-admin-2.js"></script>

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
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama;?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<?php if($this->session->userdata('login')=='admin'){ ?>
							<li><a href="<?php echo base_url()."index.php/Admin/profil"?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li><a href="<?php echo base_url()."index.php/TA_Controllers/semester"?>"><i class="fa fa-gear fa-fw"></i> Semester</a>
							</li>
						<?php } ?>
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Report</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-13">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Jumlah Mahasiswa Yang Sudah Mengumpulkan Skripsi Per-Semester
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Semester</th>
                                                    <th>Tahun Ajaran</th>
                                                    <th>Sudah Mengumpulkan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php $i=1;foreach($query->result() as $result){
													$data = get_mengumpulkan($result->semester, $result->thn_ajaran);
													?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $result->semester; ?></td>
                                                    <td><?php echo $result->thn_ajaran; ?></td>
													<?php 
													$tempTahun = str_replace(" ","",$result->thn_ajaran);
													?>
                                                    <td><a href="<?php echo base_url()."index.php/ReportTA_Controllers/mengumpulkan_ta/".$result->semester."/".$tempTahun;?>">
															<?php echo $data['total_mengumpulkan']; ?>
													</td>
                                                </tr>
												<?php $i++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-6">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
