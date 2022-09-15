<script>
    var taskTable;
    $(document).ready(function() {

        fillTaskDataTable();
    });
//Load data from db via ajax datatable
    function fillTaskDataTable() {
        var task_name = $('#task_name').val();
        var project_id=$('#project_id').val();
        taskTable = $('#tasksTable').DataTable({
            lengthMenu: [[-1],['All']],
            aoColumnDefs: [{
                bSortable: false,
                aTargets: [0, 1, 2, 3, 4]
            }],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tasks.get_filtered_data') }}",
                dataType: "json",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: task_name,
                    project_id:project_id
                }
            },
        });

    }

    function apply() {
        taskTable.destroy();
        fillTaskDataTable();
    }

    //===========Task Add/Edit Form Validation===========
    var taskValidator = $('#add_task_form').validate({

        rules: {
            project_id: {
                required: true
            },
            name: {
                required: true,
                maxlength: 100
            },
            priority: {
                required: true
            },



        },
        // Specify validation error messages
        messages: {
            project_id: {
                required: "Please select project"
            },
            name: {
                required: "Please enter name",
                maxlength: "Name must be less than 100 characters"
            },
            priority: {
                required: "Please select priority"
            },


        },
        submitHandler: function(form) {
            var url = "{{ route('tasks.store') }}";
            $.ajax({
                url: url,
                type: form.method,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status == 0) {
                        swal(response.message);
                        closeAddTaskModal();
                        reloadDataTable()

                    } else if (response.status == 1) {
                        swal(response.message);

                    }
                },
                error: function(xhr, status, error) {
                    swal(error, JSON.stringify(xhr.responseJSON));
                }
            });
        }
    });

    var taskUpdateValidator = $('#update_task_form').validate({
        rules: {
            project_id: {
                required: true
            },
            name: {
                required: true,
                maxlength: 100
            },
            priority: {
                required: true
            },




        },
        // Specify validation error messages
        messages: {
            project_id: {
                required: "Please select project"
            },
            name: {
                required: "Please enter name",
                maxlength: "Name must be less than 100 characters"
            },
            priority: {
                required: "Please select priority"
            },

        },
        submitHandler: function(form) {
            var id = $('.id').val();
            var url = "/tasks/" + id;
            $.ajax({
                url: url,
                type: 'PATCH',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status == 0) {
                        swal(response.message);
                        closeupdateTaskModal();
                        reloadDataTable()

                    } else if (response.status == 1) {
                        swal(response.message);

                    }
                },
                error: function(xhr, status, error) {
                    responseText = jQuery.parseJSON(xhr.responseText);
                    console.log(responseText.message);
                    swal(error,responseText.message);
                }
            });
        }
    });
    //close add model and refresh form
    function closeAddTaskModal() {
        taskValidator.resetForm();
        $('#add_task_form').trigger("reset");
        $('#addTaskModal').modal('hide');
    }
    //close update model and refresh form
    function closeupdateTaskModal() {
        taskUpdateValidator.resetForm();
        $('#update_task_form').trigger("reset");
        $('#updateTaskModal').modal('hide');
    }
    //refresh ajax Datatable
    function reloadDataTable() {
        $('#tasksTable').DataTable().ajax.reload();
    }
    //delete task data from db by sending ajax request
    function deleteTask(id) {

        swal({
                title: "Are you sure?",
                text: "you want to delete this Task.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "tasks/" + id,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token': '{{ csrf_token() }}',
                        },
                        data: {
                            "id": id
                        },
                        success: function(response) {
                            if (response.status == 0) {
                                swal(response.message);
                                reloadDataTable()

                            } else if (response.status == 1) {
                                swal(response.message);

                            }
                        },
                        error: function(xhr, status, error) {
                            swal(error, JSON.stringify(xhr.responseJSON));
                        }
                    });
                } else {
                    swal.close();
                }
            });
    }
    //reset filters
    function resetData() {
        $('#task_name').val('');
        $('#project_id').val('');
        apply();
    }
    //get task data from db by sending ajax request
    function getTaskData(id) {

        var url = "/tasks/" + id + "/edit";
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('.id').val(response[0].id);
                $('.name').val(response[0].name);
                $('.project_id').val(response[0].project_id);
                $('.priority').val(response[0].priority);
                $('#updateTaskModal').modal('show');
            },
            error: function(xhr, status, error) {
                swal(xhr, "error");
            }
        });
    }
</script>
