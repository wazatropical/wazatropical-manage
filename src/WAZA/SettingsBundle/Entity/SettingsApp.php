<?php

namespace WAZA\SettingsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SettingsApp
 *
 * @ORM\Table(name="settings_app")
 * @ORM\Entity(repositoryClass="WAZA\SettingsBundle\Repository\AppRepository")
 */
class SettingsApp
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
     * @ORM\Column(name="nomEntreprise", type="string", length=255, unique=true)
     */
    private $nomEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="siteWebEntreprise", type="string", length=255, unique=true)
     */
    private $siteWebEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="paysEntreprise", type="string", length=255, unique=true)
     */
    private $paysEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostalEntreprise", type="string", length=255, unique=true)
     */
    private $codePostalEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="villeEntreprise", type="string", length=255, unique=true)
     */
    private $villeEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="rueEntreprise", type="string", length=255)
     */
    private $rueEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="emailEntreprise", type="string", length=255, unique=true)
     */
    private $emailEntreprise;

    /**
     * @var int
     *
     * @ORM\Column(name="telEntreprise", type="bigint")
     */
    private $telEntreprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateSaveAutoDataBase", type="date")
     */
    private $dateSaveAutoDataBase;


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
     * Set nomEntreprise
     *
     * @param string $nomEntreprise
     *
     * @return SettingsApp
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * Get nomEntreprise
     *
     * @return string
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set siteWebEntreprise
     *
     * @param string $siteWebEntreprise
     *
     * @return SettingsApp
     */
    public function setSiteWebEntreprise($siteWebEntreprise)
    {
        $this->siteWebEntreprise = $siteWebEntreprise;

        return $this;
    }

    /**
     * Get siteWebEntreprise
     *
     * @return string
     */
    public function getSiteWebEntreprise()
    {
        return $this->siteWebEntreprise;
    }

    /**
     * Set paysEntreprise
     *
     * @param string $paysEntreprise
     *
     * @return SettingsApp
     */
    public function setPaysEntreprise($paysEntreprise)
    {
        $this->paysEntreprise = $paysEntreprise;

        return $this;
    }

    /**
     * Get paysEntreprise
     *
     * @return string
     */
    public function getPaysEntreprise()
    {
        return $this->paysEntreprise;
    }

    /**
     * Set codePostalEntreprise
     *
     * @param string $codePostalEntreprise
     *
     * @return SettingsApp
     */
    public function setCodePostalEntreprise($codePostalEntreprise)
    {
        $this->codePostalEntreprise = $codePostalEntreprise;

        return $this;
    }

    /**
     * Get codePostalEntreprise
     *
     * @return string
     */
    public function getCodePostalEntreprise()
    {
        return $this->codePostalEntreprise;
    }

    /**
     * Set villeEntreprise
     *
     * @param string $villeEntreprise
     *
     * @return SettingsApp
     */
    public function setVilleEntreprise($villeEntreprise)
    {
        $this->villeEntreprise = $villeEntreprise;

        return $this;
    }

    /**
     * Get villeEntreprise
     *
     * @return string
     */
    public function getVilleEntreprise()
    {
        return $this->villeEntreprise;
    }

    /**
     * Set rueEntreprise
     *
     * @param string $rueEntreprise
     *
     * @return SettingsApp
     */
    public function setRueEntreprise($rueEntreprise)
    {
        $this->rueEntreprise = $rueEntreprise;

        return $this;
    }

    /**
     * Get rueEntreprise
     *
     * @return string
     */
    public function getRueEntreprise()
    {
        return $this->rueEntreprise;
    }

    /**
     * Set emailEntreprise
     *
     * @param string $emailEntreprise
     *
     * @return SettingsApp
     */
    public function setEmailEntreprise($emailEntreprise)
    {
        $this->emailEntreprise = $emailEntreprise;

        return $this;
    }

    /**
     * Get emailEntreprise
     *
     * @return string
     */
    public function getEmailEntreprise()
    {
        return $this->emailEntreprise;
    }

    /**
     * Set telEntreprise
     *
     * @param integer $telEntreprise
     *
     * @return SettingsApp
     */
    public function setTelEntreprise($telEntreprise)
    {
        $this->telEntreprise = $telEntreprise;

        return $this;
    }

    /**
     * Get telEntreprise
     *
     * @return int
     */
    public function getTelEntreprise()
    {
        return $this->telEntreprise;
    }

    /**
     * Set dateSaveAutoDataBase
     *
     * @param \DateTime $dateSaveAutoDataBase
     *
     * @return SettingsApp
     */
    public function setDateSaveAutoDataBase($dateSaveAutoDataBase)
    {
        $this->dateSaveAutoDataBase = $dateSaveAutoDataBase;

        return $this;
    }

    /**
     * Get dateSaveAutoDataBase
     *
     * @return \DateTime
     */
    public function getDateSaveAutoDataBase()
    {
        return $this->dateSaveAutoDataBase;
    }
}

