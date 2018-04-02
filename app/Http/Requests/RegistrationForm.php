<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'gender' => 'required'
        ];
        
    }

    public function persist(){
        
        /*$user = User::create(
            $this->only(['first_name', 'last_name', 'email', 'password', 'gender'])
        );*/

        //send user a notification email
        //Mail::to($user)->send(new Welcome($user));

    }
}
