<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>"; 
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
	$module=$_GET['module'];
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php if($module=="beranda") echo "active"; ?>"><a href="<?php echo $base_url;?>beranda" title="beranda"><i class="fa fa-home"></i> <span>Beranda 
	(<?php echo $_SESSION['leveluser'];?>)
            </span></a></li>
			<?php
			
			//JIKA USER ADALAH SUPERADMIN MAKA AKAN TAMPIL MENU

				if($_SESSION['leveluser']=="superadmin")
				{ ?>
					<!-- echo "superadmin"; -->

					<li class="treeview <?php if($module=="pegawai" || $module=="jabatan" || $module=="gaji" || $module=="user") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-database"></i>
							<span><b>Manajemen Data</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="pegawai") echo "active"; ?>"><a href="<?php echo $base_url;?>pegawai"><i class="fa fa-users"></i> <span>Pegawai</span></a></li>		
							<li class="<?php if($module=="jabatan") echo "active"; ?>"><a href="<?php echo $base_url;?>jabatan"><i class="fa fa-flag"></i> <span>Jabatan</span></a></li>
							<li class="<?php if($module=="gaji") echo "active"; ?>"><a href="<?php echo $base_url;?>gaji"><i class="fa fa-money"></i> <span>Gaji</span></a></li>
							<li class="<?php if($module=="user") echo "active"; ?>"><a href="<?php echo $base_url;?>user"><i class="fa fa-user"></i> <span>Manajemen User</span></a></li>
							
						</ul>
					</li>	
					<li class="treeview <?php if($module=="kegiatan" || $module=="kinerja" || $module=="rekap_report") echo "active" ; ?>">
						<a href="#">
							<i class="fa fa-calendar-check-o"></i>
								<span><b>Manajemen Kerja</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>kinerja"><i class="fa fa-list-ul"></i> <span>Report Kerja</span></a></li>
							<li class="<?php if($module=="rekap_report") echo "active"; ?>"><a href="<?php echo $base_url;?>rekap_report"><i class="fa  fa-file-text-o"></i> <span>Rekapitulasi</span></a></li>
						</ul>
					</li>
					<li class="treeview <?php if($module=="tugas" || $module=="tugas") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Manajemen Tugas</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>tugas"><i class="fa fa-list-ol"></i> <span>Tugas</span></a></li>
						</ul>
					</li>
					
					<li class="treeview <?php if($module=="jadwal" || $module=="log_jadwal") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Jadwal</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="jadwal") echo "active"; ?>"><a href="<?php echo $base_url;?>jadwal"><i class="fa fa-list-ol"></i> <span>Jadwal</span></a></li>
							<li class="<?php if($module=="log_jadwal") echo "active"; ?>"><a href="<?php echo $base_url;?>log_jadwal"><i class="fa fa-list-ol"></i> <span>Log Jadwal</span></a></li>
						</ul>
					</li>
					<li>
						<ul>
							<li><a href="<?php echo $base_url;?>gajitest">Test Gaji</a></li>
						</ul>
					</li>
			
			<!-- JIKA USER ADALAH ADMIN MAKA TAMPIL MENU -->

				<?php }elseif($_SESSION['leveluser']=="admin"){ ?>
<!-- <p style="color:aliceblue;">admin</p> -->
					<li class="treeview <?php if($module=="pegawai" || $module=="jabatan" || $module=="gaji" || $module=="user") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-database"></i>
							<span><b>Manajemen Data</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="pegawai") echo "active"; ?>"><a href="<?php echo $base_url;?>pegawai"><i class="fa fa-users"></i> <span>Pegawai</span></a></li>		
							<!-- <li class="<?php //if($module=="jabatan") echo "active"; ?>"><a href="<?php //echo $base_url;?>jabatan"><i class="fa fa-flag"></i> <span>Jabatan</span></a></li>
							<li class="<?php //if($module=="gaji") echo "active"; ?>"><a href="<?php //echo $base_url;?>gaji"><i class="fa fa-money"></i> <span>Gaji</span></a></li>
							<li class="<?php //if($module=="user") echo "active"; ?>"><a href="<?php //echo $base_url;?>user"><i class="fa fa-user"></i> <span>Manajemen User</span></a></li> -->
							
						</ul>
					</li>	

					<li class="treeview <?php if($module=="kegiatan" || $module=="kinerja" || $module=="rekap_report") echo "active" ; ?>">
						<a href="#">
							<i class="fa fa-calendar-check-o"></i>
								<span><b>Manajemen Kerja</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>kinerja"><i class="fa fa-list-ul"></i> <span>Report Kerja</span></a></li>
							<li class="<?php if($module=="rekap_report") echo "active"; ?>"><a href="<?php echo $base_url;?>rekap_report"><i class="fa  fa-file-text-o"></i> <span>Rekapitulasi</span></a></li>
						</ul>
					</li>
					<li class="treeview <?php if($module=="tugas" || $module=="tugas") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Manajemen Tugas</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>tugas"><i class="fa fa-list-ol"></i> <span>Tugas</span></a></li>
						</ul>
					</li>
					
					<li class="treeview <?php if($module=="jadwal") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Jadwal</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="jadwal") echo "active"; ?>"><a href="<?php echo $base_url;?>jadwal"><i class="fa fa-list-ol"></i> <span>Jadwal</span></a></li>
						</ul>
					</li>

			<!-- JIKA USER ADALAH USER BIASA MAKA TAMPIL MENU -->
				<?php }else{ ?>
					<!-- echo "user"; -->

					<li class="treeview <?php if($module=="kegiatan" || $module=="kinerja" || $module=="rekap_report") echo "active" ; ?>">
						<a href="#">
							<i class="fa fa-calendar-check-o"></i>
								<span><b>Manajemen Kerja</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>kinerja"><i class="fa fa-list-ul"></i> <span>Report Kerja</span></a></li>
						</ul>
					</li>
					<li class="treeview <?php if($module=="tugas" || $module=="tugas") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Manajemen Tugas</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="kinerja") echo "active"; ?>"><a href="<?php echo $base_url;?>tugas"><i class="fa fa-list-ol"></i> <span>Tugas</span></a></li>
						</ul>
					</li>
					<li class="treeview <?php if($module=="jadwal") echo "active"; ?>">
						<a href="#">
							<i class="fa fa-check-square-o"></i>
								<span><b>Jadwal</b></span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li class="<?php if($module=="jadwal") echo "active"; ?>"><a href="<?php echo $base_url;?>jadwal"><i class="fa fa-list-ol"></i> <span>Jadwal</span></a></li>
						</ul>
					</li>
				<?php } ?>
			
          

		   <!--
		   <li class="treeview <?php if($module=="berita" || $module=="kategori" || $module=="tag") echo "active"; ?>">
				<a href="#">
					<i class="fa fa-edit"></i>
					<span><b>Manajemen Berita</b></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($module=="berita") echo "active"; ?>"><a href="?module=berita"><i class="fa fa-circle-o"></i> <span>Berita</span></a></li>
					<li class="<?php if($module=="kategori") echo "active"; ?>"><a href="?module=kategori"><i class="fa fa-circle-o"></i> <span>Kategori</span></a></li>
					<li class="<?php if($module=="tag") echo "active"; ?>"><a href="?module=tag"><i class="fa fa-circle-o"></i> <span>Tag / Label</span></a></li>
				</ul>
			</li>
			<li class="<?php if($module=="halamanstatis") echo "active"; ?>"><a href="?module=halamanstatis" title="Halaman Statis"><i class="fa fa-tag"></i> <span>Halaman Statis</span></a></li>
            <li class="treeview <?php if($module=="album" || $module=="galerifoto" || $module=="video" || $module=="download") echo "active"; ?>">
				<a href="#">
					<i class="fa fa-edit"></i>
					<span><b>Media</b></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($module=="album") echo "active"; ?>"><a href="?module=album"><i class="fa fa-circle-o"></i> <span>Album</span></a></li>
					<li class="<?php if($module=="galerifoto") echo "active"; ?>"><a href="?module=galerifoto"><i class="fa fa-circle-o"></i> <span>Galeri Foto</span></a></li>
					<li class="<?php if($module=="video") echo "active"; ?>"><a href="?module=video"><i class="fa fa-circle-o"></i> <span>Video</span></a></li>
					<li class="<?php if($module=="download") echo "active"; ?>"><a href="?module=download"><i class="fa fa-circle-o"></i> <span>Download</span></a></li>
				</ul>
			</li>
            <li class="treeview <?php if($module=="agenda" || $module=="polling" || $module=="hubungi") echo "active"; ?>">
				<a href="#">
					<i class="fa fa-edit"></i>
					<span><b>Interaksi</b></span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li class="<?php if($module=="agenda") echo "active"; ?>"><a href="?module=agenda"><i class="fa fa-circle-o"></i> <span>Agenda</span></a></li>
					<li class="<?php if($module=="polling") echo "active"; ?>"><a href="?module=polling"><i class="fa fa-circle-o"></i> <span>Polling</span></a></li>
					<li class="<?php if($module=="hubungi") echo "active"; ?>"><a href="?module=hubungi"><i class="fa fa-circle-o"></i> <span>Hubungi Kami</span></a></li>
				</ul>
			</li>
			<li class="<?php if($module=="banner") echo "active"; ?>"><a href="?module=banner" title="Banner"><i class="fa fa-tag"></i> <span>Banner</span></a></li>
			
			-->
			<li><a href="logout.php" title="Keluar"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<?php
}
?>



