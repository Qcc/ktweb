<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        
        {
            return [
                'content' => 'required|min:3'
            ];
        };
    }

    public function messages()
    {
        return [
            'content.min' => '回复最少需要3个字!',
        ];
    }
}
