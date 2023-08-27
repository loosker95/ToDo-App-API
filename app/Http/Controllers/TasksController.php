<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use DB;

class TasksController extends Controller
{

    function index()
    {
        $tasks = DB::table('tasks')->orderByDesc('id')->get();
        if (count($tasks) > 0) {
            return $this->output(201, $tasks);
        } else {
            return $this->output(204, 'No data found');
        }
    }

    function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:20',
                'details' => 'required|max:255',
                'status' => 'required'
            ]);

            DB::table('tasks')->insert([
                'title' => $request->title,
                'details' => $request->details,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return $this->output(201, 'Task created succesffully');

        } catch (\Exception $e) {
            return $this->output(500, $e->errors());
        }
    }

    function show($id)
    {
        $tasks = DB::table('tasks')->where('id', $id)->first();
        if ($tasks) {
            return $this->output(201, $tasks);
        } else {
            return $this->output(500, 'This task does not exist');
        }
    }

    function edit($id)
    {
        $tasks = DB::table('tasks')->where('id', $id)->first();
        if ($tasks) {
            return $this->output(200, $tasks);
        } else {
            return $this->output(500, 'This task does not exist');
        }
    }

    function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:20',
                'details' => 'required|max:255',
            ]);

            $getTasks = DB::table('tasks')->where('id', $id)->update([
                'title' => $request->title,
                'details' => $request->details,
                'status' => $request->status
            ]);
            if (getType($getTasks) === 'NULL') {
                return $this->output(204, 'This task does not exist');
            } else {
                return $this->output(200, 'Tasks Updated successfully');
            }
        } catch (\Exception $e) {
            return $this->output(500, $e->errors());
        }
    }

    function destroy($id)
    {
        try {
            $tasks = DB::table('tasks')->where('id', $id);
            $tasks->delete();

            if ($tasks) {
                return $this->output(200, 'Task deleted successfully');
            } else {
                return $this->output(204, 'This task does not exist');
            }
        } catch (\Exception $e) {
            return $this->output(500, $e->errors());
        }

    }


    function output($code, $mess = NULL)
    {
        return response()->json([
            "status" => $code,
            "message" => $mess
        ]);
    }
}
