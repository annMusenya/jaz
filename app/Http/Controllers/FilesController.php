<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Files;

class FilesController extends Controller
{
    public function addFiles(Request $request){
        $validation = array(
            'instructions_file' => ['max:1999','required']
        );
        
        $validator = Validator::make($request->all(),$validation);

        if($validator->fails()){
            return $validator->errors();
        }else{
            if ($request->hasFile('instructions_file')){
            
                if(Auth::check()){
                    $uploaded_by = Auth::id();
                }else{
                    $uploaded_by = "Guest";
                }
    
                $file = $request->file('instructions_file')[0];
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $filesize = $file->getClientSize();
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('instructions_file')[0]->storeAs('instructions', $fileNameToStore);
                
                Files::create([
                    'uploaded_by' => $uploaded_by,
                    'filename' => $fileNameToStore,
                    'filesize' => $filesize,
                    'filetype' => $extension,
                    'description' => 'Instructions file, uploaded when placing an order.'
                ]);
                return "success";
            }
        }
        
    }

    public function download($id)
    {
        $dl = Files::find($id);
        return Storage::download($dl->path,$dl->title);
    }

    public function delete($id)
    {
        Files::find($id)->delete();
        return back();
    }
}
