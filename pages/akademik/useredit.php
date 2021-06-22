<?php
	ob_start();
	if(isset($_GET['id']))
	{
		$rs = mysqli_query($conn, "Select * from user_login where sha1(username)='".$_GET['id']."'");
		$row = mysqli_fetch_array($rs);
?>
<form name="form1" method="post" action="?cat=akademik&page=useredit&id=<?php echo $_GET['id']; ?>&edit=1">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="36%">Username</td>
      <td width="64%"><label for="username"></label>
      <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>" disabled="disabled"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password" id="password" value="<?php echo $row['password']; ?>"></td>
    </tr>
    <tr>
      <td>Jenis Login</td>
      <td> <select name="jenis" id="jenis">
		   <option value="akademik">Akademik</option>
		   <option value="mahasiswa">Mahasiswa</option>
		   <option value="dosen">Dosen</option>
		   </select></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary" name="button" id="button" value="Ubah">&nbsp;&nbsp;<input type="button" class="btn btn-danger" name="reset" id="reset" value="Cancel" onclick="window.location='?cat=akademik&page=user'"></td>
    </tr>
  </table>
</form>
<?php
	ob_end_flush();
	}
	else
	{
		echo "<script>window.location='?cat=akademik&page=user'</script>";
	}
?>
<?php
	if(isset($_GET['edit']))
	{		
		$rs = mysqli_query($conn, "Update user_login SET password='".$_POST['password']."',login_hash='".$_POST['jenis']."' Where sha1(username)='".$_GET['id']."'");
		if($rs)
		{
			echo "<script>window.location='?cat=akademik&page=user'</script>";
		}
	}
?>
