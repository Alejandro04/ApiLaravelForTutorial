<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return $todos;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
        
        }else{

            $todo = Todo::create([
                'name' => $request->name,
                'date' => $request->date,
            ]);

            return $todo;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return $todo;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) 
        {
            return response()->json(['errors' => $validator->errors()], 422);
   
        }else{

            $todo = Todo::find($id);
            $todo->name = $request->name;
            $todo->date = $request->date;
            $todo->save();

            return $todo;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::destroy($id);
        
        return $id;
    }
}
