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
			case 'dashboard':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/dashboard.php");
					$dashboard->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'refProduk':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refProduk/refProduk.php");
					$refProduk->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'refNews':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refNews/refNews.php");
					$refNews->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'refTraining':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refTraining/refTraining.php");
					$refTraining->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
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
			case 'refFunnel':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/refFunnel/refFunnel.php");
					$refFunnel->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'modulTransaksi':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/modulTransaksi/modulTransaksi.php");
					$modulTransaksi->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}
			case 'modulOmset':{
				if (CekLogin()) {  setLastAktif();
					include('common/daftarobj.php');
					include('common/configClass.php');
					include("pages/modulOmset/modulOmset.php");
					$modulOmset->selector();
				}else{
					header("Location:index.php?");
				}
				break;
			}

	}

	ob_flush();
	flush();

?>
