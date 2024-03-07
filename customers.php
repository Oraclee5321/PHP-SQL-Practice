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
        <div class="table-responsive small">
            <table class="table table-striped table-sm text-center">
                <form action="modules/addfilter.php" method="post">
                    <thead>
                    <tr>
                        <td><label for="country" class="form-label">Filter</label></td>
                        <td><select class="form-select" id="filterCategory" name="filterCategory" required="">
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
                            <input name="filterValueInput" id="valueInput" type="text" class="form-control">
                        </td>
                        <td>
                            <button name="filterAddButton" id=addButton" type="submit" class="btn btn-primary form-control">Add</button>
                        </td>
                        <!-- <div class="col-md-2" style="max-height: 20vh; padding-bottom: 2vh">
                             <label for="filterSearchButton" class="form-label">Search </label>
                             <button name="filterSearchButton" id=searchButton" type="submit" class="btn btn-primary form-control">Search</button>
                         </div>-->
                    </form>
                    </tr>
                </thead>
                <thead>
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
                    $sql = "SELECT * FROM tbl_customers JOIN tbl_login ON tbl_customers.customerLoginID=tbl_login.loginID";
                    $sqlquery = $conn->query($sql);
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
            </table>
        </div>
    </main>
    </div>
</div>

</body>

</html>
