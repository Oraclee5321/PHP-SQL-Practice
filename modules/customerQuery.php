<?php

function getCustomer($requestType){
    if (! $_SESSION["filters"] || $requestType == 0){
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
    }
    else if (count($_SESSION["filters"]) >= 1 && $requestType === 1) {
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID WHERE ";
        $items = count($_SESSION["filters"]);
        foreach ($_SESSION["filters"] as $x){
            $sql = $sql . $x;
            if ($items > 1){
                $sql = $sql . " AND ";

            }
            $items --;
        }
    }
    echo $sql;
    return $sql;
};

