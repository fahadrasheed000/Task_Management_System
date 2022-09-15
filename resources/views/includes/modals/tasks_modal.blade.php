<!--===================== ADD TASK MODAL =============== -->
<div id="addTaskModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-lg modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Task</h4>
            </div>
            <div class="modal-body">
                <form id="add_task_form" method="post">
                    <div class="row">
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Select Project:</label>
                                <select class="form-control" name="project_id"  aria-placeholder="Select Project" >
                               @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                               @endforeach
                                </select>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Task Name:</label>
                                <input type="text" name="name" data-max-length="100" class="form-control"
                                    placeholder="Enter Task Name" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Priority:</label>
                                <select class="form-control" aria-placeholder="Select Priority" name="priority">
                                <option value="1">Low (1)</option>
                                <option value="2">Medium (2)</option>
                                <option value="3">Heigh (3)</option>
                                </select>
                            </div>

                        </div>
                       



                        <div class=" col-md-12">
                            <div style="float:right">
                                <button type="button" class="btn btn-danger"
                                    onclick="closeAddTaskModal()">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<div id="updateTaskModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-lg modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Task</h4>
            </div>
            <div class="modal-body">
                <form id="update_task_form" method="PATCH">
                    <div class="row">
                        <input type="hidden" name="id" class="id" />
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Select Project:</label>
                                <select class="form-control project_id" name="project_id"  aria-placeholder="Select Project" >
                               @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                               @endforeach
                                </select>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Task Name:</label>
                                <input type="text" name="name" data-max-length="100" class="form-control name"
                                    placeholder="Enter Task Name" required>
                            </div>

                        </div>
                        <div class=" col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Priority:</label>
                                <select class="form-control priority" aria-placeholder="Select Priority" name="priority">
                                <option value="1">Low (1)</option>
                                <option value="2">Medium (2)</option>
                                <option value="3">Heigh (3)</option>
                                </select>
                            </div>

                        </div>


                        <div class=" col-md-12">
                            <div style="float:right">
                                <button type="button" class="btn btn-danger"
                                    onclick="closeupdateTaskModal()">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
