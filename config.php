<?php
#include("common/vars.php");
//include('common/floodprotection.php');

/*

*/
//*
$MySQL->HOST = "localhost";
$MySQL->USER = "root";
$MySQL->PWD  = "Hash2856";
$MySQL->DB   = "surya_duta";
//*/
$DirBase	=	"";
function connection(){
  return mysqli_connect("localhost", "root", "Hash2856", "surya_duta");
}
 function sqlQuery($script){
  return mysqli_query(connection(), $script);
}
function checkLogin(){
  if(isset($_SESSION['username'])){
    header('Location: pages.php');
  }
}
function sqlInsert($table, $data){
      if (is_array($data)) {
          $key   = array_keys($data);
          $kolom = implode(',', $key);
          $v     = array();
          for ($i = 0; $i < count($data); $i++) {
              array_push($v, "'" . $data[$key[$i]] . "'");
          }
          $values = implode(',', $v);
          $query  = "INSERT INTO $table ($kolom) VALUES ($values)";
      } else {
          $query = "INSERT INTO $table $data";
      }
      return $query;

  }

function sqlUpdate($table, $data, $where){
    if (is_array($data)) {
        $key   = array_keys($data);
        $kolom = implode(',', $key);
        $v     = array();
        for ($i = 0; $i < count($data); $i++) {
            array_push($v, $key[$i] . " = '" . $data[$key[$i]] . "'");
        }
        $values = implode(',', $v);
        $query  = "UPDATE $table SET $values WHERE $where";
    } else {
        $query = "UPDATE $table SET $data WHERE $where";
    }

   return $query;
}

function sqlArray($sqlQuery){
    return mysqli_fetch_assoc($sqlQuery);
}

function sqlRowCount($sqlQuery){
    return mysqli_num_rows($sqlQuery);
}


//$stim = time()-$tim; $tim =time(); echo "<br>after connect db $stim";
include ("common/fnfile.php");
//$stim = time()-$tim; $tim =time(); echo "<br>after include fnfile $stim";
?>
