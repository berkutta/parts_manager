<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Components extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|unique:components|max:255',
                    'category' => 'required',
                    'stock' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'stock' => 'required',
                ];
            }
            default:break;
        }
    }
}
