<?php
$conn = mysqli_connect('localhost', 'root', '', '');
$sql = 'show procedure status';
if($result = mysqli_query($conn, $sql)) {
    print '<table>';
    print '<tr>';
    print '<th class="border border-dark px-3 py-1">БД</th>';
    print '<th class="border border-dark px-3 py-1">Имя</th>';
    print '<th class="border border-dark px-3 py-1">Тип</th>';
    print '</tr>';
    foreach($result as $row) {
        print '<tr>';
        if($row['Db'] != 'sys') {
            print '<td class="border border-dark px-3 py-1">'.$row['Db'].'</td>';
            print '<td class="border border-dark px-3 py-1">'.$row['Name'].'</td>';
            print '<td class="border border-dark px-3 py-1">'.$row['Type'].'</td>';
        }
        
        print '</tr>';
    }
    print '</table>';
}
