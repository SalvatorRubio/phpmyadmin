<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $value = $_POST['text'];
}
// SHOW PROCEDURE STATUS
$conn = mysqli_connect('localhost', 'root', '', $db); 
$sql = $value;
if($result = mysqli_query($conn, $sql)) {
    print '<h3>Процедура создана</h3>';
}
