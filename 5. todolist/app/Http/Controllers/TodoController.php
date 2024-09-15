<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Exception;

class TodoController extends Controller
{
    public function showList()
    {
        $todolist = Todo::get();
        return view('todo-list',compact('todolist'));
    }

    public function addToList(Request $request)
    {
        try{
            $todo = new Todo();
            $todo->name = $request->input('todo');
            $todo->save();
            return response()->json(['todolist' => $todo]);
        }catch(Excepton $exp){
            return response()->json([
                'error'=>$exp->getMessage()
            ],$exp->getCode());
        }
    }

    public function deleteTodo($id)
    {
        try{
            $todo = Todo::findOrFail($id);
            $todo->delete();

            return response()->json(['success' => true]);
        }catch(Excepton $exp){
            return response()->json([
                'error'=>$exp->getMessage()
            ],$exp->getCode());
        }
    }

    public function updateTodo(Request $request, $id)
    {
        try{
            $todo = Todo::findOrFail($id);
            $todo->name = $request->input('todo');
            $todo->save();

            return response()->json(['success' => true]);
        }catch(Excepton $exp){
            return response()->json([
                'error'=>$exp->getMessage()
            ],$exp->getCode());
        }
    }
}
