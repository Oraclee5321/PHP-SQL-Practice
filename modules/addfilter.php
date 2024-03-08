<?php
session_start();

$category = $_POST['filterCategory'];
$filterValue = $_POST['filterValueInput'];
$sqlTerms = ["customerFName","customerSName","customerDOB","customerCity","customerPostCode","customerAddress","customerPhone"];
$baseSQL = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
$newFilter = "";

switch ($category) {
    case "First Name":
        $newFilter = $sqlTerms[0];
        break;
    case "Surname":
        $newFilter = $sqlTerms[1];
        break;
    case "Date of Birth":
        $newFilter = $sqlTerms[2];
        break;
    case "City":
        $newFilter = $sqlTerms[3];
        break;
    case "Post Code":
        $newFilter = $sqlTerms[4];
        break;
    case "Address":
        $newFilter = $sqlTerms[5];
        break;
    case "Phone Number":
        $newFilter = $sqlTerms[6];
        break;
}

$_SESSION["filters"][] = "tbl_customers.".$newFilter . "=" . $filterValue;
header("Location: ../customers.php.");
exit;

?>