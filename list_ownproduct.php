<?php session_start(); ?>
<!doctype html>
<html lang="en">

<div class="row">
    <div class="  col-xs-8">
        <table class="table" style="margin-top: 15px;">
            <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Meal Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            session_start();

            $dbservername = 'localhost';
            $dbname = 'db';
            $dbusername = 'admin';
            $dbpassword = 'admin';
            $user_name = $_POST['user_name'];

            $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query("SELECT * FROM product WHERE product_shop=(SELECT shop_name FROM shop WHERE shop_owner=$user_name)");
            $result = $stmt->fetchAll();

            foreach ($result as &$row) {
                $PID = $row['PID'];
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_amount = $row['product_amount'];
                $product_img = $row['product_img'];
                $product_img_type = $row['product_img_type'];
                echo '<tr><td><img style="max-width:100%; max-height:200px" src="data:'.$product_img_type.';base64,' . $product_img . '"  alt="$product_name"/></td>';
                echo <<< EOT
                                <td>$product_name</td>
                                <td>$product_price</td>
                                <td>$product_amount</td>
                                <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#$PID">Edit</button></td>
                                <!-- Modal -->
                                <div class="modal fade" id="$PID" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">$product_name Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="change.php" method="post">
                                                <div class="modal-body">
                                                    <div class="row" >
                                                        <div class="col-xs-6">
                                                            <label for="ex71">Price</label>
                                                            <input class="form-control" id="ex71" name="price" type="text">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label for="ex41">Quantity</label>
                                                            <input class="form-control" id="ex41" name="quantity" type="text">
                                                        </div>
                                                        <input type="hidden" name="PID" value="$PID">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary">Edit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="PID" value="$PID">
                                    <td><button type="submit" class="btn btn-danger">Delete</button></td>
                                </form>
                            </tr>
                        EOT;
            }
            ?>

            </tbody>
        </table>
    </div>
</div>