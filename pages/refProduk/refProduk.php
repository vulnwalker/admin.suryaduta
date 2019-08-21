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
    var $PageTitle = 'refProduk';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'refProduk.xls';
    var $namaModulCetak = 'refProduk';
    var $Cetak_Judul = 'refProduk';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'refProdukForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0

    function setTitle()
    {
        return 'PRODUK';
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
        if (empty($namaProduk)) {
            $err = "Isi Nama Produk";
        } elseif (empty($hargaProduk)) {
            $err = "Isi Harga Produk";
        } elseif (empty($hargaProdukMember)) {
            $err = "Isi Harga Produk Member";
        } elseif (empty($deskkripsiProduk)) {
            $err = "Isi Deskripsi Produk";
        }
        $imageLocation = "upload/".md5(date('Y-m-d')).md5(date('H:i:s')).".jpg";
        $this->baseToImage($baseOfFile,$imageLocation);

        if ($err == '') {
            $arrayKomisi = array(
              array("komisi" => $this->dropPoint($komisiLevel1)),
              array("komisi" => $this->dropPoint($komisiLevel2)),
              array("komisi" => $this->dropPoint($komisiLevel3)),
              array("komisi" => $this->dropPoint($komisiLevel4)),
            );
            $dataInsert  = array(
                'nama_produk' => $namaProduk,
                'harga' => $this->dropPoint($hargaProduk),
                'harga_member' => $this->dropPoint($hargaProdukMember),
                'berat' => $this->dropPoint($beratProduk),
                'deskripsi' => $deskkripsiProduk,
                'promo' => $promoProduk,
                'komisi' => json_encode($arrayKomisi,JSON_PRETTY_PRINT),
                'gambar' => $imageLocation,
                'video' => $videoProduk,
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
            $err = "Isi Nama Produk";
        } elseif (empty($hargaProduk)) {
            $err = "Isi Harga Produk";
        } elseif (empty($hargaProdukMember)) {
            $err = "Isi Harga Produk Member";
        } elseif (empty($deskkripsiProduk)) {
            $err = "Isi Deskripsi Produk";
        }

        if ($err == '') {
          $imageLocation = "upload/".md5(date('Y-m-d')).md5(date('H:i:s')).".jpg";
          $this->baseToImage($baseOfFile,$imageLocation);
          $arrayKomisi = array(
            array("komisi" => $this->dropPoint($komisiLevel1)),
            array("komisi" => $this->dropPoint($komisiLevel2)),
            array("komisi" => $this->dropPoint($komisiLevel3)),
            array("komisi" => $this->dropPoint($komisiLevel4)),
          );
          if(!empty($baseOfFile)){
            $dataUpdate  = array(
              'nama_produk' => $namaProduk,
              'harga' => $this->dropPoint($hargaProduk),
              'harga_member' => $this->dropPoint($hargaProdukMember),
              'berat' => $this->dropPoint($beratProduk),
              'deskripsi' => $deskkripsiProduk,
              'promo' => $promoProduk,
              'komisi' => json_encode($arrayKomisi,JSON_PRETTY_PRINT),
              'gambar' => $imageLocation,
              'video' => $videoProduk,
            );
          }else{
            $dataUpdate  = array(
              'nama_produk' => $namaProduk,
              'harga' => $this->dropPoint($hargaProduk),
              'harga_member' => $this->dropPoint($hargaProdukMember),
              'berat' => $this->dropPoint($beratProduk),
              'deskripsi' => $deskkripsiProduk,
              'promo' => $promoProduk,
              'komisi' => json_encode($arrayKomisi),
              'gambar' => $imageLocation,
              'video' => $videoProduk,
            );
          }
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

        switch ($tipe) {

            case 'showDetail': {
                $fm      = $this->showDetail();
                $cek     = $fm['cek'];
                $err     = $fm['err'];
                $content = $fm['content'];
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
        return "<script type='text/javascript' src='js/refProduk/refProduk.js' language='JavaScript' ></script>

        <script src='js/thead.js'></script>
        <script src='js/jquery.fixedTableHeader.js'></script>


        " .			$this->loadCalendar().
        "



" . $scriptload;

//            <script type='text/javascript' language='JavaScript'  src='js/textboxio/textboxio.js'></script>
    }





    function showDetail()
    {
      foreach ($_REQUEST as $key => $value) {
          $$key = $value;
      }
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 400;
        $this->form_height  = 300;
        $this->form_caption = 'Media';

        $getDataProduk = sqlArray(sqlQuery("select * from $this->TblName where id = '$idProduk'"));
        //items ----------------------
        $this->form_fields    = array(

            'gambar' => array(
                'label' => '',
                'labelWidth' => 150,
                'value' => "
                <img  src='".$getDataProduk['gambar']."' style='align:center;vertical-align:middle;height:200px;width:200px;float:center !important;'  >
                  ",
                "type" => "merge"
            ),
            'gambar2' => array(
                'label' => '',
                'labelWidth' => 150,
                'value' => "
                  <br>
                  ",
                "type" => "merge"
            ),
            'video' => array(
                'label' => 'VIDEO',
                'labelWidth' => 150,
                'value' => "<a style='color:blue;' href='".$getDataProduk['video']."' target='_blank' > ".$getDataProduk['video']."</a>"
            ),

        );
        //tombol
        $this->form_menubawah = "
        <input type='button' class='btn btn-success' value='Simpan' onclick ='" . $this->Prefix . ".saveNew()' title='Simpan'>&nbsp&nbsp"
        . "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm();
        $content = $form; //$content = 'content';
        return array(
            'cek' => $cek,
            'err' => $err,
            'content' => $content
        );
    }
    function Baru()
    {

        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 600;
        $this->form_height  = 500;
        $this->form_caption = 'Baru';


        //items ----------------------
        $this->form_fields    = array(

            'judul' => array(
                'label' => 'Nama Produk',
                'labelWidth' => 150,
                'value' => "<input type='text' name = 'namaProduk' id = 'namaProduk' class='form-control'  >"
            ),
            'hargaProduk' => array(
                'label' => 'Harga Produk ( GUEST )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "hargaProduk"
                  )
                )
            ),
            'hargaProdukMember' => array(
                'label' => 'Harga Produk ( MEMBER )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "hargaProdukMember"
                  )
                )
            ),
            'beratProduk' => array(
                'label' => 'Berat',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "beratProduk"
                  )
                )
            ),
            'deskkripsiProduk' => array(
                'label' => 'Deskripsi Produk',
                'labelWidth' => 150,
                'value' => "<textarea  style='height: 800px;' name = 'deskkripsiProduk' id = 'deskkripsiProduk'  class='form-control'   > </textarea>",

            ),
            'promoProduk' => array(
                'label' => 'Promo Produk',
                'labelWidth' => 150,
                'value' => "<textarea  style='height: 800px;' name = 'promoProduk' id = 'promoProduk'  class='form-control'   > </textarea>",

            ),
            'komisiLevel1' => array(
                'label' => 'Komisi ( LEVEL 1 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel1"
                  )
                )
            ),
            'komisiLevel2' => array(
                'label' => 'Komisi ( LEVEL 2 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel2"
                  )
                )
            ),
            'komisiLevel3' => array(
                'label' => 'Komisi ( LEVEL 3 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel3"
                  )
                )
            ),
            'komisiLevel4' => array(
                'label' => 'Komisi ( LEVEL 4 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel4"
                  )
                )
            ),
            'gambar' => array(
                'label' => 'Gambar',
                'labelWidth' => 150,
                'value' =>
                "<input type='file' id='gambarProduk' name='gambarProduk' accept='image/x-png,image/gif,image/jpeg' onchange=$this->Prefix.imageChanged() placeholder='image' >".
                "<input type='hidden' name = 'namaFile' id = 'namaFile' class='form-control'  >".
                "<input type='hidden' name = 'baseOfFile' id = 'baseOfFile' class='form-control'  >"
            ),
            'video' => array(
                'label' => 'Video ( You Tube )',
                'labelWidth' => 150,
                'value' =>
                "<input type='text' name = 'videoProduk' id = 'videoProduk' class='form-control'  >"

            ),
        );
        //tombol
        $this->form_menubawah = "
        <input type='button' class='btn btn-success' value='Simpan' onclick ='" . $this->Prefix . ".saveNew()' title='Simpan'>&nbsp&nbsp"
        . "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

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
        $this->form_width   = 600;
        $this->form_height  = 500;
        $this->form_caption = 'Edit';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getData            = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idEdit[0] . "'"));
        foreach ($getData as $key => $value) {
            $$key = $value;
        }
        $arrayDataKomisi = json_decode($komisi);
        $this->form_fields    = array(

            'judul' => array(
                'label' => 'Nama Produk',
                'labelWidth' => 150,
                'value' => "<input type='text' name = 'namaProduk' id = 'namaProduk' class='form-control'  value='$nama_produk' >"
            ),
            'hargaProduk' => array(
                'label' => 'Harga Produk ( GUEST )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "hargaProduk",
                    "value" =>  $this->numberFormat(intval($harga))
                  )
                )
            ),
            'hargaProdukMember' => array(
                'label' => 'Harga Produk ( MEMBER )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "hargaProdukMember",
                    "value" =>  $this->numberFormat(intval($harga_member))
                  )
                )
            ),
            'beratProduk' => array(
                'label' => 'Berat',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "beratProduk",
                  "value" =>  $this->numberFormat(intval($berat))
                  )
                )
            ),
            'deskkripsiProduk' => array(
                'label' => 'Deskripsi Produk',
                'labelWidth' => 150,
                'value' => "<textarea  style='height: 800px;' name = 'deskkripsiProduk' id = 'deskkripsiProduk'  class='form-control'   >$deskripsi</textarea>",

            ),
            'promoProduk' => array(
                'label' => 'Promo Produk',
                'labelWidth' => 150,
                'value' => "<textarea  style='height: 800px;' name = 'promoProduk' id = 'promoProduk'  class='form-control'   >$promo</textarea>",

            ),
            'komisiLevel1' => array(
                'label' => 'Komisi ( LEVEL 1 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel1",
                    "value" =>  $this->numberFormat(intval($arrayDataKomisi[0]->komisi))
                  )
                )
            ),
            'komisiLevel2' => array(
                'label' => 'Komisi ( LEVEL 2 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel2",
                    "value" =>  $this->numberFormat(intval($arrayDataKomisi[1]->komisi))
                  )
                )
            ),
            'komisiLevel3' => array(
                'label' => 'Komisi ( LEVEL 3 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel3",
                    "value" =>  $this->numberFormat(intval($arrayDataKomisi[2]->komisi))
                  )
                )
            ),
            'komisiLevel4' => array(
                'label' => 'Komisi ( LEVEL 4 )',
                'labelWidth' => 150,
                'value' =>
                $this->numberText(
                  array(
                    "id" => "komisiLevel4",
                    "value" =>  $this->numberFormat(intval($arrayDataKomisi[3]->komisi))
                  )
                )
            ),
            'gambar' => array(
                'label' => 'Gambar',
                'labelWidth' => 150,
                'value' =>
                "<input type='file' id='gambarProduk' name='gambarProduk' accept='image/x-png,image/gif,image/jpeg' onchange=$this->Prefix.imageChanged() placeholder='image' >".
                "<input type='hidden' name = 'namaFile' id = 'namaFile' class='form-control'  >".
                "<input type='hidden' name = 'baseOfFile' id = 'baseOfFile'  class='form-control'  >"
            ),
            'video' => array(
                'label' => 'Video ( You Tube )',
                'labelWidth' => 150,
                'value' =>
                "<input type='text' name = 'videoProduk' id = 'videoProduk' class='form-control' value='$video'  >"

            ),
        );
        //tombol
        $this->form_menubawah = "<input type='button' class='btn btn-success' value='Simpan' onclick ='" . $this->Prefix . ".saveEdit(" . $idEdit[0] . ")' title='Simpan'>&nbsp&nbsp" . "<input type='button' class='btn btn-success' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

        $form    = $this->genForm();
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
        $listEmail          = implode(';', $_REQUEST['refProduk_cb']);

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
        $this->form_menubawah = "<input type='button' value='Simpan' onclick ='" . $this->Prefix . ".sendBroadCast($idrefProduk)' title='Simpan'>&nbsp&nbsp" . "<input type='button' value='Batal' onclick ='" . $this->Prefix . ".Close()' >";

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
  	   <th class='th01'  width='5' rowspan='2' style='text-align:center;vertical-align:middle;'>No.</th>
  	   $Checkbox
		   <th class='th01' width='100' rowspan='2' style='text-align:center;vertical-align:middle;'>NAMA PRODUK</th>
	     <th class='th02'  width='150' rowspan='1' colspan='2' style='text-align:center;vertical-align:middle;'>HARGA</th>
		   <th class='th01' width='880' rowspan='2' style='text-align:center;vertical-align:middle;'>DESKRIPSI</th>
		   <th class='th01' width='880' rowspan='2' style='text-align:center;vertical-align:middle;'>PROMO</th>
 	     <th class='th02'  width='150' rowspan='1' colspan='4' style='text-align:center;vertical-align:middle;'>KOMISI</th>
       <th class='th01' width='100' rowspan='2' style='text-align:center;vertical-align:middle;'>BERAT ( GRAM )</th>
       <th class='th01' width='50' rowspan='2' style='text-align:center;vertical-align:middle;'>MEDIA</th>
	   </tr>
     </tr>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>GUEST</th>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>MEMBER</th>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>LEVEL 1</th>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>LEVEL 2</th>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>LEVEL 3</th>
      <th class='th01' width='100' style='text-align:center;vertical-align:middle;'>LEVEL 4</th>
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
            $nama_produk
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($harga)
        );
        $Koloms[] = array(
            'align="right" valign="middle"',
            $this->numberFormat($harga_member)
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $deskripsi
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $promo
        );
        $arrayDataKomisi = json_decode($komisi);
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($arrayDataKomisi[0]->komisi)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($arrayDataKomisi[1]->komisi)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($arrayDataKomisi[2]->komisi)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($arrayDataKomisi[3]->komisi)
        );
        $Koloms[] = array(
          'align="center" valign="middle"',
          $this->numberFormat($berat)
        );
        $Koloms[] = array(
          'align="center" valign="middle"',
          "<input type='button' class='btn btn-success' onclick=$this->Prefix.showDetail($id) value='SHOW'  >"
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
                'PREMIUM',
                'PREMIUM'
            ),
        );
        if (empty($jumlahData))
        $jumlahData = 50;
        $comboFilterstatusProduk = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "onchange=$this->Prefix.refreshList(true)");
        $TampilOpt         = "<div class='FilterBar' style='margin-top:5px;'>" . "<table style='width:100%'>
				<tr>
					<td>NAMA PRODUK</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterNamaProduk' id ='filterNamaProduk' style='width:400px;' value='$filterNamaProduk'>
					</td>
				</tr>
				<tr>
					<td>DESKRIPSI</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterDeskripsiProduk' id ='filterDeskripsiProduk' style='width:400px;' value='$filterDeskripsiProduk'>
					</td>
				</tr>
				<tr>
					<td>PROMO</td>
					<td>:</td>
					<td style='width:86%;'>
						<input type='text' class='form-control' name='filterPromoProduk' id ='filterPromoProduk' style='width:400px;' value='$filterPromoProduk'>
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
        if (!empty($filterNamaProduk)) {
            $arrKondisi[] = "nama_produk like '%$filterNamaProduk%'";
        }
        if (!empty($filterDeskripsiProduk)) {
            $arrKondisi[] = "deskripsi like '%$filterDeskripsiProduk%'";
        }
        if (!empty($filterPromoProduk)) {
            $arrKondisi[] = "promo like '%$filterPromoProduk%'";
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
                $arrOrders[] = " type_refProduk $Asc1 ";
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
$refProduk = new refProdukObj();
?>
