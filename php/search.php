<?php
session_start();
$dbservername = 'localhost';
$dbname = 'db';
$dbusername = 'admin';
$dbpassword = 'admin';
try {
    $db = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_REQUEST['shop_name'])) $shop_name = "%" . $_REQUEST['shop_name'] . "%";
    else $shop_name = "%%";
    if (isset($_REQUEST['category'])) $category = "%" . $_REQUEST['category'] . "%";
    else $category = "%%";
    if (isset($_REQUEST['meal'])) $meal = "%" . $_REQUEST['meal'] . "%";
    else $meal = "%%";

    $price_floor = 0;
    $price_ceiling = 2147483647;
    if (isset($_REQUEST['price_floor'])) {
        $price_floor = $_REQUEST['price_floor'];
    }
    if (isset($_REQUEST['price_ceiling'])) {
        $price_ceiling = $_REQUEST['price_ceiling'];
    }

    if (isset($_REQUEST['price_floor']) || isset($_REQUEST['price_ceiling']) || isset($_REQUEST['meal'])) {

        $querystring = "SELECT DISTINCT shop_name, shop_category, ST_Distance_Sphere(user_location , shop_location) as location
                            FROM shop JOIN product
                            ON product.product_shop = shop.shop_name
                            JOIN user
                            ON user.user_account = shop.shop_owner
                            WHERE shop_name LIKE :shop_name 
                            AND shop_category LIKE :category 
                            AND product_name LIKE :meal
                            AND product_price BETWEEN :price_floor AND :price_ceiling";

        $sql = $db->prepare($querystring);

        $sql->execute(array(
            'shop_name' => $shop_name,
            'category' => $category,
            'meal' => $meal,
            'price_floor' => $price_floor,
            'price_ceiling' => $price_ceiling
        ));

    }

    else {

        $querystring = "SELECT DISTINCT shop_name, shop_category, shop_owner, ST_Distance_Sphere(user_location , shop_location) as location
                            FROM shop JOIN  user
                            ON user.user_account = shop.shop_owner
                            WHERE shop_name LIKE :shop_name 
                            AND shop_category LIKE :category ";
        $sql = $db->prepare($querystring);
        $sql->execute(array(
            'shop_name' => $shop_name,
            'category' => $category,
        ));

    }

    $result = $sql->fetchAll();
    echo <<< EOT
        
        <div class="row">
            <div class=" col-xs-8">
                    <table class="table" style= "margin-top: 15px;" >
                        <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">shop name</th>
                            <th scope="col">shop category</th>
                            <th scope="col">Distance</th>
                        </tr>
                        </thead>
                    
            </div>
        </div>
                <tbody>

        EOT;
    $SID_arr = array();
    $i = 1;
    foreach ($result as &$row) {
        $shop_name = $row['shop_name'];
        $category = $row['shop_category'];
        $distance = $row['location'];
        $distanceWord = "";
        if (isset($_REQUEST['distance'])) {
            if ($_REQUEST['distance'] == "Near") {
                $distanceWord = "Near";
                if ($distance > 2) continue;
            }
            else if ($_REQUEST['distance'] == "Medium") {
                $distanceWord = "Medium";
                if ($distance <= 2 || $distance >= 5) continue;
            }
            else if ($_REQUEST['distance'] == "Far") {
                $distanceWord = "Far";
                if ($distance < 5) continue;
            }
            else{
                if ($distance <= 2) $distanceWord = "Near";
                else if ($distance < 5) $distanceWord = "Medium";
                else if ($distance > 5) $distanceWord = "Far";
            }
        }
        else {
            if ($distance <= 2) $distanceWord = "Near";
            else if ($distance < 5) $distanceWord = "Medium";
            else if ($distance > 5) $distanceWord = "Far";
        }
        echo <<< EOT
            <colgroup span = "4">
                <tr>
                    <th scope="row">$i</th>
                    <td>$shop_name</td>
                    <td>$category</td>
                    <td>$distanceWord</td>
                    <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#$shop_name">Open menu</button></td>
                </tr>
            </colgroup>   
            EOT;
        array_push($SID_arr, $shop_name);
        $i = $i + 1;
    }
    foreach ($SID_arr as $shop_name) {
        echo <<< EOT
                </tbody>
                    </table>
                    <!-- Modal -->
                        <div class="modal fade" id=$shop_name  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Menu</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="  col-xs-12">
                                                <table class="table" style="margin-top: 15px; table-layout:fixed;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Picture</th>
                                                            <th scope="col">Meal Name</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Order check</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
            EOT;
        $sql = $db->prepare("SELECT * 
                                    FROM product 
                                    WHERE product_shop= :shop_name");
        $sql->execute(array(
            'shop_name' => $shop_name
        ));
        $shoprow = $sql->fetchAll();
        foreach ($shoprow as &$row) {
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_amount = $row['product_amount'];
            $product_img = $row['product_img'];
            $product_img_type = $row['product_img_type'];
            echo '<tr><td><img style="max-width:100%; max-height:200px" src="data:'.$product_img_type.';base64,' . $product_img . '" alt="$product_name"/></td>';
            echo <<< EOT
                        <td>$product_name</td>
                        <td>$product_price</td>
                        <td>$product_amount</td>
                        <td><input type="checkbox" id="#$shop_name" value="$product_name"></td>
                    </tr>
                EOT;
        }
        echo <<< EOT
            </tbody>
                </table>
                    </div>
                        </div>
                            </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            EOT;
    }

}
catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}
?>
