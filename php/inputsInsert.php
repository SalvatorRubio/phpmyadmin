<?php
if(isset($_POST)) {
    $db = $_POST['nameDatabase'];
    $table = $_POST['nameTable'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql = 'show columns from ' .$table;

if($result = mysqli_query($conn, $sql)) {
    print '<table id="tableInputsInsert" class="table_db mt-4" border="1">';
    print '<tr>';
    foreach($result as $row) {
        print '<th class="border border-dark px-3 py-1">';
        print $row['Field'];
        print '</th>';
    }
    print '</tr>';
    
    
    print '<tr>';
    foreach($result as $row) {
        print '<td class="border border-dark">';
        print '<input class="input_insert border-0" style="outline:none" type="text">';
        print '</td>';
    }
    print '</tr>';
    print '</table>';
    print '<button id="btnInsert" style="width:150px" class="mt-2 text-white btn bg-success">Выполнить</button>';

}


