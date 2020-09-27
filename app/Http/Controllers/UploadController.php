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
		$fileOriginalName = $request->files->get('file')->getClientOriginalName();
		$ext      = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$fileName = time().'.'.$ext;
		
		$uploads_folder = "";
		if ($ext != 'zip') {
			if ($ext == 'pdf') {
				$uploads_folder = "pdf";
			} else if ($ext == 'jpg' || $ext == 'gif' || $ext == 'png') {
				$uploads_folder = "image";
			} else if ($ext == 'mp3' || $ext == 'wav') {
				$uploads_folder = "audio";
			} else if ($ext == 'stl') {
				$uploads_folder = "stl";
			} else {
				$uploads_folder = "other";
			}
		}
   
        $result = $request->file->move(public_path($uploads_folder), $fileName);
		if ($result) {
			if ($ext == 'zip') {
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
						return ($guid."/");
					}
				}
			} else {
				return $uploads_folder."/".$fileName;
			}
		}
   
    }
}
