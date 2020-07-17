<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\FileModel;
use Illuminate\Support\Str;

class FileController extends Controller
{
    protected $__file;

    public function __construct(FileModel $file)
    {
        $this->__file = $file;
    }

    public function index()
    {
        $url = '';
        return view("welcome", ['url' => $url]);
    }

    public function upload(Request $request)
    {
        $url = $this->loadImage($request, 'test_lambda');
        dd($url);
        $item = new FileModel();
        $item->url = $url;
        $item->description = 'test';
        $item->status = 1;
        $item->save();
        return view("welcome", ['url' => $url]);
    }

    public function loadImage($request, $input)
    {
        $url = null;
        if ($request->hasFile($input)) {
            $file = $request->file($input);
            $url = $this->uploadImage($input . '/', $file);
        }
        return $url;
    }

    public function uploadImage($path, $file)
    {
        $fileName = $file->getClientOriginalName();
        $uploadDir = $path;
        $fullpath = $uploadDir . $fileName;
        Storage::disk('s3')->put($fullpath, file_get_contents($file), 'public');
        if (Storage::disk('s3')->exists($fullpath)) {
            return Storage::disk('s3')->url($fullpath);
        }
        return null;
    }
}
