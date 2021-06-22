<?php
if(isset($_SESSION['login_hash']))
{
	if($_SESSION['login_hash']!="dosen")
	{
		echo "<script>window.location='?cat=web&page=logout'</script>";
	}
}
?>