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
        return array_merge(Campaign::updateRules(), [
            'status_id' => Rule::in([CampaignStatus::DRAFT, CampaignStatus::PROPOSAL]),
        ]);
    }
}
