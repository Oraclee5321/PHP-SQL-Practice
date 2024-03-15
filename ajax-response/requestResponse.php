<?php
session_start();

if ($_SESSION['requestType'] and $_SESSION['requestType'] == 0) {
    $_SESSION['requestType'] = 1;
    $_SESSION['pressedSearch'] = 1;
    return 1;
}
elseif ( !$_SESSION['requestType'] and $_SESSION['requestType'] == 0){
    $_SESSION['requestType'] = 1;
    $_SESSION['pressedSearch'] = 1;
    return 1;
}
else {
    echo "An Error Has Occurred";
}
