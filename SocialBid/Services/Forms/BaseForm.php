<?php

namespace SocialBid\Services\Forms;

use Illuminate\Support\MessageBag;
use SocialBid\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\File\File;
class BaseForm
{
    protected $passes;
    protected $errors;
    protected $input;
    public function __construct()
    {
        $this->input = \Input::all();

        $errors = new MessageBag();

        if ($old = \Input::old("errors"))
        {
            $errors = $old;
        }

        $this->errors = $errors;

        $this->customValidators();
    }
    /**
     * allows manually set an input to validate
     * @param array $data data to validate
     */
    public function setInput(array $data){
        $this->input = $data;
    }
    /**
     * this function validates an input
     * @param  array $rules    rules
     * @param  array  $messages array of custom messages
     * @param  Closure $sometimes closure which can be used to add conditional validations
     * @return boolean           if validation passed
     */
    public function validate($rules,$messages=array(),$sometimes=null)
    {
        $validator = \Validator::make($this->input, $rules,$messages);
        if($sometimes !== null && $sometimes instanceof \Closure){
            $sometimes($validator);
        }
        $this->passes = $validator->passes();
        $this->errors = $validator->errors();
        return $this->passes;
    }
    /**
     * this method returns errors from validation if validation did not pass
     * @return /Illuminate/Support/MessageBag errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;
        return $this;
    }
    /**
     * this method checks if there are any errors
     * @return boolean
     */
    public function hasErrors()
    {
        return $this->errors->any();
    }
    /**
     * this method gets first error for specified key
     * @param  string $key key of error
     * @return string      error message
     */
    public function getError($key)
    {
        return $this->getErrors()->first($key);
    }
    /**
     * checks if request method was POST
     * @return boolean [description]
     */
    public function isPosted()
    {
        return \Input::server("REQUEST_METHOD") == "POST";
    }
    /**
     * this method holds custom validators
     * @return void 
     */
    protected function customValidators(){
        \Validator::extend('url1',function($attribute,$value,$parameters){
            return preg_match( '/^(http|https):\/\/[a-z0-9_]+([\-\.]{1}[a-z_0-9]+)*\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\/.*)?$/i' ,$value);
        });
        //checks if provided password matches user current password
        \Validator::extend('current_password', function($attribute,$value,$parameters){
            $user = \Sentry::getUser();
            if(empty($user) || !$user->checkPassword($value)){
                return false;
            }
            return true;
        });
        \Validator::extend('minNumber', function($attribute,$value,$parameters){
            return (float) $value >= (float) $parameters[0] ? true : false;
        });
        \Validator::extend('mime_types', function($attribute, $value, $parameters){
            if ( ! $value instanceof File)
            {
                return false;
            }
            if ($value->isValid() && $value->getPath() != '')
            {
                $mimeType = $value->getMimeType();
                foreach($parameters as $parameter){
                    $parameter = str_replace('/','\/', $parameter);
                    if(preg_match("/$parameter/", $mimeType)) return true;
                }
                return false;
            }
            else
            {
                return false;
            }
        });
    }
}