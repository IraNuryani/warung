<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item' => 'sometimes|string',  // Hanya divalidasi jika dikirim
            'kategori_id' => 'sometimes|integer', // Hanya divalidasi jika dikirim
            'harga' => 'sometimes|integer', // Hanya divalidasi jika dikirim
            'stok' => 'sometimes|integer',
        ];
    }
}
