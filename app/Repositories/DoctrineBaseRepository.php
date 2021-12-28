<?php
namespace App\Entities\Repository;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\ORM\EntityRepository;

class DoctrineBaseRepository extends EntityRepository{
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
    
    public function delete($object) {
        $this->_em->remove($object);

        $this->_em->flush($object);

        return true;        
    }
      

}