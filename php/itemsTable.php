<?php 
    if(isset($_POST)){
        $col = $_POST['col'];
        $name = $_POST['name'];
    }
    // print $col;
    // print $name;
    $conn = mysqli_connect('localhost', 'root', '', $col);
    if(!$conn){die('Not connect!!!');}
    $sql = 'show columns from ' .$name;
    if($result = mysqli_query($conn, $sql)) {
        foreach($result as $row) {
            print $row['Field']. ', ';
        }
    }
?>