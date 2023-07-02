<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;
class TaskController extends Controller
{
    //listar as tarefas
    public function index(){
        $tasks = Task::all();
        return response()->json($tasks);
    }

    //detalhes da tarefa
    public function show($id){
        $tasks = Task::findOrFail($id);
        return response()->json($tasks);
    }

    //criar nova tarefa
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:concluída,não concluída',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = Task::create($request->all());
        return response()->json($task, 201);//201 sucesso
    }

    //atualizar dados de tarefa
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:concluída,não concluída',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:concluída,não concluída',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json($task);
    }

    //excluir tarefa
    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);//204 não tem nada
    }
}
