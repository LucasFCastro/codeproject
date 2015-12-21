<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19/12/2015
 * Time: 23:55
 */

namespace CodeProject\Transformers;
use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['members'];

    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'owner_id' => $project->owner_id,
            'client_id' => $project->client_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMembersTransformer());
    }
}