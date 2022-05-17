<?php
session_start();

$dbservername = 'localhost';
$dbname = 'db';
$dbusername = 'admin';
$dbpassword = 'admin';

echo "hi";
/*try {
    if (!isset($_POST['latitude']) || !isset($_POST['longitude'])) {
        header("Location: ../nav.php");
        exit();
    }
    if (empty($_POST['latitude']) || empty($_POST['longitude'])) {
        throw new Exception('Please input latitude and longitude!');
    }
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stat = $conn->prepare("UPDATE user SET user_location = ST_GeometryFromText(:location) WHERE user_account = :user_account");
    $stat->execute(array('location' => 'POINT(' . $longitude . ' ' . $latitude . ')', 'user_account' => $_SESSION['user_account']));
    echo <<<EOT
            <!DOCTYPE html>
            <html lang="en-us">
                <body>
                    <script>
                        alert("Update locaion successfully.");
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