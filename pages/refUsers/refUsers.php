<?php

class refUsersObj extends configClass
{
    var $Prefix = 'refUsers';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'users'; //bonus
    var $TblName_Hapus = 'users';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'users Produk';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'refUsers.xls';
    var $namaModulCetak = 'ADMINISTRASI';
    var $Cetak_Judul = 'users Produk';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'refUsersForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0
    var $userName = ''; //0

    function setTitle()
    {
        return 'MEMBER';
    }

    function filterSaldoMiring()
    {
        return "";
    }
    function setMenuEdit()
    {
      // fujinFabMenu(id,href,title,img,style);
       $fabMenu = '';
       // $fabMenu .= fujinFabMenu('','Baru()','Baru','sections.png','',$this->Prefix);
       $fabMenu .= fujinFabMenu('','Edit()','Edit','edit_f2.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','Hapus()','Hapus','delete_f2.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','cetakAll()','Cetak','print.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','Invoice()','Invoice','print.png','',$this->Prefix);

       return $fabMenu;
    }
    function setMenuView()
    {
        return "";

    }
    function saveNew()
    {
        global $HTTP_COOKIE_VARS;
        global $Main;
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $cek     = '';
        $err     = '';
        $content = '';
        $json    = TRUE;

        if (empty($namaMember)) {
            $err = "Isi Nama ";
        } elseif (empty($emailMember)) {
            $err = "Isi Email";
        }

        if ($err == '') {

            $dataInsert  = array(
                'nama' => $namaMember,
                'email' => $emailMember,
                'alamat' => $alamatMember,
                'nomor_telepon' => $teleponMember,
                'nama_bank' => $namaBank,
                'nomor_rekening' => $nomorRekening,
                'nama_rekening' => $namaRekening,
                'upline_level_1' => "0",
                'upline_level_2' => "0",
                'upline_level_3' => "0",
                'upline_level_4' => "0",
                'tanggal_join' => date("Y-m-d"),
                'lisensi' => "BASIC",
            );
            $queryInsert = sqlInsert('users', $dataInsert);
            sqlQuery($queryInsert);

            $getIdMember = sqlArray(sqlQuery("select max(id) from users where email='$emailMember'"));
            $dataUsers = array(
              "id_users" => $getIdMember['max(id)'],
              "email" => $emailMember,
              "password" => md5("123456"),
              "status" => "AKTIF",
              "hak_akses" => "MEMBER",
              "online" => "0",
            );
            sqlQuery(sqlInsert("users",$dataUsers));

            $cek = $queryInsert;
        }

        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }
    function saveEdit()
    {
        global $HTTP_COOKIE_VARS;
        global $Main;
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $cek     = '';
        $err     = '';
        $content = '';
        $json    = TRUE;

        $fmST  = $_REQUEST[$this->Prefix . '_fmST'];
        $idplh = $_REQUEST[$this->Prefix . '_idplh'];


        if ($err == '') {
          if(empty($passwordUser)){
            $dataUpdate  = array(
                'status' => $statusUser,
                'hak_akses' => $hakAkses,
            );
          }else{
            $dataUpdate  = array(
                'status' => $statusUser,
                'hak_akses' => $hakAkses,
                'password' => md5($passwordUser),
            );
          }

          $queryUpdate = sqlUpdate('users', $dataUpdate,"id = '$idEdit'");
          sqlQuery($queryUpdate);
          $cek = $queryUpdate;
        }

        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }

