<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $business = GetData::getBusinessDetail($id);
        if ($business && Auth::user()->id === $business->user->id  ) {
            $pdf = \PDF::loadView('myPDF', compact('business'));
            // return $pdf->stream('itsolutionstuff.pdf');
            return $pdf->download($business->name.'-adp.pdf');
        }
    }
}
