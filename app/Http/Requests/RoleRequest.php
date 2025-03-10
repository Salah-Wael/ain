<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route()->role->id ?? null;
        return [
            'name' => 'required|string|unique:roles,name,' . $id,
            'guard_name' => 'required|string',
            'permissionArray.*' => 'nullable',
        ];
    }

    /**
     * Attributes .
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'            => __('messages.name'),
            'guard_name'      => __('messages.guard_name'),
            'permissionArray' => __('messages.permissions'),
        ];
    }
}
