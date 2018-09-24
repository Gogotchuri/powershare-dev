<?php

namespace App\Http\Requests\Admin;

use App\Models\Campaign;
use Illuminate\Foundation\Http\FormRequest;

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
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
