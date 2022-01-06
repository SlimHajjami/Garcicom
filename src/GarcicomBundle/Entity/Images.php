<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 11/03/2021
 * Time: 15:33
 */

namespace GarcicomBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * Images
 *
 * @ORM\Table(name="Images")
 * @ORM\Entity()
 */

class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="GarcicomBundle\Entity\Portfolio", inversedBy="images")
     * @ORM\JoinColumn(name="Portfilio",referencedColumnName="id",onDelete="CASCADE")
     */
    private $Portfolio;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPortfolio()
    {
        return $this->Portfolio;
    }

    /**
     * @param mixed $Portfolio
     */
    public function setPortfolio($Portfolio)
    {
        $this->Portfolio = $Portfolio;
    }

}