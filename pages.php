<?php

ob_start("ob_gzhandler");
/* ganti selector di index */
include("common/vars.php");
include("config.php");


$Pg = isset($HTTP_GET_VARS["Pg"]) ? $HTTP_GET_VARS["Pg"] : "";

if (CekLogin () == false){

	$tipe = $_GET['tipe'];
	if($tipe==''){//bukan ajax
		header("Location:index.php?");
	}else{
		setcookie('coOff','1');
	}
}


    switch ($Pg) {
			case 'refMember':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refMember/refMember.php");
					$refMember->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'refUsers':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refUsers/refUsers.php");
					$refUsers->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'refCopywriting':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refCopywriting/refCopywriting.php");
					$refCopywriting->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}

	}

	ob_flush();
	flush();

?>
