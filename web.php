<?php 
require("config.php");
$pass_s = $_SESSION['login'];
if (!isset($_SESSION[$pass_s])) {
	header("location: login.php");
	exit();
}

require("template/header.php");

// get file
if (is_dir('pages/')) {
	if ($handle = opendir('pages/')) {
		$i = 0;
		while (($file = readdir($handle)) !== false) {
			$set_file = explode('.', $file);
			$files[$i] = $set_file[0];
			$i = $i + 1;
		}
	}
}

if (isset($_GET['page']) && isset($_GET['view'])) {
	$page = $_GET['page'];
	$view = $_GET['view'];
	$cek = 0;
	foreach ($files as $file) {
		if ($page == $file && $view == crypt('page', $file)) {
			require("pages/".$file.".php");
			$cek = $cek + 1;
		}
	}
	if ($cek == 0) require("pages/404.php");
}
else require("pages/403.php");

require("template/footer.php");
?>
