<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembelianRequest extends FormRequest
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
            'item_id' => 'sometimes|integer',  
            'jumlah' => 'sometimes|integer', 
            'total_harga' => 'sometimes|integer',
            'distributor' => 'sometimes|string', 
            'tanggal_beli' => 'sometimes|date',
        ];
    }
}
