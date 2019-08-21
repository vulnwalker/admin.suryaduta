<?php

class refArtikelObj extends configClass
{
    var $Prefix = 'refArtikel';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'artikel'; //bonus
    var $TblName_Hapus = 'artikel';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'refArtikel';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'refArtikel.xls';
    var $namaModulCetak = 'refArtikel';
    var $Cetak_Judul = 'refArtikel';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'refArtikelForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0

    function setTitle()
    {
        return 'ARTIKEL';
    }
    function filterSaldoMiring()
    {
        return "";
    }
    function setMenuEdit()
    {
        return "
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.Baru()' title='Baru'>
	    					<img src='images/administrator/images/sections.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Baru
	    				</a>
            </li>
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

        $fmST  = $_REQUEST[$this->Prefix . '_fmST'];
        $idplh = $_REQUEST[$this->Prefix . '_idplh'];
        if (empty($judulArtikel)) {
            $err = "Isi Judul Artikel";
        } elseif (empty($isiArtikel)) {
            $err = "Isi Artikel";
        } elseif (empty($tanggalArtikel)) {
            $err = "Isi Tanggal Artikel";
        } elseif (empty($statusArtikel)) {
            $err = "Pilih Status Artikel";
        }


        if ($err == '') {
            $dataInsert  = array(
                'judul' => $judulArtikel,
                'isi_artikel' => base64_encode($isiArtikel),
                'tanggal' => $this->generateDate($tanggalArtikel),
                'status' => $statusArtikel,
            );
            $queryInsert = sqlInsert('artikel', $dataInsert);
            sqlQuery($queryInsert);
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
        if (empty($judulArtikel)) {
            $err = "Isi Judul Artikel";
        } elseif (empty($isiArtikel)) {
            $err = "Isi Artikel";
        } elseif (empty($tanggalArtikel)) {
            $err = "Isi Tanggal Artikel";
        } elseif (empty($statusArtikel)) {
            $err = "Pilih Status Artikel";
        }


        if ($err == '') {
					$dataUpdate  = array(
            'judul' => $judulArtikel,
            'isi_artikel' => base64_encode($isiArtikel),
            'tanggal' => $this->generateDate($tanggalArtikel),
            'status' => $statusArtikel,
          );
          $queryUpdate = sqlUpdate('artikel', $dataUpdate,"id = '$idEdit'");
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
        return "<script type='text/javascript' src='js/refArtikel/refArtikel.js' language='JavaScript' ></script>

        <script src='js/thead.js'></script>
        <script src='js/jquery.fixedTableHeader.js'></script>

            <script type='text/javascript' language='JavaScript'  src='js/textboxio/textboxio.js'></script>
        " .			$this->loadCalendar().
        "



" . $scriptload;
    }





    function Baru()
    {

        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 500;
        $this->form_height  = 320;
        $this->form_caption = 'Baru';

        $arrayStatus          = array(
            array(
                'AKTIF',
                'AKTIF'
            ),
            array(
                'TIDAK AKTIF',
                'TIDAK AKTIF'
            )
        );
        $comboStatus    = cmbArray('statusArtikel', "AKTIF", $arrayStatus, '-- STATUS --', "");
        //items ----------------------
        $this->form_fields    = array(

            'judul' => array(
                'label' => 'Judul',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'judulArtikel' id = 'judulArtikel' class='form-control'  >"
            ),
            'isiArtikel' => array(
                'label' => 'Isi Artikel',
                'labelWidth' => 100,
                'value' => "<textarea  style='height: 800px;' name = 'isiArtikel' id = 'isiArtikel'   > </textarea>",
                "type" => "merge"
            ),
            'tanggalArtikel' => array(
                'label' => 'Tanggal Artikel',
                'labelWidth' => 100,
                'value' => "<input type='text'  class='date' name = 'tanggalArtikel' id = 'tanggalArtikel' class='form-control' value='".$this->generateDate(date("Y-m-d"))."'  >"
            ),
            'status' => array(
                'label' => 'Status',
                'labelWidth' => 100,
                'value' =>
                $comboStatus
            ),

        );
        //tombol
        $this->form_menubawah = "<input type='button' class='btn btn-success' value='Simpan' onclick ='" . $this->Prefix . ".saveNew()' title='Simpan'>&nbsp&nbsp" . "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm2();
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
				$this->form_width   = 500;
        $this->form_height  = 320;
        $this->form_caption = 'Edit';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getData            = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idEdit[0] . "'"));
        foreach ($getData as $key => $value) {
            $$key = $value;
        }
        $arrayStatus          = array(
            array(
                'AKTIF',
                'AKTIF'
            ),
            array(
                'TIDAK AKTIF',
                'TIDAK AKTIF'
            )
        );
        $comboStatus    = cmbArray('statusArtikel', "AKTIF", $arrayStatus, '-- STATUS --', "");
        //items ----------------------
        $this->form_fields    = array(

            'judul' => array(
                'label' => 'Judul',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'judulArtikel' id = 'judulArtikel' class='form-control' value='$judul'  >"
            ),
            'isiArtikel' => array(
                'label' => 'Isi Artikel',
                'labelWidth' => 100,
                'value' => "<textarea  style='height: 800px;' name = 'isiArtikel' id = 'isiArtikel'   >". base64_decode($isi_artikel) ." </textarea>",
                "type" => "merge"
            ),
            'tanggalArtikel' => array(
                'label' => 'Tanggal Artikel',
                'labelWidth' => 100,
                'value' => "<input type='text'  class='date' name = 'tanggalArtikel' id = 'tanggalArtikel' class='form-control' value='".$this->generateDate($tanggal)."'  >"
            ),
            'status' => array(
                'label' => 'Status',
                'labelWidth' => 100,
                'value' =>
                $comboStatus
            ),

        );
        //tombol
        $this->form_menubawah = "<input type='button' class='btn btn-success' value='Simpan' onclick ='" . $this->Prefix . ".saveEdit(" . $idEdit[0] . ")' title='Simpan'>&nbsp&nbsp" . "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm2();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }



    function broadcastEmail()
    {
        global $SensusTmp;
        $cek               = '';
        $err               = '';
        $content           = '';
        $json              = TRUE; //$ErrMsg = 'tes';
        $form_name         = $this->Prefix . '_form';
        $this->form_width  = 400;
        $this->form_height = 175;

        $this->form_caption = 'BROADCAST EMAIL';
        $listEmail          = implode(';', $_REQUEST['refArtikel_cb']);

        //items ----------------------
        $this->form_fields    = array(
            'subject' => array(
                'label' => 'SUBJECT',
                'labelWidth' => 150,
                'value' => "
						<input type='hidden' name='listEmail' id='listEmail' value='$listEmail'>
						<input type='text' name='subjectEmail' id='subjectEmail' style='width:100%;'>"
            ),
            'nama' => array(
                'label' => '',
                'labelWidth' => 100,
                'value' => "<textarea id='isiEmail' name='isiEmail'></textarea>",
                'type' => "merge"
            )



        );
        //tombol
        $this->form_menubawah = "<input type='button' value='Simpan' onclick ='" . $this->Prefix . ".sendBroadCast($idrefArtikel)' title='Simpan'>&nbsp&nbsp" . "<input type='button' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm2();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
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
	   <tr>
  	   <th class='th01'  width='5' style='text-align:center;vertical-align:middle;'>No.</th>
  	   $Checkbox
		   <th class='th01' width='880' style='text-align:center;vertical-align:middle;'>JUDUL</th>
	     <th class='th01'  width='150' style='text-align:center;vertical-align:middle;'>TANGGAL</th>
		   <th class='th01'  width='100' style='text-align:center;vertical-align:middle;'>JUMLAH TRAFIC</th>
		   <th class='th01'  width='50' style='text-align:center;vertical-align:middle;'>STATUS</th>

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
            'align="center"',
            $no . '.'
        );
        if ($Mode == 1)
            $Koloms[] = array(
                " align='center'  ",
                $TampilCheckBox
            );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $judul
        );
        $Koloms[] = array(
            'align="center" valign="middle"',
            $this->generateDate($tanggal)
        );
        $getTotalTrafic = sqlArray(sqlQuery("select count(id) from trafic where id_artikel = '$id'"));
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($getTotalTrafic['count(id)'])
        );
        $Koloms[] = array(
            'align="center" valign="middle"',
            $status
        );
        return $Koloms;
    }


    function genDaftarOpsi()
    {
        global $Ref, $Main;
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $arrayStatus = array(
            array(
                'AKTIF','AKTIF',

            ),
            array(
              'TIDAK AKTIF','TIDAK AKTIF',
            )
        );
        if (empty($jumlahData))
        $jumlahData = 50;
        $comboFilterstatusArtikel = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "onchange=$this->Prefix.refreshList(true)");
        $TampilOpt         = "<div class='FilterBar' style='margin-top:5px;'>" . "<table style='width:100%'>
				<tr>
					<td>JUDUL</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterJudul' id ='filterJudul' style='width:400px;' value='$filterJudul'>
					</td>
				</tr>
				<tr>
					<td>TANGGAL </td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterTanggal' id ='filterTanggal' style='width:400px;' value='$filterTanggal'>
					</td>
				</tr>
				<tr>
					<td>STATUS</td>
					<td>:</td>
					<td style='width:86%;'>
						$comboFilterstatusArtikel
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
				</table>" . "</div>";


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
        if (!empty($filterJudul)) {
            $arrKondisi[] = "judul like '%$filterJudul%'";
        }
        if (!empty($filterStatus)) {
            $arrKondisi[] = "status = '$filterStatus'";
        }
        if (!empty($filterTanggal)) {
            $arrKondisi[] = "tanggal like '%".$this->generateDate($filterTanggal)."%'";
        }
        $Kondisi = join(' and ', $arrKondisi);
        $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;

        //Order -------------------------------------
        $fmORDER1  = cekPOST('fmORDER1');
        $fmDESC1   = cekPOST('fmDESC1');
        $Asc1      = $fmDESC1 == '' ? '' : 'desc';
        $arrOrders = array();
        switch ($filterUrut) {
            case '1':
                $arrOrders[] = " type_refArtikel $Asc1 ";
                break;
            case '2':
                $arrOrders[] = " username $Asc1 ";
                break;
            case '3':
                $arrOrders[] = " nama $Asc1 ";
                break;
            case '4':
                $arrOrders[] = " saldo $Asc1 ";
                break;
        }
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
}
$refArtikel = new refArtikelObj();
?>
