<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;

class Comparison extends Model
{
    protected $fillable = ['MediaMasterID','EnteredDate','RenditionNumber','FileID','Path','FileName','CachePath','CachePath1','CachePath2','BaseImageURL'];

}
