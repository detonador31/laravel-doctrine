<?php

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="scientist")
 */
class Scientist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
    * @ORM\OneToMany(targetEntity="Theory", mappedBy="scientist", cascade={"persist"})
    * @var ArrayCollection|Theory[]
    */
    protected $theories;

    /**
    * @param $firstname
    * @param $lastname
    */
    public function __construct()
    {

        $this->theories = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFullname()
    {
        return $this->firstname . ' ' .$this->lastname;
    }    

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname  = $lastname;
    }    

    public function addTheory(Theory $theory)
    {
        if(!$this->theories->contains($theory)) {
            $theory->setScientist($this);
            $this->theories->add($theory);
        }
    }

    public function getTheories($array = false)
    {
        $theories = $this->theories->toArray();
        // retorna array se true ao invés de objetos
        if($array) {
            for($i = 0; $i < count($theories ); $i++) {
                $theories[$i] = $theories[$i]->toArray();
            }
            return $theories;
        }

        return $theories;
    }

    public function toArray() {
        $array = get_object_vars($this);
        $array['theories'] = $this->getTheories(true);
        return $array;
    }      
}