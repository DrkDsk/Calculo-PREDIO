<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveBalanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ground_id'               => ['required'],
            'amount'                  => ['required'],
            'updated_charge'          => ['required'],
            'surcharge'               => ['required'],
            'year_at_operation_date'  => ['required'],
            'due_payment_year'        => ['required'],
            'amount_to_pay'           => ['required'],
            'month_at_operation_date' => ['required'],
            'month_of_pay'            => ['required'],
            'INCP_at_operation_date'  => ['required'],
            'INCP_applied'            => ['required'],
            'surcharge_rate'          => ['required']
        ];
    }
}
