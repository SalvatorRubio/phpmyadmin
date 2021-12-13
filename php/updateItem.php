<?php
if(isset($_POST)) {
    $db = $_POST['nameDatabase'];
    $table = $_POST['nameTable'];
    $id = $_POST['id'];
    $arrTexts = $_POST['arrTexts'];
}
$text = '';
for($i=0;$i<count($arrTexts);$i++) {
    $text .= $arrTexts[$i] . ';';
}
$text1 = explode(';', $text);


$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql = 'show columns from ' .$table;
if($result = mysqli_query($conn, $sql)) {
    foreach($result as $row) {
        $m .= $row['Field']. ';';
    }
}
$m1 = explode(';', $m);
$sql1 = '';
$sql1 = 'update '.$table.' set ';
for($i=0;$i<count($text1)-1;$i++) {
    $sql1 .= $m1[$i].' = "' .$text1[$i]. '", ';
}
$sql1 = trim($sql1, " ,");
$sql1 .= ' where '. $m1[0]. ' = "'. $id. '"';
if($result = mysqli_query($conn, $sql1)) {

    $sql = 'show columns from ' .$table;
    $m2 = '';

    if($result1 = mysqli_query($conn, $sql)) {
        print '<table class="table_db" border="1">';
        print '<tr>';
        foreach($result1 as $row1) {
            print '<th class="border border-dark px-3 py-1">';
            print $row1['Field'];
            print '</th>';
            $m2 .= $row1['Field']. ';';
        }
        print '</tr>';
    }
    $m3 = explode(';', $m2);

    $sql2 = 'select * from ' .$table;
    if($result3 = mysqli_query($conn, $sql2)) {
        foreach($result3 as $row2) {
            print '<tr class="tr">';
            for($i=0;$i<count($m3)-1;$i++) {
                print '<td class="px-3 border border-dark">';
                print $row2[$m3[$i]];
                print '</td>';
            }
            print '<td data-name="'.$m3[0].'" data-id="'.$row2[$m3[0]].'"
            data-bs-toggle="modal" data-bs-target="#exampleModal" role="button" 
            class="btn-delete px-1 border border-dark pe-auto btn-danger">Удалить</td>';
            print '<td role="button" 
            class="btn-update px-3 border border-dark btn-success"
            data-id="'.$row2[$m3[0]].'" 
            >Изменить</td>';
            print '</tr>';
        }
    }
    print '</table>';
}