    function set_selector_other2($tipe)
    {
        global $Main;
        $cek     = '';
        $err     = '';
        $content = '';
        $json    = TRUE;

        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content,
            'json' => $json
        );
    }

    function set_selector_other($tipe)
    {
        global $Main;
        $cek     = '';
        $err     = '';
        $content = '';
        $json    = TRUE;

        switch ($tipe) {

            case 'Baru': {
                $fm      = $this->Baru();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }
            case 'Edit': {
                $fm      = $this->Edit();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }
            case 'saveNew': {
                $get     = $this->saveNew();
                $cek     = $get['cek'];
                $err     = $get['err'];
                $content = $get['content'];
                break;
            }
            case 'saveEdit': {
                $get     = $this->saveEdit();
                $cek     = $get['cek'];
                $err     = $get['err'];
                $content = $get['content'];
                break;
            }
            default: {
                $other   = $this->set_selector_other2($tipe);
                $cek     = $other['cek'];
                $err     = $other['err'];
                $content = $other['content'];
                $json    = $other['json'];
                break;
            }

        } //end switch

        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content,
            'json' => $json
        );
    }

    function setPage_OtherScript()
    {
        $scriptload = "<script>
						$(document).ready(function(){

							" . $this->Prefix . ".loading();

						});
					</script>";
        return "
        <script type='text/javascript' src='js/refUsers/refUsers.js' language='JavaScript' ></script>
" . $scriptload;

    }

    function Baru()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'md'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Baru';
        // $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusUser', $statusUser, $arrayStatus, '-- STATUS --', "");
        $arrayHakAkses = array(
          array("ADMIN","ADMIN"),
          array("MEMBER","MEMBER"),
        );
        $comboHakAkses = cmbArray('hakAkses', $hakAkses, $arrayHakAkses, '-- HAK AKSES --', "");
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Email','emailUser',$emailUser,'12','3','9'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Password','passwordUser',$passwordUser,'12','3','9'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Hak Akses',$comboHakAkses,'12','3','9'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Status',$comboStatus,'12','3','9'),
                               ));


        $this->form_fields =  "<div class='FilterBar row' style='padding: 1%;margin-top:5px;'>".$fieldInform."</div>";

        $this->form_menubawah =

        "<input type='button' class='btn btn-success btn-sm' value='Simpan' onclick ='" . $this->Prefix .".saveNew()' > ".
        "<input type='button' class='btn btn-success btn-sm' value='Tutup' onclick ='" . $this->Prefix .".Close()' >"

        ;

        $form    = $this->genForm();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }
    function Edit()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'md'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Edit';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getDataMember = sqlArray(sqlQuery("select * from users where id = '".$idEdit[0]."'"));

        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusUser', $getDataMember['status'], $arrayStatus, '-- STATUS --', "");
        $arrayHakAkses = array(
          array("ADMIN","ADMIN"),
          array("MEMBER","MEMBER"),
        );
        $comboHakAkses = cmbArray('hakAkses', $getDataMember['hak_akses'], $arrayHakAkses, '-- HAK AKSES --', "");
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Email','emailUser',$getDataMember['email'],'12','3','9'," readonly"),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Password','passwordUser','','12','3','9'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Hak Akses',$comboHakAkses,'12','3','9'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Status',$comboStatus,'12','3','9'),
                               ));

        $this->form_fields =  "<div class='FilterBar row' style='padding: 1%;margin-top:5px;'>".$fieldInform."</div>";

        $this->form_menubawah =

        "<input type='button' class='btn btn-success btn-sm' value='Simpan' onclick ='" . $this->Prefix .".saveEdit(".$idEdit[0].")' > ".
        "<input type='button' class='btn btn-success btn-sm' value='Tutup' onclick ='" . $this->Prefix .".Close()' >"

        ;

        $form    = $this->genForm();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }
    function genForm($withForm=TRUE, $params=NULL, $center=TRUE){
  		$form_name = $this->Prefix.'_form';
  			$form= "<form name='$form_name' id='$form_name' method='post' action=''>".
  				createDialog(
  					$form_name.'_div',
  					$this->form_fields,
  					$this->form_width,
  					'auto',
  					$this->form_caption,
  					$this->ukuran,
  					'',
  					$this->form_menubawah.
  					"<input type='hidden' id='".$this->Prefix."_idplh' name='".$this->Prefix."_idplh' value='$this->form_idplh' >
  					<input type='hidden' id='".$this->Prefix."_fmST' name='".$this->Prefix."_fmST' value='$this->form_fmST' >"
  					,//$this->setForm_menubawah_content(),
  					$this->form_menu_bawah_height,'',$params).
  				"</form>";
  		if($center){
  			$form = centerPage( $form );
  		}
  		return $form;
  	}






    function setPage_HeaderOther()
    {
        return "";
    }

    //daftar =================================
    function setKolomHeader($Mode = 1, $Checkbox = '')
    {
        $NomorColSpan = $Mode == 1 ? 2 : 1;
        $headerTable  = "<thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01'  width='5'  style='text-align:center;vertical-align:middle;'>No.</th>
      	   $Checkbox
    		   <th class='th01'  width='100'   style='text-align:center;vertical-align:middle;'>EMAIL</th>
    		   <th class='th01'  width='100'   style='text-align:center;vertical-align:middle;'>NAMA</th>
    		   <th class='th01'  width='100'   style='text-align:center;vertical-align:middle;'>HAK AKSES</th>
    		   <th class='th01'  width='100'   style='text-align:center;vertical-align:middle;'>STATUS</th>
    		   <th class='th01'  width='100'   style='text-align:center;vertical-align:middle;'>ONLINE</th>
    	   </tr>
	        </thead>";

        return $headerTable;
    }

    function setKolomData($no, $isi, $Mode, $TampilCheckBox)
    {
        global $Ref;
        foreach ($isi as $key => $value) {
            $$key = $value;
        }
        $Koloms   = array();
        $Koloms[] = array(
            'align="center" valign="middle"',
            $no . '.'
        );

        if ($Mode == 1)
            $Koloms[] = array(
                " align='center'  ",
                $TampilCheckBox
            );
        $getDataMember = sqlArray(sqlQuery("select * from member where id = '$id_member'"));
        $Koloms[] = array(
            'align="left" valign="middle"',
            $email
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nama']
        );

        $Koloms[] = array(
            'align="left" valign="middle"',
            $status
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $hak_akses
        );
        if($online == "1"){
          $statusOnline = "ONLINE";
        }else{
          $statusOnline = "OFFLINE";
        }
        $Koloms[] = array(
            'align="left" valign="middle"',
            $statusOnline
        );



        return $Koloms;
    }


    function genDaftarOpsi()
    {
        global $Ref, $Main;
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }

        if (empty($jumlahData)){
          $jumlahData = 50;
        }
        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "");
        $arrayHakAkses = array(
          array("ADMIN","ADMIN"),
          array("MEMBER","MEMBER"),
        );
        $comboHakAkses = cmbArray('filterHakAkses', $filterHakAkses, $arrayHakAkses, '-- HAK AKSES --', "");
        // $this->textBoxColumn('title','id','value','col_field','col_label','col_input');
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama','filterNama',$filterNama,'4','5','7'),
                                $this->textBoxColumn('Email','filterEmail',$filterEmail,'4','5','7'),
                               ));

        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Hak Akses',$comboHakAkses,'4','5','7'),
                                $this->customColumn('Status',$comboStatus,'4','5','7'),
                               ));


        $TampilOpt         =
        "<div class='collapse' id='fillterContent-".$this->Prefix."' role='tabpanel' aria-labelledby='headingOne-3'>
         <div class='FilterBar row' style='margin-top:5px;'>" . "
          ".$fieldInform."

        </div>
        </div>".
        //Tidak Direkomendasikan custom Style Div class colums!
        "<div class='row'>
            <div class='col-md-4'>
              <div class='form-group row'>
                <label class='col-sm-5 col-form-label'>Jumlah Data</label>
                <div class='col-sm-7'>
                  <input type='text' class='form-control'  name='jumlahData' id ='jumlahData' value='$jumlahData'>
                </div>
              </div>
            </div>

            <div class='col-md-8'>
              <div class='form-group row'>
                <div class='col-sm-9'>
                  <input class='btn btn-success' type='button' value='Tampilkan' onclick= $this->Prefix.refreshList(true);>
                </div>
              </div>
            </div>
          </div> ";
        //END

        return array(
            'TampilOpt' => $TampilOpt
        );
    }


    function getDaftarOpsi($Mode = 1)
    {
        global $Main, $HTTP_COOKIE_VARS;
        $UID = $_COOKIE['coID'];
        //kondisi -----------------------------------
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $arrKondisi = array();
        if (!empty($filterNama)) {
            $getDataMember = sqlQuery("select * from member where nama like '%$filterNama%'");
            while ($dataMember = sqlArray($getDataMember)) {
              $arrayIdMember[] = $dataMember['id'];
            }
            $arrKondisi[] = "id_member in (".implode(',',$arrayIdMember).") ";
        }
        if (!empty($filterEmail)) {
            $arrKondisi[] = "email like '%$filterEmail%'" ;
        }
        if (!empty($filterStatus)) {
            $arrKondisi[] = "status = '$filterStatus'";
        }
        if (!empty($filterHakAkses)) {
            $arrKondisi[] = "hak_akses = '$filterHakAkses'";
        }


        $Kondisi = join(' and ', $arrKondisi);
        $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;

        //Order -------------------------------------
        $fmORDER1  = cekPOST('fmORDER1');
        $fmDESC1   = cekPOST('fmDESC1');
        $Asc1      = $fmDESC1 == '' ? '' : 'desc';
        $arrOrders = array();
        $arrOrders[] = " id desc ";
        $Order        = join(',', $arrOrders);
        $OrderDefault = '';
        $Order        = $Order == '' ? $OrderDefault : ' Order By ' . $Order;

        if (empty($jumlahData))
            $jumlahData = 50;
        $this->pagePerHal = $jumlahData;
        $Main->PagePerHal = $jumlahData;
        $pagePerHal       = $this->pagePerHal == '' ? $Main->PagePerHal : $this->pagePerHal;
        $HalDefault       = cekPOST($this->Prefix . '_hal', 1);
        $Limit            = " limit " . (($HalDefault * 1) - 1) * $pagePerHal . "," . $pagePerHal;
        $Limit            = $Mode == 3 ? '' : $Limit;
        $NoAwal           = $pagePerHal * (($HalDefault * 1) - 1);
        $NoAwal           = $Mode == 3 ? 0 : $NoAwal;

        return array(
            'Kondisi' => $Kondisi,
            'Order' => $Order,
            'Limit' => $Limit,
            'NoAwal' => $NoAwal
        );

    }

    function genRowSum($ColStyle, $Mode, $Total){
  			foreach ($_REQUEST as $key => $value) {
  			  	$$key = $value;
  			 }
        // $arrayKondisi = $this->getDaftarOpsi(1);
        // $getTotal = sqlArray(sqlQuery("select sum(total) from users ".$arrayKondisi['Kondisi']));
        // if($tipe == 'cetak_all'){
        //   $ContentTotalHal =
    		// 	"<tr>
    		// 		<td class='$ColStyle' colspan='9' align='center'><b>Total </td>
    		// 		<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(total)'] )."</td>
    		// 		<td class='GarisDaftar' align='right'></td>
    		// 		<td class='GarisDaftar' align='right'></td>
    		// 	</tr>" ;
        // }else{
        //   $ContentTotalHal =
    		// 	"<tr>
    		// 		<td class='$ColStyle' colspan='10' align='center'><b>Total </td>
    		// 		<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(total)'] )."</td>
    		// 		<td class='GarisDaftar' align='right'></td>
    		// 		<td class='GarisDaftar' align='right'></td>
    		// 	</tr>" ;
        // }

  			return $ContentTotalHal;
  		}



      function Hapus($ids){
    		$err=''; $cek='';
    		//$cid= $POST['cid'];
    		//$err = ''.$ids;
    		for($i = 0; $i<count($ids); $i++)	{
    			$err = $this->Hapus_Validasi($ids[$i]);
          sqlQuery("delete from users where id_users = '".$ids[$i]."'");
    			if($err ==''){
    				$get = $this->Hapus_Data($ids[$i]);
    				$err = $get['err'];
    				$cek.= $get['cek'];
    				if ($errmsg=='') {
    					$after = $this->Hapus_Data_After($ids[$i]);
    					$err=$after['err'];
    					$cek=$after['cek'];
    				}
    				if ($err != '') break;

    			}else{
    				break;
    			}
    		}
    		return array('err'=>$err,'cek'=>$cek);
    	}

}
$refUsers = new refUsersObj();
$refUsers->userName = $_COOKIE['coID'];;
?>
