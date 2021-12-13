<?php
if(isset($_POST)) {
    $db = $_POST['nameDatabase'];
    $table = $_POST['nameTable'];
    $col = $_POST['nameCol'];
    $id = $_POST['id'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}

$sql = 'delete from ' .$table. ' where ' .$col. ' = "' .$id. '"';
if($result = mysqli_query($conn, $sql)) {

    $sql1 = 'show columns from ' .$table;
    $m = '';

    if($result = mysqli_query($conn, $sql1)) {
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

    $sql2 = 'select * from ' .$table;
    if($result1 = mysqli_query($conn, $sql2)) {
        foreach($result1 as $row1) {
            print '<tr class="tr">';
            for($i=0;$i<count($m1)-1;$i++) {
                print '<td class="px-3 border border-dark">';
                print $row1[$m1[$i]];
                print '</td>';
            }
            print '<td data-name="'.$m1[0].'" data-id="'.$row1[$m1[0]].'"
            data-bs-toggle="modal" data-bs-target="#exampleModal" role="button" 
            class="btn-delete px-1 w-100 border border-dark pe-auto btn-danger">Удалить</td>';
            print '<td role="button" class="btn-update px-3 border border-dark btn-success">Изменить</td>';
            print '</tr>';
        }
    }
    print '</table>';
}

