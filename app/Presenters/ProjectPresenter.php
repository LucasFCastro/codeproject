<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 20/12/2015
 * Time: 00:03
 */

namespace CodeProject\Presenters;

use CodeProject\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}