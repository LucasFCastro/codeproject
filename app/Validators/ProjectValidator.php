<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 14/12/2015
 * Time: 01:13
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id'=>'required|integer',
        'client_id'=>'required|integer',
        'name'=>'required',
        'progress'=>'required',
        'status'=>'required',
        'due_date'=>'required|date_format:d/m/Y'
    ];
}