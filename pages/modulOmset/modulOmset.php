<?php

class modulOmsetObj extends configClass
{
    var $Prefix = 'modulOmset';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'komisi'; //bonus
    var $TblName_Hapus = 'transaksi';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'transaksi Produk';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'modulOmset.xls';
    var $namaModulCetak = 'ADMINISTRASI';
    var $Cetak_Judul = 'transaksi Produk';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'modulOmsetForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0
    var $userName = ''; //0

    function setTitle()
    {
        return 'Omset dan Komisi';
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
       $fabMenu .= fujinFabMenu('','detailKomisi()','Detail','valid.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','Hapus()','Hapus','delete_f2.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','cetakAll()','Cetak','print.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','Invoice()','Invoice','print.png','',$this->Prefix);

       return $fabMenu;
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

        $fmST  = $_REQUEST[$this->Prefix . '_fmST'];
        $idplh = $_REQUEST[$this->Prefix . '_idplh'];
        if (empty($statusTransaksi)) {
            $err = "Pilih status";
        }

        if ($err == '') {
          $getDataTransaksi = sqlArray(sqlQuery("select * from transaksi where id='$idEdit'"));
          $getDataMember = sqlArray(sqlQuery("select * from member where id ='".$getDataTransaksi['id_member']."'"));

          if($getDataTransaksi['jenis_transaksi'] == 'PENJUALAN'){
            if(($getDataTransaksi['status'] == 'BELUM BAYAR' || $getDataTransaksi['status'] == 'MENUNGGU KONFIRMASI' ) && $statusTransaksi == 'TERKONFIRMASI'){
              $getDetailTransaksi = sqlQuery("select * from detail_transaksi where id_transaksi ='$idEdit'");
              while ($dataDetailTransaksi = sqlArray($getDetailTransaksi)) {
                $getDataProduk = sqlArray(sqlQuery("select * from produk where id = '".$dataDetailTransaksi['id_produk']."'"));
                $arrayKomisiProduk = json_decode($getDataProduk['komisi']);
                $arrayBagiKomisi[] = array(
                   "komisiLevel1" =>  $arrayKomisiProduk[0] * $dataDetailTransaksi['jumlah'],
                   "komisiLevel2" =>  $arrayKomisiProduk[1] * $dataDetailTransaksi['jumlah'],
                   "komisiLevel3" =>  $arrayKomisiProduk[2] * $dataDetailTransaksi['jumlah'],
                   // "komisiLevel4" =>  $arrayKomisiProduk[3] * $dataDetailPenjualan['jumlah'],
                   "jumlahProduk" =>  $dataDetailTransaksi['jumlah'],
                );
              }
              $getDataUplineNomor1 = sqlArray(sqlQuery("select * from member where id = '".$getDataMember['upline_level_1']."'"));
              $getDataUplineNomor2 = sqlArray(sqlQuery("select * from member where id = '".$getDataMember['upline_level_2']."'"));
              $getDataUplineNomor3 = sqlArray(sqlQuery("select * from member where id = '".$getDataMember['upline_level_3']."'"));

              for ($i=0; $i < sizeof($arrayBagiKomisi); $i++) {
                  $totalKomisiLevel1 += $arrayBagiKomisi[$i]['komisiLevel1'];
                  if($getDataUplineNomor2['lisensi'] != "BASIC"){
                    $totalKomisiLevel2 += $arrayBagiKomisi[$i]['komisiLevel2'];
                  }
                  if($getDataUplineNomor3['lisensi'] =='AGEN'){
                    $totalKomisiLevel3 += $arrayBagiKomisi[$i]['komisiLevel3'];
                  }
                  // $totalKomisiLevel4 += $arrayBagiKomisi[$i]['komisiLevel4'];
                  $jumlahProduk += $arrayBagiKomisi[$i]['jumlahProduk'];
              }
              $dataKomisiMemberLevel1 = array(
                  'id_transaksi' => $idEdit,
                  'komisi' => $totalKomisiLevel1,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $getDataMember['upline_level_1'],
                  'tanggal' => date("Y-m-d"),
                );
              $this->insertKomisi($dataKomisiMemberLevel1,$getDataMember['upline_level_1']);
              if($totalKomisiLevel2 > 0){
                $dataKomisiMemberLevel2 = array(
                    'id_transaksi' => $idEdit,
                    'komisi' => $totalKomisiLevel2,
                    'jenis_komisi' => "PENJUALAN",
                    'id_member' => $getDataMember['upline_level_2'],
                    'tanggal' => date("Y-m-d"),
                  );
                $this->insertKomisi($dataKomisiMemberLevel2,$getDataMember['upline_level_2']);
              }
              if($totalKomisiLevel3 > 0){
                $dataKomisiMemberLevel3 = array(
                    'id_transaksi' => $idEdit,
                    'komisi' => $totalKomisiLevel3,
                    'jenis_komisi' => "PENJUALAN",
                    'id_member' => $getDataMember['upline_level_3'],
                    'tanggal' => date("Y-m-d"),
                  );
                $this->insertKomisi($dataKomisiMemberLevel3,$getDataMember['upline_level_3']);
              }
              $queryUpdateTransaksi = "UPDATE transaksi set status = 'TERKONFIRMASI', update_time = now() where id = '$idEdit'";
              sqlQuery($queryUpdateTransaksi);

            }else{
              $queryUpdateTransaksi = "UPDATE transaksi set nomor_resi='$nomorResi',keterangan = '$keterangan', update_time = now() where id = '$idEdit'";
              sqlQuery($queryUpdateTransaksi);
            }
          }elseif($getDataTransaksi['jenis_transaksi'] == 'PENDAFTARAN MEMBER (BASIC)'){
            if(($getDataTransaksi['status'] == 'BELUM BAYAR' || $getDataTransaksi['status'] == 'MENUNGGU KONFIRMASI' ) && $statusTransaksi == 'TERKONFIRMASI'){
              $getSettingKomisiPendaftaran = sqlArray(sqlQuery("select * from setting where nama ='KOMISI PENDAFTARAN'"));
              $dataKomisi = array(
                'id_transaksi' => $idEdit,
                'komisi' => $getSettingKomisiPendaftaran['isi'],
                'jenis_komisi' => "PENDAFTARAN",
                'id_member' => $getDataTransaksi['id_member'],
                'tanggal' => date("Y-m-d"),
              );
              sqlQuery(sqlInsert("komisi",$dataKomisi));
              $queryUpdateTransaksi = "UPDATE transaksi set status = 'TERKONFIRMASI', update_time = now() where id = '$idEdit'";
              sqlQuery($queryUpdateTransaksi);

              $dataMember = array(
                'nama' => $getDataTransaksi['nama_pembeli'],
                'email' => $getDataTransaksi['email_pembeli'],
                'nomor_telepon' => $getDataTransaksi['nomor_telepon'],
                'lisensi' => "BASIC",
                'tanggal_join' => date("Y-m-d"),
                'upline_level_1	' => $getDataTransaksi['id_member'],
                'upline_level_2	' => $getDataMember['upline_level_1'],
                'upline_level_3	' => $getDataMember['upline_level_2'],
                'upline_level_4	' => $getDataMember['upline_level_3'],
              );
              sqlQuery(sqlInsert("member",$dataMember));
              $getIdMember = sqlArray(sqlQuery("select max(id) from users where email='".$getDataTransaksi['email_pembeli']."'"));
              $dataUsers = array(
                "id_member" => $getIdMember['max(id)'],
                "email" => $getDataTransaksi['email_pembeli'],
                "password" => md5("123456"),
                "status" => "AKTIF",
                "hak_akses" => "MEMBER",
                "online" => "0",
              );
              sqlQuery(sqlInsert("users",$dataUsers));

            }
          }else{

          }

          // $queryUpdate = sqlUpdate('transaksi', $dataUpdate,"id = '$idEdit'");
          sqlQuery($queryUpdate);
          $cek = $queryUpdateTransaksi;
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
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        switch ($tipe) {


            case 'detailKomisi': {
                $fm      = $this->detailKomisi();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }
            case 'showDetail': {
                $fm      = $this->showDetail($idEdit);
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
                break;
            }
            case 'saveKonfirmasi': {
                $get     = $this->saveKonfirmasi();
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
        <script type='text/javascript' src='js/modulOmset/modulOmset.js' language='JavaScript' ></script>
        <script type='text/javascript' src='js/quill.min.js' language='JavaScript' ></script>
        <link rel='stylesheet' href='css/quill.snow.css'>
" . $scriptload;

    }

    function Baru()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'full'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Baru';
        // $idEdit             = $_REQUEST[$this->Prefix . '_cb'];

        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusProduk', $statusProduk, $arrayStatus, '-- STATUS --', "");
        $comboKategori = cmbQuery("kategoriProduk",$kategoriProduk,"select id,nama_kategori from ref_kategori","class='form-control'"," -- KATEGORI --");
        sqlQuery("delete from temp_media_transaksi where username = '".$_COOKIE['coID']."'");

        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Produk','namaProduk',$namaProduk,'12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Kategori',$comboKategori,'12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Deskripsi',
                                 "<div id ='deskripsiProduk' class='quill-container' > </div>",
                                '12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Media',"<span id='tableMedia'>".$this->tempTableMedia($idProduk)."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Harga',"<span id='tableHarga'>".$this->tempTableHarga($idProduk)."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Komisi',"<span id='tableKomisi'>".$this->tempTableKomisi($idProduk)."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Berat','beratProduk',$beratProduk,'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Diskon','diskonProduk',$diskonProduk,'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Nama Promo','namaDiskon',$namaDiskon,'12','1','11'),
                              ));
        // $fieldInform       .=  $this->newRow(array(
        //                         $this->customColumn('Cashback',"<span id='spanCashback>".$this->tempTableMedia($idProduk)."</span>'",'12','1','11'),
        //                       ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Status',$comboStatus,'12','1','11'),
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
    function detailKomisi()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'full'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Detail Komisi';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        $getDataEdit = sqlArray(sqlQuery("select * from komisi where id = '".$idEdit[0]."'"));
        $getDataMember = sqlArray(sqlQuery("select * from member where id ='".$getDataEdit['id_member']."'"));

