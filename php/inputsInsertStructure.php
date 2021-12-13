<?php
if(isset($_POST)) {
    $db = $_POST['db'];
    $table = $_POST['nameTbls'];
}

print '<table class="mt-4">';
print '<tr>';
print '<th class="border border-dark px-3 py-1">Field</th>';
print '<th class="border border-dark px-3 py-1">Type</th>';
print '<th class="border border-dark px-3 py-1">Null</th>';
print '<th class="border border-dark px-3 py-1">A_I</th>';
print '</tr>';
print '<tr>';
print '<td class="border border-dark py-1"><input id="inputField" class="border-0" style="outline:none" type="text"></td>';
print '<td class="border border-dark py-1"><input id="inputType" class="border-0"  style="outline:none" type="text"></td>';
print '<td class="border border-dark py-1"><input id="checkboxNull" value="YES" class="mx-4 align-middle" type="checkbox"></td>';
print '<td class="border border-dark py-1"><input id="checkboxA_I" value="auto_increment" class="mx-4 align-middle" type="checkbox"></td>';
print '</tr>';
print '</table>';
print '<button id="btnInsertStructure" style="width:150px" class="mt-2 text-white btn bg-success">Выполнить</button>';