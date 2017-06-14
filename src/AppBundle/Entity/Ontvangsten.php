<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Ontvnagsten
 *
 * @ORM\Table(name="ontvangsten")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OntvnagstenRepository")
 */
class Ontvangsten
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
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="datetime")
     */
    private $datum;

    /**
     * @var string
     *
     * @ORM\Column(name="kwaliteit", type="string", length=255)
     */
    private $kwaliteit;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Artikel")
     * @ORM\JoinColumn(name="artikelnummer", referencedColumnName="artikelnummer")
     */
    private $artikelnummer;

    /**
     * @var string
     *
     * @ORM\Column(name="omschrijving", type="string", length=255)
     */
    private $omschrijving;

    /**
     * @var string
     *
     * @ORM\Column(name="leverancier", type="string", length=255)
     */
    private $leverancier;

    /**
     * @var int
     *
     * @ORM\Column(name="hoeveelheid", type="integer")
                 * *
     *     * @Assert\Range(
     *      min = 0,
     *      minMessage = "De hoeveelheid mag niet negatief zijn."
     *     
     * )
     */
    private $hoeveelheid;


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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Ontvnagsten
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set kwaliteit
     *
     * @param string $kwaliteit
     *
     * @return Ontvnagsten
     */
    public function setKwaliteit($kwaliteit)
    {
        $this->kwaliteit = $kwaliteit;

        return $this;
    }

    /**
     * Get kwaliteit
     *
     * @return string
     */
    public function getKwaliteit()
    {
        return $this->kwaliteit;
    }

    /**
     * Set artikelnummer
     *
     * @param integer $artikelnummer
     *
     * @return Ontvnagsten
     */
    public function setArtikelnummer($artikelnummer)
    {
        $this->artikelnummer = $artikelnummer;

        return $this;
    }

    /**
     * Get artikelnummer
     *
     * @return int
     */
    public function getArtikelnummer()
    {
        return $this->artikelnummer;
    }

    /**
     * Set omschrijving
     *
     * @param string $omschrijving
     *
     * @return Ontvnagsten
     */
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * Get omschrijving
     *
     * @return string
     */
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     * Set leverancier
     *
     * @param string $leverancier
     *
     * @return Ontvnagsten
     */
    public function setLeverancier($leverancier)
    {
        $this->leverancier = $leverancier;

        return $this;
    }

    /**
     * Get leverancier
     *
     * @return string
     */
    public function getLeverancier()
    {
        return $this->leverancier;
    }

    /**
     * Set hoeveelheid
     *
     * @param integer $hoeveelheid
     *
     * @return Ontvnagsten
     */
    public function setHoeveelheid($hoeveelheid)
    {
        $this->hoeveelheid = $hoeveelheid;

        return $this;
    }

    /**
     * Get hoeveelheid
     *
     * @return int
     */
    public function getHoeveelheid()
    {
        return $this->hoeveelheid;
    }
}
