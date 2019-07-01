<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Task;

class Task extends Model
{
    //
    protected $fillable = [
    	'task_name', 'task_description','task_status'
    ];



    public function project(){

        $this->bleongTo(App\Project);
    }
}
