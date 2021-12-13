<?php
 
if(isset($_FILES['myFile'])) {
    if(move_uploaded_file($_FILES['myFile']['tmp_name'], dirname(dirname(__FILE__)).'/'.$_FILES['myFile']['name'])) {
        echo 'ok';
    } else {
        echo 'no';
    }
} else {
    echo 'аааааа';
}