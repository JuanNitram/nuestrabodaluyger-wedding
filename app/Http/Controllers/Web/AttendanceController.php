<?php

namespace App\Http\Controllers\Web;

use App\Models\Attendant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttendanceController
{
    public function weddingAttend(Request $request)
    {  
        $certificateBase64 = $request->certificate_base64;
        $extension = explode('/', explode(':', substr($certificateBase64, 0, strpos($certificateBase64, ';')))[1])[1];
        $replace = substr($certificateBase64, 0, strpos($certificateBase64, ',')+1); 
        $certificate = str_replace($replace, '', $certificateBase64); 
        $certificate = str_replace(' ', '+', $certificate);
        $certificateBase64Name = Str::random(10).'.'.$extension;
      
        Storage::disk('public')->put('certificates/' . $certificateBase64Name, base64_decode($certificate));
        
        $attendant = new Attendant();
        $attendant->full_name = $request->full_name;
        $attendant->attend = $request->attend === 'yes';
        $attendant->certificate = 'certificates/' . $certificateBase64Name;
        $attendant->type = $request->type === null ? 'NOT_DEFINED' : $request->type;

        $attendant->save();
    }
}