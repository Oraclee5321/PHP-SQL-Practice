<?php

$category = $_POST['filterCategory'];
$value = $_POST['filterValueInput'];
$baseSQL = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
echo $category;
echo $value;

?>