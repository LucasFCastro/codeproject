<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 14/12/2015
 * Time: 01:13
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id'=>'required|integer',
        'title'=>'required',
        'note'=>'required',
    ];
}