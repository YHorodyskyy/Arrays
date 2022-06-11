<?php

namespace App\Http\Requests;

use App\Helpers\Arrays\Sort\ArraySortType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SortParametersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "array_size" => "int|min:2|max:10",
            "array_sort" => [new Enum(ArraySortType::class)]
        ];
    }
}
