<?php

//include ('/pages/menubar_kanatas.php');//menu bar kanan atas

switch($Pg) //gambar header
{
	case "01":$Main->ImageLeft="tempate_01.gif";break;
	case "02":$Main->ImageLeft="pengadaan_01.gif";break;
	case "03":$Main->ImageLeft="penerimaan_01.gif";break;
	case "04":$Main->ImageLeft="penggunaan_01.gif";break;
	case "05":$Main->ImageLeft="penatausahaan_01.gif";break;
	case "06":$Main->ImageLeft="pemanfaatan_01.gif";break;
	case "07":$Main->ImageLeft="pengamanan_01.gif";break;
	case "08":$Main->ImageLeft="penilaian_01.gif";break;
	case "09":$Main->ImageLeft="penghapusan_01.gif";break;
	case "10":$Main->ImageLeft="pemindahtanganan_01.gif";break;
	case "11":$Main->ImageLeft="pembiayaan_01.gif";break;
	case "12":$Main->ImageLeft="tuntunan_01.gif";break;
	case "13":$Main->ImageLeft="pengawasan_01.gif";break;
	case "ref":$Main->ImageLeft="masterData_01.gif";break;
	case "Admin":$Main->ImageLeft="administrasi_01.gif";break;
	//case "Menu":$Main->ImageLeft="administrasi_01.gif";break;
	case "15":$Main->ImageLeft="penggunaan_01.gif";break;

}
$chatPage='?Pg=Menu&SPg=01';//'?Pg=Admin&SPg=04';
//$chatPage = '';
$chat_menu=
	"<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a id='chat_alert' style='background: no-repeat url(images/administrator/images/message_24_off.png);	
									width:24;height:24;display: inline-block;position:absolute' 
								 target='_blank' href='$chatPage' title='Chat' > 											
						</a>
	</div>";
//$chat_menu="";

$judulPage =trim($Main->Modul[$Pg][1]);
if( $Pg=='05' && $_GET['SPg'] =='belumsensus'  ) $judulPage = 'Sensus Barang';



