<?php

namespace App\Http\Requests\API\DateRanges;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\API\BaseStoreRequest;
use Carbon\Carbon;

class StoreRequest extends BaseStoreRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => 'required|date',
            'date_to' => 'nullable|date|after:date_from',
        ];
    }

    protected function validationData()
    {
        $dateFrom = Carbon::parse($this->date_from)->format('Y-m-d H:i');
        $dateTo = Carbon::parse($this->date_to)->format('Y-m-d H:i');

        return [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
    }
}
