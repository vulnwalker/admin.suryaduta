<?php

class pembayaranKomisiObj extends configClass
{
    var $Prefix = 'pembayaranKomisi';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'rekap_transaksi'; //bonus
    var $TblName_Hapus = 'users';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id_member');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'pembayaranKomisi';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'pembayaranKomisi.xls';
    var $namaModulCetak = 'ADMINISTRASI';
    var $Cetak_Judul = 'pembayaran Komisi';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'pembayaranKomisiForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0
    var $userName = ''; //0

    function setTitle()
    {
        return 'PEMBAYARAN KOMISI';
    }
    function filterSaldoMiring()
    {
        return "";
    }
    function setMenuEdit()
    {
        return "
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.Detail()' title='Detail'>
	    					<img src='images/administrator/images/info.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Detail
	    				</a>
            </li>
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.Konfirmasi()' title='Konfirmasi'>
	    					<img src='images/administrator/images/edit_f2.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Konfirmasi
	    				</a>
            </li>
						<li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
	    				<a class='toolbar' id='' href='javascript:$this->Prefix.CetakDaftar()' title='Cetak'>
	    					<img src='images/administrator/images/print.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
	    					Cetak
	    				</a>
            </li>
						";

            // <li class='nav-item' style='margin-right: 10px;margin-left: 10px;'>
            //   <a class='toolbar' id='' href='javascript:$this->Prefix.Hapus()' title='Hapus'>
            //     <img src='images/administrator/images/delete_f2.png' alt='button' name='save' width='22' height='22' border='0' align='middle'>
            //     Hapus
            //   </a>
            // </li>
    }
    function setMenuView()
    {
        return "";

    }
    function saveKonfirmasi()
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

