$(function() {
    $('.logo_table').hide()
    $('.logo_db').hide()
    $('#blockInsert').hide()
    $('#blockInsert').removeClass('d-flex')
    $('#navTableBtns').hide()
    

    $('.el').each(function() {
        $(this).click(function(e) {
            if($(e.target).hasClass('item_db')) {
                $('.table_db').remove()
                $('.el .item').remove()
                $('#blockInsert').removeClass('d-flex')
                $('#designerTable').html('')
                $.ajax({
                    url: "/php/tables.php",
                    method: 'post',
                    data: {
                        text: $(this).text()
                    },
                    success: function (response) {
                        response = response.split(', ').slice(0, -1)
                        $('#navTableBtns').hide()
                        $('.item_table').remove()
                        $('#btnInsert').remove()
                        $('.logo_table').hide()
                        $('.logo_db').show()
                        $('.info_bd').html('')
                        $('.name_db').text(e.target.innerHTML)
                        for(i = 0; i< response.length; i++) {
                            $(e.target.parentElement).append('<h1 class="item_table">'+response[i]+'</h1>')
                        }
                    }
                });
            }
        })
    })
    
    $('.el').each(function() {
        $(this).click(function(e) {
            if($(e.target).hasClass('item_table')) {
                $.ajax({
                    url: "/php/itemsTable.php",
                    method: 'POST',
                    data: {
                        col: $('.logo_db .name_db').text(),
                        name: $(e.target).text()
                    },
                    success: function(response){
                        response = response.split(', ').slice(0, -1)
                        $('.nav-btn').removeClass("bg-secondary")
                        $('#btnOverview').addClass("bg-secondary")
                        $('#navTableBtns').show()
                        $('.info_bd').html('')
                        $('#blockInsert').addClass('d-flex')
                        $('.logo_table').show()
                        $('#designerTable').html('')
                        $('.name_table').text($(e.target).text())
                        $('.item').remove()
                        for(i = 0; i< response.length; i++) {
                            $(e.target).after('<h1 class="item">'+response[i]+'</h1>')
                        }
                    }
                });
            }
        })
    })
    
    $('.nav_db').on('click','.item_table', function() {
        $.ajax({
            url: "/php/dataTables.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $(this).text()
            },
            success: function(response){
                $('.table_db').remove()
                $('.info_bd').append(response)
            }
        });
    })
    // DELETE ITEMS
    $('.info_bd').on('click', '.table_db tr .btn-delete', function() {
        $('#deleteItem').attr('data-name', $(this).data('name'))
        $('#deleteItem').attr('data-id', $(this).data('id'))
    })
    
    $('.modal-dialog').on('click', '.modal-footer #deleteItem', function() {
        $.ajax({
            url: '/php/delete.php',
            method: 'POST',
            data: {
                nameDatabase: $('.name_db').text(),
                nameTable: $('.name_table').text(),
                nameCol: $(this).attr('data-name'),
                id: $(this).attr('data-id')
            },
            success: function(response) {
                // console.log(response);
                $('#tableSqlStructure').remove()
                // $('.table_db').remove()
                $('.info_bd').append(response)
                
            }
        })
    })
    
    // UPDATE AND SAVE ITEMS
    $('.info_bd').on('click', '.table_db tr .btn-update', function() {
        let arrTextsInputs = []
        $('#inputsInsert').html('')
        if($(this).text() === 'Изменить') {
            $(this).text('Сохранить')
            
            let $allChilds = $(this).parent().children()
            for(let i = 0; i < $allChilds.length - 2; i++) {
                $allChilds[i].innerHTML = '<input type="text" value="'+$allChilds[i].innerHTML+'">'
            }
        } else {
            
            $(this).text('Изменить')
            let $allChilds = $(this).parent().children().children()
            
            for(let i = 0; i < $allChilds.length; i++) {
                arrTextsInputs.push($allChilds[i].value)
            }
            $.ajax({
                url: '/php/updateItem.php',
                method: 'POST',
                data: {
                    nameDatabase: $('.name_db').text(),
                    nameTable: $('.name_table').text(),
                    id: $(this).attr('data-id'),
                    arrTexts: arrTextsInputs,
                },
                success: function(response) {
                    $('.table_db').remove()
                    
                    $('.info_bd').append(response)
                }
            })
        }
    })

    // INSERT INTO
    $('#btnShowInputs').click(function() {
        if($('#btnOverview').hasClass('bg-secondary')) {
            $('#inputsInsert').html('')
            $.ajax({
                url: '/php/inputsInsert.php',
                method: 'POST',
                data: {
                    nameDatabase: $('.name_db').text(),
                    nameTable: $('.name_table').text(),
                },
                success: function(response) {
                    $('#inputsInsert').append(response)
                }
            })
        } else if($('#btnStructure').hasClass('bg-secondary')) {
            $('#inputsInsert').html('')
            $.ajax({
                url: '/php/inputsInsertStructure.php',
                method: 'POST',
                data: {
                    nameDatabase: $('.name_db').text(),
                    nameTable: $('.name_table').text(),
                },
                success: function(response) {
                    $('#inputsInsert').append(response)
                }
            })
        }
    })
    $('.intro_inner').on('click', '#inputsInsert #btnInsert', function() {
        $.ajax({
            url: '/php/insert.php',
            method: 'POST',
            data: {
                nameDatabase: $('.name_db').text(),
                nameTable: $('.name_table').text(),
                value: $('.input_insert').val()
            },
            success: function(response) {
                $('#btnInsert').remove()
                $('.table_db').remove()
                $('.info_bd').append(response)
            }
        })
    })

    // NAVIGATION BUTTONS
    $('.nav-btn').click(function() {
        $('.nav-btn').each(function() {
            $(this).removeClass("bg-secondary");
        })
        $('.info_bd').html('')
        $('#designerTable').html('')
        $(this).removeClass("bg-light")   
        $(this).addClass("bg-secondary")
        $('#createUser').addClass('d-none')

    })
    $('.nav-btn').mouseenter(function() {
        if(!$(this).hasClass('bg-secondary')) {
            $(this).addClass("bg-light")    
        }
    })
    $('.nav-btn').mouseleave(function() {
        $(this).removeClass("bg-light")    
    })

    $('#btnOverview').click(function(){
        $('#blockInsert').addClass('d-flex')
        $('#inputsInsert').html('')
        $.ajax({
            url: "/php/dataTables.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $('.logo_table .name_table').text()
            },
            success: function(response){
                $('.info_bd').append(response)
            }
        });
    });

    $('#btnStructure').click(function(){
        $('#blockInsert').addClass('d-flex')
        $('#inputsInsert').html('')

        $.ajax({
            url: "/php/tableStructure.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $('.logo_table .name_table').text()
            },
            success: function(response){
                $('.info_bd').append(response)
            }
        });
    });

    $('#btnSQL').click(function(){
        $('#blockInsert').removeClass('d-flex')
        $('#inputsInsert').html('')
        $.ajax({
            url: "/php/structureSQL.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $('.logo_table .name_table').text()
            },
            success: function(response){
                $('.info_bd').append(response)
            }
        });
    });


    $('#btnDesigner').click(function(){
        $('#blockInsert').removeClass('d-flex')
        $('#designerTable').addClass('h-100')
        $.ajax({
            url: "/php/designer.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTable: $('.logo_table .name_table').text()
            },
            success: function(response){
                $('#designerTable').append(response)
            }
        });
    });

    // EXPORT DB
    $('#btnExport').click(function(){
        $('#blockInsert').removeClass('d-flex')
        $('#inputsInsert').html('')
        let block = ''
        block += '<div class="d-flex flex-column align-items-center">'
        block += '<h1>Экспорт данных</h1>'
        block += '<div class="d-flex align-items-center">'
        block += '<input type="radio" name="contact" id="db" value="show create database ">'
        block += '<label class="mx-2" for="db">База данных</label>'
        block += '<input type="radio" name="contact" id="table" value="show create table ">'
        block += '<label class="mx-2" for="table">Таблицу</label>'
        block += '</div>'
        block += '<button id="doExport" class="mx-1 mt-3 btn btn-light border">Выполнить</button>'
        block += '</div>'
        $('.info_bd').html(block)
    });
    $('.info_bd').on('click', 'div #doExport', function() {
        let value = ''
        if($('#db').prop('checked')) {
            value += $('#db').val()
        } else if ($('#table').prop('checked')) {
            value += $('#table').val()
        } else {
            value = ''
        }
        if(value != '') {
            $.ajax({
                url: "/php/export.php",
                method: 'POST',
                data: {
                    db: $('.name_db').text(),
                    nameTable: $('.logo_table .name_table').text(),
                    value: value
                }
            });
        }
    })

    $('#btnImport').click(function(){
        $('#blockInsert').removeClass('d-flex')
        $('#inputsInsert').html('')
        let block = '<form id="formId">'
        block += '<input type="file" name="myFile">'
        block += '<input type="submit" value="Загрузить">'
        block += '</form>'
        $('.info_bd').html(block)
        
    });

    $('#btnProcedure').click(function(){
        $('#blockInsert').removeClass('d-flex')
        $('#inputsInsert').html('')
        let block = ''
        block += '<div class="d-flex flex-column align-items-center">'
        block += '<div id="showProcedure" class="mb-5"></div>'
        block += '<div class="d-flex my-2"><h5>Введите имя:</h5><input id="name" class="mx-2" style="outline:none" type="text"></div>'
        block += '<table class="table d-flex flex-column">'
        block += '<tr>'
        block += '<th class="border border-dark px-3 py-1">Направления</th>'
        block += '<th class="border border-dark px-3 py-1">Имя</th>'
        block += '<th class="border border-dark px-3 py-1">Тип</th>'
        block += '<th class="border border-dark px-3 py-1">Длина</th>'
        block += '</tr>'
        block += '<tr class="form">'
        block += '<td class="px-3 border border-dark"><select>'
        block += '<option value="in">IN</option>'
        block += '<option value="out">OUT</option>'
        block += '<option value="inout">INOUT</option>'
        block += '</select>'
        block += '</td>'
        block += '<td class="px-3 border border-dark"><input type="text"></td>'
        block += '<td class="px-3 border border-dark"><select>'
        block += '<option value="int">INT</option>'
        block += '<option value="varchar">VARCHAR</option>'
        block += '<option value="date">DATE</option>'
        block += '</select>'
        block += '</td>'
        block += '<td class="px-3 border border-dark"><input type="text"></td>'
        block += '<td class="px-3 border border-dark"><button class="btn border border-dark">Удалить</button></td>'
        block += '</tr>'
        block += '</table>'
        block += '<button id="addBlock" class="w-100 my-2 btn border border-dark">Добавить</button>'
        block += '</div>'
        block += '<textarea id="text" class="w-100" style="height: 150px"></textarea>'
        block += '<button id="createProcedure" class="btn border border-dark mt-2">Создать процедуру</button>'
        $('.info_bd').append(block)
        $.ajax({
            url: "/php/listProcedurs.php",
            method: 'POST',
            success: function(response){
                $('#showProcedure').append(response)
            }
        })
    });

    $('.info_bd').on('click', ' #addBlock', function() {
        block = ''
        block += '<tr class="form">'
        block += '<td class="px-3 border border-dark"><select>'
        block += '<option value="in">IN</option>'
        block += '<option value="out">OUT</option>'
        block += '<option value="inout">INOUT</option>'
        block += '</select>'
        block += '</td>'
        block += '<td class="px-3 border border-dark"><input type="text"></td>'
        block += '<td class="px-3 border border-dark"><select>'
        block += '<option value="int">INT</option>'
        block += '<option value="varchar">VARCHAR</option>'
        block += '<option value="date">DATE</option>'
        block += '</select>'
        block += '</td>'
        block += '<td class="px-3 border border-dark"><input type="text"></td>'
        block += '<td class="px-3 border border-dark"><button class="btn border border-dark">Удалить</button></td>'
        block += '</tr>'
        $('.table').append(block)
    })

    $('#btnTrigger').click(function() {
        $('#blockInsert').removeClass('d-flex')
        let block = ''
        block += '<div class="d-flex flex-column align-items-center">'
        block += '<div id="showTrigger" class="mb-5"></div>'
        block += '<div class="d-flex"><h5 class="mx-2">Введите имя триггера:</h5><input type="text" id="name"></div>'
        block += '<select id="listNamesBd" class="w-100 my-2">'
        $('.item_table').each(function(i, el) {
            block += '<option value="'+el.innerHTML+'">' + el.innerHTML + '</option>'
        })
        block += '</select>'
        block += '<select id="time" class="w-100 my-2">'
        block += '<option value="BEFORE">BEFORE</option>'
        block += '<option value="AFTER">AFTER</option>'
        block += '</select>'
        block += '<select id="method" class="w-100 my-2">'
        block += '<option value="INSERT">INSERT</option>'
        block += '<option value="UPDATE">UPDATE</option>'
        block += '<option value="DELETE">DELETE</option>'
        block += '</select>'
        block += '<textarea id="text" class="w-100" style="height: 200px"></textarea>'
        block += '<button id="createTrigger" class="w-100 btn border border-dark my-2">Создать</button>'
        block += '</div>'
        $('.info_bd').html(block)
        $.ajax({
            url: "/php/listTriggers.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
            },
            success: function(response){
                $('#showTrigger').append(response)
            }
        })
    })

    $('#btnUsers').click(function() {
        $('#blockInsert').removeClass('d-flex')
        $('.info_bd').html('')
        $('#designerTable').removeClass('h-100')
        $('#createUser').addClass('d-flex')
        $('#createUser').removeClass('d-none')
    })

    
    
    $('div').on('click', 'td button',function() {
        $(this).parent().parent().remove();
    })

    // DELETE STRUCTURE COLUMNS
    $('.intro_inner').on('click', '.info_bd #structureTable .btn-delete-column', function() {
        $('#deleteItem').attr('data-name', $(this).parent().children(':first').text())
        
    })
    $('#deleteItem').click(function() {
        $.ajax({
            url: "/php/deleteColumn.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $('.logo_table .name_table').text(),
                nameColumn: $(this).attr('data-name')
            },
            success: function(response){
                $('.info_bd').html('')
                $('#structureTable').remove()
                $('.info_bd').append(response)
            }
        });
    }) 

    // INSERT STRUCTURE COLUMNS
    $('#inputsInsert').on('click', '#btnInsertStructure', function() {
        let value = ''
        if($('#inputField').val() != '' && $('#inputType').val() != '') {
            value += $('#inputField').val() +' '
            value += $('#inputType').val()+' '
            if($('#checkboxNull').prop('checked')) {
                value += 'NULL '
            } else {
                value += ' NOT NULL '
            }
            if($('#checkboxA_I').prop('checked')) {
                value += ' AUTO_INCREMENT '
            }
        }
        $.ajax({
            url: "/php/insertStructure.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTbls: $('.logo_table .name_table').text(),
                value: value
            },
            success: function(response){
                $('#structureTable').remove()
                $('#inputsInsert').html('')
                $('.info_bd').append(response)
            }
        });
        
    })

    // UPDATE COLUMN
    $('.info_bd').on('click', '#structureTable tr .btn-update-column', function() {
        let arrTextsInputs = []
        $('#inputsInsert').html('')
        if($(this).text() === 'Изменить') {
            $(this).text('Сохранить')
            
            let $allChilds = $(this).parent().children()
            for(let i = 0; i < $allChilds.length - 6; i++) {
                $allChilds[i].innerHTML = '<input type="text" value="'+$allChilds[i].innerHTML+'">'
            }
            if($allChilds[2].innerHTML === 'NO' ) {
            $allChilds[2].innerHTML = ''
            $allChilds[2].innerHTML += '<input class="mx-4 align-middle" type="checkbox" value="NULL">'
            } else {
                $allChilds[2].innerHTML = ''
                $allChilds[2].innerHTML += '<input class="mx-4 align-middle" type="checkbox" checked value="NOT NULL">'
            }
            if($allChilds[5].innerHTML === 'auto_increment' ) {
                $allChilds[5].innerHTML = ''
                $allChilds[5].innerHTML += '<input class="mx-4 align-middle" checked type="checkbox" value="AUTO_INCREMENT">'
            } else {
                $allChilds[5].innerHTML = ''
                $allChilds[5].innerHTML += '<input class="mx-4 align-middle" type="checkbox" value="">'
            }
            
        } else {
            $(this).text('Изменить')
            let $allChilds = $(this).parent().children().children()
            
            for(let i = 0; i < $allChilds.length; i++) {
                arrTextsInputs.push($allChilds[i].value)
            }
            $.ajax({
                url: '/php/updateColumn.php',
                method: 'POST',
                data: {
                    nameDatabase: $('.name_db').text(),
                    nameTable: $('.name_table').text(),
                    arrTexts: arrTextsInputs
                },
                success: function(response) {
                    console.log(response);
                    // $('#structureTable').remove()
                    
                    // $('.info_bd').append(response)
                }
            })
        }
    })
    

    // SQL STRUCTURE
    $('.info_bd').on('click', 'div #insert', function() {
        let value = ''
        $.ajax({
            url: "/php/itemsTable.php",
            method: 'POST',
            data: {
                col: $('.logo_db .name_db').text(),
                name: $('.logo_table .name_table').text()
            },
            success: function(response){
                response = response.split(', ').slice(0, -1)
                value += 'insert into '+$('.logo_table .name_table').text()+ ' values ('
                for(let i = 0; i < response.length; i++) {
                    value += '"[value-'+(i+1)+']",'
                }
                value = value.replace(/,\s*$/, "");
                value += ')'
                $('.info_bd div textarea').val(value)
            }
        });
    })
    $('.info_bd').on('click', 'div #update', function() {
        let value = ''
        $.ajax({
            url: "/php/itemsTable.php",
            method: 'POST',
            data: {
                col: $('.logo_db .name_db').text(),
                name: $('.logo_table .name_table').text()
            },
            success: function(response){
                response = response.split(', ').slice(0, -1)
                value += ' UPDATE ' +$('.logo_table .name_table').text()+ ' SET '
                for(let i = 0; i < response.length; i++) {
                    value += ' '+response[i]+'="[value-'+(i+1)+']",'
                }
                value = value.replace(/,\s*$/, "");
                value += ' where '
                value += '1'
                $('.info_bd div textarea').val(value)
            }
        });
    })
    $('.info_bd').on('click', 'div #delete', function() {
        let value = ''
        $.ajax({
            url: "/php/itemsTable.php",
            method: 'POST',
            data: {
                col: $('.logo_db .name_db').text(),
                name: $('.logo_table .name_table').text()
            },
            success: function(response){
                response = response.split(', ').slice(0, -1)
                value += 'delete from ' + $('.logo_table .name_table').text()
                value += ' where '
                value += '1'
                $('.info_bd div textarea').val(value)
            }
        });
    })

    $('.info_bd').on('click', 'div #alter', function() {
        let value = 'alter table '+ $('.logo_table .name_table').text()
        $('.info_bd div textarea').val(value)
    })

    $('.info_bd').on('click', 'div #select', function() {
        let value = 'select * from ' + $('.logo_table .name_table').text()
        $('.info_bd div textarea').val(value)
    })

    $('.info_bd').on('click', 'div #create', function() {
        let value = 'create table table_name ()'
        $('.info_bd div textarea').val(value)
    })

    $('.info_bd').on('click', 'div #do', function() {
        
        let arr = $('#textarea').val().split(' ')
        if(arr[0] === 'create') {
            $.ajax({
                url: "/php/tables.php",
                method: 'post',
                data: {
                    text: $('.logo_db .name_db').text()
                },
                success: function (response) {
                    response = response.split(', ').slice(0, -1)
                    $('#navTableBtns').remove()
                    $('.info_bd').remove()
                    $('#structureTable').remove()
                    $('.el .item_table').remove()
                    $('.el .item').remove()
                }
            });
        }
        if(arr[0] === 'select') {
            
            $.ajax({
                url: "/php/select.php",
                method: 'POST',
                data: {
                    db: $('.logo_db .name_db').text(),
                    value: $('#textarea').val(),
                    nameTbls: $('.logo_table .name_table').text()
                },
                success: function(response){
                    
                    $('#tableSqlStructure').remove()
                    $('.info_bd').append(response)
                }
            });
        } else {
            $.ajax({
                url: "/php/doSqlQuery.php",
                method: 'POST',
                data: {
                    db: $('.logo_db .name_db').text(),
                    value: $('#textarea').val(),
                    nameTbls: $('.logo_table .name_table').text()
                },
                success: function(response){
                    $('#tableSqlStructure').remove()
                    $('.info_bd').append(response)
                    
                }
            });
        }
    })
    // CREATE PROCEDURE
    $('.info_bd').on('click', '#createProcedure', function() {
        let parent = document.querySelectorAll('.form') 
        let value = ''
        value += 'CREATE PROCEDURE ' + $('#name').val() + ' ('
        for(let i = 0; i < parent.length; i++) {
            value += parent[i].childNodes[0].childNodes[0].value + ' '
            value += parent[i].childNodes[1].childNodes[0].value + ' '
            value += parent[i].childNodes[2].childNodes[0].value + '('
            value += parent[i].childNodes[3].childNodes[0].value
            value += '), '
        }
        value = value.replace(/,\s*$/, "")
        value += ') '
        value += $('#text').val()
        $.ajax({
            url: "/php/createProcedure.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                nameTable: $('.logo_table .name_table').text(),
                text: value
            },
            success: function(response){
                $('.info_bd').html(response)
            }
        })
    })
    // CREATE TRIGGER
    $('.info_bd').on('click', '#createTrigger', function() {
        let value = 'CREATE TRIGGER '
        value += $('#name').val() + ' '
        value += $('#time').val() + ' '
        value += $('#method').val() + ' '
        value += 'ON '+ $('#listNamesBd').val() + ' FOR EACH ROW '
        value += 'BEGIN '
        
        value += $('#text').val() + '; '
        value += 'END'
        $.ajax({
            url: "/php/createTrigger.php",
            method: 'POST',
            data: {
                db: $('.name_db').text(),
                text: value
            },
            success: function(response){
                $('#showTrigger').html('')
                $('#showTrigger').append(response)
            }
        })
    })

    // CREATE USER
    $('#btnUser').click(function() {
        let user = 'CREATE USER '
        user += "'" + $('#log').val() + "'"
        user += "@'localhost'"
        user += ' IDENTIFIED '
        user += ' BY "' + $('#pass').val() + '"; '
        let rules = ''
        rules += 'GRANT '
        $('.checkboxMethod').each(function() {
            if($(this).is(':checked')) {
                rules += $(this).val() + ', '
            }
        })
        $('.checkboxStructure').each(function() {
            if($(this).is(':checked')) {
                rules += $(this).val() + ', '
            }
        })
        rules = rules.replace(/,\s*$/, "")
        rules += " ON *.* TO "
        rules += "'" + $('#log').val() + "'@'localhost';" 
        $.ajax({
            url: "/php/createUser.php",
            method: 'POST',
            data: {
                value: user,
                f: rules
            }
        })
    })
    
    $('.info_bd').on('submit', '#formId', function(e) {
        e.preventDefault()
        let formData = new FormData(this)

        $.ajax({
            type: 'POST',
            url: '/php/import.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data + 'ff');
            }
        })
    })
    
})
