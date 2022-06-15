<?php
session_start();

$dbservername = 'localhost';
$dbname = 'db';
$dbusername = 'admin';
$dbpassword = 'admin';

try {
    if (!isset($_POST['value'])) {
        header("Location: ../nav.php");
        exit();
    }
    if (empty($_POST['value']) ) {
        throw new Exception('Please enter value!');
    }
    if(!is_numeric($_POST['value'])){
        throw new Exception("Value can only contains numbers!");
    }
    $value = (int)$_POST['value'];

    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stat = $conn->prepare("UPDATE user SET user_balance = :user_balance WHERE user_account = :user_account");
    $stat->execute(array('user_balance' => $value, 'user_account' => $_SESSION['user_account']));
    $_SESSION['user_balance'] = $value;
    echo <<<EOT
            <!DOCTYPE html>
            <html lang="en-us">
                <body>
                    <script>
                        alert("Add balance successfully.");
                        window.location.replace("../nav.php");
                    </script>
                </body>
            </html>
EOT;
    exit();
}catch (Exception $e) {
    $msg = $e->getMessage();
    echo <<<EOT
        <!DOCTYPE html>
        <html lang="en-us">
            <body>
                <script>
                alert("$msg");
                window.location.replace("../nav.php");
                </script>
            </body>
        </html>
EOT;
}
?>