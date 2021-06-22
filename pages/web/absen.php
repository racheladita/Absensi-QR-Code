<div align="center">
<hr />
<table width="80%" border="1">
  <tr>
    <td>
<?php
	date_default_timezone_set('Asia/Jakarta');
	$skrg = date("Y-m-d");
	$qr = mysqli_query($conn,"Select * from config");
	$rqr = mysqli_fetch_array($qr);
	$limit = "00:".$rqr['limit_absen'];
	$limit_detik_absen = $rqr['limit_absen'];
	if(isset($_SESSION['nid']) && isset($_SESSION['matkul']) && isset($_SESSION['kelas']) && isset($_SESSION['tahun_ajaran']))
	{
		$q=mysqli_query($conn, "SELECT jadwal_kuliah.id_jadwal, jadwal_kuliah.tanggal, jadwal_kuliah.jam_mulai,  dosen.nama, kelas.nama_kelas, mata_kuliah.nama_mata_kuliah, tahun_ajaran.keterangan
							    FROM (((jadwal_kuliah LEFT JOIN dosen ON jadwal_kuliah.nid = dosen.nid) LEFT JOIN tahun_ajaran ON jadwal_kuliah.id_tahun_ajaran = tahun_ajaran.id) LEFT JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) LEFT JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah where jadwal_kuliah.tanggal='".$skrg."' and dosen.nid='".$_SESSION['nid']."' and jadwal_kuliah.kode_mata_kuliah='".$_SESSION['matkul']."' and kelas.kode_kelas='".$_SESSION['kelas']."' and tahun_ajaran.id='".$_SESSION['tahun_ajaran']."'") or die(mysqli_error($conn));
		$rq=mysqli_fetch_array($q);
		$rc=mysqli_num_rows($q);
		if($rc == "0")
		{
			unset($_SESSION['nid']);
			unset($_SESSION['matkul']);
			unset($_SESSION['kelas']);
			unset($_SESSION['tahun_ajaran']);			
			echo "<script>alert('tidak ditemukan');window.location='?cat=dosen&page=absensi'</script>";
		}
		else
		{
			$midnight = strtotime("00:00");
			$jam_mulai = $skrg." ".$rq['jam_mulai'];
			$tskrg = date("h:i");
			$newtimestamp = strtotime($skrg.' '.$rq['jam_mulai'].' + '.$limit_detik_absen.' minute');
			$jam_habis = date('Y-m-d H:i:s', $newtimestamp);
			$format24 = substr($tskrg,0,2);
			if($format24 == "12")
			{
				$format24 = "00";
			}
			$jskrg = $skrg." ".$format24.":".date("i").":00";		
			$limitok = $newtimestamp - strtotime($jskrg);
			$l1 = $newtimestamp- strtotime($jam_mulai);
			if($limitok > $l1)
			{
				unset($_SESSION['nid']);
				unset($_SESSION['matkul']);
				unset($_SESSION['kelas']);
				unset($_SESSION['tahun_ajaran']);	
				echo "<script>alert('Absen belum dibuka');window.location='?cat=dosen&page=absensi'</script>";
			}
			if($limitok < 0 )
			{
				$k_jadwal=$rq['id_jadwal'];
				echo "<center><h1>TENGGAT WAKTU ABSEN SUDAH HABIS</h1></center>"."<br>";
				$td = mysqli_query($conn,"Select * from data_absen_dosen where id_jadwal='".$k_jadwal."'");
				$rtd = mysqli_fetch_array($td);
				$td2 = mysqli_query($conn,"Select * from dosen where nid='".$rtd['nid']."'");
				$rtd2 = mysqli_fetch_array($td2);
	?>
				<h3>Dosen : <?php echo $rtd2['nama']; ?></h3>
	<?php
				echo "<h3>MAHASISWA YANG HADIR</h3>"."<br>";
	?>
				<button class="btn btn-medium btn-primary" type="button" onClick="window.location='<?php echo $baseurl."dashboard.php?cat=dosen&page=absensi&c=1"; ?>'">Cari Lain</button>
			<?php
			}
			else
			{
			?>
				<p>Tenggat Waktu Absen <h2><span id="counter"><?php echo $limitok; ?></span> detik.</h2></p>
				<script type="text/javascript">
					function countdown() 
					{
						var i = document.getElementById('counter');
						i.innerHTML = parseInt(i.innerHTML)-1;
						if (parseInt(i.innerHTML) <= 0) 
						{
							location.href = '?cat=dosen&page=absensi&c=1';
							i.innerHTML='5';
						}
						
					}
					setInterval(function(){ countdown(); },1000);
				</script>
				
				<div style="background-color:#FFFFFF">
					<?php
						$g2 = mysqli_query($conn,"Select * from mata_kuliah where kode_mata_kuliah='".$_SESSION['matkul']."'");
						$rg2 = mysqli_fetch_array($g2);
						$g1 = mysqli_query($conn,"Select * from kelas where kode_kelas='".$_SESSION['kelas']."'");
						$rg1 = mysqli_fetch_array($g1);
						$gx1 = mysqli_query($conn,"Select * from tahun_ajaran where id='".$_SESSION['tahun_ajaran']."'");
						$rgx1 = mysqli_fetch_array($g1);
						echo "<h6>Mata Kuliah = <strong>".$rq['nama_mata_kuliah']."</strong></h6>";
						echo "<h6>Nama Dosen = <strong>".$rq['nama']."</strong></h6>";
						echo "<h6>Kelas = <strong>".$rq['nama_kelas']."</strong></h6>";
						echo "<h6>Tahun Ajaran = <strong>".$rq['keterangan']."</strong></h6>";
					?>
					<form name="formabsen" method="post">
						<input type="hidden" name="idjadwal" value="<?php echo $rq['id_jadwal']; ?>" />
						<div class="control-group">
							<label>NIP</label>
							<div class="controls">
								<input type="text" name="kode" />
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<input type="submit" class="btn btn-medium btn-primary" name="simpanabsen" value="Absen" />		
								<button class="btn btn-medium btn-primary" type="button" onClick="window.location='<?php echo $baseurl."dashboard.php?cat=dosen&page=absensi&c=1"; ?>'">Cari Lain</button>
							</div>
						</div>
					</form>        
				</div>
				<p>&nbsp;</p> 
				<span class="span10">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
				  <tr>
					<td>Nomor Induk Mahasiswa</td>
					<td>Nama Mahasiswa</td>   
					<td>QRCode</td>      
					<td>&nbsp;</td>
				  </tr>
				<?php
				  $rw=mysqli_query($conn, "SELECT * FROM mahasiswa");
				  if(mysqli_num_rows($rw))
				  {
					while($s=mysqli_fetch_array($rw))
					{
				?>
					  <tr>
						<td><?php echo $s['nim']; ?></td>
						<td><?php echo $s['nama']; ?></td>
						<td>  
				<?php 
						if($s['photo'] != "")
						{
				?>
							<img src="<?php echo $baseurl?>/uploads/mahasiswa/<?php echo $s['photo'] ?> " width="160">
				<?php
						}
						else
						{
				?>
							<img src="<?php echo $baseurl."uploads/files/no-avatar.jpg"; ?>" width="160">
				<?php
						}
				?>	
						</td>
					  </tr>
				<?php
					}
				  }
				?>  
				</table>
				</span>
				<p>&nbsp;</p> 	
				<script type="text/javascript">
					$(document).ready(function()
					{
						$("div.lightbox").bind("shown",function()
						{
							console.log("Shown Event",$(this).attr('id'));
						});
					});
				</script>
<?php
			}
		}
	}
	else
	{
?>
		<form name="form1" method="post">
		<div><center><h1><?php echo $nama_aplikasi; ?></h1></center></div><br />
			<div class="control-group">
				<label class="control-label">Dosen</label>
				<div class="controls">
				<?php
					$q = mysqli_query($conn, "SELECT * from dosen ORDER BY nid");
					{
				?>
						<select name="nid" id="nid">
							<option>-- Pilih Dosen --</option>
							<?php if(mysqli_num_rows($q) > 0) {?>
								<?php while($row = mysqli_fetch_array($q)) {?>
									<option value="<?php echo $row['nid']; ?>"><?php echo $row['nama']; ?></option>
								<?php } ?>
							<?php } ?>	
						</select>
				<?php
					}
				?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Mata Kuliah</label>
				<div class="controls">
				<?php
					$q = mysqli_query($conn, "Select * from mata_kuliah ORDER BY nama_mata_kuliah");
					{
				?>
						<select name="matkul" id="matkul">
							<option>-- Pilih Mata Kuliah --</option>
							<?php if(mysqli_num_rows($q) > 0) {?>
								<?php while($row = mysqli_fetch_array($q)) {?>
									<option value="<?php echo $row['kode_mata_kuliah']; ?>"><?php echo $row['nama_mata_kuliah']; ?></option>
								<?php } ?>
							<?php } ?>	
						</select>
				<?php
					}
				?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Kelas</label>
				<div class="controls">
				<?php
					$q = mysqli_query($conn, "SELECT * from kelas ORDER BY kode_kelas");
					{
				?>
						<select name="kelas" id="kelas">
							<option>-- Pilih Kelas --</option>
							<?php if(mysqli_num_rows($q) > 0) {?>
								<?php while($row = mysqli_fetch_array($q)) {?>
									<option value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
								<?php } ?>
							<?php } ?>	
						</select>
				<?php
					}
				?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Tahun Ajaran</label>
				<div class="controls">
					<?php
						$q = mysqli_query($conn, "SELECT * from tahun_ajaran ORDER BY id");
						{
					?>
						<select name="tahun_ajaran" id="tahun_ajaran">
							<option>-- Pilih Tahun Ajaran --</option>
							<?php if(mysqli_num_rows($q) > 0) {?>
								<?php while($row = mysqli_fetch_array($q)) {?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['keterangan']; ?></option>
								<?php } ?>
							<?php } ?>	
						</select>
					<?php
						}
					?>
				</div>
			</div>
			<p></p>
			<input type="submit" name="cari" value="Cari" class="btn btn-medium btn-primary" />
		</form>
		<?php
		}
?>
<?php
	if(isset($_POST['cari']))
	{
		$_SESSION['nid']=$_POST['nid'];
		$_SESSION['matkul']=$_POST['matkul'];
		$_SESSION['kelas']=$_POST['kelas'];
		$_SESSION['tahun_ajaran']=$_POST['tahun_ajaran'];
		echo "<script>window.location='?cat=dosen&page=absensi'</script>";
	}
	if(isset($_GET['c']))
	{
		unset($_SESSION['nid']);
		unset($_SESSION['matkul']);
		unset($_SESSION['kelas']);
		unset($_SESSION['tahun_ajaran']);	
		echo "<script>window.location='?cat=dosen&page=absensi'</script>";
	}
?>

<?php
	if(isset($_POST['simpanabsen']))
	{
		$chm2 = mysqli_query($conn,"Select * from dosen where nid='".$_POST['kode']."'") or die(mysqli_error());
		$rchm2 = mysqli_num_rows($chm2);
		if($rchm2 == 1)
		{
			$ch2 = mysqli_query($conn, "Select * from data_absen_dosen where id_jadwal='".$_POST['idjadwal']."' and nid='".$_POST['kode']."'");
			$rch2 = mysqli_num_rows($ch2);
			if($rch2 == 0)
			{
				$sql2 = mysqli_query($conn,"Insert into data_absen_dosen SET id_data='',id_jadwal='".$_POST['idjadwal']."',nid='".$_POST['kode']."',tgl='".$skrg."',jam='".$jskrg."',kode_mata_kuliah='".$_SESSION['matkul']."'");
				if($sql2)
				{
					unset($_SESSION['nid']);
					unset($_SESSION['matkul']);
					unset($_SESSION['kelas']);
					unset($_SESSION['tahun_ajaran']);	
					echo "<script>alert('Terima Kasih sudah Absen');window.location='?cat=dosen&page=absensi'</script>";
				}
			}
			else
			{
				unset($_SESSION['nid']);
				unset($_SESSION['matkul']);
				unset($_SESSION['kelas']);
				unset($_SESSION['tahun_ajaran']);	
				echo "<script>alert('Anda sudah absen');window.location='?cat=dosen&page=absensi'</script>";
			}
		}
		else
		{
			unset($_SESSION['nid']);
			unset($_SESSION['matkul']);
			unset($_SESSION['kelas']);
			unset($_SESSION['tahun_ajaran']);	
			echo "<script>alert('Orang Lain dilarang absen');window.location='?cat=dosen&page=absensi'</script>";
		}
	}			
?>

	</td>
  </tr>
</table>
<hr>
<div align="center">
<h6><?php echo $label_footer;?></h6>
</div>
</div>


