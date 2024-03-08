<?php

function getCustomer($filter){
    if (! $filter){
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
    }
    else if ($filter) {
        $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID WHERE";
        foreach ($filter as $x){

        }
    }
    return $sql;
};

