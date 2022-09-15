<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\CreateTaskRequest; //Laravel form validation class
use App\Http\Requests\UpdateTaskRequest; //Laravel form validation class

class TaskController extends Controller
{
    function __construct()
    {
        $this->taskModel = new Task();
        $this->projectModel = new Project();
    }
    public function index()
    {
        $projects = $this->projectModel->getAllProjects();
        return view('tasks.index', compact('projects'));
    }
    //======jquery dynamic datatable Request
    public function getTaskData(Request $request)
    {
        $data = array();
        $taskList = $this->taskModel->getTasksDataWithFilters($request);
        if (!empty($taskList)) {
            $count = 0;
            foreach ($taskList as $list) {
                $nestedData = array();
                $count = $count + 1;
                $editButton = '<i title="update task" onclick="getTaskData(' . $list->id . ')" style="blue" class="fa fa-edit"></i></a>&nbsp;&nbsp;';
                $deleteButton = '<i title="delete task" onclick="deleteTask(' . $list->id . ')" style="color:red" class="fa fa-trash"></i></a>&nbsp;&nbsp;';
                $nestedData[] = $count;
                $nestedData[] = $list->project_name;
                $nestedData[] = $list->name;
                $nestedData[] = $list->priority;
                $nestedData[] = $editButton . ' ' . $deleteButton;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "data"            => $data
        );

        echo json_encode($json_data);
    }


    public function store(CreateTaskRequest $request)
    {
        $response = $this->taskModel->addTask($request);

        if ($response) {
            return response()->json(['status' => 0, 'message' => 'Task added successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }

    public function edit($id)
    {
        $result = $this->taskModel->getTaskById($id);
        return response()->json($result);
    }


    public function update(UpdateTaskRequest $request, $taskID)
    {
        $result = $this->taskModel->updateTask($request, $taskID);
        if ($result) {
            return response()->json(['status' => 0, 'message' => 'Task updated successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }


    public function destroy($id)
    {
        $response = $this->taskModel->deleteTask($id);
        if ($response) {
            return response()->json(['status' => 0, 'message' => 'Task deleted successfully']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Invalid data']);
        }
    }
}
