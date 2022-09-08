<?php

namespace App\Jobs;

use App\Models\Todos;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class TodoCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $todos;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Todos $todos)
    {
        $this->todos = $todos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.todoCreatedJob',[
            'name'=>$this->todos->users->name,
        ]
        , function ($message){
            //query to email
            $message->to($this->todos->users->email);
            $message->subject('To-Do Created');
        });
    }
}
