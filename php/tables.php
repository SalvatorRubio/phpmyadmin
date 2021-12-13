<?php
if(isset($_POST)){
    $db = $_POST['text'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql = 'show tables from '.$db;
if($result = mysqli_query($conn, $sql)) {
    foreach($result as $row) {
        $str = $row["Tables_in_".$db]. ', ';
        print $str;
    }
}
?>
