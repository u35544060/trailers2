<?php
$host_name = 'db742173504.db.1and1.com';
$database = 'db742173504';
$user_name = 'dbo742173504';
$password = 'C0mm0nP@rt5';

$connect = mysql_connect($host_name, $user_name, $password, $database);
if (mysql_errno()) {
    die('<p>Failed to connect to MySQL: '.mysql_error().'</p>');
} else {
    echo '<p>Connection to MySQL server successfully established.</p >';
}

$query = "SELECT * FROM cwtpcatalog";

$result = mysql_query($query);

echo $query ;
echo $result ;


while ($row = mysql_fetch_array($query)){
    echo "price:" . $row['price'];
}
?>