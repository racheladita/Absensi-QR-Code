<div align="left">
	<h1>Laporan Absensi Dosen per Semester</h1>
</div>

<?php 
	$nid = $_SESSION['login_user'];
	$jumlah = 0;
	$q = mysqli_query($conn, "SELECT id_jadwal from data_absen_dosen where nid='$nid'");
	while($x = mysqli_fetch_array($q)){$jumlah += 1;}	
?>

<form method="post">
	<p>&nbsp;</p>
	<div class="control-group">
		<label class="control-label">Filter Laporan Absensi : <input type="text" id="cari" name="cari" style="width:350px;" placeholder="Filter Berdasar Mata Kuliah atau Tahun Ajaran"></label>
	</div>
	<p>&nbsp;</p>
</form>

<span class="span8">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td><strong>No. </strong></td>
    <td><strong>Nama Dosen</strong></td>  
    <td><strong>Mata Kuliah</strong></td>
	<td><strong>Kelas</strong></td>
	<td><strong>Tahun Ajaran</strong></td>
	<td><strong>Tanggal</strong></td>
	<td><strong>Jam</strong></td>
    <td>&nbsp;</td>
  </tr>

<?php
	$i = 1;
	if(isset($_POST['cari']))
	{	
		$cari=mysqli_real_escape_string($conn, $_POST['cari']);
		$rw = mysqli_query($conn, "SELECT dosen.nama, mata_kuliah.nama_mata_kuliah, kelas.nama_kelas, tahun_ajaran.keterangan, data_absen_dosen.tgl, data_absen_dosen.jam
								FROM ((((data_absen_dosen INNER JOIN jadwal_kuliah ON data_absen_dosen.id_jadwal = jadwal_kuliah.id_jadwal) INNER JOIN tahun_ajaran ON jadwal_kuliah.id_tahun_ajaran = tahun_ajaran.id) INNER JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) INNER JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah) INNER JOIN dosen ON data_absen_dosen.nid = dosen.nid WHERE data_absen_dosen.nid = '$nid' and mata_kuliah.nama_mata_kuliah like '".$cari."%' or tahun_ajaran.keterangan like '".$cari."%' ORDER BY tgl ASC");
		$jumlah = count($rw);
	}
	else
	{
		$rw = mysqli_query($conn, "SELECT dosen.nama, mata_kuliah.nama_mata_kuliah, kelas.nama_kelas, tahun_ajaran.keterangan, data_absen_dosen.tgl, data_absen_dosen.jam
								FROM ((((data_absen_dosen INNER JOIN jadwal_kuliah ON data_absen_dosen.id_jadwal = jadwal_kuliah.id_jadwal) INNER JOIN tahun_ajaran ON jadwal_kuliah.id_tahun_ajaran = tahun_ajaran.id) INNER JOIN kelas ON jadwal_kuliah.kode_kelas = kelas.kode_kelas) INNER JOIN mata_kuliah ON jadwal_kuliah.kode_mata_kuliah = mata_kuliah.kode_mata_kuliah) INNER JOIN dosen ON data_absen_dosen.nid = dosen.nid WHERE data_absen_dosen.nid = '$nid'");
	}
	while($s = mysqli_fetch_array($rw))
	{
?>
	  <tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $s['nama']; ?></td>
		<td><?php echo $s['nama_mata_kuliah']; ?></td>
		<td><?php echo $s['nama_kelas']; ?></td>
		<td><?php echo $s['keterangan']; ?></td>
		<td><?php echo $s['tgl']; ?></td>
		<td><?php echo $s['jam']; ?></td>
		<td>&nbsp;</td>
	  </tr>
<?php
	  $i += 1;
	}
?>

	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><strong>Jumlah Hadir : </strong></td>	
		<td><strong><?php echo $jumlah; ?></strong></td>
	  </tr>
  
</table>
</span>