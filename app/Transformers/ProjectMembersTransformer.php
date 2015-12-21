<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19/12/2015
 * Time: 23:55
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMembersTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'member_name' => $member->name,
        ];
    }
}