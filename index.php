<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="intro d-flex">
        <div class="nav bg-light border min-vh-100 w-25 d-flex flex-column align-items-center">
            <h1 class="text-black-50  logo">F</h1>
            <?php
                $conn = mysqli_connect('localhost', 'root', '', '');

                $sql = 'show databases';
                if($result = mysqli_query($conn, $sql)) {
                    print '<div class="w-100 nav_db mt-5">';
                    foreach($result as $row) {
                        print '<div class="el ">';
                        print '<h1 class="item_db border m-0 p-2">'.$row['Database'].'</h1>';
                        print '</div>';
                    }
                    print '</div>';
                    
                }
            ?>
        </div>
        <div class="intro_inner d-flex flex-column px-5 w-100">
            <div class="d-flex">
                <h1 class="logo_db fs-4 px-1">База данных: <span class="name_db"></span></h1>
                <h1 class="fs-4 logo_table px-1">Таблица: <span class="name_table"></span></h1>
            </div>
            <div id="navTableBtns" class="mt-3">
                <h1 id="btnOverview" class="nav-btn fs-5 btn bg-secondary rounded-0">Обзор</h1>
                <h1 id="btnStructure" class="nav-btn fs-5 btn rounded-0">Структура</h1>
                <h1 id="btnSQL" class="nav-btn fs-5 btn rounded-0">SQL</h1>
                <h1 id="btnDesigner" class="nav-btn fs-5 btn rounded-0">Дизайнер</h1>
                <h1 id="btnExport" class="nav-btn fs-5 btn rounded-0">Экспорт</h1>
                <h1 id="btnImport" class="nav-btn fs-5 btn rounded-0">Импорт</h1>
                <h1 id="btnProcedure" class="nav-btn fs-5 btn rounded-0">Процедуры</h1>
                <h1 id="btnTrigger" class="nav-btn fs-5 btn rounded-0">Триггеры</h1>
                <h1 id="btnUsers" class="nav-btn fs-5 btn rounded-0">Учетные записи пользователей</h1>
            </div>
            <div class="info_bd d-flex flex-column align-items-center mt-5">
            </div>
            <div id="blockInsert" class="rounded mt-5 flex-column align-items-center border border-dark p-5">
                <div class="d-flex">
                    <h1 class="fs-4">Добавить элемент в таблицу</h1>
                    <button id="btnShowInputs" class="px-5 mx-4 btn btn-primary">Добавить</button>
                </div>
                <div id="inputsInsert"  class="d-flex flex-column">
                    
                </div>
            </div>
            <div id="designerTable" class="h-100">
            </div>
            <div id="createUser" class="d-none flex-column align-items-center w-75">
                <div class="d-flex w-100 flex-column border border-1">
                    <div class="d-flex my-1 px-2 justify-content-between">
                        <h5 >Имя пользователя</h5><input id="log" type="text">
                    </div>
                    <div class="d-flex my-1 px-2 justify-content-between">
                        <h5>Пароль </h5><input id="pass" type="password">
                    </div>
                    <div class="d-flex my-1 px-2 justify-content-between">
                        <h5>Подтвердите пароль </h5><input type="password">
                    </div>
                </div>
                <div class="d-flex w-100 justify-content-center">
                    <div class="d-flex mx-3">
                        <div class="d-flex flex-column border border-1 my-3">
                            <h5 class="mx-auto">Данные</h5>
                            <div class="d-flex border-top">
                                <input type="checkbox" value="SELECT" class="mx-1 checkboxMethod">
                                <h5 class="mx-1">SELECT</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="INSERT" class="mx-1 checkboxMethod">
                                <h5 class="mx-1">INSERT</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="UPDATE" class="mx-1 checkboxMethod">
                                <h5 class="mx-1">UPDATE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="DELETE" class="mx-1 checkboxMethod">
                                <h5 class="mx-1">DELETE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="FILE" class="mx-1 checkboxMethod">
                                <h5 class="mx-1">FILE</h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mx-3">
                        <div class="d-flex flex-column border border-1 my-3">
                            <h5 class="mx-auto">Структура</h5>
                            <div class="d-flex border-top">
                                <input type="checkbox" value="CREATE" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">CREATE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="ALTER" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">ALTER</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="INDEX" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">INDEX</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="DROP" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">DROP</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="CREATE TEMPORARY TABLES" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">CREATE TEMPORARY TABLES</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="SHOW VIEW" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">SHOW VIEW</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="CREATE ROUTINE" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">CREATE ROUTINE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="ALTER ROUTINE" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">ALTER ROUTINE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="EXECUTE" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">EXECUTE</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="CREATE VIEW" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">CREATE VIEW</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="EVENT" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">EVENT</h5>
                            </div>
                            <div class="d-flex">
                                <input type="checkbox" value="TRIGGER" class="mx-1 checkboxStructure">
                                <h5 class="mx-1">TRIGGER</h5>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <span><button id="btnUser" class="btn btn-light border border-dark">Создать</button></span>
                
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление элемента</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Вы уверены, что хотите удалить данный элемент?</p>
            </div>
            <div class="modal-footer">
                <button id="deleteItem" type="button" class="btn btn-danger" data-bs-dismiss="modal">Да</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Нет</button>
            </div>
            </div>
        </div>
    </div>

<script src="./script/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="/script/script.js"></script>
</body>
</html>

