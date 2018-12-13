<?php

namespace App\Http\Requests;

class CustomerRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
           // CREATE
           case 'POST':
           {
               return [
                   // CREATE ROLES
               ];
           }
           // UPDATE
           case 'PUT':
           case 'PATCH':
           {
               return [
                   'title'       => 'required|min:2|max:50',
                   'body'        => 'required|min:3',
                   'productcol_id' => 'required|numeric',
                   'solutioncol_id' => 'required|numeric',
                   'customercol_id' => 'required|numeric',
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
            'productcol_id.required' => '请选择所属产品',
            'solutioncol_id.required' => '请选择方案类型',
            'customercol_id.required' => '请选择客户行业',
        ];
    }
}
