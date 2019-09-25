<?php
include 'include/dbinfo.php';
try {
    $dbh = new PDO(
        'mysql:host=localhost;charset=utf8mb4;dbname=' . $database . '',
         $user,
          $password
    );
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$sth = $dbh->prepare('SELECT tweet.*, users.name FROM tweet
            JOIN users
            ON tweet.user_id = users.id
            ORDER BY updated_at DESC');
$sth->execute();
$row = $sth->fetchAll(PDO::FETCH_ASSOC);

include 'views/index_layout.php';
?>
