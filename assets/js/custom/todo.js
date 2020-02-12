$(document).ready(function(){

    $('#sidebar_todo').addClass('active');

    // base url
    let base_url = $('#base_url').val();

    // Enable tooltips everywhere
    $('[data-toggle="tooltip"]').tooltip();

    // do ajax for all
    $(document).on('submit', '.form-ajax', function(e){

        e.preventDefault();
		let data    = $(this).serialize();
        let url     = $(this).attr('action');
        let type    = $(this).attr('method');
        let reload  = $(this).attr('reload'); // get the reload data as a funtion name to reload the todos data
        
        // Delete hidden reset button
        // $('.reset-button-ajax').remove();
        // Add hidden reset button to clear items fater submit
        $(this).append('<button type="reset" class="reset-button-ajax d-none">Reset</button>');

        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(result) {
                // status 200 successfully added
                // status 401 couldn't add
                // status 402 validator has an errors
                result = JSON.parse(result);
                
                if(result.status == 200){

                    // Check if reload attr exist
                    // Reload todos
                    if (typeof reload !== typeof undefined && reload !== false) {
                        reload_data(reload)
                    }

                    // Trigger button reset
                    $('.reset-button-ajax').click();
                }
                else{
                    console.log(result);
                }
            },
            error: function(result){
                result = JSON.parse(result);
                alert(result);
            }
        });

    });

    function reload_data(functionName = ''){

        switch(functionName){
            case "reload_todos": reload_todos(); break;
            default: break;
        }
    }

    // Register fuction name
    function reload_todos(){
        $.ajax({
            url: base_url+'todo/fetchTodos',
            success: function(result) {
                result = JSON.parse(result);

                let index = '';
                let todo_list_not_done = '';
                let todo_list_done = '';
                // console.log(result.accomodations)
                for (index in result.todos){
                    if(result.todos[index].is_done == 0){
                        todo_list_not_done += '<li class="ui-state-default todo_status_not_done" reload="reload_todos" style="cursor:pointer" id="'+result.todos[index].id+'">';
                        todo_list_not_done += '<i class="fas fa-trash fa-sm float-right mt-1 mr-2 text-danger delete_todo" id="'+result.todos[index].id+'" reload="reload_todos" style="cursor:pointer"></i>';
                        todo_list_not_done += '<div class="checkbox">';
                        todo_list_not_done += '<input type="checkbox" value="'+result.todos[index].id+'">';
                        todo_list_not_done += '<label>'+result.todos[index].name+'</label>';
                        todo_list_not_done += '</div>';
                        todo_list_not_done += '</li>';
                        todo_list_not_done += '<hr class="m-2">';
                    }
                    else{
                        todo_list_done += '<li class="ui-state-default todo_status_not_done" reload="reload_todos" id="'+result.todos[index].id+'">';
                        todo_list_done += '<i class="fas fa-check fa-sm"></i> '+result.todos[index].name+'';

                        todo_list_done += '<i class="fas fa-trash fa-sm float-right mt-1 mr-2 text-danger delete_todo" id="'+result.todos[index].id+'" reload="reload_todos" style="cursor:pointer"></i>';
                        todo_list_done += '<i class="fas fa-undo fa-sm float-right mt-1 mr-2 undo_todo" id="'+result.todos[index].id+'" reload="reload_todos" style="cursor:pointer"></i>';
                        todo_list_done += '</li>';
                        todo_list_done += '<hr class="m-2">';
                    }
                }

                $('#todo_list_not_done').html(todo_list_not_done);
                $('#todo_list_done').html(todo_list_done);

            },
            error: function(result){
                result = JSON.parse(result);
                alert(result);
            }
        });
    }

    // Mark as done
    $(document).on('click', '.todo_status_not_done', function(){

        let id = $(this).attr('id');
        let reload  = $(this).attr('reload'); // get the reload data as a funtion name to reload the todos data

        $.ajax({
            url: base_url+'todo/markAsDone',
            type: 'POST',
            data: {id:id},
            success: function(result) {
                result = JSON.parse(result);
                if(result.status == 200){
                    if (typeof reload !== typeof undefined && reload !== false) {
                        reload_data(reload)
                    }
                }
            },
            error: function(result){
                result = JSON.parse(result);
                console.log(result);
            }
        });
    });

    $(document).on('click', '.undo_todo', function(){

        let id = $(this).attr('id');
        let reload  = $(this).attr('reload'); // get the reload data as a funtion name to reload the todos data

        $.ajax({
            url: base_url+'todo/undo',
            type: 'POST',
            data: {id:id},
            success: function(result) {
                result = JSON.parse(result);
                if(result.status == 200){
                    if (typeof reload !== typeof undefined && reload !== false) {
                        reload_data(reload)
                    }
                }
            },
            error: function(result){
                result = JSON.parse(result);
                console.log(result);
            }
        });
    });

    $(document).on('click', '.delete_todo', function(){

        let id = $(this).attr('id');
        let reload  = $(this).attr('reload'); // get the reload data as a funtion name to reload the todos data

        $.ajax({
            url: base_url+'todo/destroy',
            type: 'POST',
            data: {id:id},
            success: function(result) {
                result = JSON.parse(result);
                if(result.status == 200){
                    if (typeof reload !== typeof undefined && reload !== false) {
                        reload_data(reload)
                    }
                }
            },
            error: function(result){
                result = JSON.parse(result);
                console.log(result);
            }
        });
    });

    $(document).on('click', '#checkAll', function(){

        let id = $(this).attr('id');
        let reload  = $(this).attr('reload'); // get the reload data as a funtion name to reload the todos data

        $.ajax({
            url: base_url+'todo/markAllAsDone',
            type: 'POST',
            data: {id:id},
            success: function(result) {
                result = JSON.parse(result);
                if(result.status == 200){
                    if (typeof reload !== typeof undefined && reload !== false) {
                        reload_data(reload)
                    }
                }
            },
            error: function(result){
                result = JSON.parse(result);
                console.log(result);
            }
        });
    });
    
});