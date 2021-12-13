<?php
if(isset($_POST)) {
    $value = $_POST['value'];
    $f = $_POST['f'];
}

$conn = mysqli_connect('localhost', 'root', '', '');
// print $value;
if($result = mysqli_query($conn, $value)) {
    if($result1 = mysqli_query($conn, $f)) {
        print 1;
    }
}
print 2;
?>