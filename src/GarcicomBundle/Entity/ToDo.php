<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 02/02/2021
 * Time: 10:55
 */

namespace GarcicomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ToDo
 *
 * @ORM\Table(name="ToDo")
 * @ORM\Entity()
 */
class ToDo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $desription;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $etat;

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
    public function getDesription()
    {
        return $this->desription;
    }

    /**
     * @param mixed $desription
     */
    public function setDesription($desription)
    {
        $this->desription = $desription;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="User",referencedColumnName="id",onDelete="CASCADE")
     */
    private $User;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }





}