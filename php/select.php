<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $value = $_POST['value'];
    $table = $_POST['nameTbls'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$result = mysqli_query($conn, $value);
if($info = mysqli_fetch_fields($result)) {
    print '<table class="table_db" border="1">';
    print '<tr>';
    foreach($info as $row) {
        print '<th class="border border-dark px-3 py-1">';
        print $row->name;
        print '</th>';
    }
    print '</tr>';
    foreach($result as $row) {
        print '<tr>';
        foreach($info as $row1) {
            print '<td class="px-3 border border-dark">';
            print $row[$row1->name];
            print '</td>';
        }
        print '</tr>';
    }
    print '</table>';
}