$Main->Base = "

	<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
	<html xmlns=\"http://www.w3.org/1999/xhtml\">
	<head>
	<title><!--JUDUL--> {$HTTP_COOKIE_VARS['coNama']}</title>
	<meta name='format-detection' content='telephone=no' />
	<META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW' />
	<!--  
	<link rel=\"stylesheet\" href=\"css/template_css.css\" type=\"text/css\" />
	<link rel=\"stylesheet\" href=\"css/theme.css\" type=\"text/css\" />
	<link rel=\"stylesheet\" href=\"dialog/dialog.css\" type=\"text/css\" />
	<link rel=\"stylesheet\" href=\"lib/chatx/chatx.css\" type=\"text/css\" />
	<link rel='stylesheet' href='css/menu.css' type='text/css' />
	
	<script language=\"JavaScript\" src=\"lib/js/JSCookMenu_mini.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"lib/js/ThemeOffice/theme.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"lib/js/joomla.javascript.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"js/ajaxc2.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"dialog/dialog.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"js/base.js\" type=\"text/javascript\"></script>
	<script language=\"JavaScript\" src=\"lib/chatx/chatx.js\" type=\"text/javascript\"></script>
	-->
	
	$Main->HeadStyle 
	$Main->HeadScript
	

	  <!-- calendar stylesheet -->
	  <link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"js/jscalendar-1.0/calendar-win2k-cold-1.css\" title=\"win2k-cold-1\" />

	  <!-- main calendar program -->
	  <script type=\"text/javascript\" src=\"js/jscalendar-1.0/calendar.js\"></script>

	  <!-- language for the calendar -->
	  <script type=\"text/javascript\" src=\"js/jscalendar-1.0/lang/calendar-id.js\"></script>

	  <!-- the following script defines the Calendar.setup helper function, which makes
		   adding a calendar a matter of 1 or 2 lines of code. -->
	  <script type=\"text/javascript\" src=\"js/jscalendar-1.0/calendar-setup.js\"></script>
	  
	  <script type=\"text/javascript\">
	  	
	  
	  </script>

	
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
	<meta name=\"Generator\" content=\"Joomla! Content Management System\" />
	<link rel=\"shortcut icon\" href=\"http://localhost:90/dkk/images/favicon.ico\" />

	</head>
	<body style='overflow: auto' onload=\"cek_notify('".$HTTP_COOKIE_VARS['coID']."')\">
	
	

	<table width=\"100%\" height=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border='0' style='position:relative;top:0'>	
	<tr  height=30><td valign=top>
		<!-- page title -->
		<table width=\"100%\" class=\"menubar\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
		<tr><td background=\"images/bg.gif\">
			<div id='pagetitle'>
					
					<table width=\"100%\" > <tr>
					<td width=30>
						<img src=\"images/administrator/images/user_group_2.png\" height=\"30\" width=\"20\" />
					</td>
					<td  >".$judulPage."</td>
					<td align='right' >
						<!--menubar_kanatas-->
						<table><tr><td>
						
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/logout_24.png);	
									width:24;height:24;display: inline-block;position:absolute' href='index.php?Pg=LogOut' title='Logout'> 											
						</a>
						</div>".
						
						/*"<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/search_24.png);	
									width:24;height:24;display: inline-block;position:absolute' target='_blank' href='viewer.php' title='Pencarian Data'> 				
							
						</a>
						</div>".*/
						
						"<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/help_f2_24.png);	
									width:24;height:24;display: inline-block;position:absolute' 
									href='pages.php?Pg=userprofil' title='User Profile'> 											
						</a>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/user_group_2.png);	
									width:24;height:24;display: inline-block;position:absolute' 
									href='index.php?Pg=Admin&SPg=01' title='Administrasi User'> 											
						</a>
						</div>
						
						$chat_menu
						
						<div style='margin:0 4 0 4;width:2;height:24;float:right;position:relative;background-color:grey'>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/payment.png);	
							width:24;height:24;display: inline-block;position:absolute' 
							href='pages.php?Pg=rekapbonus' title='Pembayaran Bonus'> 											
						</a>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/money_bag.png);	
							width:24;height:24;display: inline-block;position:absolute' 
							href='pages.php?Pg=daftarbonus' title='Bonus'> 											
						</a>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/jaringan_mlm.png);	
							width:24;height:24;display: inline-block;position:absolute' 
							href='pages.php?Pg=jaringan' title='Jaringan'> 											
						</a>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/member-icon.png);	
							width:24;height:24;display: inline-block;position:absolute' 
							href='pages.php?Pg=daftarmember' title='Anggota'> 											
						</a>
						</div>
						
						<div style='margin:0 4 0 4;width:24;height:24;float:right;position:relative'>
						<a style='background: no-repeat url(images/administrator/images/forms.png);	
							width:24;height:24;display: inline-block;position:absolute' 
							href='pages.php?Pg=pendaftaran' title='Pendaftaran'> 											
						</a>
						</div>".
						
						//$chat_menu
						
						"</td></tr></table>
						
					</td>
					</tr>
					</table>
										
					
					
			</div>
					
					
					
		</td></tr>
		</table>
	</td></tr>
	
	<tr height=*>
	<td vAlign=top >
		<div id=\"header\"></div>
			<!--NAVATAS-->
				
			<div align=\"center\" class=\"centermain\">
				<div class=\"main\">
				<!---isi_-->
				<!--ISI-->
				<!-- end isi -->
				</div>	
			</div>		
	</td></tr>
	
	<tr>
		<td vAlign=bottom>
			<!---navbawah_-->
			<!--NAVBAWAH-->
			<div id=\"footer\"><center><!--COPYRIGHT--></div>
		</td>
	</tr>
	</table>
	</body>
	</html>
";

?>
