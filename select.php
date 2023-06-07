<?php 

$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "db connection works";
}
catch (\PDOException $e)
{
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

//deel 1
$stmt = $pdo->query("SELECT * FROM producten");
$resultaat1 = $stmt->fetchAll();

foreach ($resultaat1 as $row) {
    echo $row['producten_code'] . "<br/>";
    echo $row['product_naam'] . "<br/>";
    echo $row['prijs_per_stuk'] . "<br/>";
    echo $row['omschrijving'] . "<br/>";
}

//deel 2

$zoek_product_code = 1;
$stmt = $pdo->prepare("SELECT * FROM producten WHERE producten_code = ?");
$stmt->execute([$zoek_product_code]);
$resultaat2 = $stmt->fetch();

echo $resultaat2['producten_code'] . "<br/>";
echo $resultaat2['product_naam'] . "<br/>";
echo $resultaat2['prijs_per_stuk'] . "<br/>";
echo $resultaat2['omschrijving'] . "<br/>";


//deel 3

$zoek_product_code = 2;
$stmt = $pdo->prepare("SELECT * FROM producten WHERE producten_code = :producten_code");
$stmt->execute([$zoek_product_code]);
$resultaat3 = $stmt->fetch();

echo $resultaat3["producten_code"] . "<br/>";
echo $resultaat3["product_naam"] . "<br/>";
echo $resultaat3["prijs_per_stuk"] . "<br/>";
echo $resultaat3["omschrijving"] . "<br/>";






?>