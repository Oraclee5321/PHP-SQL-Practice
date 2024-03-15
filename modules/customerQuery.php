<?php

function getCustomer($requestType, $sqltype){
    if (! $_SESSION["filters"] || $requestType == 0){
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
    }
    elseif (count($_SESSION["filters"]) >= 1 && $requestType === 1 and $sqltype == 1) {
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID WHERE ";
        $items = count($_SESSION["filters"]);
        $_SESSION['previousFilters'] = [];
        foreach ($_SESSION["filters"] as $x) {
            $_SESSION["previousFilters"][] = $x;
            $sql = $sql . $x;
            if ($items > 1) {
                $sql = $sql . " AND ";

            }
            $items--;
        }
    }
    elseif (count($_SESSION["previousFilters"]) >= 1 && $requestType === 1 and $sqltype == 0) {
            $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID WHERE ";
            $items = count($_SESSION["previousFilters"]);
            foreach ($_SESSION["previousFilters"] as $x){
                $sql = $sql . $x;
                if ($items > 1){
                    $sql = $sql . " AND ";

                }
                $items --;
            }
        }
    return $sql;
};

