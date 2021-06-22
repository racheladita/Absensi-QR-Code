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
?>

<form method="post" class="form-horizontal" name="form1" id="form1" enctype="multipart/form-data" onsubmit="return validateForm()"  />
	<div class="control-group">
		<label class="control-label">Tanggal</label>
		<div class="controls">
			<input type="text" name="tgl" id="datepicker3" class="input-small">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Jam Mulai</label>
		<div class="controls">
			<input type="text" name="jam" id="jam" class="input-small">Ex. 15:45
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
	if($jml == "1")
	{
		echo "Jadwal ini sudah ada";
	}
	else
	{
		$q1 = mysqli_query($conn, "Insert into jadwal_kuliah (`tanggal`,`jam_mulai`,`kode_kelas`,`nid`,`id_tahun_ajaran`,`kode_mata_kuliah`) values 
									('".$_POST['tgl']."','".$_POST['jam']."','".$_POST['kelas']."','".$_POST['dosen']."','".$_POST['tahun_ajaran']."','".$_POST['matkul']."')");
		if($q1)
		{
			echo "<script>alert('Berhasil ditambahkan');window.location='?cat=akademik&page=jadwal'</script>";
		}
	}
}
?>

<?php
	ob_end_flush();
?>