        if($statusPembayaran == "SUDAH TRANSFER"){
          $dataPembayaran = array(
            "id_member" => $idMember,
            "tanggal" => $filterTahun."-".$filterBulan."-28",
            "jumlah" => $this->dropPoint($jumlahBayar),
          );
          $queryInsert = sqlInsert("pembayaran_komisi",$dataPembayaran);
          sqlQuery($queryInsert);
          $cek = $queryInsert;
        }elseif($statusPembayaran == "BELUM TRANSFER"){
          sqlQuery("DELETE FROM pembayaran_komisi where id_member = '$idMember' and year(tanggal) = '$filterTahun' and month(tanggal) = '$filterBulan'");
          $cek = "DELETE FROM pembayaran_komisi where id_member = '$idMember' and year(tanggal) = '$filterTahun' and month(tanggal) = '$filterBulan'";
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
        if (empty($namaProduk)) {
            $err = "Isi Nama Produk";
        } elseif (empty($hargaProduk)) {
            $err = "Isi Harga Produk";
        } elseif (empty($hargaProdukMember)) {
            $err = "Isi Harga Produk Member";
        } elseif (empty($deskkripsiProduk)) {
            $err = "Isi Deskripsi Produk";
        }

        if ($err == '') {
          if(!empty($baseOfFile)){
            $dataUpdate  = array(
              'nama_penjualan' => $namaProduk,
              'harga' => $this->dropPoint($hargaProduk),
              'harga_member' => $this->dropPoint($hargaProdukMember),
              'deskripsi' => $deskkripsiProduk,
              'promo' => $promoProduk,
              'komisi' => json_encode($arrayKomisi),
              'gambar' => $imageLocation,
              'video' => $videoProduk,
            );
          }else{
            $dataUpdate  = array(
              'nama_penjualan' => $namaProduk,
              'harga' => $this->dropPoint($hargaProduk),
              'harga_member' => $this->dropPoint($hargaProdukMember),
              'deskripsi' => $deskkripsiProduk,
              'promo' => $promoProduk,
              'komisi' => json_encode($arrayKomisi),
              'gambar' => $imageLocation,
              'video' => $videoProduk,
            );
          }
          $queryUpdate = sqlUpdate('penjualan', $dataUpdate,"id = '$idEdit'");
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

            case 'CetakDaftar':{
              $json = FALSE;
              $this->CetakDaftar();
              break;
            }
            case 'saveKonfirmasi': {
                $fm      = $this->saveKonfirmasi();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }
            case 'Konfirmasi': {
                $fm      = $this->Konfirmasi();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }

            case 'Detail': {
                $fm      = $this->Detail();
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
        return "<script type='text/javascript' src='js/pembayaranKomisi/pembayaranKomisi.js' language='JavaScript' ></script>

        <script src='js/thead.js'></script>
        <script src='js/jquery.fixedTableHeader.js'></script>


        " .			$this->loadCalendar().
        "



" . $scriptload;

//            <script type='text/javascript' language='JavaScript'  src='js/textboxio/textboxio.js'></script>
    }



    function Konfirmasi()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 500;
        $this->form_height  = 200;
        $this->form_caption = 'Konfirmasi Pembayaran';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getDataMember            = sqlArray(sqlQuery("select * from users where id = '" . $idEdit[0] . "'"));
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        foreach ($getDataMember as $key => $value) {
            $$key = $value;
        }
        $arrayStatus          = array(
            array(
                'SUDAH TRANSFER',  'SUDAH TRANSFER',
            ),
            array(
                'BELUM TRANSFER',  'BELUM TRANSFER',
            )
        );


        if(empty($filterTahun)){
          $err = "Pilih Tahun";
        }else if(empty($filterBulan)){
          $err = "Pilih Bulan";
        }
        $arrKondisi = array();
        if (!empty($filterTahun)) {
            $arrKondisi[] = "year(tanggal) ='$filterTahun'";
        }
        if (!empty($filterBulan)) {
            $arrKondisi[] = "month(tanggal) ='$filterBulan'";
        }
        if(sizeof($arrKondisi) != 0){
          $Kondisi = "and ".join(' and ', $arrKondisi);
        }
        $getDataKomisi = sqlArray(sqlQuery("select sum(komisi) from komisi where id_member = '".$idEdit[0]."' $Kondisi "));
        $getDataPembayaranKomisi = sqlRowCount(sqlQuery("select * from pembayaran_komisi where id_member = '".$idEdit[0]."' $Kondisi"));
        if(!empty($getDataPembayaranKomisi)){
          $statusPembayaran = "SUDAH TRANSFER";
        }else{
          $statusPembayaran = "BELUM TRANSFER";
        }
        $statusPembayaran    = cmbArray('statusPembayaran', $statusPembayaran, $arrayStatus, '-- STATUS --', "");
        //items ----------------------
        $this->form_fields    = array(

            'nama' => array(
                'label' => 'Nama',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'namaMember' id = 'namaMember' value='$nama' class='form-control' readonly  >"
            ),
            'namaBank' => array(
                'label' => 'Nama Bank',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'namaMember' id = 'namaMember' value='$nama_bank' class='form-control' readonly  >"
            ),
            'nomorRekening' => array(
                'label' => 'Nomor Rekening',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'namaMember' id = 'namaMember' value='$nomor_rekening' class='form-control' readonly  >"
            ),
            'jumlahTransfer' => array(
                'label' => 'Jumlah Transfer',
                'labelWidth' => 100,
                'value' => "<input type='text' name = 'jumlahBayar' id = 'jumlahBayar' value='".$this->numberFormat($getDataKomisi['sum(komisi)'])."' class='form-control' style='text-align:right;' readonly  >"
            ),

            'statusMember' => array(
                'label' => 'Status Pembayaran',
                'labelWidth' => 100,
                'value' => $statusPembayaran
            )
        );
        //tombol
        $this->form_menubawah =
        "<input type='hidden' id='filterTahun' name='filterTahun' value='$filterTahun'> ".
        "<input type='hidden' id='filterBulan' name='filterBulan' value='$filterBulan'> ".
        "<input type='button' class='btn btn-success' value='Konfirmasi' onclick ='" . $this->Prefix . ".saveKonfirmasi(" . $idEdit[0] . ")' title='Konfirmasi'>&nbsp&nbsp ".
        "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }


    function Detail()
    {
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 600;
        $this->form_height  = 500;
        $arrayBulan = array(
            array('01','JANUARI'),
            array('02','FEBRUARI'),
            array('03','MARET'),
            array('04','APRIL'),
            array('05','MEI'),
            array('06','JUNI'),
            array('07','JULI'),
            array('08','AGUSTUS'),
            array('09','SEPTEMBER'),
            array('10','OKTOBER'),
            array('11','NOVEMBER'),
            array('12','DESEMBER'),

        );

        $this->form_caption = 'Detail Komisi Bulan '.$filterBulan." Tahun $filterTahun";
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getDataMember            = sqlArray(sqlQuery("select * from users where id = '" . $idEdit[0] . "'"));


        $this->form_fields    = array(

            'namaMember' => array(
                'label' => 'Nama Member',
                'labelWidth' => 150,
                'value' => $getDataMember['nama']
            ),
            'emailMember' => array(
                'label' => 'Email',
                'labelWidth' => 150,
                'value' => $getDataMember['email']
            ),
            'teleponMember' => array(
                'label' => 'Telepon',
                'labelWidth' => 150,
                'value' => $getDataMember['nomor_telepon']
            ),
            'namaBank' => array(
                'label' => 'Nama Bank',
                'labelWidth' => 150,
                'value' => $getDataMember['nama_bank']
            ),
            'nomorRekening' => array(
                'label' => 'Nomor Rekening',
                'labelWidth' => 150,
                'value' => $getDataMember['nomor_rekening']
            ),

            'detailOrder' => array(
                'label' => '',
                'labelWidth' => 150,
                'value' =>$this->detailKomisi($idEdit[0]),
                'type' => 'merge'
            ),

        );
        //tombol
        $this->form_menubawah ="<input type='button' class='btn btn-success' value='Tutup' onclick ='" . $this->Prefix .".Close()' >";

        $form    = $this->genForm2();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }



    function detailKomisi($idMember){
      foreach ($_REQUEST as $key => $value) {
          $$key = $value;
      }
      $arrKondisi = array();
      if (!empty($filterTahun)) {
          $arrKondisi[] = "year(tanggal) ='$filterTahun'";
      }
      if (!empty($filterBulan)) {
          $arrKondisi[] = "month(tanggal) ='$filterBulan'";
      }
      if(sizeof($arrKondisi) != 0){
        $Kondisi = "and ".join(' and ', $arrKondisi);
      }
  		$cek = '';
  		$err = '';
  		$qry = "select * from komisi where id_member = '$idMember' $Kondisi order by tanggal";$cek.=$qry;
  		$aqry = sqlQuery($qry);
  		$no=1;
  		while($dt = sqlArray($aqry)){

  		foreach ($dt as $key => $value) {
  				  $$key = $value;
  		}

  			$datanya.="

  						<tr class='row0'>
  							<td class='GarisDaftar' align='center'>$no</a></td>
  							<td class='GarisDaftar' align='left'>".$this->generateDate($tanggal)."</td>
  							<td class='GarisDaftar' align='left'>$jenis_komisi</td>
  							<td class='GarisDaftar' align='right'>
  								".number_format($komisi,2,',','.')."
  							</td>
  						</tr>
  			";
  			$totalHarga += $komisi;
  			$no = $no+1;
  		}
  		$datanya.="

  					<tr class='row0'>
  						<td class='GarisDaftar' colspan='3' align='center'>TOTAL</td>

  						<td class='GarisDaftar' align='right'>
  							".number_format($totalHarga,2,',','.')."
  						</td>
  					</tr>

  		";



  		$content =
  			"
  					<div id='tabelRekening'>
  					<table class='table table-striped'   width= 100% border='1'>
  						<tr>
  							<th class='th01' width='50px;'>NO </th>
  							<th class='th01' width='100px;'>TANGGAL</th>
  							<th class='th01' width='300px;'>JENIS KOMISI</th>
  							<th class='th01' width='200px;'>TOTAL</th>
  						</tr>
  						$datanya

  					</table>
  					</div>
  					"
  		;

  		return	$content;
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
      	   <th class='th01'  width='5' rowspan='2'  style='text-align:center;vertical-align:middle;'>No.</th>
           $Checkbox
    		   <th class='th01' width='200'  rowspan='2' style='text-align:center;vertical-align:middle;'>NAMA</th>
    		   <th class='th01' width='200'  rowspan='2' style='text-align:center;vertical-align:middle;'>EMAIL</th>
    		   <th class='th02' width='200'  rowspan='1' colspan='3' style='text-align:center;vertical-align:middle;'>REKENING</th>
    		   <th class='th02' width='200'  rowspan='1' colspan='3' style='text-align:center;vertical-align:middle;'>PENDAPATAN</th>

     	     <th class='th01'  width='50' rowspan='2' style='text-align:center;vertical-align:middle;'>STATUS</th>
    	   </tr>
         </tr>
         <th class='th01' width='200'  style='text-align:center;vertical-align:middle;'>NAMA BANK</th>
         <th class='th01' width='200'  style='text-align:center;vertical-align:middle;'>NOMOR</th>
         <th class='th01' width='200'  style='text-align:center;vertical-align:middle;'>NAMA REKENING</th>
         <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>TRANSAKSI</th>
         <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>PEMBELIAN</th>
         <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>KOMISI</th>
         </tr>
	        </thead>";

        return $headerTable;
    }

    function setKolomData($no, $isi, $Mode, $TampilCheckBox)
    {
        global $Ref;
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        foreach ($isi as $key => $value) {
            $$key = $value;
        }
        $Koloms   = array();
        $Koloms[] = array(
            'align="center"',
            $no . '.'
        );
        $getDataMember = sqlArray(sqlQuery("select * from users where id = '".$id_member."'"));
        if ($Mode == 1)
            $Koloms[] = array(
                " align='center'  ",
                $TampilCheckBox
            );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nama']
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['email']
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nama_bank']
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nomor_rekening']
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nama_rekening']
        );


        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($jumlah_penjualan)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($jumlah_barang)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($komisi)
        );

        $status = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' />";
        if (!empty($filterTahun) && !empty($filterBulan) ) {
          $arrKondisi = array();
          if (!empty($filterTahun)) {
              $arrKondisi[] = "year(tanggal) ='$filterTahun'";
          }
          if (!empty($filterBulan)) {
              $arrKondisi[] = "month(tanggal) ='$filterBulan'";
          }
          if(sizeof($arrKondisi) != 0){
            $Kondisi = "and ".join(' and ', $arrKondisi);
          }
          $getDataKomisi = sqlArray(sqlQuery("select sum(komisi) from komisi where id_member = '$id_member' $Kondisi "));
          $getDataPembayaran = sqlRowCount(sqlQuery("select * from pembayaran_komisi where id_member = '$id_member' $Kondisi"));
          if(!empty($getDataPembayaran)){
            $status = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' />";
          }
        }
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
                'PENDING',
                'PENDING'
            ),
            array(
                'SELESAI',
                'SELESAI'
            ),
        );
        $arrayBulan = array(
            array('01','JANUARI'),
            array('02','FEBRUARI'),
            array('03','MARET'),
            array('04','APRIL'),
            array('05','MEI'),
            array('06','JUNI'),
            array('07','JULI'),
            array('08','AGUSTUS'),
            array('09','SEPTEMBER'),
            array('10','OKTOBER'),
            array('11','NOVEMBER'),
            array('12','DESEMBER'),

        );
        if (empty($jumlahData))$jumlahData = 50;
        $explodeTanggalHariIni = explode("-",date("Y-m-d"));
        if (empty($filterTahun))$filterTahun = $explodeTanggalHariIni[0];
        if (empty($filterBulan))$filterBulan = $explodeTanggalHariIni[1];
        $comboFilterStatus = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "");
        $comboFilterBulan = cmbArray('filterBulan', $filterBulan, $arrayBulan, '-- BULAN --', "");
        $arrayPeringkat = array(
            array(
                'KOMISI TERBANYAK','KOMISI TERBANYAK'
            ),
            array(
                'PENJUALAN TERBANYAK','PENJUALAN TERBANYAK'
            ),
            array(
                'KOMISI TERENDAH','KOMISI TERENDAH'
            ),
            array(
                'PENJUALAN TERENDAH','PENJUALAN TERENDAH'
            ),
        );
        $comboUrutan = cmbArray('orderPeringkat', $orderPeringkat, $arrayPeringkat, '-- URUTKAN --', "");
        $TampilOpt         = "<div class='FilterBar' style='margin-top:5px;'>" . "<table style='width:100%'>
				<tr>
					<td>NAMA MEMBER</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterNamaMember' id ='filterNamaMember' style='width:400px;' value='$filterNamaMember'>
					</td>
				</tr>
				<tr>
					<td>TAHUN</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterTahun' id ='filterTahun' style='width:400px;' value='$filterTahun'>
					</td>
				</tr>
				<tr>
					<td>BULAN</td>
					<td>:</td>
					<td style='width:86%;'>
						$comboFilterBulan
					</td>
				</tr>
				<tr>
					<td>STATUS</td>
					<td>:</td>
					<td style='width:86%;'>
						$comboFilterStatus
					</td>
				</tr>
				<tr>
					<td colspan='3'><hr></td>
				</tr>
        <tr>
					<td> URUTKAN PERINGKAT</td>
          <td>:</td>
          <td style='width:86%;'>
            $comboUrutan
          </td>
				</tr>
        <tr>
					<td> MINIMAL PENCAIRAN</td>
          <td>:</td>
          <td style='width:86%;'>
            <input type='text' class='form-control'  name='minimalPencairan' id ='minimalPencairan' style='width:200px;' value='$minimalPencairan' >
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

    function insertKomisi($dataInsert,$idMember){
      $queryInsertKomisi = sqlInsert("komisi",$dataInsert);
      sqlQuery($queryInsertKomisi);
      $queryUpdateKomisi = "UPDATE users set komisi = komisi + ".$dataInsert['komisi']." where id = '$idMember'";
      sqlQuery($queryUpdateKomisi);
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

        if(!isset($filterBulan)){
          $filterTahun = date("Y");
          $filterBulan = date("m");
        }
        // if (!empty($filterTahun)) {
          $filterPeriode = $filterTahun."-".$filterBulan;
          $arrKondisi[] = "periode ='$filterPeriode'";
        // }

        if (!empty($filterNamaMember)) {
            $arrKondisi[] = "id_member in ( select id from users where nama like '%".$filterNamaMember."%' ) ";
        }
        if (!empty($filterStatus) && !empty($filterTahun) &&  !empty($filterBulan) ) {
          if($filterStatus == "PENDING"){
            $arrKondisi[] = "id_member not in ( select id_member from pembayaran_komisi where year(tanggal) ='$filterTahun' and month(tanggal) ='$filterBulan') ";
          }elseif($filterStatus == "SELESAI"){
            $arrKondisi[] = "id_member in ( select id_member from pembayaran_komisi where year(tanggal) ='$filterTahun' and month(tanggal) ='$filterBulan') ";
          }
        }
        $arrayUserBlokir = array();
        $getUserBlokir = sqlQuery("select * from users where status='TIDAK AKTIF' ");
        while ($dataUserBlokir = sqlArray($getUserBlokir)) {
          $arrayUserBlokir[] = $dataUserBlokir['id'];
        }
        if(sizeof($arrayUserBlokir) > 0 ){
          $arrKondisi[] = "id_member not in (".implode($arrayUserBlokir).")";
        }
        if(!empty($minimalPencairan)){
          $arrKondisi[] = "komisi > $minimalPencairan";
        }

        $Kondisi = join(' and ', $arrKondisi);
        $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;

        //Order -------------------------------------
        $fmORDER1  = cekPOST('fmORDER1');
        $fmDESC1   = cekPOST('fmDESC1');
        $Asc1      = $fmDESC1 == '' ? '' : 'desc';
        $arrOrders = array();
        if(!empty($orderPeringkat)){
          if($orderPeringkat == "KOMISI TERBANYAK"){
            $arrOrders[] = "komisi desc";
          }elseif($orderPeringkat == "PENJUALAN TERBANYAK"){
            $arrOrders[] = "jumlah_barang desc";
          }elseif($orderPeringkat == "KOMISI TERENDAH"){
            $arrOrders[] = "komisi asc";
          }elseif($orderPeringkat == "PENJUALAN TERENDAH"){
            $arrOrders[] = "jumlah_barang asc";
          }
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

    function genRowSum($ColStyle, $Mode, $Total){
  			foreach ($_REQUEST as $key => $value) {
  			  	$$key = $value;
  			 }
        $arrayKondisi = $this->getDaftarOpsi(1);
        $getTotal = sqlArray(sqlQuery("select sum(komisi) from rekap_transaksi ".$arrayKondisi['Kondisi']));
        if($tipe == 'cetak_all'){
          $ContentTotalHal =
    			"<tr>
    				<td class='$ColStyle' colspan='8' align='center'><b>Total </td>
    				<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(komisi)'] )."</td>
    				<td class='GarisDaftar' align='right'></td>
    			</tr>" ;
        }else{
          $ContentTotalHal =
    			"<tr>
    				<td class='$ColStyle' colspan='9' align='center'><b>Total </td>
    				<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(komisi)'] )."</td>
    				<td class='GarisDaftar' align='right'></td>
    			</tr>" ;
        }

  			return $ContentTotalHal;
  		}
      function CetakDaftar(){
        foreach ($_POST as $key => $value) {
          $$key = $value;
        }
        $arrayKondisi = $this->getDaftarOpsi(1);
        $getDataPembayaran = sqlQuery("select * from rekap_transaksi ".$arrKondisi['Kondisi']);
        $nomor = 1;
        while ($dataPembayaran = sqlArray($getDataPembayaran)) {
          foreach ($dataPembayaran as $key => $value) {
              $$key = $value;
          }
          $getDataMember = sqlArray(sqlQuery("select * from users where id = '".$dataPembayaran['id_member']."'"));
          $status = "<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' />";
          if (!empty($filterTahun) && !empty($filterBulan) ) {
            $getDataPembayaran = sqlRowCount(sqlQuery("select * from pembayaran_komisi where id_member = '".$dataPembayaran['id_member']."' $Kondisi"));
            if(!empty($getDataPembayaran)){
              $status = "<img src='images/administrator/images/valid.png' width='20px' heigh='20px' />";
            }
          }

          $rowPembayaranKomisi .= "
          <tr  valign='top '>
             <td class='GarisCetak '  align='center'>$nomor</td>
             <td class='GarisCetak '  align='left' valign='middle'>".$getDataMember['nama']."</td>
             <td class='GarisCetak '  align='left' valign='middle'>".$getDataMember['email']."</td>
             <td class='GarisCetak '  align='left' valign='middle'>".$getDataMember['nama_bank']."</td>
             <td class='GarisCetak '  align='left' valign='middle'>".$getDataMember['nomor_rekening']."</td>
             <td class='GarisCetak '  align='left' valign='middle'>".$getDataMember['nama_rekening']."</td>
             <td class='GarisCetak '  align='right' valign='middle'>".$this->numberFormat($dataPembayaran['jumlah_penjualan'])."</td>
             <td class='GarisCetak '  align='right' valign='middle'>".$this->numberFormat($dataPembayaran['jumlah_barang'])."</td>
             <td class='GarisCetak '  align='right' valign='middle'>".$this->numberFormat($dataPembayaran['komisi'])."</td>
             <td class='GarisCetak '  align='center' valign='middle'>
              $status
             </td>
          </tr>
          ";
          $totalKomisi += $komisi;
          $nomor += 1;
        }
        echo  "
        <html>
        <head>
            <title>RIZKI KITA</title>
            <link rel='stylesheet' href='css/template_css.css' type='text/css' />
        </head>
        <body>
            <form name='adminForm' id='adminForm' method='post' action=''>
                <div style='width:30cm'>
                    <table class='rangkacetak' style='width:30cm'>
                        <tr>
                            <td valign='top'>
                                <table style='width:100%' border='0'>
                                    <tr>
                                        <td class='judulcetak' align='center'>PEMBAYARAN KOMISI ".$this->titiMangsa($filterTahun."-".$filterBulan."-01")."</td>
                                    </tr>
                                </table>
                                <br>
                                <div id='cntTerimaKondisi'></div>
                                <div id='cntTerimaDaftar'>
                                    <div class='demo'>
                                        <table class='table table-striped' border='1' style='margin:4 0 0 0;width:' 100% ' id='pembayaranKomisi_table ' ><thead>
            	   <tr>
              	   <th class='th01 '  width='5 ' rowspan='2 '  style='text-align:center;vertical-align:middle; '>No.</th>

            		   <th class='th01 ' width='200 '  rowspan='2 ' style='text-align:center;vertical-align:middle; '>NAMA</th>
            		   <th class='th01 ' width='200 '  rowspan='2 ' style='text-align:center;vertical-align:middle; '>EMAIL</th>
            		   <th class='th02 ' width='200 '  rowspan='1 ' colspan='3 ' style='text-align:center;vertical-align:middle; '>REKENING</th>
            		   <th class='th02 ' width='200 '  rowspan='1 ' colspan='3 ' style='text-align:center;vertical-align:middle; '>PENDAPATAN</th>

             	     <th class='th01 '  width='50 ' rowspan='2 ' style='text-align:center;vertical-align:middle; '>STATUS</th>
            	   </tr>
                 </tr>
                 <th class='th01 ' width='200 '  style='text-align:center;vertical-align:middle; '>NAMA BANK</th>
                 <th class='th01 ' width='200 '  style='text-align:center;vertical-align:middle; '>NOMOR</th>
                 <th class='th01 ' width='200 '  style='text-align:center;vertical-align:middle; '>NAMA REKENING</th>
                 <th class='th01 '  width='100 '  style='text-align:center;vertical-align:middle; '>TRANSAKSI</th>
                 <th class='th01 '  width='100 '  style='text-align:center;vertical-align:middle; '>PEMBELIAN</th>
                 <th class='th01 '  width='100 '  style='text-align:center;vertical-align:middle; '>KOMISI</th>
                 </tr>
        	        </thead><tbody>
                  $rowPembayaranKomisi

                    <tr>
            				<td class='GarisCetak ' colspan='8 ' align='center '><b>Total </td>
            				<td class='GarisDaftar ' align='right '>".$this->numberFormat($totalKomisi)."</td>
            				<td class='GarisDaftar ' align='right '></td>
            			</tr></tbody></table>


        				</table> </td></tr>
        			</table>
        			</div>
        			</form>
        			</body>
        			</html>
        ";
      }

      function titiMangsa($tgl = "")
      {
          global $Ref;
          if (!empty($tgl) and substr($tgl, 0, 4) != "0000") {
              $cHr = @$Ref->NamaHari[date("w", mktime(0, 0, 0, substr($tgl, 5, 2), substr($tgl, 8, 2), substr($tgl, 0, 4)))];
              return  @$Ref->NamaBulan[(substr($tgl, 5, 2) * 1) - 1] . " " . substr($tgl, 0, 4);
          } else {
              return " ";
          }
      }
}
$pembayaranKomisi = new pembayaranKomisiObj();
$pembayaranKomisi->userName = $_COOKIE['coID'];;
?>
