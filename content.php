<?php
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
	echo "<script>alert('Untuk mengakses modul, Anda harus login dulu.'); window.location = 'index.php'</script>"; 
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
	
	include "config/library.php";
	
	

  // Home (Beranda)
  if ($_GET['module']=='beranda'){               
    
      include "modul/mod_beranda/beranda.php";
      
  }

  //tugas
  elseif ($_GET['module']=='tugas'){               
    
    include "modul/mod_tugas/tugas.php";
  }

  //jadwal
  elseif ($_GET['module']=='jadwal'){               
   
    include "modul/mod_jadwal/jadwal.php";
  }

    //kpi
    elseif ($_GET['module']=='kpi'){               
   
      include "modul/mod_kpi/kpi.php";
    }

    //kpi
    elseif ($_GET['module']=='input_kpi'){               
   
      include "modul/mod_kpi/input_kpi.php";
    }

  elseif ($_GET['module']=='log_jadwal'){               
   
      include "modul/mod_jadwal/log_jadwal.php";
    }

  //role
  elseif ($_GET['module']=='role'){               
   
    include "modul/mod_role/role.php";
  }

  //shift
  elseif ($_GET['module']=='shift'){               
   
    include "modul/mod_shift/shift.php";
  }

  //rekap_report
  elseif ($_GET['module']=='rekap_report'){               
    
    include "modul/mod_kinerja/rekap_report.php";
  }

  //profile
  elseif ($_GET['module']=='profile'){               
    
    include "modul/mod_profile/profile.php";
  }

  // Identitas Website
  elseif ($_GET['module']=='sd'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_sd/sd.php";
    }
  }

  // Manajemen User
  elseif ($_GET['module']=='user'){
    
      include "modul/mod_user/user.php";
    
  }

  // Manajemen Modul
  elseif ($_GET['module']=='gajitest'){
    if ($_SESSION['leveluser']=='superadmin'){
      include "modul/gaji_test/gaji_test.php";
    }
  }
  
   // Manajemen Jabatan
  elseif ($_GET['module']=='jabatan'){
    if ($_SESSION['leveluser']=='superadmin'){
      include "modul/mod_jabatan/jabatan.php";
    }
  }

  // Kategori
  elseif ($_GET['module']=='smp'){
    if ($_SESSION['leveluser']=='superadmin'){
      include "modul/mod_smp/smp.php";
    }
  }

   // Bidang
  elseif ($_GET['module']=='bidang'){
    if ($_SESSION['leveluser']=='superadmin'){
      include "modul/mod_bidang/bidang.php";
    }
  }
  
     // Atasan
  elseif ($_GET['module']=='gaji'){
    if ($_SESSION['leveluser']=='superadmin'){
      include "modul/mod_gaji/gaji.php";
    }
  }
  
   // Approvalkegiatan
  elseif ($_GET['module']=='approvalkegiatan'){
    if ($_SESSION['leveluser']=='atasan'){
      include "modul/mod_approvalkegiatan/approvalkegiatan.php";
    }
  }
  
   // Approval
  elseif ($_GET['module']=='approval'){
    if ($_SESSION['leveluser']=='atasan'){
      include "modul/mod_approval/approval.php";
    }
  }
  
    // Pegawai
  elseif ($_GET['module']=='pegawai'){
    if ($_SESSION['leveluser']=='superadmin' || $_SESSION['leveluser']=='admin'){
      include "modul/mod_pegawai/pegawai.php";
    }
  }
  
    // Kegiatan
  elseif ($_GET['module']=='kegiatan'){
   
      include "modul/mod_kegiatan/kegiatan.php";
    
  }
  
     // Kinerja
  elseif ($_GET['module']=='kinerja'){
    
      include "modul/mod_kinerja/kinerja.php";
    
  }
  
  
  // Bagian Berita
  elseif ($_GET['module']=='pendapatanmurni'){
    
      include "modul/mod_pendapatanmurni/pendapatanmurni.php";                            
    
  }
  
   // Bagian Berita
  elseif ($_GET['module']=='pendapatanbank'){
    
      include "modul/mod_pendapatanbank/pendapatanbank.php";                            
    
  }


// Bagian Berita
  elseif ($_GET['module']=='pendapatanlain'){
    
      include "modul/mod_pendapatanlain/pendapatanlain.php";                            
    
  }


// Bagian Berita
  elseif ($_GET['module']=='sts'){
    
      include "modul/mod_sts/sts.php";                            
    
  }

  // Tag (Berita Terkait)
  elseif ($_GET['module']=='kastunai'){
    
      include "modul/mod_kastunai/kastunai.php";
    
  }

  // Agenda
  elseif ($_GET['module']=='kasbank'){
  
      include "modul/mod_kasbank/kasbank.php";
    
  }

  // Banner
  elseif ($_GET['module']=='belanjapegawai' OR $_GET['module']=='belanjabarangjasa' OR $_GET['module']=='belanjamodal'){
   
      include "modul/mod_belanja/belanja.php";
    
  }
// Laporan Harian
  elseif ($_GET['module']=='laporanharian'){
   
      include "modul/mod_laporanharian/laporanharian.php";
    
  }
  // Laporan Bulanan
  elseif ($_GET['module']=='laporanbulanan'){
   
      include "modul/mod_laporanbulanan/laporanbulanan.php";
    
  }
  // Polling
  elseif ($_GET['module']=='laporansekolah'){
   
      include "modul/mod_laporan/laporan.php";
    
  }

  // Download
  elseif ($_GET['module']=='laporankecamatan'){
    if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='kecamatan'){
      include "modul/mod_laporankec/laporankec.php";
    }
  }
  
  
  // Download
  elseif ($_GET['module']=='pejabat'){
    if ($_SESSION['leveluser']=='kecamatan' OR $_SESSION['leveluser']=='user'){
      include "modul/mod_pejabat/pejabat.php";
    }
  }

  // Hubungi Kami
  elseif ($_GET['module']=='waktu'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_waktu/waktu.php";
    }
  }

  // Templates
  elseif ($_GET['module']=='rekening'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_rekening/rekening.php";
    }
  }

  // Album
  elseif ($_GET['module']=='album'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_album/album.php";
    }
  }

  // Galeri Foto
  elseif ($_GET['module']=='galerifoto'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_galerifoto/galerifoto.php";
    }
  }

  // Menu Website
  elseif ($_GET['module']=='menu'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_menu/menu.php";
    }
  }
    // Menu Website user
  elseif ($_GET['module']=='menu'){
    if ($_SESSION['leveluser']=='user'){
      include "modul/mod_menu/menu.php";
    }
  }

  // Halaman Statis
  elseif ($_GET['module']=='halamanstatis'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_halamanstatis/halamanstatis.php";
    }
  }
    // Halaman Statis user
  elseif ($_GET['module']=='halamanstatis'){
    if ($_SESSION['leveluser']=='user'){
      include "modul/mod_halamanstatis/halamanstatis.php";
    }
  }

  // Video
  elseif ($_GET['module']=='video'){
    if ($_SESSION['leveluser']=='admin'){
      include "modul/mod_video/video.php";
    }
  }

  //report hari ini
  elseif($_GET['module']=='report-today'){
    if($_SESSION['leveluser']=='admin'){
      include "modul/mod_report/report_today.php";
    }
  }

  // Apabila modul tidak ditemukan
  else{
?>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Modul tidak ada.
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Title</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              Start creating your amazing application!
            </div><!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->

<?php
	}
}
?>