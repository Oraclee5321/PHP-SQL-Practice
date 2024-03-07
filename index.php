<?php
include "modules/dbconnect.php";
$conn = connect();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <?php include "modules/links.php"?>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <?php include "modules/sidebar.php"?>
        </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="visually-hidden">Sidebars examples</h1>

        <div class="b-example-divider b-example-vr"></div>


        <div class="b-example-divider b-example-vr"></div>
    </main>
    </div>
</div>


<script src="script.js"></script>
</body>
</html>
