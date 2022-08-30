<?php

namespace App\Http\Controllers;
use App\Models\Todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos=Todos::all();
        return view('todos.index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.todos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //declare model
        $todos = new Todos;
        $todos->name = $request->name;
        $todos->description = $request->description;
        $todos->date = $request->date;
        $todos->save();

        return redirect()->route('todos:index')->with('message', 'To-Do Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todos $todos)
    {
        //create editform
        return view('todos.show',compact('todos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Todos $todos)
    {
        //Update 
    
        $todos->name=$request->name;
        $todos->description=$request->description;
        $todos->date=$request->date;
        $todos->save();

        return redirect()->route('todos:index')->with('message', 'To-Do Updated Successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos $todos)
    {
        //To delete 
        $todos->delete();

        return redirect()->route('todos:index')->with('message', 'To-Do Deleted');
    }
}