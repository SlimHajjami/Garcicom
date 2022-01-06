<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 22/09/2021
 * Time: 06:07
 */

namespace GarcicomBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Affectation
 *
 * @ORM\Table(name="Affectation")
 * @ORM\Entity()
 */
class Affectation
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
    private $titre;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $libelle;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="Responsable",referencedColumnName="id",onDelete="CASCADE")
     */
    private $Responsable;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="Employee",referencedColumnName="id",onDelete="CASCADE")
     */
    private $Employee;

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
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
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

    /**
     * @param mixed $Responsable
     */
    public function setResponsable($Responsable)
    {
        $this->Responsable = $Responsable;
    }

    /**
     * @return mixed
     */
    public function getEmployee()
    {
        return $this->Employee;
    }

    /**
     * @param mixed $Employee
     */
    public function setEmployee($Employee)
    {
        $this->Employee = $Employee;
    }

}