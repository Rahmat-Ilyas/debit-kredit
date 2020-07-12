<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "db_rws"); 

function url($url) {
	$crypt = crypt('page', $url);
	$set_url = "web.php?page=".$url."&view=".$crypt;
	return $set_url;
}

function uang($string) {
	$balik = strrev($string);
	$uang = str_split($balik);
	$i = 1;
	foreach ($uang as $mny) {
		$tes[] = $mny;      
		if ($i % 3 == 0) {
			$tes[] = ".";
		}
		$i = $i + 1;
	}
	if(end($tes) == ".") unset($tes[count($tes)-1]);
	$a = implode("", $tes);
	$b = strrev($a);
	return $b;
}

function jumlah($jum, $tggl) {
  global $conn;
  if ($tggl == '0') $query = "SELECT SUM($jum) AS jumlah FROM tb_saldo";
  else $query = "SELECT SUM($jum) AS jumlah FROM tb_saldo WHERE tanggal LIKE '%$tggl%'";

  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($result);
  $total = uang($data['jumlah']);
  return $total;
}

if (isset($_GET['logout'])) {
	session_unset();
	session_destroy();
	$pass = $_COOKIE['login'];
	setcookie($pass, '', time()-172800);
	setcookie('login', '', time()-172800);

	header("location: login.php");
}

date_default_timezone_set("Asia/Makassar");

?>