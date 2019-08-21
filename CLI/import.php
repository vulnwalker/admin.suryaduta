<?php
include 'config.php';
include 'excel_reader.php';
class importAbsen extends Config{
  function __construct(){
    $options = getopt(null, ["fileName:"]);
    $namaFile =$options['fileName'];
    $nameFileExcel = $namaFile;
    $excel = new PhpExcelReader;
    $excel->read("$namaFile");
    $sheet = $excel->sheets[0];
       $x = 2;
       $jumlahData = $sheet['numRows'] - 1;
       while($x <= $sheet['numRows']) {
        $tanggal =  $sheet['cells'][$x][1];
        $nik =  $sheet['cells'][$x][2];
        $jamDatang =  $sheet['cells'][$x][4];
        $jamPulang =  $sheet['cells'][$x][5];
        $statusAbsen =  $sheet['cells'][$x][6];
        $keterangan =  $sheet['cells'][$x][7];
        $dataAbsen = array(
          "tanggal" => $this->generateDate($tanggal),
          "nik_pegawai" => $nik,
          "datang" => $jamDatang,
          "pulang" => $jamPulang,
          "status" => $statusAbsen,
          "keterangan" => $keterangan,
        );
        if($this->sqlRowCount($this->sqlQuery("select * from absensi where tanggal = '".$this->generateDate($tanggal)."' and nik_pegawai = '$nik'")) !=0){
          $queryInsert = $this->sqlUpdate("absensi",$dataAbsen,"tanggal = '".$this->generateDate($tanggal)."' and nik_pegawai = '$nik'");
          $this->sqlQuery($queryInsert);
        }else{
          $queryInsert = $this->sqlInsert("absensi",$dataAbsen);
          $this->sqlQuery($queryInsert);
        }

        echo $queryInsert."\n";
        $x++;
      }
  }

  function stringDetector($string){
      $string = str_replace("`","",$string);
      $string = str_replace("'","",$string);
      $string = str_replace(" ","",$string);
      return $string;
  }

}

$wakwaw = new importAbsen();







 ?>
