<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileModel extends Model
{

    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $fillable = [ 'url', 'description', 'status'];

    //FileModel.php


//nếu cài đặt disk default trong filesystems rồi thì không cần viết Storage::disk('s3') nữa mà chỉ cần Storage::disk() là OK.
// Xóa file thì dùng hàm
//Storage::disk()->delete($fullSrc);

}
