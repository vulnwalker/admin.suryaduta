<?php

class dashboardObj extends configClass
{
    var $Prefix = 'dashboard';
    var $elCurrPage = "HalDefault";
    var $SHOW_CEK = TRUE;
    var $TblName = 'penjualan'; //bonus
    var $TblName_Hapus = 'penjualan';
    var $MaxFlush = 10;
    var $TblStyle = array('koptable', 'cetak', 'cetak'); //berdasar mode
    var $ColStyle = array('GarisDaftar', 'GarisCetak', 'GarisCetak');
    var $KeyFields = array('id');
    var $FieldSum = array(); //array('jml_harga');
    var $SumValue = array();
    var $FieldSum_Cp1 = array(14, 13, 13); //berdasar mode
    var $FieldSum_Cp2 = array(1, 1, 1);
    var $checkbox_rowspan = 2;
    var $PageTitle = 'penjualan Produk';
    var $PageIcon = 'images/administrasi_ico.png';
    var $pagePerHal = '';
    //var $cetak_xls=TRUE ;
    var $fileNameExcel = 'dashboard.xls';
    var $namaModulCetak = 'ADMINISTRASI';
    var $Cetak_Judul = 'penjualan Produk';
    var $Cetak_Mode = 2;
    var $Cetak_WIDTH = '30cm';
    var $Cetak_OtherHTMLHead;
    var $FormName = 'dashboardForm';
    var $noModul = 14;
    var $TampilFilterColapse = 0; //0
    var $userName = ''; //0

    function setTitle()
    {
        return 'DASHBOARD';
    }

    function filterSaldoMiring()
    {
        return "";
    }
    function setMenuEdit()
    {
      // fujinFabMenu(id,href,title,img,style);
       $fabMenu = '';
       // $fabMenu .= fujinFabMenu('','Detail()','Detail','info.png','',$this->Prefix);
       // $fabMenu .= fujinFabMenu('','Konfirmasi()','Konfirmasi','edit_f2.png','',$this->Prefix);
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
                'nama_penjualan' => $namaProduk,
                'harga' => $this->dropPoint($hargaProduk),
                'harga_member' => $this->dropPoint($hargaProdukMember),
                'deskripsi' => $deskkripsiProduk,
                'promo' => $promoProduk,
                'komisi' => json_encode($arrayKomisi),
                'gambar' => $imageLocation,
                'video' => $videoProduk,
            );
            $queryInsert = sqlInsert('penjualan', $dataInsert);
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

            case 'Invoice':{
              $json = FALSE;
              $this->Invoice();
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
        return "
        <script type='text/javascript' src='js/dashboard.js' language='JavaScript' ></script>





" . $scriptload;

//            <script type='text/javascript' language='JavaScript'  src='js/textboxio/textboxio.js'></script>
    }



