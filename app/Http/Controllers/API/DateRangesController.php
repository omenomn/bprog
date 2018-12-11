<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DateRange;
use App\Http\Requests\API\DateRanges\StoreRequest;
use Carbon\Carbon;
use App\Http\Resources\DateRangesCollection;

class DateRangesController extends Controller
{
    public function list(Request $request)
    {
    	$ranges = DateRange::get();

        return new DateRangesCollection($ranges);
    }

    public function store(StoreRequest $request)
    {
    	$dateFrom =  Carbon::parse($request->date_from)->format('Y-m-d H:i');
    	$dateTo =  Carbon::parse($request->date_to)->format('Y-m-d H:i');

    	$ranges = DateRange::crossRanges($dateFrom, $dateTo)->get();

    	if ($ranges->count() > 0) {
    		return response()->json([
    			'range' => trans('messages.range_occupied')
    		], 422);
    	}

    	DateRange::create([
    		'date_from' => $dateFrom,
    		'date_to' => $dateTo,
    	]);

		return response()->json([
			'msg' => trans('messages.success')
		]);
    }
}
