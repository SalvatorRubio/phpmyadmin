<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $table = $_POST['nameTbls'];
    $value1 = $_POST['value'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql3 = 'alter table ' .$table. ' add ' .$value1;

if($result1 = mysqli_query($conn, $sql3)) {
    $sql = 'show columns from '.$table;
    if($result = mysqli_query($conn, $sql)) {
        print '<table border="1" id="structureTable">';
        print '<tr>';
        foreach($result as $row1) {
            
            foreach($row1 as $row => $value) {
                print '<th class="border border-dark px-3 py-1">';
                print $row;
                print '</th>';
            }
            break;
        }
        print '</tr>';
        foreach($result as $row1) {
            print '<tr>';
            foreach($row1 as $row => $value) {
                print '<td class="px-3 border border-dark">';
                print $value;
                print '</td>';
            }
            print '<td 
            data-bs-toggle="modal" data-bs-target="#exampleModal" role="button" 
            class="btn-delete-column px-1 border border-dark pe-auto btn-danger">Удалить</td>';
            print '<td role="button" 
            class="btn-update px-3 border border-dark btn-success" 
            >Изменить</td>';
            print '</tr>';
            
        }
        print '</table>';
    }
}
