<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "ringbuilder";

$conn = mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
<?php
// conn.php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ringbuilder', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
