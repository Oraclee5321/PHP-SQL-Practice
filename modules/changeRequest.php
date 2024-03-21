<?php

function getRequestType(){
    if ($_SESSION['requestType'] == 0){
        return (0);
    }
    elseif ($_SESSION['requestType'] == 1){
        return (1);
    }
}