    function saveKonfirmasi(){
      $err = "";
      $cek = "";
      $content = array();
      foreach ($_REQUEST as $key => $value) {
          $$key = $value;
      }
      $getDataPenjualan = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idPenjualan . "'"));
      if($getDataPenjualan['status'] == "SUKSES"){
        $err = "Penjualan sudah terkonfirmasi !";
      }
      if(empty($err)){
        if($statusPenjualan == "SUKSES"){
          if(!empty($getDataPenjualan['id_member'])){
            $getDataMember = sqlArray(sqlQuery("select * from users where id ='".$getDataPenjualan['id_member']."'"));
            $decodeUplineInvitor = json_decode($getDataMember['upline']);
            $arrayUplineNewMember = array(
              array(
                "LEVEL1" => $decodeUplineInvitor[1]->LEVEL2,
              ),
              array(
                "LEVEL2" => $decodeUplineInvitor[2]->LEVEL3,
              ),
              array(
                "LEVEL3" => $decodeUplineInvitor[3]->LEVEL4,
              ),
              array(
                "LEVEL4" => $getDataPenjualan['id_member'],
              )
            );
            if($getDataMember['email'] != $getDataPenjualan['email_pembeli']){
              $alamatPembeli = $getDataPenjualan['alamat_pengiriman']."\n".
                        $getDataPenjualan['kecamatan_pengiriman']." <br>".
                        $getDataPenjualan['kota_pengiriman']." <br>".
                        $getDataPenjualan['provinsi_pengiriman']." <br>".
                        $getDataPenjualan['kode_pos_pengiriman'];
                        ;
              $dataMemberBaru = array(
                'email' => $getDataPenjualan['email_pembeli'],
                'password' => password_hash("123456",PASSWORD_BCRYPT),
                'nama' => $getDataPenjualan['nama_pembeli'],
                'alamat' => $alamatPembeli,
                'nomor_telepon' => $getDataPenjualan['nomor_telepon'],
                'tanggal_join' => date("Y-m-d"),
                'status' => "AKTIF",
                'upline' => json_encode($arrayUplineNewMember,JSON_PRETTY_PRINT),
              );
              $queryInsertMember = sqlInsert("users",$dataMemberBaru);
              sqlQuery($queryInsertMember);

              //PENENTUAN KOMISI
              $arrayBagiKomisi = array();
              $getDetailPenjualan = sqlQuery("select * from detail_penjualan where id_penjualan = '$idPenjualan'");
              while ($dataDetailPenjualan = sqlArray($getDetailPenjualan)) {
                $getDataProduk = sqlArray(sqlQuery("select * from produk where id = '".$dataDetailPenjualan['id_produk']."'"));
                $arrayKomisiProduk = json_decode($getDataProduk['komisi']);
                $arrayBagiKomisi[] = array(
                  "komisiLevel1" =>  $arrayKomisiProduk[0]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel2" =>  $arrayKomisiProduk[1]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel3" =>  $arrayKomisiProduk[2]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel4" =>  $arrayKomisiProduk[3]->komisi * $dataDetailPenjualan['jumlah'],
                  "jumlahProduk" =>  $dataDetailPenjualan['jumlah'],
                );
              }

              if(!empty(sizeof($arrayBagiKomisi))){
                for ($i=0; $i < sizeof($arrayBagiKomisi); $i++) {
                  $totalKomisiLevel1 += $arrayBagiKomisi[$i]['komisiLevel1'];
                  $totalKomisiLevel2 += $arrayBagiKomisi[$i]['komisiLevel2'];
                  $totalKomisiLevel3 += $arrayBagiKomisi[$i]['komisiLevel3'];
                  $totalKomisiLevel4 += $arrayBagiKomisi[$i]['komisiLevel4'];
                  $jumlahProduk += $arrayBagiKomisi[$i]['jumlahProduk'];
                }
                //MEMBER LEVEL1
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[0]->LEVEL1."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel1 where id_member = '".$decodeUplineInvitor[0]->LEVEL1."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[0]->LEVEL1,
                    "komisi" => $totalKomisiLevel1,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel1 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel1,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[0]->LEVEL1,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel1,$decodeUplineInvitor[0]->LEVEL1);

                //MEMBER LEVEL 2
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[1]->LEVEL2."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel2 where id_member = '".$decodeUplineInvitor[1]->LEVEL2."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[1]->LEVEL2,
                    "komisi" => $totalKomisiLevel2,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel2 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel2,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[1]->LEVEL2,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel2,$decodeUplineInvitor[1]->LEVEL2);

                //MEMBER LEVEL 3
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[2]->LEVEL3."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel3 where id_member = '".$decodeUplineInvitor[2]->LEVEL3."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[2]->LEVEL3,
                    "komisi" => $totalKomisiLevel3,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel3 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel3,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[2]->LEVEL3,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel3,$decodeUplineInvitor[2]->LEVEL3);

                //MEMBER LEVEL4
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[3]->LEVEL4."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel4 where id_member = '".$decodeUplineInvitor[3]->LEVEL4."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[3]->LEVEL4,
                    "komisi" => $totalKomisiLevel4,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel4 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel4,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[3]->LEVEL4 ,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel4,$decodeUplineInvitor[3]->LEVEL4);

                //MEMBER DIRECT

                $dataKomisiMemberDirect = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $getDataProduk['harga'] - $getDataProduk['harga_member'],
                  'jenis_komisi' => "REKRUT",
                  'id_member' => $getDataPenjualan['id_member'] ,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberDirect,$getDataPenjualan['id_member']);
                sqlQuery("UPDATE users set jumlah_transaksi = jumlah_transaksi + 1 where id = '".$getDataPenjualan['id_member']."'");
                $komisiMemberDirect = $getDataProduk['harga'] - $getDataProduk['harga_member'];
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$getDataPenjualan['id_member']."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $komisiMemberDirect where id_member = '".$getDataPenjualan['id_member']."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $getDataPenjualan['id_member'],
                    "komisi" => $komisiMemberDirect,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
              }

            }else{
              //Repeat Order Member Lama
              //PENENTUAN KOMISI
              $arrayBagiKomisi = array();
              $getDetailPenjualan = sqlQuery("select * from detail_penjualan where id_penjualan = '$idPenjualan'");
              while ($dataDetailPenjualan = sqlArray($getDetailPenjualan)) {
                $getDataProduk = sqlArray(sqlQuery("select * from produk where id = '".$dataDetailPenjualan['id_produk']."'"));
                $arrayKomisiProduk = json_decode($getDataProduk['komisi']);
                $arrayBagiKomisi[] = array(
                  "komisiLevel1" =>  $arrayKomisiProduk[0]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel2" =>  $arrayKomisiProduk[1]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel3" =>  $arrayKomisiProduk[2]->komisi * $dataDetailPenjualan['jumlah'],
                  "komisiLevel4" =>  $arrayKomisiProduk[3]->komisi * $dataDetailPenjualan['jumlah'],
                  "jumlahProduk" =>  $dataDetailPenjualan['jumlah'],
                );
              }

              if(!empty(sizeof($arrayBagiKomisi))){
                for ($i=0; $i < sizeof($arrayBagiKomisi); $i++) {
                  $totalKomisiLevel1 += $arrayBagiKomisi[$i]['komisiLevel1'];
                  $totalKomisiLevel2 += $arrayBagiKomisi[$i]['komisiLevel2'];
                  $totalKomisiLevel3 += $arrayBagiKomisi[$i]['komisiLevel3'];
                  $totalKomisiLevel4 += $arrayBagiKomisi[$i]['komisiLevel4'];
                  $jumlahProduk += $arrayBagiKomisi[$i]['jumlahProduk'];
                }
                //MEMBER LEVEL1
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[0]->LEVEL1."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel1 where id_member = '".$decodeUplineInvitor[0]->LEVEL1."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[0]->LEVEL1,
                    "komisi" => $totalKomisiLevel1,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel1 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel1,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[0]->LEVEL1,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel1,$decodeUplineInvitor[0]->LEVEL1);
                //MEMBER LEVEL 2
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[1]->LEVEL2."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel2 where id_member = '".$decodeUplineInvitor[1]->LEVEL2."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[1]->LEVEL2,
                    "komisi" => $totalKomisiLevel2,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel2 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel2,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[1]->LEVEL2,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel2,$decodeUplineInvitor[1]->LEVEL2);
                //MEMBER LEVEL 3
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[2]->LEVEL3."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel3 where id_member = '".$decodeUplineInvitor[2]->LEVEL3."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[2]->LEVEL3,
                    "komisi" => $totalKomisiLevel3,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel3 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel3,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[2]->LEVEL3,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel3,$decodeUplineInvitor[2]->LEVEL3);
                //MEMBER LEVEL4
                if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$decodeUplineInvitor[3]->LEVEL4."' and periode = '".date("Y-m")."'")) !=0 ){
                  sqlQuery("UPDATE rekap_transaksi set komisi = komisi + $totalKomisiLevel4 where id_member = '".$decodeUplineInvitor[3]->LEVEL4."' and periode = '".date("Y-m")."' ");
                }else{
                  $dataRekapTransaksi = array(
                    "id_member" => $decodeUplineInvitor[3]->LEVEL4,
                    "komisi" => $totalKomisiLevel4,
                    "jumlah_penjualan" => 0,
                    "jumlah_barang" => 0,
                    "periode" => date("Y-m"),
                  );
                  $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                  sqlQuery($queryInsertRekapTransaksi);
                }
                $dataKomisiMemberLevel4 = array(
                  'id_penjualan' => $idPenjualan,
                  'komisi' => $totalKomisiLevel4,
                  'jenis_komisi' => "PENJUALAN",
                  'id_member' => $decodeUplineInvitor[3]->LEVEL4 ,
                  'tanggal' => date("Y-m-d"),
                );
                $this->insertKomisi($dataKomisiMemberLevel4,$decodeUplineInvitor[3]->LEVEL4);
              }
              if(sqlRowCount(sqlQuery("select * from rekap_transaksi where id_member = '".$getDataPenjualan['id_member']."' and periode = '".date("Y-m")."'")) !=0 ){
                sqlQuery("UPDATE rekap_transaksi set jumlah_penjualan = jumlah_penjualan + 1, jumlah_barang = jumlah_barang + $jumlahProduk where id_member = '".$getDataPenjualan['id_member']."' and periode = '".date("Y-m")."' ");
              }else{
                $dataRekapTransaksi = array(
                  "id_member" => $getDataPenjualan['id_member'],
                  "komisi" => 0,
                  "jumlah_penjualan" => 1,
                  "jumlah_barang" => $jumlahProduk,
                  "periode" => date("Y-m"),
                );
                $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
                sqlQuery($queryInsertRekapTransaksi);
              }
              sqlQuery("UPDATE users set jumlah_transaksi = jumlah_transaksi + 1, jumlah_barang = jumlah_barang + $jumlahProduk  where id = '".$getDataPenjualan['id_member']."'");
            }
          }else{
            //Yatim piatu
            //Insert MEMBER
            $arrayUplineNewMember = array(
              array(
                "LEVEL1" => "0",
              ),
              array(
                "LEVEL2" => "0",
              ),
              array(
                "LEVEL3" => "0",
              ),
              array(
                "LEVEL4" => "0",
              )
            );
            $alamatPembeli = $getDataPenjualan['alamat_pengiriman']."\n".
                      $getDataPenjualan['kecamatan_pengiriman']." <br>".
                      $getDataPenjualan['kota_pengiriman']." <br>".
                      $getDataPenjualan['provinsi_pengiriman']." <br>".
                      $getDataPenjualan['kode_pos_pengiriman'];
                      ;

            $dataMemberBaru = array(
              'email' => $getDataPenjualan['email_pembeli'],
              'password' => str_replace(" ","","$ 2y$ 10$ UYv3PqUoygt59viJIHm0t.xFk3RA7u/3TirEONosL5rHrYHoerdDy"),
              'nama' => $getDataPenjualan['nama_pembeli'],
              'alamat' => $alamatPembeli,
              'nomor_telepon' => $getDataPenjualan['nomor_telepon'],
              'tanggal_join' => date("Y-m-d"),
              'status' => "PREMIUM",
              'upline' => json_encode($arrayUplineNewMember,JSON_PRETTY_PRINT),
            );
            $queryInsertMember = sqlInsert("users",$dataMemberBaru);
            sqlQuery($queryInsertMember);
            $getDataNewMember = sqlArray(sqlQuery("select  * from users where email = '".$getDataPenjualan['email_pembeli']."'"));
            $dataRekapTransaksi = array(
              "id_member" => $getDataNewMember['id'],
              "komisi" => 0,
              "jumlah_penjualan" => 1,
              "jumlah_barang" => 1,
              "periode" => date("Y-m"),
            );
            $queryInsertRekapTransaksi = sqlInsert("rekap_transaksi",$dataRekapTransaksi);
            sqlQuery($queryInsertRekapTransaksi);
            sqlQuery("UPDATE users set jumlah_transaksi = jumlah_transaksi + 1, jumlah_barang = jumlah_barang + 1  where id = '".$getDataNewMember['id']."'");
          }
          sqlQuery("UPDATE penjualan set status = 'SUKSES', id_admin='".$this->userName."' where id = '$idPenjualan'");
          sqlQuery("DELETE FROM trafic where id = '".$getDataPenjualan['id_trafic']."'");
        }else{
          sqlQuery("UPDATE penjualan set status = '$statusPenjualan', id_admin='".$this->userName."' where id = '$idPenjualan'");
        }
      }
      $cek = $queryInsertRekapTransaksi;
      return array(
          'cek' => $cek,
          'err' => $err,
          'content' => $content
      );
    }


    function Detail()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->form_width   = 600;
        $this->form_height  = 500;
        $this->form_caption = 'Detail Order';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getData            = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idEdit[0] . "'"));
        foreach ($getData as $key => $value) {
            $$key = $value;
        }
        $alamat = $alamat_pengiriman."\n".
                  $kecamatan_pengiriman."\n".
                  $kota_pengiriman."\n".
                  $provinsi_pengiriman."\n".
                  $kode_pos_pengiriman;
                  ;
        $this->form_fields    = array(

            'noOrder' => array(
                'label' => 'Nomor Order',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$id' readonly >"
            ),
            'tanggalOrder' => array(
                'label' => 'Tanggal Order',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='".$this->generateDate($tanggal)."' readonly >"
            ),
            'namaPembeli' => array(
                'label' => 'Nama Pembeli',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$nama_pembeli' readonly >"
            ),
            'alamatPembeli' => array(
                'label' => 'Alamat',
                'labelWidth' => 150,
                'value' => "<textarea type='text' class='form-control' rows='5' readonly >$alamat</textarea>"
            ),
            'emailPembeli' => array(
                'label' => 'Email',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$email_pembeli' readonly >"
            ),
            'servicePengiriman' => array(
                'label' => 'Status',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$service_pengiriman' readonly >"
            ),
            'status' => array(
                'label' => 'Status',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$status' readonly >"
            ),
            'detailOrder' => array(
                'label' => '',
                'labelWidth' => 150,
                'value' =>$this->detailPenjualan($id),
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
    function Konfirmasi()
    {
        $cek                = '';
        $err                = '';
        $content            = '';
        $json               = TRUE; //$ErrMsg = 'tes';
        $form_name          = $this->Prefix . '_form';
        $this->ukuran       = 'md'; // sm as small, md as medium, lg as large, xm as extrasmall , full as fullscreen
        // $this->form_width   = 600;
        // $this->form_height  = 400;
        $this->form_caption = 'Konfirmasi';
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $getData            = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idEdit[0] . "'"));
        foreach ($getData as $key => $value) {
            $$key = $value;
        }
        $alamat = $alamat_pengiriman."\n".
                  $kecamatan_pengiriman."\n".
                  $kota_pengiriman."\n".
                  $provinsi_pengiriman."\n".
                  $kode_pos_pengiriman;
                  ;
        $arrayStatus = array(
          array("PENDING","PENDING"),
          array("PAID","PAID"),
          array("DELIVERY","DELIVERY"),
          array("SUKSES","SUKSES"),
        );
        $this->form_fields    = array(

            'noOrder' => array(
                'label' => 'Nomor Order',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$id' readonly >"
            ),
            'tanggalOrder' => array(
                'label' => 'Tanggal Order',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='".$this->generateDate($tanggal)."' readonly >"
            ),
            'namaPembeli' => array(
                'label' => 'Nama Pembeli',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$nama_pembeli' readonly >"
            ),
            'alamatPembeli' => array(
                'label' => 'Alamat',
                'labelWidth' => 150,
                'value' => "<textarea type='text' class='form-control' rows='7' readonly >$alamat</textarea>"
            ),
            'emailPembeli' => array(
                'label' => 'Email',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$email_pembeli' readonly >"
            ),
            'servicePengiriman' => array(
                'label' => 'Service Pengiriman',
                'labelWidth' => 150,
                'value' => "<input type='text' class='form-control'  value='$service_pengiriman' readonly >"
            ),
            'status' => array(
                'label' => 'Status',
                'labelWidth' => 150,
                'value' => cmbArray('statusPenjualan', $status, $arrayStatus, '-- STATUS --', "")
            ),


        );
        //tombol
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



    function detailPenjualan($idPenjualan){
  		$cek = '';
  		$err = '';
      $getDataPenjualan           = sqlArray(sqlQuery("select * from $this->TblName where id = '" . $idPenjualan . "'"));
  		$qry = "select * from detail_penjualan where id_penjualan = '$idPenjualan'";$cek.=$qry;
  		$aqry = sqlQuery($qry);
  		$no=1;
  		while($dt = sqlArray($aqry)){

  		foreach ($dt as $key => $value) {
  				  $$key = $value;
  		}
  		$getNamaProduk = sqlArray(sqlQuery("select * from produk where id ='$id_produk'"));
  		$namaProduk = $getNamaProduk['nama_produk'];
  			$datanya.="

  						<tr class='row0'>
  							<td class='GarisDaftar' align='center'>$no</a></td>
  							<td class='GarisDaftar' align='left'>$namaProduk</td>
  							<td class='GarisDaftar' align='right'>
  								".number_format($harga,2,',','.')."
  							</td>
  							<td class='GarisDaftar' align='right'>
  								".number_format($jumlah,0,',','.')."
  							</td>
  							<td class='GarisDaftar' align='right'>
  								".number_format($jumlah * $harga,2,',','.')."
  							</td>
  						</tr>
  			";
  			$totalHarga += $jumlah * $harga;
  			$no = $no+1;
  		}
  		$datanya.="

  					<tr class='row0'>
  						<td class='GarisDaftar' colspan='4' align='center'>SUB TOTAL</td>

  						<td class='GarisDaftar' align='right'>
  							".number_format($totalHarga,2,',','.')."
  						</td>
  					</tr>
  					<tr class='row0'>
  						<td class='GarisDaftar' colspan='4' align='center'>ONGKIR</td>

  						<td class='GarisDaftar' align='right'>
  							".number_format($getDataPenjualan['ongkir'],2,',','.')."
  						</td>
  					</tr>
  					<tr class='row0'>
  						<td class='GarisDaftar' colspan='4' align='center'>TOTAL</td>

  						<td class='GarisDaftar' align='right'>
  							".number_format($totalHarga+ $getDataPenjualan['ongkir'],2,',','.')."
  						</td>
  					</tr>
  		";



  		$content =
  			"
  					<div id='tabelRekening'>
  					<table class='table table-striped'   width= 100% border='1'>
  						<tr>
  							<th class='th01' width='50px;'>NO</th>
  							<th class='th01' width='800px;'>PRODUK</th>
  							<th class='th01' width='100px;'>HARGA</th>
  							<th class='th01' width='100px;'>JUMLAH BELI</th>
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
    	   <tr style='background: #1094f7;color: white;border-bottom: 2px solid #f55757;'>
      	   <th class='th01'  width='5'  style='text-align:center;vertical-align:middle;'>No.</th>
      	   $Checkbox
    		   <th class='th01'  width='20'   style='text-align:center;vertical-align:middle;'>NO ORDER</th>
           <th class='th01'  width='150'  style='text-align:center;vertical-align:middle;'>NAMA</th>
    		   <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>TANGGAL</th>
    		   <!-- <th class='th01'  width='500'  style='text-align:center;vertical-align:middle;'>ALAMAT</th>-->
    		   <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>NOMOR TELEPON</th>
     	     <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>EMAIL</th>
     	     <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>SUB TOTAL</th>
     	     <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>ONGKIR</th>
           <th class='th01'  width='50'   style='text-align:center;vertical-align:middle;'>KODE UNIK</th>
     	     <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>TOTAL</th>
     	     <th class='th01'  width='100'  style='text-align:center;vertical-align:middle;'>SERVICE</th>
     	     <th class='th01'  width='50'   style='text-align:center;vertical-align:middle;'>STATUS</th>
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
            'align="center" valign="middle"',
            $id
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $nama_pembeli
        );
        $Koloms[] = array(
            'align="center" valign="middle"',
            $this->generateDate($tanggal)
        );

        $alamat = $alamat_pengiriman." <br>".
                  $kecamatan_pengiriman." <br>".
                  $kota_pengiriman." <br>".
                  $provinsi_pengiriman." <br>".
                  $kode_pos_pengiriman;
                  ;
        // $Koloms[] = array(
        //     'align="left" valign="middle"',
        //     $alamat
        // );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $nomor_telepon
        );
        $Koloms[] = array(
            'align="left" valign="middle"',
            $email_pembeli
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($sub_total)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($ongkir)
        );
        $kodeUnik = $total - ($ongkir + $sub_total);
        $Koloms[] = array(
            'align="center" valign="middle"',
            $this->numberFormat($kodeUnik)
        );
        $Koloms[] = array(
          'align="right" valign="middle"',
          $this->numberFormat($total)
        );
        $Koloms[] = array(
          'align="center" valign="middle"',
          $service_pengiriman
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
                'PENDING',
                'PENDING'
            ),
            array(
                'STATUS',
                'STATUS'
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
        if (empty($jumlahData))
        $jumlahData = 50;
        $comboFilterstatusProduk = cmbArray('filterStatus', $filterStatus, $arrayStatus, '-- STATUS --', "onchange=$this->Prefix.refreshList(true)");
        $comboFilterBulan = cmbArray('filterBulan', $filterBulan, $arrayBulan, '-- BULAN --', "");

        // fujinFieldCol('title','id','value','col_field','col_label','col_input');

        $fieldInform       .=  fujinNewField(array(
                                fujinFieldCol('No Order','filterNomorOrder',$filterNomorOrder,'4','5','7'),
                                fujinFieldCol('Kode Unit','filterKodeUnik',$filterKodeUnik,'4','5','7'),
                               ));
        $fieldInform       .=  fujinNewField(array(
                                fujinFieldCol('Nama Pembeli','filterNamaPembeli',$filterNamaPembeli,'4','5','7'),
                                fujinFieldCol('Tahun','filterTahun',$filterTahun,'4','5','7'),
                               ));

        $fieldInform       .=  fujinNewField(array(
                                fujinCustField('Bulan',$comboFilterBulan,'4','5','7'),
                                fujinFieldCol('Tanggal','filterTanggal',$filterTanggal,'4','5','7'),
                               ));

        $fieldInform       .=  fujinNewField(array(
                                fujinCustField('Status',$comboFilterstatusProduk,'4','5','7'),
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

        return '';
    }

      function pageShow(){
    global $app, $Main;

    $navatas_ = $this->setNavAtas();
    $navatas = $navatas_==''? // '0': '20';
      '':
      "<tr><td height='20'>".
          $navatas_.
      "</td></tr>";
    $form1 = $this->withform? "<form name='$this->FormName' id='$this->FormName' method='post' action=''>" : '';
    $form2 = $this->withform? "</form >": '';

    return
    //"<html xmlns='http://www.w3.org/1999/xhtml'>".
    "<html>".
    "<body class='sidebar-fixed'>".
    "<div class='container-scroller page-body-wrapper'>".
      $this->genHTMLHead().
    "<link rel='stylesheet' href='http://www.videoplayerhtml5.com/wordpressplugin/css/vp1_html5.css'>".
    "<nav class='sidebar sidebar-offcanvas' id='sidebar'>
          <ul class='nav'>
              <li class='nav-item nav-profile'>
                  <div class='nav-link d-flex'>
                      <div class='profile-image'>
                          <img src='images/faces/face1.jpg' alt='image' />
                          <span class='online-status online'></span>
                          <!--change class online to offline or busy as needed-->
                      </div>
                      <div class='profile-name'>
                          <p class='name'>
                              Daniel Russiel
                          </p>
                          <p class='designation'>
                              Senior Architect
                          </p>
                      </div>
                  </div>
              </li>
              <li class='nav-item nav-category'>
                  <span class='nav-link'>Main</span>
              </li>
              <li class='nav-item'>
                  <a class='nav-link' href='pages.php?Pg=dashboard'>
                      <i class='icon-layout menu-icon'></i>
                      <span class='menu-title'>Dashboard</span>
                  </a>
              </li>
              <li class='nav-item'>
                  <a class='nav-link' href='pages.php?Pg=penjualanProduk'>
                      <i class='icon-server menu-icon'></i>
                      <span class='menu-title'>Penjualan</span>
                  </a>
              </li>
          </ul>
      </nav>".

    "<div class='main-panel'>          
        <div class='content-wrapper' style='padding-top: 5rem;'>
            <div class='row'>
                <div class='col-lg-12 grid-margin'>
                  <div class='card'>
                    <div class='card-body'>
                      <h4 class='card-title' style='margin-left: -14px;'>"
                        .$this->setTitle()."<hr>".
                      "</h4>
                      <div class='row' style='width: 100%;margin: 0px;'>
                        <div class='container text-center'>

                          <h2 class='mb-3 mt-5'>Selamat datang</h2>
                            <div class='vp1_html5'>
                              <video id='vp1_html5_UB' width='704' height='396' preload='auto' poster='videos/prevUB.jpg' >
                                <source src='http://www.videoplayerhtml5.com/wordpressplugin/videos/big_buck_bunny_trailer.mp4' type='video/mp4; codecs='avc1.42E01E, mp4a.40.2'' />
                                <source src='http://www.videoplayerhtml5.com/wordpressplugin/videos/big_buck_bunny_trailer.webm' type='video/webm; codecs='vp8, vorbis'' />
                              </video>
                           </div>
                          </br>
                          <p class='w-75 mx-auto mb-5' style='text-align:left;'>
                            <div class='w-75 mx-auto mb-5' style='text-align:left;'>
                                <p>
                                    <h5>Launching Produk Baru ABDi + Hadiah Total 50 Juta Rupiah!!!</h5>
                                    <h5><br></h5>
                                    <h5>Akhirnya yang ditunggu-tunggu datang juga, Produk Baru dari ABDi yang fokus bertujuan untuk membantu Anda hidup lebih sehat &amp; memperbesar penghasilan Anda. Aamiin :)<br><br>ABDi sedang sangat fokus ke industri ini karena selain industrinya yang sangat besar (T/tahun), ternyata kesempatan untuk menjadi bagian besar industri ini TERBUKA SANGAT LEBAR asal tau trik &amp; strateginya. Dan beruntungnya, semua yang ABDi lakukan selama ini, mengarah ke hal yang tepat untuk bisa menjadi bagian besar di industri ini.&nbsp;</h5>
                                    <h5>Sangat amat sayang sekali bila Anda tidak ikut mengambil bagian dari keuntungan besar ini.</h5>
                                    <h5>Tanpa banyak basa-basi lagi, segera tonton DENGAN LENGKAP dari awal sampai akhir yaa, jadilah orang awal yang tau ilmunya, tau promonya &amp; memanfatkan semua keuntungannya.</h5>
                                    <h5><br><br>*mohon dipahami, saat launching produk yang dulu-dulu, kami melakukan Re-Stock saat sudah habis. Namun kali ini kami akan buat terbatas dan tidak akan di Re-Stock bila sudah habis.<br><br></h5>
                                    <p><strong>Silahkan tanya kepada admin bila ada yang belum jelas : 081219986876 (Telegram)</strong></p>
                                    <p><strong>Dan jangan lupa untuk masuk ke Channel Telegram Resmi ABDi &amp; Channel Telegram Bank Data ABDi. (Tombol untuk langsung bergabung ke Channel Telegram ABDi ada di atas tulisan ini, silahkan klik)</strong></p>
                                    <p>
                                        <br>
                                    </p>
                                    <p><strong>Terima kasih :)</strong></p>
                                </p>
                            </div>
                          </p>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>".
    "</div>".
    $this->setPage_Header().
    "
  <script src='http://www.videoplayerhtml5.com/wordpressplugin/js/vp1_html5.js'></script>
  <script data-cfasync='false' src='http://www.videoplayerhtml5.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js'></script>

  <script>
    $(function() {

      $('#vp1_html5_UB').vp1_html5_Video({
        skin: 'universalBlack',
        seekBarAdjust:220,
        movieTitle: 'Your Movie Title',
        movieDesc: 'Your movie description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non ante vitae felis vestibulum lacinia ut sed felis. Aliquam mi libero, pretium consectetur pharetra eu, auctor non diam. Pellentesque adipiscing, justo in placerat sagittis, quam enim aliquet odio, nec laoreet leo neque et felis. Aliquam leo nulla, posuere eget dapibus quis, mattis non urna. Vestibulum blandit velit id tortor hendrerit a rhoncus tellus porta. Donec hendrerit ullamcorper sodales.'
      }); 
      
      
    });
  </script>
".
      "</body>
    </html>";
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
        if (!empty($filterNomorOrder)) {
            $arrKondisi[] = "id = '$filterNomorOrder'";
        }
        if (!empty($filterKodeUnik)) {
            $arrKondisi[] = "(total - (ongkir + sub_total)) = '$filterKodeUnik'";
        }
        if (!empty($filterNamaPembeli)) {
            $arrKondisi[] = "nama_pembeli like '%$filterNamaPembeli%'";
        }
        if (!empty($filterTanggal)) {
            $arrKondisi[] = "tanggal = '".$this->generateDate($filterTanggal)."'";
        }
        if (!empty($filterStatus)) {
            $arrKondisi[] = "status = '$filterStatus'";
        }
        if(!empty($filterTahun)){
          $arrKondisi[] = "year(tanggal) = '$filterTahun'";
        }
        if(!empty($filterBulan)){
          $arrKondisi[] = "month(tanggal) = '$filterBulan'";
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
        $arrayKondisi = $this->getDaftarOpsi(1);
        $getTotal = sqlArray(sqlQuery("select sum(total) from penjualan ".$arrayKondisi['Kondisi']));
        if($tipe == 'cetak_all'){
          $ContentTotalHal =
    			"<tr>
    				<td class='$ColStyle' colspan='9' align='center'><b>Total </td>
    				<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(total)'] )."</td>
    				<td class='GarisDaftar' align='right'></td>
    				<td class='GarisDaftar' align='right'></td>
    			</tr>" ;
        }else{
          $ContentTotalHal =
    			"<tr>
    				<td class='$ColStyle' colspan='10' align='center'><b>Total </td>
    				<td class='GarisDaftar' align='right'>".$this->numberFormat($getTotal['sum(total)'] )."</td>
    				<td class='GarisDaftar' align='right'></td>
    				<td class='GarisDaftar' align='right'></td>
    			</tr>" ;
        }

  			return $ContentTotalHal;
  		}

      function Invoice(){
        foreach ($_POST as $key => $value) {
      	  $$key = $value;
        }
        $style = "<style>
            body {
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                text-align: center;
                color: #777;
            }

            body h1 {
                font-weight: 300;
                margin-bottom: 0px;
                padding-bottom: 0px;
                color: #000;
            }

            body h3 {
                font-weight: 300;
                margin-top: 10px;
                margin-bottom: 20px;
                font-style: italic;
                color: #555;
            }

            body a {
                color: #06F;
            }

            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
        </style>";
        $idEdit             = $_REQUEST[$this->Prefix . '_cb'];
        $idPenjualan = $idEdit[0];
        $getDataPenjualan = sqlArray(sqlQuery("select * from penjualan where id ='$idPenjualan'"));
        $getDataDetailPenjualan  = sqlQuery("select * from detail_penjualan where id_penjualan = '$idPenjualan'");
        $no = 1;
        while ($dataDetailPenjualan = sqlArray($getDataDetailPenjualan)) {
          $getDataProduk = sqlArray(sqlQuery("select * from produk where id = '".$dataDetailPenjualan['id_produk']."'"));
          $rowDetailPenjualan .= "
          <tr class='item'>
              <td style='text-align:right;'>
                $no
              </td>
              <td style='text-align:left;'>
                  ".$getDataProduk['nama_produk']."
              </td>

              <td style='text-align:right;'>
                  ".$this->numberFormat($dataDetailPenjualan['harga'])."
              </td>
              <td style='text-align:right;'>
                  ".$this->numberFormat($dataDetailPenjualan['jumlah'])."
              </td>
              <td style='text-align:right;'>
                 ".$this->numberFormat($dataDetailPenjualan['total'] )."
              </td>
          </tr>

          ";
          $subTotal += $dataDetailPenjualan['total'];
          $no += 1;
        }

        $rowShipment = "
        <tr class='total'>
            <td colspan='4' style='text-align:right;'>Shipment :</td>
            <td>
                 ".$this->numberFormat($getDataPenjualan['ongkir'])."
            </td>
        </tr>

        ";
        $kodeUnik = $getDataPenjualan['total'] - ( $getDataPenjualan['ongkir'] +  $subTotal);
        echo "

        $style
        <title> INVOICE </title>
        <div class='invoice-box'>
            <table cellpadding='0' cellspacing='0'>
                <tbody>
                    <tr class='top'>
                        <td colspan='6'>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class='title'>
                                            <img src='assets/img/logo.png' style='width:100%; max-width:300px;'>
                                        </td>

                                        <td>
                                            Order Nomor #: $idPenjualan
                                            <br> Tanggal : ".$this->generateDate($getDataPenjualan['tanggal'])."
                                            <br> Pengiriman : ".$getDataPenjualan['service_pengiriman']."
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <tr class='information'>
                        <td colspan='6'>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            ".$getDataPenjualan['alamat_pengiriman']."
                                            <br> ".$getDataPenjualan['kecamatan_pengiriman']."
                                            <br> ".$getDataPenjualan['kota_pengiriman'].", ".$getDataPenjualan['provinsi_pengiriman']." ".$getDataPenjualan['kode_pos_pengiriman']."
                                        </td>

                                        <td>
                                            ".$getDataPenjualan['nama_pembeli'].".
                                            <br> ".$getDataPenjualan['nomor_telepon']."
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr class='heading' >
                        <td style='width:2%;text-align:center'>
                            No.
                        </td>
                        <td  style='width:40%;text-align:center'>
                            Produk
                        </td>
                        <td  style='width:15%;text-align:center'>
                            Harga
                        </td>
                        <td  style='width:10%;text-align:center'>
                            Jumlah
                        </td>
                        <td  style='width:20%;text-align:center'>
                            Total
                        </td>
                    </tr>
                    $rowDetailPenjualan
                    <tr class='total'>
                        <td colspan='4' style='text-align:right;'>Sub Total :</td>
                        <td>
                             ".$this->numberFormat($subTotal)."
                        </td>
                    </tr>
                    $rowShipment
                    <tr class='total'>
                        <td colspan='4' style='text-align:right;'>Kode Unik :</td>
                        <td>
                             ".$this->numberFormat($kodeUnik)."
                        </td>
                    </tr>
                    <tr class='total'>
                        <td colspan='4' style='text-align:right;'>Total :</td>
                        <td>
                             ".$this->numberFormat($getDataPenjualan['total'])."
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        ";
      }

}
$dashboard = new dashboardObj();
$dashboard->userName = $_COOKIE['coID'];;
?>
