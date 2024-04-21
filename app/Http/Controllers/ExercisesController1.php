<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ExercisesDataTable;
use Yajra\Datatables\Facades\Datatables;
use Flash;
use Auth;
use App\ExercisesMaster;
use App\Exercises;
use App\Scenarios;
use App\Modes;
use App\LanguagePairs;
use App\MP3File;
use getID3;
use App\Subjects;
use App\Fields;
use Illuminate\Support\Str;


class ExercisesController1 extends Controller
{
    public function __construct(ExercisesDataTable $dataTable)
    {
        // date_default_timezone_set('Asia/Kolkata');
        header("Access-Control-Allow-Origin: *");
        $this->dataTable = $dataTable;
        $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    public function index(Request $request) { 
        if ($request->ajax()) {
            // return Datatables::of($this->dataTable->all($request))->make(true);
            return Datatables::of($this->dataTable->all($request))->filter(function ($instance) use ($request) {
                if ($request->has('LanguagePairId')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['LanguagePairId'], $request->get('LanguagePairId')) ? true : false;
                    });
                }
                if ($request->has('FieldId')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['FieldName'], $request->get('FieldId')) ? true : false;
                    });
                }
                if ($request->has('ModeId')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['ModeId'], $request->get('ModeId')) ? true : false;
                    });
                }
                if ($request->has('SubjectId')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['SubjectName'], $request->get('SubjectId')) ? true : false;
                    });
                }
                if ($request->has('ScenarioId')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['scenarioName'], $request->get('ScenarioId')) ? true : false;
                    });
                }
                if ($request->has('Status')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['IsActive'], $request->get('Status')) ? true : false;
                    });
                }
            },true)
            ->make(true);
        }
        $languages =$this->getAllLanguagePairs(); 
        $fields = $this->getAllFieldss();
        $modes = $this->getAllModes();
        $subjects = $this->getAllSubject();
        $scenarios =$this->getAllScenarios();
        return view('exercises.index', compact('languages' ,'fields' ,'modes','subjects','scenarios'));
    }
    public function create()
    {
        $languagepairs = $this->getAllLanguagePairs(); 
        $fields = $this->getAllFieldss();
        $modes = $this->getAllModes();
        $subjects = $this->getAllSubject();
        $scenarios =$this->getAllScenarios();
        return view('exercises.create' , compact('subjects','scenarios','languagepairs', 'modes','fields'));
    }

    public function store(Request $request)
    {
        // d($request->all());  die;
        $exExists = ExercisesMaster::where('ScenarioId' , $request->get('ScenarioId'))->where('LanguagePairId' , $request->get('LanguagePairId'))->where('ModeId' , $request->get('ModeId'))->IsDelete()->get();
        if (count($exExists) > 0) {
            Flash::error('Exercise with same language pair, scenario and mode already exists.');
            return redirect()->route('exercises.create')->withInput();
        }         
        if($request->ModeId == 3) {    
            if ( strlen($request->ExtraDescription) <= 0) {
                Flash::error('Scenario Detail Description is empty please add once again.');
                return redirect()->route('exercises.create')->withInput();
            } 
        }
        $input = [];
        $input = $request->all();       
        $input['IsActive'] = isset($input['IsActive']) ? 1 : 0;
        if($request->WrittenPrice) {
            $input['WrittenPrice'] = '$'.$input['WrittenPrice'];
        } 
        if($request->VerbalPrice) {
            $input['VerbalPrice'] = '$'.$input['VerbalPrice'];
        }
        if($request->ApproxTime) {
            $input['ApproxTime'] =  $input['ApproxTime'] * 60;
            
        } else {
            $input['ApproxTime'] = '200';
        }
        $ExercisesMaster = ExercisesMaster::create($input);
        $ExercisesMasterId = $ExercisesMaster->ExercisesMasterId;
        // $ExercisesMasterId = 1;
        if($request->ModeId == 1) {
            $ex_data = [];
            $ex_data['ScenarioDescription'] = $request->ScenarioDescription;
            $ex_data['ExercisesMasterId'] = $ExercisesMasterId;
            $ex_data['Title'] = $request->STitle;
            $ex_data['SlidePosition'] = '1';
            // $ex_data['IsPublish'] = $request->IsPublish;
            // print_r($ex_data);
            Exercises::create($ex_data);
            if($request->File) {
                $count = 2; 
                $total_duration = 0;
                foreach($request->File as $key => $file) {
                    if ($request->hasFile('File')) {
                        if($file->getfileName()) {
                            if($file->getSize() > 0) {
                                $getID3 = new getID3;
                                $ThisFileInfo = $getID3->analyze($file);
                                $Duration = round($ThisFileInfo['playtime_seconds']); 
                                $fileurl = uplaod_audio_s3($file , 'exercises');
                                /* $file_name = str_replace(' ', '_', $file->getClientOriginalName());
                                    $filename = 'file_' . time() . '_' .$file_name;
                                    $file->move(public_path('uploads/ex'), $filename); 
                                */
                                // $mp3file = new MP3File($file); //allow for only mp3 file
                                // $Duration = $mp3file->getDurationEstimate();
                                $mode_data= []; 
                                $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
                                $mode_data['Title'] = $request->Title[$key];
                                // $mode_data['File'] =  env('UPLOAD_URL') .  'ex/'. $filename;
                                $mode_data['File'] =  $fileurl;
                                $mode_data['FileType'] = 'Audio';
                                $mode_data['Duration'] = $Duration;
                                $total_duration = $total_duration + $Duration + 10;
                                $mode_data['SlidePosition'] = $count++;
                                Exercises::create($mode_data);
                                if($request->ApproxTime) {
                                    $input['ApproxTime'] = $input['ApproxTime'] * 60;
                                } else {
                                    ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                                }
                                // echo '<pre>'; print_r($mode_data);
                            } else {
                                ExercisesMaster::destroy($ExercisesMasterId);
                                Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                                Flash::error('Filesize is not valid.');
                                return redirect()->back()->withInput();    
                            }
                        } else {
                            Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                            ExercisesMaster::destroy($ExercisesMasterId);
                            Flash::error('File not Uploaded. Something Went Wrong');
                            return redirect()->back()->withInput();
                        }
                    }
                }
            }
        } else if($request->ModeId == 2) {
            if($request->hasFile('File')) {
                $file = $request->File;
                if($file->getfileName()) {
                    if($file->getSize() > 0) {
                        $getID3 = new getID3;
                        $ThisFileInfo = $getID3->analyze($file);
                        $Duration = round($ThisFileInfo['playtime_seconds']); 
                        $fileurl = uplaod_audio_s3($file , 'exercises');
                        // $filename = 'file_' . time() . '_' .$file->getClientOriginalName();
                        /*$file_name = str_replace(' ', '_', $file->getClientOriginalName());
                        $filename = 'file_' . time() . '_' .$file_name;
                        $file->move(public_path('uploads/ex'), $filename); */
                        $mode_data= []; 
                        $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
                        $mode_data['Title'] = $request->STitle;
                        $mode_data['ScenarioDescription'] = $request->SScenarioDescription;
                        // $mode_data['File'] =  env('UPLOAD_URL') .  'ex/'. $filename;
                        $mode_data['File'] =  $fileurl;
                        $mode_data['FileType'] = 'Audio';
                        $mode_data['Duration'] = $Duration;

                        Exercises::create($mode_data);
                        $total_duration = $Duration + 20;
                        if($request->ApproxTime) {
                            $input['ApproxTime'] = $input['ApproxTime'] * 60;
                        } else {
                            ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                        }
                    } else {
                        ExercisesMaster::destroy($ExercisesMasterId);
                        Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                        Flash::error('Filesize is not valid.');
                        return redirect()->back()->withInput();
                    }
                } else {
                    ExercisesMaster::destroy($ExercisesMasterId);
                    Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                    Flash::error('File not Uploaded.');
                    return redirect()->back()->withInput();
                }
            } 
        } else if($request->ModeId == 3) {
            
            if ( strlen($request->ExtraDescription) <= 0) {
                Flash::error('Scenario Detail Description is empty please add once again.');
                return redirect()->route('exercises.create')->withInput();
            } 
            $mode_data= []; 
            $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
            $mode_data['Title'] = $request->Title;
            $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
            $mode_data['ExtraDescription'] = $request->ExtraDescription;
            Exercises::create($mode_data);
        }
        Flash::success('Exercise added successfully.');
        return redirect(route('exercises.index'));
    }

    public function show($id) 
    {
        $tr_modes = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
        if (empty($tr_modes)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        // Check this function in ExercisesDataTable .
        $exercises = $this->dataTable->getExercise($id); 
        return view('exercises.show')->with('exercises', $exercises);
    }

    public function edit($id)
    {
        $exercises = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
        if (empty($exercises)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        $exercise = $this->dataTable->getExercise($id); 
        return view('exercises.edit')->with('exercise', $exercise);
    }
    
    /*
    public function update($id, Request $request)
    {
        echo '<pre>';  print_r($request->all());
        $ExercisesMasterId = $id;
        $tr_modes = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
        if (empty($tr_modes)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        if($request->ModeId == 3) {
            if ( strlen($request->ExtraDescription) <= 0) {
                Flash::error('Scenario Detail Description is empty please add once again.');
                return redirect()->back()->withInput();
            } 
        }

        $input = [];
        $input['IsActive'] = isset($request->IsActive) ? 1 : 0;      
        if($request->WrittenPrice) {
            $input['WrittenPrice'] = '$'.$request->WrittenPrice;
        } 
        if($request->VerbalPrice) {
            $input['VerbalPrice'] = '$'.$request->VerbalPrice;
        }
        $ExercisesMaster = ExercisesMaster::where('ExercisesMasterId',$ExercisesMasterId)->update($input);
        
        if($request->ModeId == 1) {
            $ex_data = [];
            $ex_data['ScenarioDescription'] = $request->ScenarioDescription;
            $ex_data['Title'] = $request->STitle;
            $ex_data['SlidePosition'] = '1';
            // print_r($ex_data);
            Exercises::where('ExerciseId',$request->ExerciseId)->update($ex_data);
            // Exercises::create($ex_data);
            $request->ExerciseIds;
            $ExerciseIds =$request->ExerciseIds;
            $existing_exercises = Exercises::where('ExercisesMasterId',$ExercisesMasterId)->where('SlidePosition' ,'!=', 1)->select('ExerciseId')->IsActive()->IsDelete()->get(); 
            print_r($existing_exercises->toArray());

            $delete_exe = Exercises::whereIn('ExerciseId', $ExerciseIds)->update(['IsDelete'=>1]);   //delete notes 
            $existing_exercise_ids= [];
            foreach ($existing_exercises as $exercise) {
                if (in_array($exercise->ExerciseId, $ExerciseIds)) {
                    $existing_exercise_ids[] = $exercise->ExerciseId;
                    // Exercise::destroy($exercise->ExerciseId);
                    // $mode_data = [];
                    //Exercises::create($mode_data);
                } else {
                 
                }
            }
            if(in_array("0", $ExerciseIds)) {
                echo 'yes';
            } else {
                echo 'no';
                
            }
            // if($request->File) {
            //     $count = 2; 
            //     $total_duration = 0;
            //     foreach($request->File as $key => $file) {
            //         if ($request->hasFile('File')) {
            //             if($file->getfileName()) {
            //                 if($file->getSize() > 0) {
            //                     $getID3 = new getID3;
            //                     $ThisFileInfo = $getID3->analyze($file);
            //                     $Duration = round($ThisFileInfo['playtime_seconds']);

            //                         $filename = 'file_' . time() . '_' .$file->getClientOriginalName();
            //                         $file->move(public_path('uploas/ex'), $filename);

            //                     // $mp3file = new MP3File($file); //allow for only mp3 file
            //                     // $Duration = $mp3file->getDurationEstimate();
            //                     $mode_data= []; 
            //                     $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
            //                     $mode_data['Title'] = $request->Title[$key];
            //                     $mode_data['File'] =  env('UPLOAD_URL') .  'ex/'. $filename;;
            //                     $mode_data['FileType'] = 'Audio';
            //                     $mode_data['Duration'] = $Duration;
            //                     $total_duration = $total_duration + $Duration + 10;
            //                     $mode_data['SlidePosition'] = $count++;
            //                     Exercises::create($mode_data);
            //                     ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
            //                     // echo '<pre>'; print_r($mode_data);
            //                 } else {
            //                     ExercisesMaster::destroy($ExercisesMasterId);
            //                     Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
            //                     Flash::error('Filesize is not valid.');
            //                     return redirect()->back()->withInput();  
            //                 }
            //             } else {
            //                 Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
            //                 ExercisesMaster::destroy($ExercisesMasterId);
            //                 Flash::error('File not Uploaded. Something Went Wrong');
            //                 return redirect()->back()->withInput();
            //             }
            //         }
            //     }
            // } 
        } else if($request->ModeId == 2) {

            $mode_data= []; 
            $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
            $mode_data['Title'] = $request->STitle;
            $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
            
            if($request->hasFile('File')) {
                $file = $request->File;
                if($file->getfileName()) {
                    if($file->getSize() > 0) {
                        $getID3 = new getID3;
                        $ThisFileInfo = $getID3->analyze($file);
                        //$mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');;
                        $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
                        $mode_data['Duration'] = round($ThisFileInfo['playtime_seconds']); 
                        $total_duration = $Duration + 20;
                        delete_exercise_audio($request->origonal_audio , 'uploads/ex/');
                        ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                    } else {
                        ExercisesMaster::destroy($ExercisesMasterId);
                        Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                        Flash::error('Filesize is not valid.');
                        return redirect()->back()->withInput();
                    }
                } else {
                    ExercisesMaster::destroy($ExercisesMasterId);
                    Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                    Flash::error('File not Uploaded.');
                    return redirect()->back()->withInput();
                }
            } 
            Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
            
        } else if($request->ModeId == 3) {
            $mode_data= []; 
            $mode_data['Title'] = $request->Title;
            $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
            $mode_data['ExtraDescription'] = $request->ExtraDescription;
            Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
        }

        die;
        // unset($input['_token']);
        // unset($input['_method']);
        // $ExerciseIds =$input['ExerciseIds'];
        // unset($input['ExerciseId']);
        // unset($input['STitle']);
        // unset($input['ScenarioDescription']);
        // unset($input['ExerciseIds']);
        // $Title =$input['Title'];
        // unset($input['Title']);
        // $File =$input['File'];
        // unset($input['File']);
        // $Origonal_audio =$input['origonal_audio'];
        // unset($input['origonal_audio']);
        // $trainingMode = ExercisesMaster::where('ExercisesMasterId',$id)->update($input);
        //Check Existing Notes and delete extra notes
        // $existing_notes = NoteModes::where('ExercisesMasterId', $id)->select('NoteModeId')->IsActive()->IsDelete()->get();
        // foreach ($existing_notes as $notes) {
        //     if (in_array($notes->NoteModeId, $NoteModeId)) {
        //         $existing_NoteModeIds[] = $notes->NoteModeId;
        //     } else {
        //         $delete_notes = NoteModes::where('NoteModeId', $notes->NoteModeId)->update(['IsDelete'=>1]);   //delete notes 
        //     }
        // }
               
        // $existing_NoteModeIds =  implode(',',$existing_NoteModeIds); 
        // foreach($NoteModeId as $key=> $note) {
        //     if($Title[$key]) {
        //         $title= $Title[$key];
        //     } else {
        //         $title = '';
        //     }

        //     if($Description[$key]) {
        //         $desc=  $Description[$key];
        //         if($note > 0) {
        //             $update_notes = NoteModes::where('NoteModeId', $note)->update(['Title'=>$title ,'Description'=>$desc]); //Update Notes
        //             // if ( strpos($existing_NoteModeIds,$note) >= -1 ){}  //check 
        //             // if (strpos($a, 'are') !== false) { echo 'true';}
        //         } else {
        //             $insert_notes = NoteModes::create(['Title'=>$title ,'Description'=>$desc,'ExercisesMasterId'=>$id]); //Insert Notes
        //         }
        //     } 
        // }
        Flash::success('Exercise updated successfully.');
        return redirect(route('exercises.index'));
    } */
    public function update($id, Request $request)
    {
        // echo '<Dasdsd>'; die;
        // echo '<pre>';  print_r($request->all());
        $ExercisesMasterId = $id;
        $tr_modes = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
        if (empty($tr_modes)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        if($request->ModeId == 3) {
            if ( strlen($request->ExtraDescription) <= 0) {
                Flash::error('Scenario Detail Description is empty please add once again.');
                return redirect()->back()->withInput();
            } 
        }

        $input = [];
        $input['IsActive'] = isset($request->IsActive) ? 1 : 0;      
        if($request->WrittenPrice) {
            $input['WrittenPrice'] = '$'.$request->WrittenPrice;
        } 
        if($request->VerbalPrice) {
            $input['VerbalPrice'] = '$'.$request->VerbalPrice;
        }
        $ExercisesMaster = ExercisesMaster::where('ExercisesMasterId',$ExercisesMasterId)->update($input);

        if($request->ModeId == 1) {

            $ex_data = [];
            $ex_data['ScenarioDescription'] = $request->ScenarioDescription;
            $ex_data['Title'] = $request->STitle;
            $ex_data['SlidePosition'] = '1';
            // print_r($ex_data);
            Exercises::where('ExerciseId',$request->ExerciseId)->update($ex_data);
            // Exercises::create($mode_data);
            
            $ExerciseIds =$request->ExerciseIds;
            $Title= $request->Title;
            $origonal_audio= $request->origonal_audio;
            if($request->File) {
                $File= $request->File;
            } else {
                $File  = [];
            }
            //Delete Unused Exercises
            $existing_exercises = Exercises::where('ExercisesMasterId', $ExercisesMasterId)->select('ExerciseId')->IsActive()->IsDelete()->get();
            foreach ($existing_exercises as $exercise) {
                if (!in_array($exercise->ExerciseId, $ExerciseIds)) {
                    echo '<Br> delete : ' . $exercise->ExerciseId;
                    // Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                    $exe_data = Exercises::select('File')->where('ExerciseId', $exercise->ExerciseId)->where('SlidePosition', '!=' , 1)->first();
                    $file_url =  $exe_data['File'];
                    $delete_exercise = Exercises::where('ExerciseId', $exercise->ExerciseId)->where('SlidePosition', '!=' , 1)->delete();   //delete exercise
                    if($delete_exercise) {
                        // print_r($file_url);
                        delete_exercise_audio($file_url ,'uploads/ex/');
                    }
                } 
            }
            // $delete_exe = Exercises::whereIn('ExerciseId', $ExerciseIds)->update(['IsDelete'=>1]);   //delete exercises 
            
            $i = 0;
            $count = 2; 
            $total_duration = 0;
            foreach($ExerciseIds as $key => $ExerciseId) {
                echo '<br> -============================================ $i ' . $count;
                if($ExerciseId > 0) {
                    echo '<br> in if ';
                    if (array_key_exists($key , $File) == array_key_exists($key, $origonal_audio)) {
                        echo '<br>not same delete older one and set new file ' . $key . '   <BR>' .$request->origonal_audio[$key] .'<br>';
                        // print_r($request->File[$key]);   
                        $file = $request->File[$key];
                        if($file->getfileName() && ( $file->getSize() > 0)) {
                            $getID3 = new getID3;
                            $ThisFileInfo = $getID3->analyze($file);
                            $Duration = round($ThisFileInfo['playtime_seconds']); 
                            $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
                            $mode_data['Title'] = $request->Title[$key];
                            // $mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');
                            $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
                            $mode_data['FileType'] = 'Audio';
                            $mode_data['Duration'] = $Duration;
                            $total_duration = $Duration + 20;
                            $mode_data['SlidePosition'] = $count++;
                            // print_r($mode_data);
                            Exercises::create($mode_data);
                            delete_exercise_audio($request->origonal_audio[$key] ,'uploads/ex/');
                            ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                        } else {
                            ExercisesMaster::destroy($ExercisesMasterId);
                            Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                            Flash::error('File not Uploaded.');
                            return redirect()->back()->withInput();
                        }
                    } else {
                        if(array_key_exists($key, $origonal_audio)) {
                            // echo '<br>same file url+' . $key.' -'. $request->origonal_audio[$key];
                            $exercise = Exercises::find($ExerciseId);
                            $newExercise = $exercise->replicate();
                            $newExercise->save();
                            $new_exercise_id =$newExercise->ExerciseId;
                            $mode_data['Title'] =  $Title[$key]; 
                            $mode_data['SlidePosition'] = $count++; 
                            Exercises::where('ExerciseId',$new_exercise_id)->update($mode_data);                           
                        }
                    }
                } else {
                    echo '<br>else ';
                    if(array_key_exists($key , $request->File)) {
                        // print_r($request->File[$key]);    
                        $file = $request->File[$key];
                        if($file->getfileName() && ( $file->getSize() > 0)) {
                            $getID3 = new getID3;
                            $ThisFileInfo = $getID3->analyze($file);
                            $Duration = round($ThisFileInfo['playtime_seconds']); 
                            $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
                            $mode_data['Title'] = $request->Title[$key];
                            // $mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');
                            $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
                            $mode_data['FileType'] = 'Audio';
                            $mode_data['Duration'] = $Duration;
                            $total_duration = $Duration + 20;
                            $mode_data['SlidePosition'] = $count++;
                            // print_r($mode_data);
                            Exercises::create($mode_data);
                            ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                        } else {
                            ExercisesMaster::destroy($ExercisesMasterId);
                            Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                            Flash::error('File not Uploaded.');
                            return redirect()->back()->withInput();
                        }                 
                    }
                }
                Exercises::destroy($ExerciseId);
            }

        } else if($request->ModeId == 2) {

            $mode_data= []; 
            $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
            $mode_data['Title'] = $request->STitle;
            $mode_data['ScenarioDescription'] = $request->SScenarioDescription;
            
            if($request->hasFile('File')) {
                $file = $request->File;
                if($file->getfileName()) {
                    if($file->getSize() > 0) {
                        $getID3 = new getID3;
                        $ThisFileInfo = $getID3->analyze($file);
                        $Duration =  round($ThisFileInfo['playtime_seconds']);
                        // $mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');;
                        $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');

                        $mode_data['Duration'] = $Duration; 
                        $total_duration = $Duration + 20;
                        delete_exercise_audio($request->origonal_audio , 'uploads/ex/');
                        ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
                    } else {
                        ExercisesMaster::destroy($ExercisesMasterId);
                        Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                        Flash::error('Filesize is not valid.');
                        return redirect()->back()->withInput();
                    }
                } else {
                    ExercisesMaster::destroy($ExercisesMasterId);
                    Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
                    Flash::error('File not Uploaded.');
                    return redirect()->back()->withInput();
                }
            } 
            Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
            
        } else if($request->ModeId == 3) {
            echo 'sd'; 
            $mode_data= []; 
            $mode_data['Title'] = $request->Title;
            $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
            $mode_data['ExtraDescription'] = $request->ExtraDescription;
            Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
        }
        // die;
        Flash::success('Exercise updated successfully.');
        return redirect(route('exercises.index'));
    }
    public function destroy($id)
    {
        $ExercisesMaster = ExercisesMaster::find($id);
        if (empty($ExercisesMaster)) {
            Flash::error('Exercise not found');
            return redirect(route('exercises.index'));
        }
        // ExercisesMaster::destroy($id);
        ExercisesMaster::where('ExercisesMasterId', $id)->update(['IsDelete' => 1]);
        return $this->responseSuccess('Deleted Successfully.');
    }
}
// class ExercisesController extends Controller
// {
//     public function __construct(ExercisesDataTable $dataTable)
//     {
//         // date_default_timezone_set('Asia/Kolkata');
//         header("Access-Control-Allow-Origin: *");
//         $this->dataTable = $dataTable;
//         $this->middleware('preventBackHistory');
//         $this->middleware('auth');
//     }
//     public function index(Request $request) { 
//         if ($request->ajax()) {
//             return Datatables::of($this->dataTable->all($request))->make(true);
//         }
//         return view('exercises.index');
//     }
//     public function create()
//     {
//         $subjects = Subjects::IsDelete()->IsActive()->get();
//         $scenarios = Scenarios::IsDelete()->IsActive()->get();
//         $modes = Modes::IsDelete()->IsActive()->get(); 
//         $languagepairs = LanguagePairs::IsDelete()->IsActive()->get(); 
//         return view('exercises.create' , compact('subjects','scenarios','languagepairs', 'modes'));
//     }

//     public function store(Request $request)
//     {
//         $exExists = ExercisesMaster::where('ScenarioId' , $request->get('ScenarioId'))->where('LanguagePairId' , $request->get('LanguagePairId'))->where('ModeId' , $request->get('ModeId'))->IsDelete()->get();
//         if (count($exExists) > 0) {
//             Flash::error('Exercise with same language pair, scenario and mode already exists.');
//             return redirect()->route('exercises.create')->withInput();
//         }         
//         if($request->ModeId == 3) {    
//             if ( strlen($request->ExtraDescription) <= 0) {
//                 Flash::error('Scenario Detail Description is empty please add once again.');
//                 return redirect()->route('exercises.create')->withInput();
//             } 
//         }
//         // echo '<pre>'; print_r($request->all());  
//         $input = [];
//         $input = $request->all();       
//         $input['IsActive'] = isset($input['IsActive']) ? 1 : 0;
//         if($request->WrittenPrice) {
//             $input['WrittenPrice'] = '$'.$input['WrittenPrice'];
//         } 
//         if($request->VerbalPrice) {
//             $input['VerbalPrice'] = '$'.$input['VerbalPrice'];
//         }
//         $input['ApproxTime'] = '200';
//         $ExercisesMaster = ExercisesMaster::create($input);
//         $ExercisesMasterId = $ExercisesMaster->ExercisesMasterId;
//         // $ExercisesMasterId = 1;
//         if($request->ModeId == 1) {
//             $ex_data = [];
//             $ex_data['ScenarioDescription'] = $request->ScenarioDescription;
//             $ex_data['ExercisesMasterId'] = $ExercisesMasterId;
//             $ex_data['Title'] = $request->STitle;
//             $ex_data['SlidePosition'] = '1';
//             // print_r($ex_data);
//             Exercises::create($ex_data);
//             if($request->File) {
//                 $count = 2; 
//                 $total_duration = 0;
//                 foreach($request->File as $key => $file) {
//                     if ($request->hasFile('File')) {
//                         if($file->getfileName()) {
//                             if($file->getSize() > 0) {
//                                 $getID3 = new getID3;
//                                 $ThisFileInfo = $getID3->analyze($file);
//                                 $Duration = round($ThisFileInfo['playtime_seconds']); 
//                                 $filename = 'file_' . time() . '_' .$file->getClientOriginalName();
//                                 $file->move(public_path('uploads/ex'), $filename);
//                                 // $mp3file = new MP3File($file); //allow for only mp3 file
//                                 // $Duration = $mp3file->getDurationEstimate();
//                                 $mode_data= []; 
//                                 $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//                                 $mode_data['Title'] = $request->Title[$key];
//                                 $mode_data['File'] =  env('UPLOAD_URL') .  'ex/'. $filename;;
//                                 $mode_data['FileType'] = 'Audio';
//                                 $mode_data['Duration'] = $Duration;
//                                 $total_duration = $total_duration + $Duration + 10;
//                                 $mode_data['SlidePosition'] = $count++;
//                                 Exercises::create($mode_data);
//                                 ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
//                                 // echo '<pre>'; print_r($mode_data);
//                             } else {
//                                 ExercisesMaster::destroy($ExercisesMasterId);
//                                 Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                                 Flash::error('Filesize is not valid.');
//                                 return redirect()->back()->withInput();    
//                             }
//                         } else {
//                             Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                             ExercisesMaster::destroy($ExercisesMasterId);
//                             Flash::error('File not Uploaded. Something Went Wrong');
//                             return redirect()->back()->withInput();
//                         }
//                     }
//                 }
//             }
//         } else if($request->ModeId == 2) {
//             if($request->hasFile('File')) {
//                 $file = $request->File;
//                 if($file->getfileName()) {
//                     if($file->getSize() > 0) {
//                         $getID3 = new getID3;
//                         $ThisFileInfo = $getID3->analyze($file);
//                         $Duration = round($ThisFileInfo['playtime_seconds']); 
//                         $filename = 'file_' . time() . '_' .$file->getClientOriginalName();
//                         $file->move(public_path('uploads/ex'), $filename);
//                         $mode_data= []; 
//                         $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//                         $mode_data['Title'] = $request->STitle;
//                         $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
//                         $mode_data['File'] =  env('UPLOAD_URL') .  'ex/'. $filename;;
//                         $mode_data['FileType'] = 'Audio';
//                         $mode_data['Duration'] = $Duration;

//                         Exercises::create($mode_data);
//                         $total_duration = $Duration + 20;
//                         ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
//                     } else {
//                         ExercisesMaster::destroy($ExercisesMasterId);
//                         Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                         Flash::error('Filesize is not valid.');
//                         return redirect()->back()->withInput();
//                     }
//                 } else {
//                     ExercisesMaster::destroy($ExercisesMasterId);
//                     Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                     Flash::error('File not Uploaded.');
//                     return redirect()->back()->withInput();
//                 }
//             } 
//         } else if($request->ModeId == 3) {
            
//             if ( strlen($request->ExtraDescription) <= 0) {
//                 Flash::error('Scenario Detail Description is empty please add once again.');
//                 return redirect()->route('exercises.create')->withInput();
//             } 
//             $mode_data= []; 
//             $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//             $mode_data['Title'] = $request->Title;
//             $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
//             $mode_data['ExtraDescription'] = $request->ExtraDescription;
//             Exercises::create($mode_data);
//         }
//         Flash::success('Exercise added successfully.');
//         return redirect(route('exercises.index'));
//     }

//     public function show($id) 
//     {
//         $tr_modes = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
//         if (empty($tr_modes)) {
//             Flash::error('Exercise not found');
//             return redirect(route('exercises.index'));
//         }
//         // Check this function in ExercisesDataTable .
//         $exercises = $this->dataTable->getExercise($id); 
//         return view('exercises.show')->with('exercises', $exercises);
//     }

//     public function edit($id)
//     {
//         $exercises = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
//         if (empty($exercises)) {
//             Flash::error('Exercise not found');
//             return redirect(route('exercises.index'));
//         }
//         $exercise = $this->dataTable->getExercise($id); 
//         return view('exercises.edit')->with('exercise', $exercise);
//     }

//     public function update($id, Request $request)
//     {
//         // echo '<Dasdsd>'; die;
//         // echo '<pre>';  print_r($request->all());
//         $ExercisesMasterId = $id;
//         $tr_modes = ExercisesMaster::where('ExercisesMasterId',$id)->IsDelete()->first();
//         if (empty($tr_modes)) {
//             Flash::error('Exercise not found');
//             return redirect(route('exercises.index'));
//         }
//         if($request->ModeId == 3) {
//             if ( strlen($request->ExtraDescription) <= 0) {
//                 Flash::error('Scenario Detail Description is empty please add once again.');
//                 return redirect()->back()->withInput();
//             } 
//         }

//         $input = [];
//         $input['IsActive'] = isset($request->IsActive) ? 1 : 0;      
//         if($request->WrittenPrice) {
//             $input['WrittenPrice'] = '$'.$request->WrittenPrice;
//         } 
//         if($request->VerbalPrice) {
//             $input['VerbalPrice'] = '$'.$request->VerbalPrice;
//         }
//         $ExercisesMaster = ExercisesMaster::where('ExercisesMasterId',$ExercisesMasterId)->update($input);

//         if($request->ModeId == 1) {

//             $ex_data = [];
//             $ex_data['ScenarioDescription'] = $request->ScenarioDescription;
//             $ex_data['Title'] = $request->STitle;
//             $ex_data['SlidePosition'] = '1';
//             // print_r($ex_data);
//             Exercises::where('ExerciseId',$request->ExerciseId)->update($ex_data);
//             // Exercises::create($mode_data);
            
//             $ExerciseIds =$request->ExerciseIds;
//             $Title= $request->Title;
//             $origonal_audio= $request->origonal_audio;
//             if($request->File) {
//                 $File= $request->File;
//             } else {
//                 $File  = [];
//             }
//             //Delete Unused Exercises
//             $existing_exercises = Exercises::where('ExercisesMasterId', $ExercisesMasterId)->select('ExerciseId')->IsActive()->IsDelete()->get();
//             foreach ($existing_exercises as $exercise) {
//                 if (!in_array($exercise->ExerciseId, $ExerciseIds)) {
//                     echo '<Br> delete : ' . $exercise->ExerciseId;
//                     // Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                     $exe_data = Exercises::select('File')->where('ExerciseId', $exercise->ExerciseId)->where('SlidePosition', '!=' , 1)->first();
//                     $file_url =  $exe_data['File'];
//                     $delete_exercise = Exercises::where('ExerciseId', $exercise->ExerciseId)->where('SlidePosition', '!=' , 1)->delete();   //delete exercise
//                     if($delete_exercise) {
//                         // print_r($file_url);
//                         delete_exercise_audio($file_url ,'uploads/ex/');
//                     }
//                 } 
//             }
//             // $delete_exe = Exercises::whereIn('ExerciseId', $ExerciseIds)->update(['IsDelete'=>1]);   //delete exercises 
            
//             $i = 0;
//             $count = 2; 
//             $total_duration = 0;
//             foreach($ExerciseIds as $key => $ExerciseId) {
//                 echo '<br> -============================================ $i ' . $count;
//                 if($ExerciseId > 0) {
//                     echo '<br> in if ';
//                     if (array_key_exists($key , $File) == array_key_exists($key, $origonal_audio)) {
//                         echo '<br>not same delete older one and set new file ' . $key . '   <BR>' .$request->origonal_audio[$key] .'<br>';
//                         // print_r($request->File[$key]);   
//                         $file = $request->File[$key];
//                         if($file->getfileName() && ( $file->getSize() > 0)) {
//                             $getID3 = new getID3;
//                             $ThisFileInfo = $getID3->analyze($file);
//                             $Duration = round($ThisFileInfo['playtime_seconds']); 
//                             $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//                             $mode_data['Title'] = $request->Title[$key];
//                             //$mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');
//                             $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
//                             $mode_data['FileType'] = 'Audio';
//                             $mode_data['Duration'] = $Duration;
//                             $total_duration = $Duration + 20;
//                             $mode_data['SlidePosition'] = $count++;
//                             // print_r($mode_data);
//                             Exercises::create($mode_data);
//                             delete_exercise_audio($request->origonal_audio[$key] ,'uploads/ex/');
//                             ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
//                         } else {
//                             ExercisesMaster::destroy($ExercisesMasterId);
//                             Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                             Flash::error('File not Uploaded.');
//                             return redirect()->back()->withInput();
//                         }
//                     } else {
//                         if(array_key_exists($key, $origonal_audio)) {
//                             // echo '<br>same file url+' . $key.' -'. $request->origonal_audio[$key];
//                             $exercise = Exercises::find($ExerciseId);
//                             $newExercise = $exercise->replicate();
//                             $newExercise->save();
//                             $new_exercise_id =$newExercise->ExerciseId;
//                             $mode_data['Title'] =  $Title[$key]; 
//                             $mode_data['SlidePosition'] = $count++; 
//                             Exercises::where('ExerciseId',$new_exercise_id)->update($mode_data);                           
//                         }
//                     }
//                 } else {
//                     echo '<br>else ';
//                     if(array_key_exists($key , $request->File)) {
//                         // print_r($request->File[$key]);    
//                         $file = $request->File[$key];
//                         if($file->getfileName() && ( $file->getSize() > 0)) {
//                             $getID3 = new getID3;
//                             $ThisFileInfo = $getID3->analyze($file);
//                             $Duration = round($ThisFileInfo['playtime_seconds']); 
//                             $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//                             $mode_data['Title'] = $request->Title[$key];
//                             //$mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');
//                             $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
//                             $mode_data['FileType'] = 'Audio';
//                             $mode_data['Duration'] = $Duration;
//                             $total_duration = $Duration + 20;
//                             $mode_data['SlidePosition'] = $count++;
//                             // print_r($mode_data);
//                             Exercises::create($mode_data);
//                             ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
//                         } else {
//                             ExercisesMaster::destroy($ExercisesMasterId);
//                             Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                             Flash::error('File not Uploaded.');
//                             return redirect()->back()->withInput();
//                         }                 
//                     }
//                 }
//                 Exercises::destroy($ExerciseId);
//             }

//         } else if($request->ModeId == 2) {

//             $mode_data= []; 
//             $mode_data['ExercisesMasterId'] = $ExercisesMasterId;
//             $mode_data['Title'] = $request->STitle;
//             $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
            
//             if($request->hasFile('File')) {
//                 $file = $request->File;
//                 if($file->getfileName()) {
//                     if($file->getSize() > 0) {
//                         $getID3 = new getID3;
//                         $ThisFileInfo = $getID3->analyze($file);
//                         $Duration =  round($ThisFileInfo['playtime_seconds']);
//                         //$mode_data['File'] =  upload_exercise_audio($file, 'uploads/ex');;
//                         $mode_data['File'] =  uplaod_audio_s3($file, 'exercises');
//                         $mode_data['Duration'] = $Duration; 
//                         $total_duration = $Duration + 20;
//                         delete_exercise_audio($request->origonal_audio , 'uploads/ex/');
//                         ExercisesMaster::where('ExercisesMasterId', $ExercisesMasterId)->update(['ApproxTime' => $total_duration]);
//                     } else {
//                         ExercisesMaster::destroy($ExercisesMasterId);
//                         Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                         Flash::error('Filesize is not valid.');
//                         return redirect()->back()->withInput();
//                     }
//                 } else {
//                     ExercisesMaster::destroy($ExercisesMasterId);
//                     Exercises::where('ExercisesMasterId', $ExercisesMasterId)->delete();
//                     Flash::error('File not Uploaded.');
//                     return redirect()->back()->withInput();
//                 }
//             } 
//             Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
            
//         } else if($request->ModeId == 3) {
//             echo 'sd'; 
//             $mode_data= []; 
//             $mode_data['Title'] = $request->Title;
//             $mode_data['ScenarioDescription'] = $request->ScenarioDescription;
//             $mode_data['ExtraDescription'] = $request->ExtraDescription;
//             Exercises::where('ExerciseId',$request->ExerciseId)->update($mode_data);
//         }
//         // die;
//         Flash::success('Exercise updated successfully.');
//         return redirect(route('exercises.index'));
//     }

//     public function destroy($id)
//     {
//         $ExercisesMaster = ExercisesMaster::find($id);
//         if (empty($ExercisesMaster)) {
//             Flash::error('Exercise not found');
//             return redirect(route('exercises.index'));
//         }
//         // ExercisesMaster::destroy($id);
//         ExercisesMaster::where('ExercisesMasterId', $id)->update(['IsDelete' => 1]);
//         return $this->responseSuccess('Deleted Successfully.');
//     }
// }
