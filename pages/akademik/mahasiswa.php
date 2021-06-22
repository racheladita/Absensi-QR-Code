<div align="left">
	<h1>Data Mahasiswa</h1>
</div>

<div align="right">
	<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=addmahasiswa'">Tambah Data</button>
</div>
<span class="span8">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Nomor Induk Mahasiswa</td>
    <td>Nama Mahasiswa</td>  
    <td>Umur</td> 
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
		<td><?php echo $s['umur']; ?></td>
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
		<td><a href="?cat=akademik&page=editmahasiswa&id=<?php echo sha1($s['nim']); ?>">Edit</a> - <a href="?cat=akademik&page=mahasiswa&del=1&id=<?php echo sha1($s['nim']); ?>">Hapus</a></td>
	  </tr>
<?php
	}
  }
?>  
</table>
</span>

<?php
	if(isset($_GET['del']))
	{
		$ids = $_GET['id'];
		$ff = mysqli_query($conn, "Delete from mahasiswa Where sha1(nim)='".$ids."'");
		if($ff)
		{
			echo "<script>window.location='?cat=akademik&page=mahasiswa'</script>";
		}
	}
?>
	
<script type="text/javascript">
	$(document).ready(function()
	{
		$("div.lightbox").bind("shown",function()
		{
			console.log("Shown Event",$(this).attr('id'));
		});
	});
</script>