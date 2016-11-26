<?php

namespace WAZA\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsUser
 *
 * @ORM\Table(name="settings_user")
 * @ORM\Entity(repositoryClass="WAZA\SettingsBundle\Repository\SettingsUserRepository")
 */
class SettingsUser
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
     * @ORM\OneToOne(targetEntity="WAZA\FileBundle\Entity\FormatExport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $formatExpFile; 
    
    /**
     * @ORM\OneToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Monnaie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monnaie1; 
    
    /**
     * @ORM\OneToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Monnaie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monnaie2; 
    
    /**
     * @ORM\OneToOne(targetEntity="WAZA\ComptabiliteBundle\Entity\Monnaie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monnaie3;

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
     * Set formatExpFile
     *
     * @param \WAZA\FileBundle\Entity\FormatExport $formatExpFile
     *
     * @return SettingsUser
     */
    public function setFormatExpFile(\WAZA\FileBundle\Entity\FormatExport $formatExpFile)
    {
        $this->formatExpFile = $formatExpFile;

        return $this;
    }

    /**
     * Get formatExpFile
     *
     * @return \WAZA\FileBundle\Entity\FormatExport
     */
    public function getFormatExpFile()
    {
        return $this->formatExpFile;
    }

    /**
     * Set monnaie1
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie1
     *
     * @return SettingsUser
     */
    public function setMonnaie1(\WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie1)
    {
        $this->monnaie1 = $monnaie1;

        return $this;
    }

    /**
     * Get monnaie1
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Monnaie
     */
    public function getMonnaie1()
    {
        return $this->monnaie1;
    }

    /**
     * Set monnaie2
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie2
     *
     * @return SettingsUser
     */
    public function setMonnaie2(\WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie2)
    {
        $this->monnaie2 = $monnaie2;

        return $this;
    }

    /**
     * Get monnaie2
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Monnaie
     */
    public function getMonnaie2()
    {
        return $this->monnaie2;
    }

    /**
     * Set monnaie3
     *
     * @param \WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie3
     *
     * @return SettingsUser
     */
    public function setMonnaie3(\WAZA\ComptabiliteBundle\Entity\Monnaie $monnaie3)
    {
        $this->monnaie3 = $monnaie3;

        return $this;
    }

    /**
     * Get monnaie3
     *
     * @return \WAZA\ComptabiliteBundle\Entity\Monnaie
     */
    public function getMonnaie3()
    {
        return $this->monnaie3;
    }
}
