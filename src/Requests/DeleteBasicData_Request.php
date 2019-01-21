<?php

namespace ArtinCMS\LBDM\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteBasicdata_Request extends FormRequest
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
        $roles = [
            'basic_data_id' => 'required',
        ];
        return $roles;
    }

    protected function failedValidation(Validator $validator)
    {
        $api_errors = LBDM_Validation_error_to_api_json($validator->errors());
        $res =
            [
                'status' => "-1",
                'status_type' => "error",
                'errors' => $api_errors,
                'message' => [['title' => 'لطفا موارد زیر را بررسی نمایید:', 'items' => $api_errors]]
            ];
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }
}
