<?php
/**
 * Created by PhpStorm.
 * User: Samsung
 * Date: 25/03/2016
 * Time: 23:36
 */

namespace CodeProject\Http\Requests;


class ProjectRequest extends Request
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
            'name' => 'required',
            'owner_id' => 'required',
            'client_id' => 'required'
        ];
    }

}