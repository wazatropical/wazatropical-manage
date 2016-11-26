<?php

namespace WAZA\ComptabiliteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * depense
 *
 * @ORM\Table(name="depense")
 * @ORM\Entity(repositoryClass="WAZA\ComptabiliteBundle\Repository\depenseRepository")
 */
class Depense
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    
    /**
     * @var \DateTime
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Depense
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
     * Set dateenreg
     *
     * @param \DateTime $dateenreg
     *
     * @return Depense
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Depense
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
     * Set user
     *
     * @param \WAZA\UserBundle\Entity\User $user
     *
     * @return Depense
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
