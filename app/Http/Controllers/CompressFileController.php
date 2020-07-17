<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CompressFileController extends Controller
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function index(Request $request)
    {
        $file = $request->file('File');                                       //get file from request
        $arrayFileName = explode(".", $file->getClientOriginalName());
//        to get name of file in array form?
$filename =  $file->getClientOriginalName();            //to get existing name  of file
$storage_path_full = '/'.$filename;                            //to make path
 $localVideo =  Storage::disk('public')->put($storage_path_full,
     file_get_contents($file));
				//to save the file in your public folder
 $s3FilePath = 'userMedia/'. $arrayFileName[0] . date('his') . '.' . $extension;
			             //to make s3 file path
$lowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500);
		  FFMpeg::fromDisk('public')
			 ->open($filename)
                                  ->addFilter(function ($filters) {
	                     $filters->resize(new Dimension(960, 540));
		            })
		         ->export()
		        ->toDisk('s3')
		         ->inFormat($lowBitrateFormat)
		         ->save($docPath);
    }
}
