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
        $attendant = new Attendant();
        $attendant->full_name = $request->full_name;
        $attendant->attend = true;
        $attendant->message = $request->get('message', '');
        $attendant->type = $request->type === null ? 'NOT_DEFINED' : $request->type;

        $attendant->save();

        return redirect('/');
    }
}