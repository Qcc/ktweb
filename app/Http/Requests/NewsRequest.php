<?php

namespace App\Http\Requests;

class NewsRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'title'       => 'required|min:2|max:50',
                    'body'        => 'required|min:3',
                    'column_id' => 'required|numeric',
                    'image' => 'required',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:2|max:50',
                    'body'        => 'required|min:3',
                    'column_id' => 'required|numeric',
                    'image' => 'required',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.min' => '标题必须至少两个字符',
            'title.max' => '标题不能超过50个字符',
            'body.min' => '文章内容必须至少三个字符',
            'image.required' => '首图不能为空'
        ];
    }
}
