<?php
/**
 * Created by PhpStorm.
 * User: Slim sl
 * Date: 02/02/2021
 * Time: 13:58
 */

namespace GarcicomBundle\Entity;

use Composer\Util\Filesystem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Portfolio
 *
 * @ORM\Table(name="Portfolio")
 * @ORM\Entity()
 */
class Portfolio
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
     * @ORM\ManyToOne(targetEntity="GarcicomBundle\Entity\Societe")
     * @ORM\JoinColumn(name="idSociete",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idSociete;

    /**
     * @return mixed
     */
    public function getIdSociete()
    {
        return $this->idSociete;
    }

    /**
     * @param mixed $idSociete
     */
    public function setIdSociete($idSociete)
    {
        $this->idSociete = $idSociete;
    }
    /**
     * @ORM\OneToMany(targetEntity="GarcicomBundle\Entity\Images", mappedBy="Portfolio", cascade={"persist"})
     */
    public $images;

    public function getImages()
    {
        return $this->images;
    }

    public function addImage(Images $image)
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setPortfolio($this);
        }

        return $this;
    }

    public function removeImage(Images $image)
    {
        if ($this->images->contains($image)) {
            $filesystem = new Filesystem();
            $filesystem->remove($image);
            // set the owning side to null (unless already changed)
            if ($image->getName() === $this) {
                $image->setName(null);
            }
        }

        return $this;
    }

}