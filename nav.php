<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/jquery.disable.js"></script>
    <title>VberEats</title>
</head>

<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <ul class="nav nav-tabs">
                <a class="navbar-brand " href="nav.php">VberEats</a>
                <a class="navbar-brand " href="#home">Home</a>
                <a class="navbar-brand " href="#menu1">shop</a>
                <a class="navbar-brand " href="php/logout.php">Logout</a>
            </ul>
        </div>

    </div>
</nav>
<style>
    .c {
        display: inline;
    }
</style>
<div class="container">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#home">Home</a></li>
        <li><a href="#menu1">shop</a></li>


    </ul>
    <
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h3>Profile</h3>
            <div class="row">
                <div class="col-xs-12">
                    Accouont: <?php echo $_SESSION['user_name']; ?>,
                    <?php echo $_SESSION['user_type']; ?>,
                    PhoneNumber: <?php echo $_SESSION['user_phone']; ?>,
                    location: <?php echo $_SESSION['user_latitude']; ?>,
                    <?php echo $_SESSION['user_longitude']; ?>
                    <button type="button" style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal"
                            data-target="#location">edit location
                    </button>
                    <!--  -->
                    <div class="modal fade" id="location" data-backdrop="static" tabindex="-1" role="dialog"
                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <form action="php/edit_location.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">edit location</h4>
                                    </div>
                                    <div class="modal-body">
                                        <label class="control-label " for="latitude">latitude</label>
                                        <input type="text" class="form-control" id="latitude" name="latitude"
                                               placeholder="enter latitude">
                                        <br>
                                        <label class="control-label " for="longitude">longitude</label>
                                        <input type="text" class="form-control" id="longitude" name="longitude"
                                               placeholder="enter longitude">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--  -->
                    walletbalance:<?php echo $_SESSION['user_balance']; ?>
                    <!-- Modal -->
                    <button type="button " style="margin-left: 5px;" class=" btn btn-info " data-toggle="modal"
                            data-target="#myModal">Add value
                    </button>
                    <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog"
                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm">
                            <form action="php/add_balance.php" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add value</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" id="value"
                                               placeholder="enter add value" name = "value">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!--

                 -->
            <h3>Search</h3>
            <div class=" row  col-xs-8">
                <form class="form-horizontal" action="/action_page.php">
                    <div class="form-group">
                        <label class="control-label col-sm-1" for="Shop">Shop</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" placeholder="Enter Shop name">
                        </div>
                        <label class="control-label col-sm-1" for="distance">distance</label>
                        <div class="col-sm-5">


                            <select class="form-control" id="sel1">
                                <option>near</option>
                                <option>medium</option>
                                <option>far</option>

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-sm-1" for="Price">Price</label>
                        <div class="col-sm-2">

                            <input type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="~">~</label>
                        <div class="col-sm-2">

                            <input type="text" class="form-control">

                        </div>
                        <label class="control-label col-sm-1" for="Meal">Meal</label>
                        <div class="col-sm-5">
                            <input type="text" list="Meals" class="form-control" id="Meal" placeholder="Enter Meal">
                            <datalist id="Meals">
                                <option value="Hamburger">
                                <option value="coffee">
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="category"> category</label>


                        <div class="col-sm-5">
                            <input type="text" list="categorys" class="form-control" id="category"
                                   placeholder="Enter shop category">
                            <datalist id="categorys">
                                <option value="fast food">

                            </datalist>
                        </div>
                        <button type="submit" style="margin-left: 18px;" class="btn btn-primary">Search</button>

                    </div>
                </form>
            </div>
            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">shop name</th>
                            <th scope="col">shop category</th>
                            <th scope="col">Distance</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>

                            <td>macdonald</td>
                            <td>fast food</td>

                            <td>near</td>
                            <td>
                                <button type="button" class="btn btn-info " data-toggle="modal"
                                        data-target="#macdonald">Open menu
                                </button>
                            </td>

                        </tr>


                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="macdonald" data-backdrop="static" tabindex="-1" role="dialog"
                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">menu</h4>
                                </div>
                                <div class="modal-body">
                                    <!--  -->

                                    <div class="row">
                                        <div class="  col-xs-12">
                                            <table class="table" style=" margin-top: 15px;">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Picture</th>

                                                    <th scope="col">meal name</th>

                                                    <th scope="col">price</th>
                                                    <th scope="col">Quantity</th>

                                                    <th scope="col">Order check</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td><img src="Picture/1.jpg" with="50" heigh="10" alt="Hamburger">
                                                    </td>

                                                    <td>Hamburger</td>

                                                    <td>80</td>
                                                    <td>20</td>

                                                    <td><input type="checkbox" id="cbox1" value="Hamburger"></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td><img src="Picture/2.jpg" with="10" heigh="10" alt="coffee"></td>

                                                    <td>coffee</td>

                                                    <td>50</td>
                                                    <td>20</td>

                                                    <td><input type="checkbox" id="cbox2" value="coffee"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>


                                    <!--  -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Order</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <form action="php/shop_register.php" method="post">
                <h3> Start a business </h3>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-xs-2">
                            <label for="ex5">shop name</label>
                            <input class="form-control" id="ex5" name="shop_name"
                                   placeholder="<?php echo $_SESSION['shop_name']; ?>"
                                   type="text" <?php echo $_SESSION['is_manger']; ?>>
                        </div>
                        <div class="col-xs-2">
                            <label for="ex5">shop category</label>
                            <input class="form-control" id="ex5" name="shop_category"
                                   placeholder="<?php echo $_SESSION['shop_category']; ?>"
                                   type="text" <?php echo $_SESSION['is_manger']; ?>>
                        </div>
                        <div class="col-xs-2">
                            <label for="ex6">latitude</label>
                            <input class="form-control" id="ex6" name="shop_latitude"
                                   placeholder="<?php echo $_SESSION['shop_latitude']; ?>"
                                   type="text" <?php echo $_SESSION['is_manger']; ?>>
                        </div>
                        <div class="col-xs-2">
                            <label for="ex8">longitude</label>
                            <input class="form-control" id="ex8" name="shop_longitude"
                                   placeholder="<?php echo $_SESSION['shop_longitude']; ?>"
                                   type="text" <?php echo $_SESSION['is_manger']; ?>>
                        </div>
                    </div>
                </div>


                <div class=" row" style=" margin-top: 25px;">
                    <div class=" col-xs-3">
                        <button type="submit" class="btn btn-primary" <?php echo $_SESSION['is_manger']; ?>>register
                        </button>
                    </div>
                </div>
                <hr>
            </form>

            <h3>ADD</h3>
            <!-- upload meal -->
            <form action="shop_add.php" method="post" class="form-group" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xs-6">
                        <label for="ex3">meal name</label>
                        <input name="product_name" class="form-control" id="ex3" type="text">
                    </div>
                </div>
                <div class="row" style=" margin-top: 15px;">
                    <div class="col-xs-3">
                        <label for="ex7">price</label>
                        <input name="product_price" class="form-control" id="ex7" type="text">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex4">quantity</label>
                        <input name="product_amount" class="form-control" id="ex4" type="text">
                    </div>
                </div>

                <div class="row" style=" margin-top: 25px;">

                    <div class=" col-xs-3">
                        <label for="ex12">上傳圖片</label>
                        <input id="myFile" type="file" name="myFile" multiple class="file-loading">
                    </div>

                    <div class=" col-xs-3">
                        <input style=" margin-top: 15px;" type="submit" class="btn btn-primary" value="Add">
                    </div>

                </div>
            </form>
            <div class="row">
                <div class="  col-xs-8">
                    <table class="table" style=" margin-top: 15px;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Picture</th>
                            <th scope="col">meal name</th>

                            <th scope="col">price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $dbservername = 'localhost';
                        $dbname = 'db';
                        $dbusername = 'admin';
                        $dbpassword = 'admin';

                        $conn = new PDO(
                            "mysql:host=$dbservername;dbname=$dbname",
                            $dbusername, $dbpassword);

                        $conn->setAttribute(
                            PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("select * from product");
                        $stmt->execute();
                        while($row=$stmt->fetch()){
                            $PID = $row['PID'];
                            $product_name = $row['product_name'];
                            $product_img = $row['product_img'];
                            $product_img_type = $row['product_img_type'];
                            $product_price = $row['product_price'];
                            $product_amount = $row['product_amount'];
                            $product_shop = $row['product_shop'];
                            print_row($PID,$product_name,$product_img,$product_img_type,$product_price,
                                $product_amount , $product_shop );
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function () {
        $(".nav-tabs a").click(function () {
            $(this).tab('show');
        });
    });
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  -->
</body>

</html>
