<script src="js/jquery-ui.js"></script>
<script>
	$(function() 
	{
		$("#datepicker3").datepicker(
		{        
			 dateFormat: "yy-mm-dd",
		});
	});
</script>
<?php
	ob_start();
	$ids = $_GET['id'];
	$gj = mysqli_query($conn, "Select * from jadwal_kuliah where sha1(id_jadwal)='".$ids."'");
	$rgj = mysqli_fetch_array($gj);
?>

<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
	<div class="control-group">
		<label class="control-label">Tanggal</label>
		<div class="controls">
			<input type="text" name="tgl" id="datepicker3" class="input-small" value="<?php echo $rgj['tanggal']; ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Jam Mulai</label>
		<div class="controls">
			<input type="text" name="jam" id="jam" class="input-small" value="<?php echo $rgj['jam_mulai']; ?>">Ex. 15:45
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
		<label class="control-label">Dosen</label>
		<div class="controls">
<?php
			$q = mysqli_query($conn, "SELECT * from dosen ORDER BY nid");
			{
?>
				<select name="dosen" id="dosen">
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
	<div class="control-group">
		<div class="controls">
			<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Simpan Data" />&nbsp;&nbsp;<input type="button" class="btn btn-danger" name="reset" id="reset" value="Cancel" onclick="window.location='?cat=akademik&page=jadwal'">
		</div>
	</div>
</form>

<?php
if(isset($_POST['simpan']))
{
	$q = mysqli_query($conn, "Select count(id_jadwal) as rw from jadwal_kuliah where tanggal='".$_POST['tgl']."' and jam_mulai='".$_POST['jam']."' and kode_kelas='".$_POST['kelas']."'");
	$r = mysqli_fetch_array($q);
	$jml = $r['rw'];
	if($jml == "0")
	{
		echo "Jadwal belum ada";
	}
	else
	{
		$q1 = mysqli_query($conn, "Update jadwal_kuliah 
									SET `tanggal`='".$_POST['tgl']."',`jam_mulai`='".$_POST['jam']."',`kode_kelas`='".$_POST['kelas']."',`nid`='".$_POST['dosen']."',
									`id_tahun_ajaran`='".$_POST['tahun_ajaran']."',`kode_mata_kuliah`='".$_POST['matkul']."'
									Where sha1(id_jadwal)='".$_GET['id']."'");
		if($q1)
		{
			echo "<script>alert('Berhasil diubah');window.location='?cat=akademik&page=jadwal'</script>";
		}
	}
}
?>

<?php
	ob_end_flush();
?>