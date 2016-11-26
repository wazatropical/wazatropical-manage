<?php

namespace WAZA\ComptabiliteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * objet
 *
 * @ORM\Table(name="objet")
 * @ORM\Entity(repositoryClass="WAZA\ComptabiliteBundle\Repository\objetRepository")
 */
class Objet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Monnaie")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $monnaie;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Mesure")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $mesure;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="pu", type="decimal", precision=10, scale=2)
     */
    private $pu;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     *
     * @ORM\Column(name="dateenreg", type="datetime", nullable=false)
     */
    private $dateenreg;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return objet
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set pu
     *
     * @param string $pu
     *
     * @return objet
     */
    public function setPu($pu)
    {
        $this->pu = $pu;

        return $this;
    }

    /**
     * Get pu
     *
     * @return string
     */
    public function getPu()
    {
        return $this->pu;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return objet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set monnaie
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie
     *
     * @return objet
     */
    public function setMonnaie(\WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie)
    {
        $this->monnaie = $monnaie;

        return $this;
    }

    /**
     * Get monnaie
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Monnaie
     */
    public function getMonnaie()
    {
        return $this->monnaie;
    }

    /**
     * Set mesure
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Mesure $mesure
     *
     * @return objet
     */
    public function setMesure(\WAZA\ComptabiliteBundle\Entity\Mesure $mesure)
    {
        $this->mesure = $mesure;

        return $this;
    }

    /**
     * Get mesure
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Mesure
     */
    public function getMesure()
    {
        return $this->mesure;
    }

    /**
     * Set dateenreg
     *
     * @param \DateTime $dateenreg
     *
     * @return Objet
     */
    public function setDateenreg($dateenreg)
    {
        $this->dateenreg = $dateenreg;

        return $this;
    }

    /**
     * Get dateenreg
     *
     * @return \DateTime
     */
    public function getDateenreg()
    {
        return $this->dateenreg;
    }

    /**
     * Set user
     *
     * @param \WAZA\UserBundle\Entity\User $user
     *
     * @return Objet
     */
    public function setUser(\WAZA\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WAZA\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
