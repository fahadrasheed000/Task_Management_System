<x-header />

<section class="main">
    <div class="row">
        <div class="col-sm-12">
            <center><h1>{{env('APP_NAME')}}</h1></center>
            <hr>
            <div class="card">
                <div class="card-header search-tag">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-control" id="project_id" name="project_id"  aria-placeholder="Search by Project" >
                                <option value="">Search by Project</option>
                                @foreach($projects as $project)
                                     <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                                 </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="task_name" placeholder="Search by task name" />
                        </div>

                        <div class="col-md-3">
                            <button type="button" onclick="apply()" class="btn btn-primary"><i
                                    class="fa fa-search"></i>&nbsp;Apply</button>&nbsp;&nbsp;
                            <button type="button" onclick="resetData()" class="btn btn-danger"><i
                                    class="fa fa-close"></i>&nbsp;Reset</button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <div class="card-header">

                    <a href="#addTaskModal" style="color:white" class="btn btn-primary pull-right"
                        data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Add New Task</a>

                </div>
                <div class="card-block">
               
                        <table id="tasksTable" class="table table-striped table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Priority</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>

                        </table>
                    
                </div>
            </div>
        </div>


    </div>

</section>

<x-footer />
@include('includes.modals.tasks_modal')
@include('includes.js_scripts.tasks_js')
