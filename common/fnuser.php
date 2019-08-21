<?php


Function UserLogin() {
	global $HTTP_POST_VARS,$HTTP_COOKIE_VARS,$HTTP_GET_VARS;


	$errmsg = ''; $errNo = 0;
	//-- get data
	$User = isset($HTTP_POST_VARS['user'])?$HTTP_POST_VARS['user']:"";
	$Pwd  = isset($HTTP_POST_VARS['password'])?$HTTP_POST_VARS['password']:"";

	//-- validasi
	if ($errmsg == '' && strpos($User, ' ') ){
		$errNo = 1;
		$errmsg = 'Nama User Salah! Ganti spasi dengan garis bawah!' ;}
	if ($errmsg == '' && strpos($User, ';')!== false ){
		$errNo = 2;
		$errmsg = 'Nama User Salah! Silahkan menghubungi users';}

	$aqry = "select * from users where email='".$User."' ";  //echo $aqry; //$aqry = "select * from users where email='$User';
	$Cek2 = sqlQuery($aqry);
	if ($errmsg == '' && sqlRowCount($Cek2)== false ){
		$errNo = 5;
		$errmsg = 'User tidak ada!';
	}


	if ($errmsg == ''){
		//-- cek user dgn password ini ada
		$aqry = "select * from users where email='".$User."' and password = md5('$Pwd') ";  //echo $aqry; //$aqry = "select * from users where email='$User';
		$Cek1 = sqlQuery($aqry);

		if(sqlRowCount($Cek1)) {
			//-- ambil data user
			$isi = sqlArray($Cek1);

			//-- cek user aktif
			//$Status = $isi['status']=="1" ? true:false; //user aktif
			$Status = true;
			//-- boleh masuk jika user aktif dan

		} else {
			$Status = false;
			$errNo = 5;
			$errmsg = "User dengan password ini tidak ada!";
		}
		if($Status) {

			$sesino = rand();
			setcookie('cosesino',$sesino);
			setcookie("coStatus", $Status);

			setcookie("coID",$User); setcookie("coNama",$Nama); setcookie("coSebagai",$Sebagai);

			//-- update info online, lastaktif
			$OnLine = sqlQuery("update users set online='1', sesino=".$sesino.", lastaktif=now(), ipaddr='".$_SERVER['REMOTE_ADDR']."'  where email='$User'");

			//-- update user aktif

		} else {
			//return $errmsg;// false;
		}
	}



	return $errmsg;
}

Function UserLogout() {
	global $HTTP_POST_VARS,$HTTP_GET_VARS,$HTTP_COOKIE_VARS;
	$OnLine = sqlQuery("update users set online='0' where email='{$HTTP_COOKIE_VARS['coID']}'");
	setcookie('cosesino');
	setcookie("coID");
	setcookie("coNama");
	setcookie("coSebagai");
	setcookie("coStatus");
	setcookie("coSKPD");
	setcookie("coUNIT");
	setcookie("coSUBUNIT");
	setcookie("coModul");
	setcookie("coLevel");

	//setcookie("coDlmRibu");
	return true;
}

function JmlOnLine() {
	global $USER_TIME_OUT;
	$n = 0;
	$n = sqlRowCount(sqlQuery("select * from users
				where online='1' and lastaktif <>''
				and TIMESTAMPDIFF(MINUTE,lastaktif,now()) < ".$USER_TIME_OUT));
	return $n;
}

function isUserTimeOut($user){
	global $USER_TIME_OUT;
	$isi = sqlArray( sqlQuery('select TIMESTAMPDIFF(MINUTE,lastaktif,now()) as diff from users where email="'.$user.'"  ') );
				//echo $isi['diff'].'<br>';
	if ($isi['diff'] >= $USER_TIME_OUT ){
		return true;
	}else{
		return FALSE;
	}
}

Function CekLogin($cekTimeOut=TRUE) {
	global $USER_TIME_OUT, $HTTP_COOKIE_VARS, $HTTP_GET_VARS,$HTTP_COOKIE_VARS;

	if (isset($HTTP_COOKIE_VARS['coStatus'])) {
		// echo 'select sesino from users where email="'.$HTTP_COOKIE_VARS['coID'].'"  ';

		if($HTTP_COOKIE_VARS['coStatus']) {
			$user = $HTTP_COOKIE_VARS['coID'];

			$isi = sqlArray( sqlQuery('select online from users where email="'.$user.'"  ') );
			//echo 'ol='.$isi['online'].'<br>';
			if($isi['online'] == '1'){
				//jika online, cek time out
				if (isUserTimeOut( $user )==false ){
					//jika belum timeout, cek sesi
					$sesino = $HTTP_COOKIE_VARS['cosesino']; //echo $sesino;
					$isi2 = sqlArray( sqlQuery('select sesino from users where email="'.$user.'"  ') );
					if ($isi2['sesino'] != $sesino){
						//jika beda sesi return false (harus login)
						return FALSE; //beda sesi
					}else{
						return TRUE;

					}
				}else{
					if ($cekTimeOut) {
						return FALSE; //sudah timeout
					}else{
						return TRUE;
					}
				}

			} else {
				return false; //sudah logoff
			}
		} else {
			return false; //sudah logoff
		}
	}else{
		return false;
	}
}


function login_cekPasword($userID, $pass){
	$errmsg = '';



	$sqry = 'select * from users where email="'.$userID.'"';
	$row = sqlArray(sqlQuery($sqry));
	return ($row['password'] == md5($pass) );
}

function login_cekUserBaru($userID){
	$errmsg = '';

	$sqry = 'select * from users where email="'.$userID.'"';
	$row = sqlRowCount(sqlQuery($sqry));

	//if (($errmsg =='')&&($row==0)){$errmsg = 'Nama User tidak ada!';}
	//if (($errmsg =='')&&( cekPasword($userID, $pass) = FALSE )){$errmsg = 'Password Salah!';}
	//if ($errmsg ==''){}
	//return $errmsg
	return $row==0;
}

function login_getUser(){
	global $HTTP_POST_VARS,$HTTP_COOKIE_VARS,$HTTP_GET_VARS;
	//$User = $HTTP_COOKIE_VARS['coID'];
	$User =$_COOKIE['coID'];
	return $User;
}

function login_getGroup(){
	global $HTTP_POST_VARS,$HTTP_COOKIE_VARS,$HTTP_GET_VARS;
	$Group =$_COOKIE['coGroup'];
	return $Group;
}

function login_setUserCo($User){
	global $HTTP_POST_VARS,$HTTP_COOKIE_VARS,$HTTP_GET_VARS;
	//setcookie('coID',$User);//$User = $HTTP_COOKIE_VARS['coID'];
	setcookie("coID",$User);//$HTTP_COOKIE_VARS['coID']:= $User;

	//return $User;
}

function login_getName(){
	global $HTTP_POST_VARS,$HTTP_COOKIE_VARS,$HTTP_GET_VARS;
	$name = $HTTP_COOKIE_VARS['coNama'];
	return $name;
}

function login_simpan($oldemail, $email, $pass, $namel){
	global $cek;
	$sqry = 'update users
			set email="'.$email.'",
			  password="'.md5($pass).'",
			  nama ="'.$namel.'",
			  online= 0
			where email="'.$oldemail.'" limit 1';
	$cek .='<br> sqrysimpan='.$sqry;
	$row = sqlQuery($sqry);
}


?>
