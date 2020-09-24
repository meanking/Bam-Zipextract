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
   
        $result = $request->file->move(public_path($uploads_folder), $fileName);
		if ($result) {
			$flag = false;
			while($flag == false) {
				if (file_exists(public_path($uploads_folder).'/'.$fileName)) {
					$flag = true;
					$Path = public_path($uploads_folder).'/'.$fileName;
					$result = \Madzipper::make($Path)->extractTo(public_path($uploads_folder));
					$guid = uniqid();
					$old = public_path($uploads_folder).'/content';
					$new = public_path($uploads_folder).'/'.$guid;
					rename($old, $new);
					return ($guid);
				}
			}
		}
   
    }
}
