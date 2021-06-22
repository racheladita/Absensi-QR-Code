<!--NAVIGASI MENU UTAMA-->

<div class="leftmenu">
  <ul class="nav nav-tabs nav-stacked">
    <li class="active"><a href="dashboard.php"><span class="icon-align-justify"></span> Dashboard</a></li>
    
    <!--MENU AKADEMIK-->
    <?php
		if($_SESSION['login_hash']=="akademik")
		{
	?>
			<li class="dropdown"><a href="#"><span class="icon-th-list"></span> Data Utama</a>
			  <ul>
			   <li><a href="?cat=akademik&page=matkul">Mata Kuliah</a></li>
			   <li><a href="?cat=akademik&page=kelas">Data Kelas</a></li>
			   <li><a href="?cat=akademik&page=jadwal">Jadwal Kuliah</a></li>
			   <li><a href="?cat=akademik&page=dosen">Data Dosen</a></li>
			   <li><a href="?cat=akademik&page=mahasiswa">Data Mahasiswa</a></li>
			   <li><a href="?cat=akademik&page=user">User Management</a></li>
			  </ul>
			</li>   
			<li class="dropdown"><a href="#"><span class="icon-pencil"></span> Konfigurasi</a>
			  <ul>
				<li><a href="?cat=akademik&page=configabsen">Konfigurasi Absen</a></li>
			  </ul>
			</li>           
			<li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
			  <ul>
				<li><a href="?cat=akademik&page=lapfull">Laporan per Semester (Mahasiswa)</a></li>
				<li><a href="?cat=akademik&page=lapfull2">Laporan per Semester (Dosen)</a></li>
			  </ul>
			</li>        
	
   <!--MENU MAHASISWA-->
    <?php
		}
		elseif($_SESSION['login_hash'] == "mahasiswa")
		{
	?>    
			<li><a href="?cat=mahasiswa&page=absensi"><span class="icon-th-list"></span> Absensi</a></li>           
			<li><a href="?cat=mahasiswa&page=laporan"><span class="icon-pencil"></span> Laporan per Semester</a></li>
    
	<!--MENU DOSEN-->
    <?php
		}
		elseif($_SESSION['login_hash'] == "dosen")
		{
	?>    
			<li><a href="?cat=dosen&page=absensi"><span class="icon-th-list"></span> Absensi</a></li>           
			<li class="dropdown"><a href="#"><span class="icon-pencil"></span> Laporan</a>
			  <ul>
				<li><a href="?cat=dosen&page=laporanmhs">Laporan per Semester (Mahasiswa)</a></li> 
				<li><a href="?cat=dosen&page=laporan">Laporan per Semester (Dosen)</a></li> 
			  </ul>
			</li>
  	<?php
		}
	?>
  </ul>
</div>
<!--leftmenu-->

</div>
<!--mainleft--> 
<!-- END OF LEFT PANEL -->