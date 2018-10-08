<?php

namespace App\Http\Requests\User;

use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'featured-image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'         => Rule::in([
                CampaignStatus::nameFromId(CampaignStatus::DRAFT),
                CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)
            ]),
            'video_url' => 'url',
            'ethereum_address' => 'nullable|string|max:255',
        ]);
    }
}
