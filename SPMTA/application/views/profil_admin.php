<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Form Makalah TA</title>

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
	</style>
	<script type="text/JavaScript">
	$(document).ready(function(){
		$.ajax({
			url:'get_all_nim/',
			data:{},
			success:function(data){
				$("#nim").autocomplete({
					source: data,
					autoFocus:true
				})
			}
		})		
		$("#nim").bind('focusout keydown change', function(){
			var nim = $(this).val();
			$.ajax({
				url:'get_mahasiswa_ta/'+nim,
				data:{},
				success:function(data){
					$("#name").val(data['name']);
					$("#angkatan").val(data['angkatan']);
				}
			})
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
                <a class="navbar-brand">SISTEM PENYIMPANAN MAKALAH TUGAS AKHIR</a>
            </div>
            <!-- /.navbar-header -->
			
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i>Smester <b><?php echo $status_smt; ?></b>
										<b><?php echo $thn_ajaran; ?></b>
							</i> |
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama;?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url()."index.php/TA_Controllers/semester"?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                                    <a href="<?php echo base_url()."index.php/TA_Controllers/tabel_ta"?>">Tabel Makalah TA</a>
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
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
                <div class="col-lg-12">
                    <h1 class="page-header"> Profil <?php if($status=='kajur') echo 'Ketua Jurusan'; else if($status=='admin') echo 'Admin'; ?> </h1>
                </div>
                <!-- /.col-lg-12 -->
					<form method="POST" action="<?php echo base_url();?>index.php/Admin/simpan_profil" enctype="multipart/form-data">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<p style="font-size:20px"> </p>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label>NAMA LENGKAP</label>
										<input class="form-control" type="text" name="name" value="<?php echo $row['name'];?>" placeholder="Masukkan Nama Lengkap Dosen">
									</div>
									<div class="form-group">
										<label>NIP</label>
										<input class="form-control" type="number" name="nip" value="<?php echo $row['nip'];?>">
									</div>
									<div class="form-group">
										<label>Username</label>
										<input class="form-control" type="text" name="username" value="<?php echo $row['username'];?>">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input class="form-control" type="text" name="password">
									</div>
									<table>
										<tr>
											<td>
												<label>Status</label>
											</td>
											<td>
												<label> : </label>
											</td>
											<td>
												<span>   <?php echo $row['status'];?></span>
											</td>
										</tr>
									</table>
								</div>
								<!-- /.panel-body -->
							</div>
							<!-- /.panel -->
						</div>
						<!-- /.col-lg-6 -->
						<div style="text-align:center;" class="panel-body col-lg-12">
								<button type="submit" name="submit" class="btn btn-default button">Submit Button</button>
								<button type="reset" class="btn btn-default button">Reset Button</button>
						</div>
					</form>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
