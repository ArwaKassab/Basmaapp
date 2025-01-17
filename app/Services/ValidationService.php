<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ValidationService
{
    /**
     * Validate user creation data.
     */
    public function validateAddUser(array $data)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_name' => 'nullable|string',
            'mobile_number' => 'nullable|string|min:10|max:15|unique:users',
            'address' => 'nullable|string'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            throw new \Exception($validator->errors()->first());
        }
    }
    /**
     * Validate user update data.
     */

    public function validateUpdateUser(array $data, $id)
    {

        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($id)],
            'user_name' => ['nullable', 'string', Rule::unique('users')->ignore($id)], // استثناء المستخدم الحالي من التحقق من اسم المستخدم الفريد
            'mobile_number' => ['nullable', 'string', 'min:10', 'max:15', Rule::unique('users')->ignore($id)],
            'address' => 'nullable|string',

            'birthdate' => 'nullable|date',
            'date_of_join' => 'nullable|date',
            'date_of_exit' => 'nullable|date',
            'starting_disease' => 'nullable|date',
            'healing_date' => 'nullable|date',
            'disease_type' => 'nullable|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    /**
     * Validate child user creation data.
     */

    public function validateAddChild(array $data)
    {
        $rules = [

            'name' => 'required||max:255',
            'email' => 'nullable|email|unique:users',
            'user_name' => 'required|string|unique:users', // استثناء المستخدم الحالي من التحقق من اسم المستخدم الفريد
            'mobile_number' => 'nullable|string|min:10|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',


            'address' => 'nullable|string',
            'birthdate' => 'required|date',
            'date_of_join' => 'required|date',
            'starting_disease' => 'nullable|date',
            'disease_type' => 'required|string',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];



        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    public function validateorderExplanations(array $data)
    {


        $rules = [
            'user_id' => 'required|exists:users,id',
            'subject_class_id' => 'required|exists:subject_classes,id',
            'title_id' => 'required|exists:titles,id',
            'note' => 'nullable|string',

        ];



        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }
    }


}