        $comboStatus = cmbArray('statusTransaksi',$getDataEdit['status'], $arrayStatus,'-- STATUS --',"class='form-control'" ,  "");
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Member','namaMember',$getDataMember['nama'],'12','1','11',"readonly"),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Periode','periodeTransaksi',$filterPeriode,'12','1','11',"readonly"),
                               ));

         $fieldInform       .=  $this->newRow(array(
                                 $this->customColumn('Rincian Transaksi',"<span id='tableRincian'>".$this->tableRincianTransaksi($getDataEdit['id_member'])."</span>",'12','1','11'),
                               ));

        $this->form_fields =  "<div class='FilterBar row' style='padding: 1%;margin-top:5px;'>".$fieldInform."</div>";

        $this->form_menubawah =

        "<input type='button' class='btn btn-success btn-sm' value='Simpan' onclick ='" . $this->Prefix .".saveKonfirmasi(".$idEdit[0].")' > ".
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
    function showDetail($idEdit)
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'full'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Edit';
        // $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getDataEdit = sqlArray(sqlQuery("select * from transaksi where id = '".$idEdit."'"));

        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusProduk', $getDataEdit['status'], $arrayStatus, '-- STATUS --', "");
        $comboKategori = cmbQuery("kategoriProduk",$getDataEdit['kategori'],"select id,nama_kategori from ref_kategori","class='form-control'"," -- KATEGORI --");
        sqlQuery("delete from temp_media_transaksi where username = '".$_COOKIE['coID']."'");
        $jsonDecodeMedia = json_decode($getDataEdit['media']);
        for ($i=0; $i < sizeof($jsonDecodeMedia) ; $i++) {
          $dataTempMedia = array(
            'username' => $this->userName,
            'media' => $jsonDecodeMedia[$i]->sourceMedia,
            'type' => $jsonDecodeMedia[$i]->type,
          );
          sqlQuery(sqlInsert("temp_media_transaksi",$dataTempMedia));
        }

        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Produk','namaProduk',$getDataEdit['nama_transaksi'],'12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Kategori',$comboKategori,'12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Deskripsi',
                                 "<div id ='deskripsiProduk' class='quill-container' >".base64_decode($getDataEdit['deskripsi'])."</div>",
                                '12','1','11'),
                               ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Media',"<span id='tableMedia'>".$this->tempTableMedia($idProduk)."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Harga',"<span id='tableHarga'>".$this->tempTableHarga($getDataEdit['id'])."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Komisi',"<span id='tableKomisi'>".$this->tempTableKomisi($getDataEdit['id'])."</span>",'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Berat','beratProduk',$getDataEdit['berat'],'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Diskon','diskonProduk',$getDataEdit['diskon'],'12','1','11'),
                              ));
        $fieldInform       .=  $this->newRow(array(
                               $this->textBoxColumn('Nama Promo','namaDiskon',$getDataEdit['nama_diskon'],'12','1','11'),
                              ));
        // $fieldInform       .=  $this->newRow(array(
        //                         $this->customColumn('Cashback',"<span id='spanCashback>".$this->tempTableMedia($idProduk)."</span>'",'12','1','11'),
        //                       ));
        $fieldInform       .=  $this->newRow(array(
                                $this->customColumn('Status',$comboStatus,'12','1','11'),
                               ));
        $this->form_fields =  "<div class='FilterBar row' style='padding: 1%;margin-top:5px;'>".$fieldInform."</div>";

        $this->form_menubawah =

        // "<input type='button' class='btn btn-success btn-sm' value='Simpan' onclick ='" . $this->Prefix .".saveEdit(".$idEdit[0].")' > ".
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
      	   <th class='th01'  width='5' colspan='1' rowspan='2'  style='text-align:center;vertical-align:middle;'>No.</th>
      	   ".str_replace(">"," colspan='1' rowspan = '2' style='text-align:center;vertical-align:middle;'>",$Checkbox)."
    		   <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>PERIODE</th>
    		   <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>NAMA MEMBER</th>
    		   <th class='th01'  width='100' colspan='3' rowspan='1'  style='text-align:center;vertical-align:middle;border-bottom: none;'>OMSET</th>
           <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>TOTAL</th>
    	   </tr>
         <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>PENJUALAN</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>RECRUITMENT</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>UPGRADE</th>
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
        if(empty($_REQUEST['filterPeriode']))$_REQUEST['filterPeriode'] = date("Y-m");
        $Koloms[] = array(
            'align="center" valign="middle"',
            $_REQUEST['filterPeriode']
        );
        $getDataMember = sqlArray(sqlQuery("select * from member where id = '$id_member'"));
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getDataMember['nama']
        );
        $explodeFilterPeriode = explode("-",$_REQUEST['filterPeriode']);
        // $arrKondisi[] = "year(tanggal) ='".$explodeFilterPeriode[0]."'";
        // $arrKondisi[] = "month(tanggal) ='".$explodeFilterPeriode[1]."'";
        $getKomisiPenjualan = sqlArray(sqlQuery("select sum(komisi) from komisi where id_member = '$id_member' and jenis_komisi = 'PENJUALAN' and year(tanggal) ='".$explodeFilterPeriode[0]."' and month(tanggal) ='".$explodeFilterPeriode[1]."'"));
        $getKomisiPendaftaran = sqlArray(sqlQuery("select sum(komisi) from komisi where id_member = '$id_member' and jenis_komisi = 'PENDAFTARAN' and year(tanggal) ='".$explodeFilterPeriode[0]."' and month(tanggal) ='".$explodeFilterPeriode[1]."'"));
        $getKomisiUpgrade = sqlArray(sqlQuery("select sum(komisi) from komisi where id_member = '$id_member' and jenis_komisi = 'UPGRADE' and year(tanggal) ='".$explodeFilterPeriode[0]."' and month(tanggal) ='".$explodeFilterPeriode[1]."'"));
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($getKomisiPenjualan['sum(komisi)'],0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($getKomisiPendaftaran['sum(komisi)'] ,0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($getKomisiUpgrade['sum(komisi)'],0)
        );
        $total = $getKomisiPenjualan['sum(komisi)'] + $getKomisiPendaftaran['sum(komisi)'] + $getKomisiUpgrade['sum(komisi)'];
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($total,0)
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
          array("BELUM BAYAR","BELUM BAYAR"),
          array("MENUNGGU KONFIRMASI","MENUNGGU KONFIRMASI"),
          array("TERKONFIRMASI","TERKONFIRMASI"),
          array("DIKIRIM","DIKIRIM"),
          array("SELESAI","SELESAI"),
        );
        if(empty($filterPeriode))$filterPeriode = date("Y-m");
        $comboStatus = cmbArray('filterStatus',$filterStatus, $arrayStatus,'-- STATUS --',"class='form-control'" ,  "");
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Member','filterNamaMember',$filterNamaMember,'4','5','7'),
                                $this->textBoxColumn('Periode','filterPeriode',$filterPeriode,'4','5','7'),
                               ));

       // $fieldInform        .=  $this->newRow(array(
       //                         $this->customColumn('Status',$comboStatus,'4','5','7'),
       //                         $this->textBoxColumn('Nomor Transaksi','filterIdTransaksi',$filterIdTransaksi,'4','5','7'),
       //                        ));



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
        if (!empty($filterNamaMember)) {
            $arrayIdMember = array();
            $getNamaMember = sqlQuery("select id from member where nama like '%$filterNamaMember%'");
            while ($dataMember = sqlArray($getNamaMember)) {
              $arrayIdMember[] = $dataMember['id'];
            }
            $arrKondisi[] = "id_member in (".implode(",",$arrayIdMember).")";
        }
        if(empty($filterPeriode))$filterPeriode = date("Y-m");
        if (!empty($filterPeriode)) {
          $explodeFilterPeriode = explode("-",$filterPeriode);
          $arrKondisi[] = "year(tanggal) ='".$explodeFilterPeriode[0]."'";
          $arrKondisi[] = "month(tanggal) ='".$explodeFilterPeriode[1]."'";
        }
        if (!empty($filterIdTransaksi)) {
            $arrKondisi[] = "id ='$filterIdTransaksi'";
        }
        if (!empty($filterKodeUnik)) {
            $arrKondisi[] = "kode_unik like'%$filterKodeUnik%'";
        }


        $Kondisi = join(' and ', $arrKondisi);
        $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;

        //Order -------------------------------------
        $fmORDER1  = cekPOST('fmORDER1');
        $fmDESC1   = cekPOST('fmDESC1');
        $Asc1      = $fmDESC1 == '' ? '' : 'desc';
        $arrOrders = array();
        // $arrOrders[] = " id desc ";
        $Order        = join(',', $arrOrders);
        $OrderDefault = '';
        $Order        = $Order == '' ? $OrderDefault : ' Order By ' . $Order;

        if (empty($jumlahData))
            $jumlahData = 50;
        $this->pagePerHal = $jumlahData;
        $Main->PagePerHal = $jumlahData;
        $pagePerHal       = $this->pagePerHal == '' ? $Main->PagePerHal : $this->pagePerHal;
        $HalDefault       = cekPOST($this->Prefix . '_hal', 1);
        $Limit            = " group by id_member limit " . (($HalDefault * 1) - 1) * $pagePerHal . "," . $pagePerHal;
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
        // $getTotal = sqlArray(sqlQuery("select sum(total) from transaksi ".$arrayKondisi['Kondisi']));
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
          sqlQuery("delete from users where id_transaksi = '".$ids[$i]."'");
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

      function tableRincianTransaksi($idMember){
        // if(!empty($idProduk))$kondisiProduk = " and id_transaksi = '$idProduk'";
        $explodeFilterPeriode = explode("-",$_REQUEST['filterPeriode']);
        $className= "row0";
        $nomor = 1;
        $getDataMedia = sqlQuery("select * from komisi where id_member = '$idMember' and year(tanggal) = '".$explodeFilterPeriode[0]."' and month(tanggal) = '".$explodeFilterPeriode[1]."' order by id  ");
        while ($dataMedia = sqlArray($getDataMedia)) {
          foreach ($dataMedia as $key => $value) {
              $$key = $value;
          }
          $getDataProduk = sqlArray(sqlQuery("select * from produk where id ='$id_produk'"));
          $listProduk.= "
          <tr class='$className'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>".$this->generateDate($tanggal)."</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'>#$id</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$jenis_komisi</td>
            <td class='GarisDaftar' style='text-align:right;valign:middle;'>".$this->numberFormat($komisi,0)."</td>
          </tr>
          ";
          $subTotal += $komisi;
      	  if($nomor % 2 == 1){
    	   		$className = "row0";
    	   	}else{
    	   		$className = "row1";
    	   	}
          $nomor+= 1;

        }

        $listProduk.= "
        <tr class='$className'>
          <td class='GarisDaftar' style='text-align:right;valign:middle;' colspan='4'>TOTAL</td>
          <td class='GarisDaftar' style='text-align:right;valign:middle;'>".$this->numberFormat($subTotal,0)."</td>
        </tr>
        ";
        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>TANGGAL</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>NOMOR TRANSAKSI</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>JENIS TRANSAKSI</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>KOMISI</th>
        </thead>
        <tbody>
          ".$listProduk."
        </tbody>

        </table>

        ";
      }
    function insertKomisi($dataInsert,$idMember){
      $queryInsertKomisi = sqlInsert("komisi",$dataInsert);
      sqlQuery($queryInsertKomisi);
      // $queryUpdateKomisi = "UPDATE users set komisi = komisi + ".$dataInsert['komisi']." where id = '$idMember'";
      // sqlQuery($queryUpdateKomisi);
    }

}
$modulOmset = new modulOmsetObj();
$modulOmset->userName = $_COOKIE['coID'];;
?>
