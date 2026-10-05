<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $operationId = $this->route('operation')->id ?? null;

        return [
            'operation_code' => 'required|string|unique:operations,operation_code,' . $operationId,
            'personnel_id' => 'required|exists:personnel,id',
            'logistics_item_id' => 'required|exists:logistics_items,id',
            'quantity_allocated' => 'required|integer|min:1',
            'status' => 'required|in:Pending,Active,Completed',
            'mission_notes' => 'nullable|string|max:1000',
        ];
    }
}
