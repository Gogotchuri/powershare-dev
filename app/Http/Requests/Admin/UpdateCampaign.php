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
        return array_merge(Campaign::baseRules(), [
            'featured-image' => 'image|mimes:jpeg,png,jpg,gif',
            'status_id' => 'required|exists:campaign_statuses,id',
            'video_url' => 'url',
            'ethereum_address' => 'nullable|string|max:255',
        ]);
    }
}
