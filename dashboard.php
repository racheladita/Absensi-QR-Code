<?php
	session_start();
	if(!isset($_SESSION['login_hash']))
	{
		echo "<script>window.location='index.php'</script>";
	}
	include("_db.php");
?>

<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nama_aplikasi; ?></title>
	<?php include("_scr.php"); ?>
</head>

<body>

<div class="mainwrapper fullwrapper">
	
    <!-- START OF LEFT PANEL -->
    <div class="leftpanel">
    	
        <div class="logopanel">
        	<h1><a href="dashboard.php"><?php echo $nama_usaha; ?></a></h1>
        </div><!--logopanel-->
        
        <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div>
    	
        <?php include("_main-nav.php"); ?> <!--NAVIGASI MENU UTAMA-->
    
    <!-- START OF RIGHT PANEL -->
    <div class="rightpanel">
    	<div class="headerpanel">
        	<a href="" class="showmenu"></a>
            <div class="headerright">
            	<span  style="color:#FFF">
                <?php 
					if($_SESSION['login_hash']=="mahasiswa")
					{
						echo "Selamat Datang Kembali ".$_SESSION['login_user'];
					}
				?>
                </span>
                <?php
					include("_userinfo.php"); 
				?>
            </div><!--headerright-->
    	</div><!--headerpanel-->
        
        <div class="breadcrumbwidget">
        	<ul class="breadcrumb">
                <li></li>
            </ul>
        </div> 
        <!--breadcrumbwidget-->
        
		<div class="pagetitle">
        	<h1><?php echo $nama_aplikasi; ?></h1>
        </div>
        
      <div class="maincontent">
       	<div class="contentinner content-dashboard">
                <div class="row-fluid"><!--span8-->
                <?php
					$v_cat = (isset($_REQUEST['cat'])&& $_REQUEST['cat'] !=NULL)?$_REQUEST['cat']:'';
					$v_page = (isset($_REQUEST['page'])&& $_REQUEST['page'] !=NULL)?$_REQUEST['page']:'';
					if(file_exists("pages/".$v_cat."/".$v_page.".php"))
					{
						include("pages/".$v_cat."/".$v_page.".php");
					}
					else
					{
						if($_SESSION['login_hash']=="mahasiswa" or $_SESSION['login_hash']=="dosen")
						{
							echo "<h1><strong>Selamat Datang di Absensi Digital Departemen Informatika FSM Universitas Diponegoro</strong></h1> 
								  <h4>Absensi digital berbasis web ini dibuat untuk mahasiswa dan dosen Program Studi Informatika Universitas Diponegoro. 
									  Aplikasi ini bertujuan untuk memudahkan para dosen dan mahasiswa dalam melakukan absensi sekaligus meminimalisir kecurangan absensi yang sering dilakukan oleh mahasiswa.</h4>
								  <br /><br />";
						}
						include("pages/web/homepage.php");
					}
				?>
                <!--span4-->
              </div>
                <!--row-fluid-->
          </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div><!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
    
	<!--FOOTER-->
    <?php include("_footer.php"); ?>
    
</div><!--mainwrapper-->
	<!--SLIDE NAVIGASI-->
    <?php include("_nav-slider.php"); ?>
</body>
</html>
