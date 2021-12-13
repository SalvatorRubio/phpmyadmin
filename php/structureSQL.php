<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $table = $_POST['nameTbls'];
}
print '<div id="tableSqlStructure" class="d-flex flex-column" >';
print '<textarea rows="10" cols="45" type="text" id="textarea"></textarea>';
print '<div class="d-flex mt-2">';
print '<button id="select" class="mx-1 btn btn-light border">SELECT</button>';
print '<button id="insert" class="mx-1 btn btn-light border">INSERT</button>';
print '<button id="update" class="mx-1 btn btn-light border">UPDATE</button>';
print '<button id="delete" class="mx-1 btn btn-light border">DELETE</button>';
print '<button id="alter" class="mx-1 btn btn-light border">ALTER</button>';
print '<button id="create" class="mx-1 btn btn-light border">CREATE</button>';
print '<button id="do" class="mx-1 btn btn-light border">Выполнить</button>';
print '</div>';
print '</div>';
?>
