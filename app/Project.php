<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Task;
use App\User;

class Project extends Model
{
    protected $fillable = [
    	'project_name', 'project_description'
    ];



    public function task(){

        $this->hasMany(App\Task);
    }

    public function user(){
        $this->hasMany(App\User);
    }
}
