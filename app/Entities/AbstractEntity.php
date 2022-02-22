
<?php

use Doctrine\ORM\Mapping AS ORM;

class AbstractEntity {

    /**
     * @var \DateTime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var \DateTime $updated_at
     *
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

}
