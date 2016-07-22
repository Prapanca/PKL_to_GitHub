<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Form Edit TA</title>

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
		.button{
			background-color:gray;
			color:white;
		}
		.button:hover{
			background-color:white;
			color:black;
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
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama;?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                                <li>
                                    <a href="<?php echo base_url()."index.php/PKL_Controllers/tabel_pkl"?>">Tabel Laporan PKL</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()."index.php/TA_Controllers/tabel_ta"?>">Tabel Makalah TA</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
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
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Makalah Tugas Akhir</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="panel panel-default">
				<div class="row">
					<form method="POST" action="<?php echo base_url();?>index.php/TA_Controllers/update">
					<?php foreach ($row as $row){?>
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<p style="font-size:28px">Form Data Mahasiswa</p>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label>NIM</label>
										<input class="form-control" type="number" name="nim" value="<?php echo $row->nim;?>" placeholder="NIM Mahasiswa" required autofocus>
									</div>
									<div class="form-group">
										<label>NAMA LENGKAP</label>
										<input class="form-control" type="text" name="name" value="<?php echo $row->name;?>" placeholder="Masukkan Nama Lengkap Mahasiswa">
									</div>						
									<div class="form-group">
										<label>ANGKATAN</label>
										<select class="form-control" name="angkatan">
											<option value=""> -- Masukkan Tahun Angkatan Mahasiswa -- </option>
											<option value="<?php echo $row->angkatan;?>"> <?php echo $row->angkatan;?> </option>
										</select>
									</div>
									<div class="form-group">
										<label>Unggah Foto</label>
										<input type="file" name="file">
									</div>
								</div>
								<!-- /.panel-body -->
							</div>
							<!-- /.panel -->
						</div>
						<!-- /.col-lg-6 -->
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<p style="font-size:28px">Form Data Makalah</p>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label>Judul Makalah</label>
										<textarea class="form-control" name="judul" rows="3" required> <?php echo $row->judul;?> </textarea>
									</div>
									<div class="form-group">
										<label>Unggah File .doc / .docx</label>
										<input type="file" name="doc">
									</div>
									<div class="form-group">
										<label>Unggah File .pdf</label>
										<input type="file" name="pdf">
									</div>
									<div class="form-group">
										<label>Unggah File .ppt / .pptx</label>
										<input type="file" name="ppt">
									</div>
									<div class="form-group">
										<label>Unggah File SourceCode .zip /.rar </label>
										<input type="file" name="file1">
									</div>
									<div class="form-group">
										<label>Unggah File Artikel Ilmiah .zip /.rar</label>
										<input type="file" name="file2">
									</div>
									<div class="form-group">
										<label>Unggah File Lampiran .zip /.rar</label>
										<input type="file" name="file3">
									</div>
									<br>
									<div class="form-group">
										<label>Dosen Pembimbing</label>
										<select class="form-control" name="nip">
										<?php foreach ($dosen as $row){?>
											<option value="<?php echo $row->nip;?>"> <?php echo $row->nama;?> </option>
										<?php }?>
										</select>
									</div>
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
					<?php }?>
					</form>
				</div>
				<!-- /.row -->
			</div>
			<!--panel panel-default-->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
