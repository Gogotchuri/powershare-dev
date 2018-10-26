<?php

namespace App\Http\Requests\Admin;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaign extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return array_merge(Campaign::updateRules(), [
            'status_id' => 'required|exists:campaign_statuses,id',
        ]);
    }
}
