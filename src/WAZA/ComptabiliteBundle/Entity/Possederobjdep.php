<?php

namespace WAZA\ComptabiliteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * possederobjdep
 *
 * @ORM\Table(name="possederobjdep")
 * @ORM\Entity(repositoryClass="WAZA\ComptabiliteBundle\Repository\possederobjdepRepository")
 */
class Possederobjdep
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
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Objet")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $objet;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Depense")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $depense;
    
    /**
     * @ORM\ManyToOne(targetEntity="WAZA\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="raison", type="string", length=255, nullable=true)
     */
    private $raison;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;
    
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Possederobjdep
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
     * Set raison
     *
     * @param string $raison
     *
     * @return Possederobjdep
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Possederobjdep
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
     * Set quantite
     *
     * @param string $quantite
     *
     * @return Possederobjdep
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
     * Set objet
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Objet $objet
     *
     * @return Possederobjdep
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
     * Set depense
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Depense $depense
     *
     * @return Possederobjdep
     */
    public function setDepense(\WAZA\ComptabiliteBundle\Entity\Depense $depense)
    {
        $this->depense = $depense;

        return $this;
    }

    /**
     * Get depense
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Depense
     */
    public function getDepense()
    {
        return $this->depense;
    }

    /**
     * Set user
     *
     * @param \WAZA\UserBundle\Entity\User $user
     *
     * @return Possederobjdep
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
