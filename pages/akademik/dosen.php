<div align="left">
	<h1>Data Dosen</h1>
</div>

<div align="right">
	<button class="btn btn-medium btn-primary" type="button" onClick="window.location='?cat=akademik&page=adddosen'">Tambah Data</button>
</div>
<span class="span8">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
  <tr>
    <td>Nomor Induk Dosen</td>
    <td>Nama Dosen</td>  
    <td>Umur</td> 
    <td>Foto</td>      
    <td>&nbsp;</td>
  </tr>
<?php
  $rw=mysqli_query($conn, "Select * from dosen");
  if(mysqli_num_rows($rw))
  {
	  while($s=mysqli_fetch_array($rw))
	  {
?>
		  <tr>
			<td><?php echo $s['nid']; ?></td>
			<td><?php echo $s['nama']; ?></td>
			<td><?php echo $s['umur']; ?></td>
			<td>  
<?php 
			if($s['photo'] != "")
			{
?>
				<img src="<?php echo $baseurl?>/uploads/dosen/<?php echo $s['photo'] ?> " width="160">
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
			<td><a href="?cat=akademik&page=editdosen&id=<?php echo sha1($s['nid']); ?>">Edit</a> - <a href="?cat=akademik&page=dosen&del=1&id=<?php echo sha1($s['nid']); ?>">Hapus</a></td>
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
		$ff = mysqli_query($conn, "Delete from dosen Where sha1(nid)='".$ids."'");
		if($ff)
		{
			echo "<script>window.location='?cat=akademik&page=dosen'</script>";
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