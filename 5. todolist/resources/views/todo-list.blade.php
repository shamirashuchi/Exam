<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Todo List</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Todo List</div>
                <div class="card-body">
                    <form id="list-submit">
                        <div class="input-group">
                            <input id="list-input" type="text" placeholder="Todo.." class="form-control" aria-label="todo" aria-describedby="todo" required>
                            <input type="hidden" id="todo-id">
                            <div class="input-group-append ms-4">
                                <button type="submit" class="btn btn-info text-white" id="form-submit-btn">Add</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="todo-table-body">
                            @foreach ($todolist as $index => $todo)
                                <tr id="todo-{{ $todo->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="todo-name">{{ $todo->name }}</span></td>
                                    <td>
                                        <button class="edit-btn btn btn-primary" data-id="{{ $todo->id }}">Edit</button>
                                        <button class="delete-todo btn btn-danger" data-id="{{ $todo->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#list-submit").on('submit', function(event) {
            event.preventDefault();
            const todoText = $("#list-input").val();
            const todoId = $("#todo-id").val();
            const url = todoId ? `/update-todo/${todoId}` : '/add-to-list';
            const type = todoId ? 'PUT' : 'POST';

            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: url,
                type: type,
                data: { todo: todoText },
                success: function(res) {
                    if (todoId) {
                        $(`#todo-${todoId} .todo-name`).text(todoText);
                        $("#form-submit-btn").text('Add');
                        $("#todo-id").val('');
                    } else {
                        const newTodoId = res.todolist.id;
                        const newTodoName = res.todolist.name;
                        const newRow = `<tr id="todo-${newTodoId}">
                                        <td>${$("#todo-table-body tr").length + 1}</td>
                                        <td><span class="todo-name">${newTodoName}</span></td>
                                        <td>
                                            <button class="edit-btn btn btn-primary" data-id="${newTodoId}">Edit</button>
                                            <button class="delete-todo btn btn-danger" data-id="${newTodoId}">Delete</button>
                                        </td>
                                    </tr>`;
                        $("#todo-table-body").append(newRow);
                    }
                    $("#list-input").val('');
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Handle edit button click
        $(document).on('click', '.edit-btn', function() {
            const todoId = $(this).data('id');
            const currentName = $(`#todo-${todoId} .todo-name`).text();
            $("#list-input").val(currentName);
            $("#todo-id").val(todoId);
            $("#form-submit-btn").text('Update');
        });

        // Handle delete button click
        $(document).on('click', '.delete-todo', function() {
            const todoId = $(this).data('id');
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: `/delete-todo/${todoId}`,
                type: 'DELETE',
                success: function() {
                    $(`#todo-${todoId}`).remove();
                    $("#todo-table-body tr").each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>
