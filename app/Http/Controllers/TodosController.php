<?php

namespace App\Http\Controllers;
use File;
use Storage;
use App\Models\Todos;
use App\Jobs\TodoCreatedJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$todos=Todos::paginate(5);
        if($request->keyword){
            $todos = auth()->user()->todos->query()
                        ->where('name','LIKE','%'.$request->keyword.'%')
                        ->orWhere('description','LIKE','%'.$request->keyword.'%')
                        ->paginate(5);
        }else{
            $todos =  auth()->user()->todos()->paginate(5);
        }
        //$todos=Todos::all();
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
        $request->validate([
            'name' => 'required|min:5', //perlu isi lebih dpda 5 characters
        ],
        [
            'name.required' => 'Characters must be at least 5',
        ]);
        //declare model
        $todos = new Todos;
        $todos->name = $request->name;
        $todos->description = $request->description;
        $todos->date = $request->date;
        $todos->user_id = Auth::user()->id;
        $todos->save();

        if($request->hasFile('attachment'))
        {
            //logic dalam sini
            //rename
            $filename = Hash::make($todos->name.'-'.$todos->date.'-'.$request->attachment->getClientOriginalExtension());
            //simpan dalam storage
            Storage::disk('public')->put($filename,File::get($request->attachment));
            //save
            $todos->update(['attachment'=>$filename]);

        }

        TodoCreatedJob::dispatch($todos);

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
