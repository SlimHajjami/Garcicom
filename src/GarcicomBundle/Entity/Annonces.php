<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 02/02/2021
 * Time: 13:59
 */

namespace GarcicomBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Annonces
 *
 * @ORM\Table(name="Annonces")
 * @ORM\Entity()
 */
class Annonces
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
private $libelle;
    /**
     * @ORM\Column(type="string",length=255)
     */
private $lien;

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
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * @param mixed $lien
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    }


}