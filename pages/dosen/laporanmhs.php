<div align="left">
	<h1>Laporan Absensi Mahasiswa per Semester</h1>
</div>
<br />
<br />
<span class="span8">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td><strong>No. </strong></td>
    <td><strong>Tahun Ajaran</strong></td>  
    <td><strong>Link Website</strong></td>
    <td>&nbsp;</td>
  </tr>

<?php
	$rw = mysqli_query($conn, "SELECT * from tahun_ajaran ORDER BY id");	
	while($s = mysqli_fetch_array($rw))
	{
?>
	  <tr>
		<td><?php echo $s['id']; ?></td>
		<td><?php echo $s['keterangan']; ?></td>
		<td><a href="<?php echo $s['link']; ?>">Link Laporan Kehadiran Mahasiswa Tahun Ajaran <?php echo $s['keterangan']?></a></td>
		<td>&nbsp;</td>
	  </tr>
<?php
	}
?>
</table>
</span>