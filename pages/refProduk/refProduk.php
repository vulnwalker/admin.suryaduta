<?php

class refProdukObj extends configClass
{
    var $Prefix = 'refProduk';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'produk'; //bonus
    var $TblName_Hapus = 'produk';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'produk Produk';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'refProduk.xls';
    var $namaModulCetak = 'ADMINISTRASI';
    var $Cetak_Judul = 'produk Produk';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'refProdukForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0
    var $userName = ''; //0

    function setTitle()
    {
        return 'Produk';
    }

    function filterSaldoMiring()
    {
        return "";
    }
    function setMenuEdit()
    {
      // fujinFabMenu(id,href,title,img,style);
       $fabMenu = '';
       $fabMenu .= fujinFabMenu('','Baru()','Baru','sections.png','',$this->Prefix);
       $fabMenu .= fujinFabMenu('','Edit()','Edit','edit_f2.png','',$this->Prefix);
       $fabMenu .= fujinFabMenu('','Hapus()','Hapus','delete_f2.png','',$this->Prefix);
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

        if (empty($namaProduk)) {
            $err = "Isi Nama produk ";
        } elseif (empty($deskripsiProduk)) {
            // $err = "Isi Deskripsi";
        } elseif (empty($hargaUmum)) {
            $err = "Isi Harga ";
        }

        if ($err == '') {
            $getDataMedia = sqlQuery("select * from temp_media_produk where username = '".$this->userName."'");
            $arrayMedia = array();
            while ($dataMedia = sqlArray($getDataMedia)) {
              $arrayMedia[] = array(
                'sourceMedia' => $dataMedia['media'],
                'type' => $dataMedia['type'],
              );
            }
            $arrayKomisi = array();
            $arrayKomisi[] = $jumlahKomisiLevel1;
            $arrayKomisi[] = $jumlahKomisiLevel2;
            $arrayKomisi[] = $jumlahKomisiLevel3;
            $arrayKomisi[] = $jumlahKomisiLevel4;
            $dataInsert  = array(
                'nama_produk' => $namaProduk,
                'kategori' => $kategoriProduk,
                'deskripsi' => base64_encode($deskripsiProduk),
                'harga' => $hargaUmum,
                'harga_member' => $hargaMember,
                'media' => json_encode($arrayMedia),
                'berat' => $beratProduk,
                'komisi' => json_encode($arrayKomisi),
                'diskon' => $diskonProduk,
                'nama_diskon' => $namaDiskon,
                'status' => $statusProduk,
            );
            $queryInsert = sqlInsert('produk', $dataInsert);
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
        if (empty($namaProduk)) {
            $err = "Isi Nama produk ";
        } elseif (empty($deskripsiProduk)) {
            // $err = "Isi Deskripsi";
        } elseif (empty($hargaUmum)) {
            $err = "Isi Harga ";
        }

        if ($err == '') {
            $getDataMedia = sqlQuery("select * from temp_media_produk where username = '".$this->userName."'");
            $arrayMedia = array();
            while ($dataMedia = sqlArray($getDataMedia)) {
              $arrayMedia[] = array(
                'sourceMedia' => $dataMedia['media'],
                'type' => $dataMedia['type'],
              );
            }
            $arrayKomisi = array();
            $arrayKomisi[] = $jumlahKomisiLevel1;
            $arrayKomisi[] = $jumlahKomisiLevel2;
            $arrayKomisi[] = $jumlahKomisiLevel3;
            $arrayKomisi[] = $jumlahKomisiLevel4;
            $dataUpdate  = array(
                'nama_produk' => $namaProduk,
                'kategori' => $kategoriProduk,
                'deskripsi' => base64_encode($deskripsiProduk),
                'harga' => $hargaUmum,
                'harga_member' => $hargaMember,
                'media' => json_encode($arrayMedia),
                'berat' => $beratProduk,
                'komisi' => json_encode($arrayKomisi),
                'diskon' => $diskonProduk,
                'nama_diskon' => $namaDiskon,
                'status' => $statusProduk,
            );

          $queryUpdate = sqlUpdate('produk', $dataUpdate,"id = '$idEdit'");
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
        foreach ($_REQUEST as $key => $value) {
            $$key = $value;
        }
        switch ($tipe) {

            case 'saveNewMedia': {
                if(empty($sourceMedia)){
                  $err = "Isi source media ";
                }elseif(empty($typeMedia)){
                  $err = "Pilih type media";
                }else{
                  $dataMedia = array(
                    'media' => $sourceMedia,
                    'type' => $typeMedia,
                    'username' => $this->userName,
                  );
                  $queryInsert = sqlInsert("temp_media_produk",$dataMedia);
                  sqlQuery($queryInsert);
                  $cek = $queryInsert;
                }
                $content = array(
                  'tableMedia' => $this->addMedia()
                );
                break;
            }
            case 'saveEditMedia': {
                if(empty($sourceMedia)){
                  $err = "Isi source media ";
                }elseif(empty($typeMedia)){
                  $err = "Pilih type media";
                }else{
                  $dataUpdate = array(
                    'media' => $sourceMedia,
                    'type' => $typeMedia,
                    'username' => $this->userName,
                  );
                  $queryUpdate = sqlUpdate("temp_media_produk",$dataUpdate,"id = '$idEdit'");
                  sqlQuery($queryUpdate);
                  $cek = $queryUpdate;
                }
                $content = array(
                  'tableMedia' => $this->addMedia()
                );
                break;
            }
            case 'hapusMedia': {
                sqlQuery("delete from temp_media_produk where id = '$idEdit'");
                $cek = "delete from temp_media_produk where id = '$idEdit'";
                $content = array(
                  'tableMedia' => $this->tempTableMedia()
                );
                break;
            }
            case 'batalMedia': {

                $content = array(
                  'tableMedia' => $this->tempTableMedia()
                );
                break;
            }
            case 'addMedia': {

                $content = array(
                  'tableMedia' => $this->addMedia()
                );
                break;
            }
            case 'editMedia': {

                $content = array(
                  'tableMedia' => $this->editMedia($idEdit)
                );
                break;
            }
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
            case 'showDetail': {
                $fm      = $this->showDetail($idEdit);
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
        <script type='text/javascript' src='js/refProduk/refProduk.js' language='JavaScript' ></script>
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
        sqlQuery("delete from temp_media_produk where username = '".$_COOKIE['coID']."'");

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
    function Edit()
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
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getDataEdit = sqlArray(sqlQuery("select * from produk where id = '".$idEdit[0]."'"));

        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusProduk', $getDataEdit['status'], $arrayStatus, '-- STATUS --', "");
        $comboKategori = cmbQuery("kategoriProduk",$getDataEdit['kategori'],"select id,nama_kategori from ref_kategori","class='form-control'"," -- KATEGORI --");
        sqlQuery("delete from temp_media_produk where username = '".$_COOKIE['coID']."'");
        $jsonDecodeMedia = json_decode($getDataEdit['media']);
        for ($i=0; $i < sizeof($jsonDecodeMedia) ; $i++) {
          $dataTempMedia = array(
            'username' => $this->userName,
            'media' => $jsonDecodeMedia[$i]->sourceMedia,
            'type' => $jsonDecodeMedia[$i]->type,
          );
          sqlQuery(sqlInsert("temp_media_produk",$dataTempMedia));
        }

        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Produk','namaProduk',$getDataEdit['nama_produk'],'12','1','11'),
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
        $getDataEdit = sqlArray(sqlQuery("select * from produk where id = '".$idEdit."'"));

        $arrayStatus = array(
          array("AKTIF","AKTIF"),
          array("TIDAK AKTIF","TIDAK AKTIF"),
        );
        $comboStatus = cmbArray('statusProduk', $getDataEdit['status'], $arrayStatus, '-- STATUS --', "");
        $comboKategori = cmbQuery("kategoriProduk",$getDataEdit['kategori'],"select id,nama_kategori from ref_kategori","class='form-control'"," -- KATEGORI --");
        sqlQuery("delete from temp_media_produk where username = '".$_COOKIE['coID']."'");
        $jsonDecodeMedia = json_decode($getDataEdit['media']);
        for ($i=0; $i < sizeof($jsonDecodeMedia) ; $i++) {
          $dataTempMedia = array(
            'username' => $this->userName,
            'media' => $jsonDecodeMedia[$i]->sourceMedia,
            'type' => $jsonDecodeMedia[$i]->type,
          );
          sqlQuery(sqlInsert("temp_media_produk",$dataTempMedia));
        }

        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Produk','namaProduk',$getDataEdit['nama_produk'],'12','1','11'),
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
    		   <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>NAMA PRODUK</th>
    		   <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>KATEGORI</th>
    		   <th class='th01'  width='100' colspan='2' rowspan='1'  style='text-align:center;vertical-align:middle;border-bottom: none;'>HARGA</th>
    		   <th class='th01'  width='100' colspan='4' rowspan='1'  style='text-align:center;vertical-align:middle;border-bottom: none;'>KOMISI</th>
           <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>BERAT</th>
           <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>PROMO</th>
           <th class='th01'  width='100' colspan='1' rowspan='2'   style='text-align:center;vertical-align:middle;'>DETAIL</th>
    	   </tr>
         <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>UMUM</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>MEMBER</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>LEVEL 1</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>LEVEL 2</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>LEVEL 3</th>
         <th class='th01'  width='100' colspan='1' rowspan='1'   style='text-align:center;vertical-align:middle;'>LEVEL 4</th>
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
        $Koloms[] = array(
            'align="left" valign="middle"',
            $nama_produk
        );
        $getNamaKategori = sqlArray(sqlQuery("select * from ref_kategori where id = '$kategori'"));
        $Koloms[] = array(
            'align="left" valign="middle"',
            $getNamaKategori['nama_kategori']
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($harga,0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($harga_member,0)
        );
        $decodeKomisi = json_decode($komisi);
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($decodeKomisi[0],0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($decodeKomisi[1],0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($decodeKomisi[2],0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($decodeKomisi[3],0)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($berat,0)
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $nama_diskon
        );
        $Koloms[] = array(
            'align="center" valign="middle"',
            "<input type='button' class='btn btn-success' value='DETAIL' onclick=$this->Prefix.showDetail($id)> "
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
        $arrayKategori = array(
          array("produk","produk"),
          array("PRODUK","PRODUK"),
        );
        $comboKategori = cmbQuery('filterKategori', $filterKategori, "select id, nama_kategori from ref_kategori","class='form-control'" , '-- KATEGORI --', "");
        // $this->textBoxColumn('title','id','value','col_field','col_label','col_input');
        $fieldInform       .=  $this->newRow(array(
                                $this->textBoxColumn('Nama Produk','filterNamaProduk',$filterNamaProduk,'4','5','7'),
                                $this->customColumn('Kategori',$comboKategori,'4','5','7'),
                               ));
                               $arrayStatus = array(
                                 array("AKTIF","AKTIF"),
                                 array("TIDAK AKTIF","TIDAK AKTIF"),
                               );
                               $comboStatus = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "");

       $fieldInform        .=  $this->newRow(array(
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
        if (!empty($filterNamaProduk)) {
            $arrKondisi[] = "nama_produk like '%$filterNamaProduk%'";
        }
        if (!empty($filterStatus)) {
            $arrKondisi[] = "status ='$filterStatus'";
        }
        if (!empty($filterKategori)) {
            $arrKondisi[] = "kategori ='$filterKategori'";
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
        // $getTotal = sqlArray(sqlQuery("select sum(total) from produk ".$arrayKondisi['Kondisi']));
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
          sqlQuery("delete from users where id_produk = '".$ids[$i]."'");
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

      function tempTableMedia($idProduk){
        if(!empty($idProduk))$kondisiProduk = " and id_produk = '$idProduk'";
        $className= "row0";
        $nomor = 1;
        $getDataMedia = sqlQuery("select * from temp_media_produk where username = '".$this->userName."' $kondisiProduk");
        while ($dataMedia = sqlArray($getDataMedia)) {
          foreach ($dataMedia as $key => $value) {
              $$key = $value;
          }
          $listMedia.= "
          <tr class='$className'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'>$media</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$type</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>
            <span id='btnOpsi4910'>
						<img id='ubah4910' src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editMedia($id)>
						<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusMedia($id)>
						</span>
            </td>
          </tr>
          ";
      	  if($nomor % 2 == 1){
    	   		$className = "row0";
    	   	}else{
    	   		$className = "row1";
    	   	}
          $nomor+= 1;

        }
        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:60%;'>SOURCE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:30%;'>TYPE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>
            <span id='atasbutton'>
						 <a href='javascript:$this->Prefix.addMedia($idProduk)' id='linkAtasButton'><img id='gambarAtasButton' src='datepicker/add-256.png' style='width:20px;height:20px;'></a>
					  </span>
           </th>
    	   </tr>
        </thead>
        <tbody>
          ".$listMedia."
        </tbody>

        </table>

        ";
      }

      function addMedia(){
        // if(!empty($idProduk))$kondisiProduk = " and id_produk = '$idProduk'";
        $className= "row0";
        $nomor = 1;
        $getDataMedia = sqlQuery("select * from temp_media_produk where username = '".$this->userName."' $kondisiProduk");
        while ($dataMedia = sqlArray($getDataMedia)) {
          foreach ($dataMedia as $key => $value) {
              $$key = $value;
          }
          $listMedia.= "
          <tr class='$className'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'>$media</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$type</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>
            <span id='btnOpsi4910'>
						<img id='ubah4910' src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editMedia($id)>
						<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusMedia($id)>
						</span>
            </td>
          </tr>
          ";
          if($nomor % 2 == 1){
            $className = "row0";
          }else{
            $className = "row1";
          }
          $nomor+= 1;

        }
        $arrayType = array(
          array("GAMBAR","GAMBAR"),
          array("VIDEO","VIDEO"),
        );
        $comboType = cmbArray('typeMedia', $typeMedia, $arrayType, '-- TYPE --', "");
        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:60%;'>SOURCE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:30%;'>TYPE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>
            <span id='atasbutton'>
						 <a href='javascript:$this->Prefix.addMedia()' id='linkAtasButton'><img id='gambarAtasButton' src='datepicker/add-256.png' style='width:20px;height:20px;'></a>
					  </span>
           </th>
    	   </tr>
        </thead>
        <tbody>
          ".$listMedia."
          <tr class='$className'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='sourceMedia' id='sourceMedia' ></td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>$comboType</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>
            <span id='btnOpsi4910'>
            <img id='ubah4910' src='datepicker/save.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.saveNewMedia()>
            <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.batalMedia()>
            </span>
            </td>
          </tr>
        </tbody>

        </table>

        ";
      }
      function editMedia($idEdit){
        // if(!empty($idProduk))$kondisiProduk = " and id_produk = '$idProduk'";
        $className= "row0";
        $nomor = 1;
        $getDataMedia = sqlQuery("select * from temp_media_produk where username = '".$this->userName."'");
        while ($dataMedia = sqlArray($getDataMedia)) {
          foreach ($dataMedia as $key => $value) {
              $$key = $value;
          }
          if($id == $idEdit){
            $arrayType = array(
              array("GAMBAR","GAMBAR"),
              array("VIDEO","VIDEO"),
            );
            $comboType = cmbArray('typeMedia', $type, $arrayType, '-- TYPE --', "");
            $listMedia.= "
            <tr class='$className'>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
              <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='sourceMedia' id='sourceMedia' value='$media' ></td>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>$comboType</td>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>
              <span id='btnOpsi4910'>
              <img id='ubah4910' src='datepicker/save.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.saveEditMedia($idEdit)>
              <img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.batalMedia()>
              </span>
              </td>
            </tr>
            ";
          }else{
            $listMedia.= "
            <tr class='$className'>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>$nomor</td>
              <td class='GarisDaftar' style='text-align:left;valign:middle;'>$media</td>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>$type</td>
              <td class='GarisDaftar' style='text-align:center;valign:middle;'>
              <span id='btnOpsi4910'>
  						<img id='ubah4910' src='images/administrator/images/edit_f2.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.editMedia($id)>
  						<img src='images/administrator/images/invalid.png' width='20px' heigh='20px' style='cursor : pointer;' onclick=$this->Prefix.hapusMedia($id)>
  						</span>
              </td>
            </tr>
            ";
          }

          if($nomor % 2 == 1){
            $className = "row0";
          }else{
            $className = "row1";
          }
          $nomor+= 1;

        }

        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:60%;'>SOURCE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:30%;'>TYPE</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:10%;'>
            <span id='atasbutton'>
						 <a href='javascript:$this->Prefix.addMedia()' id='linkAtasButton'><img id='gambarAtasButton' src='datepicker/add-256.png' style='width:20px;height:20px;'></a>
					  </span>
           </th>
    	   </tr>
        </thead>
        <tbody>
          ".$listMedia."

        </tbody>

        </table>

        ";
      }
      function tempTableKomisi($idProduk){
        $className= "row0";

        $arrayType = array(
          array("GAMBAR","GAMBAR"),
          array("VIDEO","VIDEO"),
        );
        $getDataEdit = sqlArray(sqlQuery("select * from produk where id = '$idProduk'"));
        $decodeKomisi= json_decode($getDataEdit['komisi']);
        $comboType = cmbArray('typeMedia', $typeMedia, $arrayType, '-- TYPE --', "");
        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:30%;'>LEVEL</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:60%;'>KOMISI</th>
    	   </tr>
        </thead>
        <tbody>
          <tr class='row0'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>1</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>LEVEL 1</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='jumlahKomisiLevel1' id='jumlahKomisiLevel1' value='".$decodeKomisi[0]."' ></td>
          </tr>
          <tr class='row1'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>2</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>LEVEL 2</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='jumlahKomisiLevel2' id='jumlahKomisiLevel2' value='".$decodeKomisi[1]."' ></td>
          </tr>
          <tr class='row0'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>3</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>LEVEL 3</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='jumlahKomisiLevel3' id='jumlahKomisiLevel3' value='".$decodeKomisi[2]."' ></td>
          </tr>
          <tr class='row1'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>4</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>LEVEL 4</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='jumlahKomisiLevel4' id='jumlahKomisiLevel4' value='".$decodeKomisi[3]."' ></td>
          </tr>


        </tbody>

        </table>

        ";
      }
      function tempTableHarga($idProduk){
        $className= "row0";
        $getDataEdit = sqlArray(sqlQuery("select * from produk where id = '$idProduk'"));
        $arrayType = array(
          array("GAMBAR","GAMBAR"),
          array("VIDEO","VIDEO"),
        );
        $comboType = cmbArray('typeMedia', $typeMedia, $arrayType, '-- TYPE --', "");
        return "
        <table class='table table-sm table-striped table-hover' border='1' style='min-width: 100%;border: 1px solid #b0b0b2;' id='tech-companies-1'>
        <thead>
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01' style='text-align:center;vertical-align:middle;width:1%;'>No.</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:30%;'>LEVEL</th>
    		   <th class='th01' style='text-align:center;vertical-align:middle;width:60%;'>HARGA</th>
    	   </tr>
        </thead>
        <tbody>
          <tr class='row0'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>1</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>UMUM</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='hargaUmum' id='hargaUmum' value='".$getDataEdit['harga']."' ></td>
          </tr>
          <tr class='row1'>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>2</td>
            <td class='GarisDaftar' style='text-align:center;valign:middle;'>MEMBER</td>
            <td class='GarisDaftar' style='text-align:left;valign:middle;'><input type='text' class='form-control' name='hargaMember' id='hargaMember' value='".$getDataEdit['harga_member']."' ></td>
          </tr>



        </tbody>

        </table>

        ";
      }

}
$refProduk = new refProdukObj();
$refProduk->userName = $_COOKIE['coID'];;
?>
