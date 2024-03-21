<?php

session_start();
if (! isset($_SESSION["filters"])){
    $_SESSION["filters"] = [];
}

if (! isset($_SESSION["previousFilters"])){
    $_SESSION["previousFilters"] = [];
}

if (! isset($_SESSION["requestType"])){
    $_SESSION["requestType"] = 0;
}

if (! isset($_SESSION["pressedSearch"])){
    $_SESSION["pressedSearch"] = 0;
}

include "modules/dbconnect.php";
include "modules/customerQuery.php";
include "modules/changeRequest.php";
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
        <div class="table-responsive small" id="customerTable">
            <table id="filtertable" class="table table-striped table-sm text-center">
                <form action="modules/addfilter.php" method="post">
                    <thead>
                    <tr>
                        <td><label for="country" class="form-label">Filter</label>
                        <select class="form-select" id="filterCategory" name="filterCategory" required="">
                                <option value="" class="disabled">Choose...</option>
                                <option>First Name</option>
                                <option>Surname</option>
                                <option>City</option>
                                <option>Post Code</option>
                                <option>Address</option>
                                <option>Phone Number</option>
                            </select></td>
                        <div class="invalid-feedback">
                            Please select a valid column filter
                        </div>
                        <td>
                            <label for="filterValueInput" class="form-label">Filter Value</label>
                            <input name="filterValueInput" id="filterValueInput" type="text" class="form-control">
                        </td>
                        <td>
                            <button name="filterAddButton" id=addButton" type="submit" class="btn btn-primary form-control">Add</button>
                        </td>
                        <td>
                        <div class="col" style="max-height: 20vh">
                             <button name="filterSearchButton" id=searchButton" type="button" class="btn btn-primary form-control" onclick="applyFilter()">Search</button>
                         </div>
                        </td>
                        <td>
                        <div class="col" style="max-height: 20vh">
                            <button name="filterSearchButton" id=searchButton" type="button" class="btn btn-primary form-control" onclick="removeFilters()">Clear Filters</button>
                        </div>
                        </td>
                    </tr>
                    </thead>
                    </form>
            </table>
            <div class="dbtablecontainer">
            <table class="table table-striped table-sm text-center" id="dbinfo">
                <thead id="dbheader" class="">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">City</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                </tr>
                </thead>

                <tbody>
                    <?php
                    $sqlquery = Null;
                    if ($_SESSION['requestType'] == 1 and $_SESSION['pressedSearch'] == 1){
                        $sql = getCustomer(getRequestType(),1);
                        $sqlquery = $conn->query($sql);
                        $_SESSION['pressedSearch'] = 0;
                    }
                    elseif ($_SESSION['requestType'] == 1 and $_SESSION['pressedSearch'] == 0){
                        $sql = getCustomer(getRequestType(),0);
                        $sqlquery = $conn->query($sql);
                    }
                    elseif ($_SESSION['requestType'] == 0){
                        $sql = getCustomer(getRequestType(),0);
                        $sqlquery = $conn->query($sql);
                    }
                    while ($row = $sqlquery->fetch_assoc()) {
                        $id = $row['customerID'];
                        $name = $row['customerFName'] ." ". $row['customerSName'];
                        $dob = $row['customerDOB'];
                        $city = $row['customerCity'];
                        $postcode = $row['customerPostCode'];
                        $address = $row['customerAddress'];
                        $phone = $row['customerPhone'];
                        $email = $row['loginEmail'];
                        echo
                        '
                        <tr>
                        <td>'.$id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$email.'</td>
                        <td>'.$dob.'</td>
                        <td>'.$city.'</td>
                        <td>'.$postcode.'</td>
                        <td>'.$address.'</td>
                        <td>'.$phone.'</td>
                        </tr>
                        ';}
                    ?>
                </tbody>
                <tfoot id="dbfooter" class="hidden">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">City</th>
                    <th scope="col">Postcode</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </main>
    </div>
</div>

<script>
    function applyFilter() {
        console.log("AYYYY")
        $.ajax({

            url: 'ajax-response/requestResponse.php',
            type: 'POST',
            success: function () {
                console.log("Heyyyy");
                console.log(location.href);
                $("#dbinfo").load(location.href+" #dbinfo>*","");
            },
            error: function () {
                console.log('error');
            }

        });
    }
    function removeFilters() {
        console.log("AYYYY")
        $.ajax({

            url: 'ajax-response/removeFiltersResponse.php',
            type: 'POST',
            success: function () {
                console.log("Heyyyy");
                console.log(location.href);
                $("#dbinfo").load(location.href+" #dbinfo>*","");
            },
            error: function () {
                console.log('error');
            }

        });
    }
    document.addEventListener('wheel', function() {
        const header = document.getElementById('dbheader');
        const footer = document.getElementById('dbfooter');
        const scrollAmount = document.getElementById('customerTable').scrollTop;
        console.log(scrollAmount)
        // Check if the element is completely out of view (both top and bottom)
        if (scrollAmount > 0) {
            header.classList.add('hidden');
            footer.classList.remove('hidden')
        }
        if (scrollAmount === 0){
            header.classList.remove('hidden');
            footer.classList.add('hidden')
        }
    });
</script>
</body>

</html>
