<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Data Skripsi Mahasiswa</title>

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
	
	<script>
	<?php
		if($nimPDF == NULL){
			echo 'var nim = 0; var redirects = false;';
		}
		else{
			echo 'var nim = "'.$nimPDF.'"; var redirects = true;';
		}
		echo 'var base_url = "'. base_url().'";';
	?>
	</script>
	
	<script>
		function confirm_delete(nim){
				window.location="<?php echo base_url()?>index.php/TA_Controllers/deleteTA/"+nim;
		}
	</script>
	
	<style>
		.edit{
			text-align:right;
			padding-right:15%;
		}
		img{
			width:145px;
			height:200px;
			float:right;
			margin-right:10px;
			margin-left:50px;
			margin-bottom:15px;
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

<body oncontextmenu="return false">

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
							<li><a href="<?php echo base_url()."index.php/Admin/profil_admin"?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                                <li class='hidden'>
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
                                <li class='hidden'>
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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">

			<?php foreach ($row as $row){?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> <?php echo $row->name;?> </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<!-- Breadcrumbs-->
								<ol class="breadcrumb" style="margin-bottom:0%">
									<li class="breadcrumb-item">
										<a href="<?php echo base_url()."index.php/TA_Controllers/tabel_ta"?>">Tabel Skripsi</a>
									</li>
									<li class="breadcrumb-item active">Detail Skripsi</li>
								</ol>
							<!-- Example DataTables Card-->

							<div class="panel-body">
								<?php if($this->session->userdata('login')=='admin'){ ?>
									<div class="edit">
										<ul>
											<a href="<?php base_url();?>../../TA_Controllers/editTA/<?php echo $row->nim;?>">
												<button class="btn btn-primary">
													Edit
												</button>
											</a>
											<button class="btn btn-danger" data-toggle="modal" data-target="#myDelete">
												Delete
											</button>
										</ul>
									</div>
									<!-- /.edit-->
								<?php }?>
								
								<div class="foto">
									<?php 
									if ($row->foto == ''){
									?>
											<img src="<?php echo base_url("resource/foto_profil/Foto_Profil.jpg");?>">
									<?php
										} else{
									?>
											<img src="<?php echo base_url().'/uploads/'.$row->nim.'/'.$row->foto;?>">	
									<?php
										}
									?>
								</div>
								<!-- /.foto-->
								<table>
									<tr>
										<td><b> NIM </b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->nim;?> </td>
									</tr>
									<tr>
										<td><b>Nama</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->name;?> </td>
									</tr>
									<tr>
										<td><b>Judul Skripsi</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->judul;?></td>
									</tr>
									<tr>
										<td><b>Dosen Pembimbing</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->nama_dosen;?> </td>
									</tr>
									<tr>
										<td><b>Angkatan</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->angkatan;?> </td>
									</tr>
									<tr>
										<td><b>Abstrak</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->abstrak;?> </td>
									</tr>
									<tr>
										<td><b>Kata Kunci</b></td>
										<td><b> : </b></td>
										<td> <?php echo $row->kata_kunci;?> </td>
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
											<li>Laporan .doc    : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->doc);?>"><?php echo $row->doc;?></a></li>
											<li>Laporan .pdf    : <a target="_blank" href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->pdf);?>"><?php echo $row->pdf;?></a></li>
											<li>Dokumen Per-BAB : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->dokumen_per_bab);?>"><?php echo $row->dokumen_per_bab;?></a></li>
											<li>Presentasi .ppt : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->ppt);?>"><?php echo $row->ppt;?></a></li>
											<li>Source Code     : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->source_code);?>"><?php echo $row->source_code;?></a></li>
											<li>Artikel Ilmiah  : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->artikel_ilmiah);?>"><?php echo $row->artikel_ilmiah;?></a></li>
											<li>Lampiran        : <a href="<?php echo base_url('uploads/'.$row->nim.'/'.$row->lampiran);?>"><?php echo $row->lampiran;?></a></li>
										</td>
									</tr>
								</table>
								<!-- /.table-->
								
								<?php if($this->session->userdata('login')=='admin'){ ?>
								<div class="cetak" style="margin-bottom:25px; margin-top:5px; margin-left:200px;">
									<a target="_blank" href="<?php echo site_url('TA_Controllers/TampilPdf/'.$row->nim); ?>">
										<button class="btn btn-primary" style="background-color:grey; border:none;"> 
												<p class="fa fa-print" style="margin-bottom:0px"></p>
													Kartu Bebas Departemen
										</button>
									</a>
								</div>
								<?php }?>
								
								<!--<div class="cetak" style="margin-bottom:25px; margin-left:200px;">
									<a target="_blank" href="<?php echo site_url('ReportTA_Controllers/TampilLaporan/'.$row->nim); ?>">
										<button class="btn btn-primary" style="background-color:grey; border:none"> 
											Cetak Laporan Pengumpulan Makalah Tugas Akhir
										</button>
									</a>
								</div>-->
								
								<div class="pdf">
									<object width="100%" height="1130px" type="application/pdf" data="<?php echo base_url().'/uploads/'.$row->nim.'/'.$row->pdf;?>" id="pdf_content">
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

	<!--MODAL-->
		<!-- Modal Success Edit-->
		<?php
			if($this->session->flashdata('status') != null) {
		?>
		<script>
			$(window).on('load', function(){
				$('#modalSukses').modal('show');
			});
		</script>
		<div class="modal fade" id="modalSukses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Pemberitahuan !!</h4>
					</div>
					<div class="modal-body">
						Selamat, Data Berhasil Dirubah <span class="glyphicon glyphicon-thumbs-up" style="color:blue;"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<?php } ?>
		<!-- /.modal succes edit-->
		
		<!-- Modal Delete-->
		<div class="modal fade" id="myDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Peringatan !!</h4>
					</div>
					<div class="modal-body">
						Apakah anda yakin akan menghapus data ini ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<a href="javascript:;" onclick="confirm_delete(<?php echo $row->nim;?>)">
							<button type="button" class="btn btn-primary">Iya</button>
						</a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal delete-->
		
	<!--/.MODAL-->

</body>

</html>
