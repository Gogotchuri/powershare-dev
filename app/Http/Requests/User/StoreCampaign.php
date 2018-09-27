<?php

namespace App\Http\Requests\User;

use App\Models\Campaign;
use App\Models\Reference\CampaignStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampaign extends FormRequest
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
            'featured_image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'         => Rule::in([
                CampaignStatus::nameFromId(CampaignStatus::DRAFT),
                CampaignStatus::nameFromId(CampaignStatus::PROPOSAL)
            ]),
        ]);
    }
}
