<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Madzipper;
class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function extract_zip(Request $request)
    {
        $fileName = time().'.'.$request->file->extension();  
		
		$uploads_folder = "";
   
        $request->file->move(public_path($uploads_folder), $fileName);
        $Path = public_path($uploads_folder).'\\'.$fileName;
        \Madzipper::make($Path)->extractTo(public_path($uploads_folder));
		$guid = uniqid();
		$old = public_path($uploads_folder).'/content';
		$new = public_path($uploads_folder).'/'.$guid;
		rename($old, $new);
        return ($guid);
   
    }
}
