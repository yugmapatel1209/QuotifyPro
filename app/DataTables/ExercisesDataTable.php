<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ExercisesMaster;
use App\Exercises;

class ExercisesDataTable
{
    public function all()
    {
        $data =[];
        // $data = ExercisesMaster::with('ceu')->with('scenario' )->with('mode')->with('languagepair')->with('exercises')->GetSelectAdmin()
        // ->IsDelete()->get();
        $data = ExercisesMaster::with('ceu')->with(['scenario' => function ($scenario) {
                    $scenario->with(['subject' => function ($subject) {
                        $subject->with('fields');
                    }]);
                }])->with('mode')->with('languagepair')->with('exercises')->GetSelectAdmin()->IsDelete()->get();
        // print_r($data->toArray()); die;
        foreach($data as $key =>$dt) {
            $data[$key]['Date'] = date("Y-m-d H:i:s", strtotime($dt['CreatedDate']));

            $data[$key]['modeName'] = 'Not Found ';
            if($dt->mode) {
                $data[$key]['modeName'] = $dt->mode->Name; 
                $data[$key]['ModeId'] = $dt->mode->ModeId; 
            } 
            $data[$key]['scenarioName'] = 'Not Found ';
            if($dt->scenario) {
                $data[$key]['scenarioName'] = $dt->scenario->Name; 
            } 
            $data[$key]['SubjectName'] = 'Not Found';
            if($dt->scenario->subject) {
                $data[$key]['SubjectName'] = $dt->scenario->subject->Name; 
            } 
            $data[$key]['FieldName'] = 'Not Found ';
            if($dt->scenario->subject->fields) {
                $data[$key]['FieldName'] = $dt->scenario->subject->fields->Name; 
            } 
            $data[$key]['languagepairName'] = 'Not Found ';
            if($dt->languagepair) {
                $data[$key]['languagepairName'] = $dt->languagepair->Name;
                $data[$key]['LanguagePairId'] = $dt->languagepair->LanguagePairId;
            } 
            if($dt->ceu) {
                $data[$key]['CCHI'] = $dt->ceu->CCHI;
                $data[$key]['ATA'] = $dt->ceu->ATA;
                $data[$key]['NBCMI'] = $dt->ceu->NBCMI;
            } else {
                $data[$key]['CCHI'] = 'Not Found ';
                $data[$key]['ATA'] = 'Not Found ';
                $data[$key]['NBCMI'] = 'Not Found ';
            } 
            if($dt->IsActive) {
                if($data[$key]['IsActive'] == 1) {
                    $data[$key]['Status'] = 'Active';
                } else if($data[$key]['IsActive'] == 0) {
                    $data[$key]['Status'] = 'Inactive';
                }
            }
            $data[$key]['Time'] = 0;
            if($dt->ApproxTime) {
                $data[$key]['Time'] =secToHR($dt->ApproxTime);
            } 
            // unset($data[$key]['mode']); 
            // unset($data[$key]['languagepair']); 
            // unset($data[$key]['scenario']); 
        }
        // echo '<pre>'; print_r($data->toArray()); die;
        
        return $data;
    }

    public function getExercise($id)
    {
        $data =[];
        $data = ExercisesMaster::with('ceu')->with(['scenario' => function ($scenario) {
            $scenario->with(['subject' => function ($subject) {
                $subject->with('fields');
            }]);
        }])->with('mode')->with('languagepair')->with('exercises')->GetSelectAdmin()->where('ExercisesMasterId',$id)->IsDelete()->get();
        // $data = TrainingModes::with('notes')->with('mode')->GetSelectAdmin()->where('TrainingModeId', $id)->IsDelete()->get();
        foreach($data as $key =>$dt) {
            
            $data[$key]['Date'] = date("Y-m-d", strtotime($dt['CreatedDate']));
            $data[$key]['modeName'] = 'Not Found ';
            if($dt->mode) {
                $data[$key]['modeName'] = $dt->mode->Name; 
            } 
            $data[$key]['scenarioName'] = 'Not Found ';
            if($dt->scenario) {
                $data[$key]['scenarioName'] = $dt->scenario->Name; 
            } 
            $data[$key]['SubjectName'] = 'Not Found ';
            if($dt->scenario->subject) {
                $data[$key]['SubjectName'] = $dt->scenario->subject->Name; 
            } 
            $data[$key]['FieldName'] = 'Not Found ';
            if($dt->scenario->subject->fields) {
                $data[$key]['FieldName'] = $dt->scenario->subject->fields->Name; 
            } 
            $data[$key]['languagepairName'] = 'Not Found ';
            if($dt->languagepair) {
                $data[$key]['languagepairName'] = $dt->languagepair->Name;
            } 
            $data[$key]['Status'] = '';
            if($dt->IsActive == 1) {
                $data[$key]['Status'] = 'Active';
            } else if($dt->IsActive == 0) {
                $data[$key]['Status'] = 'Inactive';
            }
          
            $data[$key]['Time'] = 0;
            if($dt->ApproxTime) {
                $data[$key]['Time'] =secToHR($dt->ApproxTime);
            } 
            if($dt->ceu) {
                $data[$key]['CCHI'] = $dt->ceu->CCHI;
                $data[$key]['ATA'] = $dt->ceu->ATA;
                $data[$key]['NBCMI'] = $dt->ceu->NBCMI;
            } else {
                $data[$key]['CCHI'] = 'Not Found ';
                $data[$key]['ATA'] = 'Not Found ';
                $data[$key]['NBCMI'] = 'Not Found ';
            } 
            // unset($data[$key]['mode']); 
            // unset($data[$key]['languagepair']); 
            // unset($data[$key]['scenario']); 
        }   
        // echo '<pre>'; print_r($data[0]->toarray()); die;
        return $data[0];
    }
}