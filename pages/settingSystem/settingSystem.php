<?php

class settingSystemObj  extends configClass{
	var $Prefix = 'settingSystem';
	var $elCurrPage="HalDefault";
	var $SHOW_CEK = TRUE;
	var $TblName = 'setting'; //bonus
	var $TblName_Hapus = 'setting';
	var $MaxFlush = 10;
	var $TblStyle = array( 'koptable', 'cetak','cetak'); //berdasar mode
	var $ColStyle = array( 'GarisDaftar', 'GarisCetak','GarisCetak');
	var $KeyFields = array('id');
	var $FieldSum = array();//array('jml_harga');
	var $SumValue = array();
	var $FieldSum_Cp1 = array( 14, 13, 13);//berdasar mode
	var $FieldSum_Cp2 = array( 1, 1, 1);
	var $checkbox_rowspan = 1;
	var $PageTitle = 'settingSystem';
	var $PageIcon = 'images/administrasi_ico.png';
	var $pagePerHal ='';
	//var $cetak_xls=TRUE ;
	var $fileNameExcel='settingSystem.xls';
	var $namaModulCetak='settingSystem';
	var $Cetak_Judul = 'settingSystem';
	var $Cetak_Mode=2;
	var $Cetak_WIDTH = '30cm';
	var $Cetak_OtherHTMLHead;
	var $FormName = 'settingSystemForm';
	var $noModul=14;
	var $TampilFilterColapse = 0; //0

	function setTitle(){
		return 'SETTING';
	}
	function filterSaldoMiring(){
		return "";
	}
	function setMenuEdit(){
		return "
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.Edit()' title='Edit'>
	    					<img src='images/administrator/images/edit_f2.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Edit
	    				</a>
            </li>
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.Hapus()' title='Hapus'>
	    					<img src='images/administrator/images/delete_f2.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Hapus
	    				</a>
            </li>


						";
		return "";
	}
	function setMenuView(){
	return "";

}
	function simpan(){
	 global $HTTP_COOKIE_VARS;
	 global $Main;
	 foreach ($_REQUEST as $key => $value) {
			 $$key = $value;
		 }
	 $cek = ''; $err=''; $content=''; $json=TRUE;
	//get data -----------------
	 $fmST = $_REQUEST[$this->Prefix.'_fmST'];
	 $idplh = $_REQUEST[$this->Prefix.'_idplh'];

	 if(empty($nik)){
		 	$err  ="Isi NIK";
	 }elseif(empty($namaPegawai)){
		 	$err  ="Isi Nama Karyawan";
	 }elseif(empty($jenisKelamin)){
		 	$err  ="Pilih Jenis Kelamin";
	 }elseif(empty($alamatKaryawan)){
		 	$err  ="Isi Alamat";
	 }

			if($fmST == 0){
				if($err==''){
							$dataInsert = array(
													'nik' => $nik,
													'nama' => $namaPegawai,
													'kelamin' => $jenisKelamin,
													'alamat' => $alamatKaryawan,
													'nomor_hp' => $nomorHP,
							);
							$queryInsert = VulnWalkerInsert('setting',$dataInsert);
							sqlQuery($queryInsert);
							$cek = $queryInsert;
				}
			}else{
				if($err==''){
					$dataUpdate = array(
												'nik' => $nik,
												'nama' => $namaPegawai,
												'kelamin' => $jenisKelamin,
												'alamat' => $alamatKaryawan,
												'nomor_hp' => $nomorHP,
					);
					$queryUpdate = VulnWalkerUpdate('setting',$dataUpdate,"id = '".$idplh."'");
					sqlQuery($queryUpdate);
					$cek = $queryUpdate;
				}
			}

			return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
    }

	function set_selector_other2($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;

	 return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
	}

