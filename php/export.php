<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $table = $_POST['nameTable'];
    $value = $_POST['value'];
}

$conn = mysqli_connect('localhost', 'root', '', $db);
if(!$conn){die('Not connect!!!');}
$text = '';
$insert = '';
if($value === 'show create database ') {
    $m = '';
    $sql = $value.' '.$db;
    if($result = mysqli_query($conn, $sql)) {
        foreach($result as $row) {
            $text .= $row['Create Database'].' ';
        }
        $sql1 = 'show tables from ' .$db;
        if($result1 = mysqli_query($conn, $sql1)) {
            foreach($result1 as $row1) {
                $sql2 = 'show create table '.$row1['Tables_in_'.$db];
                if($result2 = mysqli_query($conn, $sql2)) {
                    foreach($result2 as $row2) {
                        $text .= $row2['Create Table'].' ';
                    }
                }
                $sql3 = 'show columns from ' .$row1['Tables_in_'.$db];
                $insert .= ' INSERT INTO '.$row1['Tables_in_'.$db]. '(';
                if($result3 = mysqli_query($conn, $sql3)) {
                    foreach($result3 as $row3) {
                        $insert .= $row3['Field']. ',';
                    }
                    $insert = trim($insert, ',');
                }
                $insert .= ') VALUES ';
                $sql4 = 'select * from '.$row1['Tables_in_'.$db];
                if($result4 = mysqli_query($conn, $sql4)) {
                    foreach($result4 as $row4) {
                        $insert .= '(';
                        foreach($row4 as $row5) {
                            $insert .= '"'.$row5 . '",';
                            
                        }
                    $insert = trim($insert, ',');
                    $insert .= '),';
                    }
                    $insert = trim($insert, ',');
                    
                    
                }
            }
            $text .= $insert;
            $textDB = fopen($db.".sql", 'w') or die("не удалось создать файл");
            fwrite($textDB, $text);
            fclose($textDB);
        }
    }
} else if($value === 'show create table ') {
    $sql = $value.' ' .$table;
    if($result = mysqli_query($conn, $sql)) {
        foreach($result as $row) {
            $text = $row['Create Table'];
        }
        $sql3 = 'show columns from ' .$table;
        $insert .= ' INSERT INTO '.$table. '(';
        if($result3 = mysqli_query($conn, $sql3)) {
            foreach($result3 as $row3) {
                $insert .= $row3['Field']. ',';
            }
            $insert = trim($insert, ',');
        }
        $insert .= ') VALUES ';
        $sql4 = 'select * from '.$table;
        if($result4 = mysqli_query($conn, $sql4)) {
            foreach($result4 as $row4) {
                $insert .= '(';
                foreach($row4 as $row5) {
                    $insert .= '"'.$row5 . '",';
                    
                }
            $insert = trim($insert, ',');
            $insert .= '),';
            }
            $insert = trim($insert, ',');
        }
        $text .= $insert;
        $text_table = fopen($table.".sql", 'w') or die("не удалось создать файл");
        fwrite($text_table, $text);
        fclose($text_table);
    }
}