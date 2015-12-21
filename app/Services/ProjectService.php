<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 14/12/2015
 * Time: 00:34
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repositoy;

    /**
     * @var ProjectValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjectRepository $repository,
                                ProjectValidator $validator,
                                Filesystem $filesystem,
                                Storage $storage)
    {
        $this->repositoy = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    public function create(array $data)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repositoy->create($data);

        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repositoy->update($data, $id);

        } catch(ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function createFile(array $data)
    {
        $project = $this->repositoy->skipPresenter()->find($data['project_id']);

        $projectFile = $project->files()->create($data);

        $this->storage->put($projectFile->id . "." .
            $data['extension'], $this->filesystem->get($data['file']));

    }
}