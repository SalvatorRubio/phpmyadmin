<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $table = $_POST['nameTable'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$sql = 'show tables from '.$db;
if($result = mysqli_query($conn, $sql)) {
    
    foreach($result as $row) {
        // print $row['Field'];
        print '<table border="1" style="cursor:pointer" class="mt-2" id="'.$db.'.'.$row['Tables_in_'.$db].'">';
        print '<tr>';
        print '<th class="border border-dark px-3 py-1">';
        print $db.'.'.$row['Tables_in_'.$db];
        print '</th>';
        print '</tr>';
        $sql1 = 'show columns from '.$row['Tables_in_'.$db];
        if($result1 = mysqli_query($conn, $sql1)) {
            
            foreach($result1 as $row1) {
                print '<tr>';
                print '<td class="px-3 border border-dark">';
                print $row1['Field'].':'.$row1['Type'];
                print '</td>';
                print '</tr>';
            }
        }
        print '</table>';
    }
} 
?>
<script>
$('table').draggable();
</script>