	function set_selector_other($tipe){
	 global $Main;
	 $cek = ''; $err=''; $content=''; $json=TRUE;

	  switch($tipe){

		case 'Baru':{
			$fm = $this->Baru();
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];
		break;
		}
		case 'Edit':{
			$cbid = $_REQUEST[$this->Prefix.'_cb'];
			$fm = $this->Edit($cbid[0]);
			$cek = $fm['cek'];
			$err = $fm['err'];
			$content = $fm['content'];
		break;
		}


		case 'saveNew':{
			foreach ($_REQUEST as $key => $value) {
					$$key = $value;
			}
			if(empty($idPegawai)){
				$err = "Pilih pegawai";
			}elseif(empty($tahunBerlaku)){
				$err = "Isi tahun berlaku";
			}
			if(empty($err)){
				if($this->sqlRowCount($this->sqlQuery("select * from $this->TblName where id_pegawai = '$idPegawai' and tahun_berlaku = '$tahunBerlaku'")) != 0){
					$err = "Data Pegawai Sudah ada";
				}
			}
			if(empty($err)){
				$dataInsert = array(
					"id_pegawai" => $idPegawai,
					"gaji_pokok" => $this->removeDot($gajiPokok),
					"tahun_berlaku" => $tahunBerlaku,
				);
				$queryInsert = sqlInsert("setting",$dataInsert);
				sqlQuery($queryInsert);
			}
			break;
    }
		case 'saveEdit':{
			foreach ($_REQUEST as $key => $value) {
					$$key = $value;
			}

			if(empty($err)){
				$dataUpdate = array(
					"value" => $valueSetting,
					"status" => $statusSetting,
					"keterangan" => $keteranganSetting,
				);
				$queryUpdate = sqlUpdate("setting",$dataUpdate,"id = '$idEdit'");
				$cek = $queryUpdate;
				sqlQuery($queryUpdate);
			}
			break;
    }

		 default:{
				$other = $this->set_selector_other2($tipe);
				$cek = $other['cek'];
				$err = $other['err'];
				$content=$other['content'];
				$json=$other['json'];
		 break;
		 }

	 }//end switch

		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content, 'json'=>$json);
   }

   function setPage_OtherScript(){
		$scriptload =
					"<script>
						$(document).ready(function(){
							".$this->Prefix.".loading();
						});
					</script>";
		return
			"
			<script type='text/javascript' src='js/settingSystem/settingSystem.js' language='JavaScript' ></script>
			<script type='text/javascript' src='js/popup/popupsettingSystem.js' language='JavaScript' ></script>
			".$this->loadCSS().
			$this->loadCalendar().

			$scriptload;
	}

	function Baru(){
	 global $SensusTmp;
	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';
	 $this->form_width = 600;
	 $this->form_height = 140;
   $this->form_caption = 'Baru';

	  $this->form_fields = array(

			'nik' => array(
						'label'=>'Pegawai',
						'labelWidth'=>100,
						'value'=> cmbQuery("idPegawai","","select id,nama from ref_pegawai", "onchange=$this->Prefix.clearId();", "-- PEGAWAI -- ")
						 ),
			'gajiPokok' => array(
						'label'=>'SETTING',
						'labelWidth'=>100,
						'value'=> $this->numberText(
							array(
								"id" => "gajiPokok",
							)
						)
					),
			'tahunBerlaku' => array(
						'label'=>'Tahun Berlaku',
						'labelWidth'=>100,
						'value'=> $this->textBox(
							array(
								"id" => "tahunBerlaku",
								"params" => "style = 'width:60px;' maxlength='4'",
							)
						)
					),
			);
		//tombol
		$this->form_menubawah =
			"<input type='hidden' id='idLogAbsensi' name='idLogAbsensi'>".
			"<input type='button' class='btn btn-success' value='Simpan' onclick ='".$this->Prefix.".saveNew()' title='Simpan'>&nbsp&nbsp".
			"<input type='button' class='btn btn-success' value='Batal' onclick ='".$this->Prefix.".Close()' >";

		$form = $this->genForm();
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}
	function Edit($idEdit){
	 global $SensusTmp;
	 $cek = ''; $err=''; $content='';
	 $json = TRUE;	//$ErrMsg = 'tes';
	 $form_name = $this->Prefix.'_form';
	 $this->form_width = 600;
	 $this->form_height = 200;
   $this->form_caption = 'Edit';
	 $getDataEdit = sqlArray(sqlQuery("select * from setting where id = '$idEdit'"));

	  $this->form_fields = array(

			'namaSetting' => array(
						'label'=>'Nama',
						'labelWidth'=>100,
						'value'=> $this->textBox(
							array(
								"id" => "namaSetting",
								"value" => $getDataEdit['nama'],
								"params" => "readOnly"
							)
						)
						 ),
			'valueSetting' => array(
						'label'=>'Value',
						'labelWidth'=>100,
						'value'=> $this->textBox(
							array(
								"id" => "valueSetting",
								"value" => $getDataEdit['value']
							)
						)
						 ),
			'statusSettig' => array(
						'label'=>'Status',
						'labelWidth'=>100,
						'value'=> cmbArray(
							"statusSetting",
							$getDataEdit['status'],
							array(
								array(
									"AKTIF","AKTIF"
								),
								array(
									"TIDAK AKTIF","TIDAK AKTIF"
								)
							)
						)
					),
			'keterangan' => array(
						'label'=>'Keterangan',
						'labelWidth'=>100,
						'value'=> $this->textArea(
							array(
								"id" => "keteranganSetting",
								"value" => $getDataEdit['keterangan']
							)
						)
					),
			);
		//tombol
		$this->form_menubawah =
			"<input type='button' class='btn btn-success' value='Simpan' onclick ='".$this->Prefix.".saveEdit($idEdit)' title='Simpan'>&nbsp&nbsp".
			"<input type='button' class='btn btn-success' value='Batal' onclick ='".$this->Prefix.".Close()' >";

		$form = $this->genForm();
		$content = $form;//$content = 'content';
		return	array ('cek'=>$cek, 'err'=>$err, 'content'=>$content);
	}


	function setPage_HeaderOther(){
	return
			"";
	}

	//daftar =================================
	function setKolomHeader($Mode=1, $Checkbox=''){
	 $NomorColSpan = $Mode==1? 2: 1;
	 $headerTable =
	  "<thead>
	   <tr>
  	   <th class='th01'  style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
			 $Checkbox
		   <th class='th01' style='text-align:center;vertical-align:middle;width:20%;'>NAMA SETTING</th>
		   <th class='th01'  style='text-align:center;vertical-align:middle;width:30%;'>VALUE</th>
		   <th class='th01'  style='text-align:center;vertical-align:middle;width:6%;'>STATUS</th>
		   <th class='th01'  style='text-align:center;vertical-align:middle;width:40%;'>KETERANGAN</th>
	   </tr>
	   </thead>";

		return $headerTable;
	}

	function setKolomData($no, $isi, $Mode, $TampilCheckBox){
	 global $Ref;
	 foreach ($isi as $key => $value) {
			 $$key = $value;
		 }
	 $Koloms = array();
	 $Koloms[] = array('align="center"', $no.'.' );
	 $Koloms[] = array('align="center"', $TampilCheckBox );
	 $Koloms[] = array('align="left" valign="middle"',$nama);
	 $Koloms[] = array('align="left" valign="middle"',$isi['value']);
	 $Koloms[] = array('align="center" valign="middle"',$status);
	 $Koloms[] = array('align="left" valign="middle"',str_replace("\n","<br>",$keterangan));
	 return $Koloms;
	}


	function genDaftarOpsi(){
	 global $Ref, $Main;
	 foreach ($_REQUEST as $key => $value) {
			$$key = $value;
		}
		$arrayOrder = array(
											 array('1','LAKI-LAKI'),
											 array('2','PEREMPUAN'),
		);
		if(empty($jumlahData))$jumlahData =50;
		 $TampilOpt =
				"<div class='FilterBar' style='margin-top:5px;'>".
				"<table style='width:100%'>
				<tr>
					<td>NOMOR INDUK KARYAWAN</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterNIK' id ='filterNIK' style='width:400px;' value='$filterNIK'>
					</td>
				</tr>
				<tr>
					<td>NAMA</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterNama' id ='filterNama' style='width:400px;' value='$filterNama'>
					</td>
				</tr>
				<tr>
					<td>TANGGAL</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterTanggal' id ='filterTanggal' style='width:400px;' value='$filterTanggal'>
					</td>
				</tr>
				<tr>
					<td>JUMLAH DATA</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control'  name='jumlahData' id ='jumlahData' style='width:100px;' value='$jumlahData' >
					</td>
				</tr>
		    <tr>
				<td></td>
				<td></td>
				<td style='width:86%;'>
				<input class='btn btn-success' type='button' value='Tampilkan' onclick= $this->Prefix.refreshList(true);>
				</td>
				</tr>
				</table>".
				"</div>"

				;


		return array('TampilOpt'=>$TampilOpt);
	}

	function getDaftarOpsi($Mode=1){
		global $Main, $HTTP_COOKIE_VARS;
		$UID = $_COOKIE['coID'];
		//kondisi -----------------------------------
		foreach ($_REQUEST as $key => $value) {
 			$$key = $value;
 		}
		$arrKondisi = array();
		if(!empty($filterNIK)){
				$arrKondisi[] = "nik_pegawai = '$filterNIK'";
		}
		if(!empty($filterNama)){
				$getDataPegawai = sqlQuery("select * from ref_pegawai where nama like '%$filterNama%'");
				while ($dataPegawai = sqlArray($getDataPegawai)) {
					$arrayIdPegawai[] = $dataPegawai['nik'];
				}
				$arrKondisi[] = " nik_pegawai in (".implode(',',$arrayIdPegawai).")";
		}
		if(!empty($filterTanggal)){
				$arrKondisi[] = "tanggal like '%".$this->generateDate($filterTanggal)."%'";
		}

		$Kondisi= join(' and ',$arrKondisi);
		$Kondisi = $Kondisi =='' ? '':' Where '.$Kondisi;
		//Order -------------------------------------
		$fmORDER1 = cekPOST('fmORDER1');
		$fmDESC1 = cekPOST('fmDESC1');
		$Asc1 = $fmDESC1 ==''? '': 'desc';
		$arrOrders = array();
		$Order= join(',',$arrOrders);
		$OrderDefault = '';// Order By no_terima desc ';
		$Order =  $Order ==''? $OrderDefault : ' Order By '.$Order;
		if(empty($jumlahData))$jumlahData=50;
		$this->pagePerHal = $jumlahData;
		$Main->PagePerHal = $jumlahData;
		$pagePerHal = $this->pagePerHal =='' ? $Main->PagePerHal: $this->pagePerHal;
		$HalDefault=cekPOST($this->Prefix.'_hal',1);
		$Limit = " limit ".(($HalDefault	*1) - 1) * $pagePerHal.",".$pagePerHal;
		$Limit = $Mode == 3 ? '': $Limit;
		$NoAwal= $pagePerHal * (($HalDefault*1) - 1);
		$NoAwal = $Mode == 3 ? 0: $NoAwal;
		return array('Kondisi'=>$Kondisi, 'Order'=>$Order ,'Limit'=>$Limit, 'NoAwal'=>$NoAwal);
	}

}
$settingSystem = new settingSystemObj();
?>
