<?php
if(isset($_POST)) {
    $db = $_POST['nameDatabase'];
    $table = $_POST['nameTable'];
    $value = $_POST['value'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql = 'show columns from ' .$table;

$m = '';
if($result = mysqli_query($conn, $sql)) {
    $sql2 = 'insert into '.$table;

    foreach($result as $row) {
        $n .= $row['Field']. ',';
    }
    $n = trim($n, ',');
    $sql2 .= ' (';
    $sql2 .= $n;
    $sql2 .= ') values ';
    $sql2 .= '("';
    $sql2 .= $value;
    $sql2 .= '")';
    if($result1 = mysqli_query($conn, $sql2)) {
        print '<table class="table_db" border="1">';
        print '<tr>';
        foreach($result as $row) {
            print '<th class="border border-dark px-3 py-1">';
            print $row['Field'];
            print '</th>';
            $m .= $row['Field']. ';';
        }
        print '</tr>';
    }
    $m1 = explode(';', $m);

    $sql1 = 'select * from ' .$table;
    if($result2 = mysqli_query($conn, $sql1)) {
        foreach($result2 as $row1) {
            print '<tr class="tr">';
            for($i=0;$i<count($m1)-1;$i++) {
                print '<td class="px-3 border border-dark">';
                print $row1[$m1[$i]];
                print '</td>';
            }
            print '<td data-name="'.$m1[0].'" data-id="'.$row1[$m1[0]].'"
            data-bs-toggle="modal" data-bs-target="#exampleModal" role="button" 
            class="btn-delete px-1 border border-dark pe-auto btn-danger">Удалить</td>';
            print '<td role="button" 
            class="btn-update px-3 border border-dark btn-success"
            data-id="'.$row1[$m1[0]].'" 
            >Изменить</td>';
            print '</tr>';
        }
    }
}

