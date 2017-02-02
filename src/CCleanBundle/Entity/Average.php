<?php

namespace CCleanBundle\Entity;

use CCleanBundle\Traits\Stampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Average
 *
 * @ORM\Table(name="average")
 * @ORM\Entity(repositoryClass="CCleanBundle\Repository\AverageRepository")
 */
class Average
{
    use Stampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="decimal", precision=10, scale=1)
     */
    private $score;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set score
     *
     * @param string $score
     * @return Average
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string 
     */
    public function getScore()
    {
        return $this->score;
    }
}
