<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
     * Users 数据表验证规则
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'nickname' => 'required|unique:users,nickname,'. Auth::id(),'|between:2,10',
            'temp_mail' => 'email|unique:users,email,' . Auth::id(),
            'introduction' => 'max:80',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
        ];
    }
    /**
     * 自定义错误验证消息提示
     *
     * @return void
     */
    public function messages()
    {
        return [
            'temp_mail.unique' => '邮箱已被注册，如果不是您本人注册请找回密码修改',
            'name.between' => '姓名必须介于 3 - 10 个字符之间。',
            'nickname.required' => '昵称不能为空。',
            'nickname.unique' => '昵称已经被使用。',
            'nickname.between' => '昵称必须介于 3 - 10 个字符之间。',
            'avatar.mimes' =>'头像必须是 jpeg, bmp, png, gif 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
        ];
    }
}
