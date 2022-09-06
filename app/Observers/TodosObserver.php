<?php

namespace App\Observers;

use App\Models\Todos;

class TodosObserver
{
    public function created(Todos $todos)
    {
        $todos->uuid = 'todos'.'user_name = '.$todos->name;
        $todos->save();
    }
}
