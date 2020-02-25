<?php

namespace App\Http\Requests\ServiceRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'vehicle_make'      => ['required'],
            'vehicle_model_id'  => ['required'],
            'client_name'       => ['required', 'string', 'min:4', 'max:100'],
            'client_email'      => ['required', 'string', 'email', 'max:100'],
            'client_phone'      => ['required', 'numeric', 'regex:/^[0-9]{10,14}$/'],
            'description'       => ['required', 'string'],
        ];
    }
}
