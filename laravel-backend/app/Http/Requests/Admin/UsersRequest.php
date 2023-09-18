<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->can('add users') || $user->can('edit users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|required|min:1|max:255',
            'password' => 'string|nullable|min:6',
            'email' => 'string|required|email',
            'roles' => 'array|required',
        ];
    }
}
