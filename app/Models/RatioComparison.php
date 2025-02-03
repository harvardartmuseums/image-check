<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatioComparison extends Model
{
    protected $fillable = ["BaseImageURL", "CachePath", "DYNMC_DRS_FileDate", "DYNMC_DRS_FileID", "DYNMC_PixelH", "DYNMC_PixelW", "DYNMC_Ratio", "EnteredDate", "FileID", "FileName", "MediaMasterID", "PRDWORK_BaseImageURL", "PRDWORK_DRS_FileDate", "PRDWORK_DRS_File_ID", "PRDWORK_FileID", "PRDWORK_FileName", "PRDWORK_MediaMasterID", "PRDWORK_PixelH", "PRDWORK_PixelW", "PRDWORK_Ratio","PRDWORK_RenditionNumber", "Path", "RenditionNumber", "RatioDifference", "mediastatusid"];
}
