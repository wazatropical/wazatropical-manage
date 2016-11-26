<?php

namespace WAZA\ComptabiliteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * possederobjgain
 *
 * @ORM\Table(name="possederobjgain")
 * @ORM\Entity(repositoryClass="WAZA\ComptabiliteBundle\Repository\possederobjgainRepository")
 */
class Possederobjgain
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
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Gain")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $gain;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Objet")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $objet;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255)
     */
    private $responsable;
    
    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="decimal", precision=10, scale=2)
     */
    private $quantite;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Possederobjgain
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Possederobjgain
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set quantite
     *
     * @param string $quantite
     *
     * @return Possederobjgain
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set gain
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Gain $gain
     *
     * @return Possederobjgain
     */
    public function setGain(\WAZA\ComptabiliteBundle\Entity\Gain $gain)
    {
        $this->gain = $gain;

        return $this;
    }

    /**
     * Get gain
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Gain
     */
    public function getGain()
    {
        return $this->gain;
    }

    /**
     * Set objet
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Objet $objet
     *
     * @return Possederobjgain
     */
    public function setObjet(\WAZA\ComptabiliteBundle\Entity\Objet $objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Objet
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set user
     *
     * @param \WAZA\UserBundle\Entity\User $user
     *
     * @return Possederobjgain
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
