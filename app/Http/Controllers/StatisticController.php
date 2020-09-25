<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

use App\Charts\NewChart;
use App\Report;

class StatisticController extends Controller
{
    public function index() {
        $projects = Project::all();
    
        //ideja mi je da u niz stavim sve brojeve po projektima: 
        //nesto kao $projects = Project::pluck('project');
        
    
        $user = User::find(1);

        //return $user->reports;

        $projectName = Project::pluck('project');
        // hocu da prodjem kroz ovaj niz $projectName i da u neki novi niz upisem kolicine
        $projectCount = [];
        

        for($i = 0; $i <= count($projectName)-1; $i++){
            $projectCount[$i] = Report::where('project', $projectName[$i])->count();
        }
        // return $projectCount;

        // return Report::where('project', $projectName[2])->count();
        // return $projectName[2];
        // return count($projectName);

        $chart1 = new NewChart;
        $chart1->labels($projectName);
        $chart1->dataset('Količina', 'bar', $projectCount);
        
        
        // po mjesecima za svaki od projekata 


        return view('test', compact('chart1'));
    }
}
