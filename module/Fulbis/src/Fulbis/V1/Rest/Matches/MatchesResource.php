<?php
namespace Fulbis\V1\Rest\Matches;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Fulbis\Domain\Service;

class MatchesResource extends AbstractResourceListener
{

    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $data->team1 = $this->service->fetch('Fulbis\Domain\Entity\Team', $data->team1);
        $data->team2 = $this->service->fetch('Fulbis\Domain\Entity\Team', $data->team2);

        return $this->service->create('Fulbis\Domain\Entity\Match', (array)$data);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return (bool)$this->service->delete('Fulbis\Domain\Entity\Match', $id);
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->service->fetch('Fulbis\Domain\Entity\Match', $id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->service->fetchAll('Fulbis\Domain\Entity\Match');
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        $data->team1 = $this->service->fetch('Fulbis\Domain\Entity\Team', $data->team1);
        $data->team2 = $this->service->fetch('Fulbis\Domain\Entity\Team', $data->team2);

        return $this->service->update('Fulbis\Domain\Entity\Match', $id, (array)$data);
    }
}
