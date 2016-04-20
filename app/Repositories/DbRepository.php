<?php
namespace Omega\Repositories;

class DbRepository
{
    protected $entity;

    /**
     * DbRepository constructor.
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function new()
    {
        return new $this->entity;
    }

    public function create(array $parameters)
    {
        return $this->entity->create($parameters);
    }

    public function getAll()
    {
        return $this->entity->all();
    }
}
