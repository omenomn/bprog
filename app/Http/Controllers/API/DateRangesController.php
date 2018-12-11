<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DateRange;

class DateRangesController extends Controller
{
    public function list(Request $request)
    {
    	$ranges = DateRange::crossRanges('2018-12-10')->get();

    	dd($ranges);
    }
}
