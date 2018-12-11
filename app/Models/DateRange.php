<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateRange extends Model
{
	protected $table = 'ranges';

    protected $fillable = [
        'date_from', 
        'date_to',
    ];

    public function scopeCrossRanges($query, $dateFrom, $dateTo = null)
    {
    	if ($dateTo) {
    		$query->whereDate('date_from', '>', $dateFrom)
				->whereDate('date_to', '<', $dateTo)
				 
				->orWhereDate('date_from', '<', $dateFrom)
				->whereDate('date_to', '>', $dateTo)  

				->orWhereDate('date_from', '<', $dateFrom)
				->whereDate('date_to', '>', $dateFrom) 
				->whereDate('date_to', '<', $dateTo) 

				->orWhereDate('date_from', '>', $dateFrom)
				->whereDate('date_from', '<', $dateTo) 
				->whereDate('date_to', '>', $dateTo) 

				->orWhereDate('date_from', '=', $dateFrom)
				->orWhereDate('date_to', '=', $dateTo);

    	} else {

			$query->orWhereDate('date_from', '>', $dateFrom)
				->whereNull('date_to')  

				->orWhereDate('date_from', '<', $dateFrom)
				->whereDate('date_to', '>', $dateFrom);
    	}

    	$query
			->orWhereDate('date_from', '=', $dateFrom)
			->orWhereDate('date_to', '=', $dateTo)
			->orWhereDate('date_to', '=', $dateFrom)
			->orWhereDate('date_from', '=', $dateTo);

        return $query;

    }
}
