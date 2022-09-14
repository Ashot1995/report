<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortLinkRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'link' => 'required|url'
        ];
    }
}
