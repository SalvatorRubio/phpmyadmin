<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $value = $_POST['text'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if($result = mysqli_query($conn, $value)) {
    $sql = 'SHOW TRIGGERS FROM '. $db;
    if($result1 = mysqli_query($conn, $sql)) {
        print '<table>';
        print '<tr>';
        print '<th class="border border-dark px-3 py-1">Имя</th>';
        print '<th class="border border-dark px-3 py-1">Время</th>';
        print '<th class="border border-dark px-3 py-1">Событие</th>';
        print '</tr>';
        foreach($result1 as $row) {
            print '<tr>';
            print '<td class="border border-dark px-3 py-1">'.$row['Trigger'].'</td>';
            print '<td class="border border-dark px-3 py-1">'.$row['Timing'].'</td>';
            print '<td class="border border-dark px-3 py-1">'.$row['Event'].'</td>';
            print '</tr>';
        }
        print '</table>';
    }
}