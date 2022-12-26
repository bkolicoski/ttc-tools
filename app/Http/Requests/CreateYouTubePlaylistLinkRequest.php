<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateYouTubePlaylistLinkRequest extends FormRequest
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
        return [
            'playlist_id' => 'required',
            'url' => 'required|unique:latest_links,url',
            'token' => 'required|recaptcha'
        ];
    }

    public function data()
    {
        return $this->only('playlist_id', 'url');
    }
}
