<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'priority', 'project_id'];


    //===Implementation of Dynamic datatable.
    function getTasksDataWithFilters($request)
    {
        $getData = Task::select('tasks.*', 'projects.name as project_name');
        $getData->join('projects', 'projects.id', '=', 'tasks.project_id');
        if (!empty($request->post('name'))) {
            $getData->where('tasks.name', $request->post('name'));
        }
        if (!empty($request->post('project_id'))) {
            $getData->where('tasks.project_id', $request->post('project_id'));
        }
        $getData->orderBy('tasks.priority', 'DESC');
        $originalData = $getData->get();
        return $originalData;
    }
    public function addTask($request)
    {
        try {
            $data = array(
                'name' =>   $request->input('name'),
                'priority'   =>   $request->input('priority'),
                'project_id'    =>   $request->input('project_id')
            );
            $Task = Task::create($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTaskById($id)
    {

        $Task = Task::where('id', $id)->get(['*']);
        return $Task;
    }

    public function updateTask($request, $taskID)
    {
        $data = array(
            'name' =>   $request->input('name'),
            'priority'   =>   $request->input('priority'),
            'project_id'    =>   $request->input('project_id')
        );
        $update = Task::find($taskID)->update($data);

        if (!$update) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteTask($id)
    {
        try {
            Task::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
