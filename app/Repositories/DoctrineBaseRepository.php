<?php
namespace App\Entities\Repository;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

class DoctrineBaseRepository extends EntityRepository{
    use PaginatesFromParams;

    public function insert($data) {
        $entity = new $this->_entityName();
        return $this->prepare($entity, $data);
    }

    public function update($data, $id) {
        $entity = $this->find($id);

        return $this->prepare($entity, $data);
    }

    public function prepare($entity, $data) {
        $set = 'set';
        $whitelist = $entity->toArray();
        foreach($whitelist as $key => $value) {
            if(isset($data[$key])) {
                $setter = $set.Inflector::classify($key);
                $entity->$setter($data[$key]);
            }
        }
        $this->save($entity);

        return $entity;
    }    
    
    public function save($object) {
        $this->_em->persist($object);

        $this->_em->flush($object);

        return $object;
    }
    
    public function delete($object = null, $id = null) {
        if($id){
            $object = $this->find($id);
        }
        $this->_em->remove($object);

        $this->_em->flush($object);

        return true;        
    }

    /**
     * @return object[]|LengthAwarePaginator
     */
    public function pagAll(int $limit = 20, int $page = 1): LengthAwarePaginator
    {
        // paginateAll is already public, you may use it directly as well.
        return $this->paginateAll($limit, $page);
    }   
      

}