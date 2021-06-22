<form method="post">
	<div class="control-group">
		<label class="control-label">Mata Kuliah</label>
		<div class="controls">
			<?php
				$q = mysqli_query($conn, "SELECT * from mata_kuliah ORDER BY kode_mata_kuliah");
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
			<input type="submit" name="simpan" class="btn btn-medium btn-primary" value="Cetak Data" />
		</div>
	</div>
</form>
<?php
	if(isset($_POST['simpan']))
	{
		echo "<script>window.location='".$baseurl."pages/web/lapabsen.php?semester=".$_POST['semester']."&blnadd=6&tipe=MAHASISWA&matkul=".$_POST['matkul']."'</script>";
	}
?>