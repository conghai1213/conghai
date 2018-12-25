<?php
require_once '../lib/db.php';

if (isset($_GET["user"])) {
	$user = $_GET["user"];
	$sql = "select * from nguoidung where UserName = '$user'";
	$rs = load($sql);
	if ($rs->num_rows > 0) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	echo -1; // bad request
}