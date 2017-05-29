<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bestelformulier
 * @ORM\Table(name="bestelformulier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\bestelformulierRepository")
 */
class Bestelformulier
{
    /**
     * @var int
     *
     * @ORM\Column(name="bid", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $bid;

    /**
     * @var string
     *
     * @ORM\Column(name="leverancier", type="string", length=255)
     */
    private $leverancier;

    /**
     * @var int
     *
     * @ORM\Column(name="bestelordernr", type="integer")
     */
    private $bestelordernr;

    /**
    *@ORM\ManyToOne(targetEntity="Artikel", inversedBy="nummers")
    *@ORM\JoinColumn(name="artikelnummer", referencedColumnName="artikelnummer")
     */
    private $artikelnummer;

    /**
    *@ORM\ManyToOne(targetEntity="Artikel", inversedBy="nummers")
    *@ORM\JoinColumn(name="omschrijving", referencedColumnName="omschrijving")
     */
    private $omschrijving;

    /**
     * @var int
     *
     * @ORM\Column(name="besteldaantal", type="integer")
     */
    private $besteldaantal;

    /**
     * Set bid
     *
     * @param integer $bid
     *
     * @return bestelformulier
     */
    public function setBid($bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return int
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * Set leverancier
     *
     * @param string $leverancier
     *
     * @return bestelformulier
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
     * Set bestelordernr
     *
     * @param integer $bestelordernr
     *
     * @return bestelformulier
     */
    public function setBestelordernr($bestelordernr)
    {
        $this->bestelordernr = $bestelordernr;

        return $this;
    }

    /**
     * Get bestelordernr
     *
     * @return int
     */
    public function getBestelordernr()
    {
        return $this->bestelordernr;
    }

    /**
     * Set artikelnummer
     *
     * @param integer $artikelnummer
     *
     * @return bestelformulier
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
     * @return Temp
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
     * Set besteldaantal
     *
     * @param integer $besteldaantal
     *
     * @return bestelformulier
     */
    public function setBesteldaantal($besteldaantal)
    {
        $this->besteldaantal = $besteldaantal;

        return $this;
    }

    /**
     * Get besteldaantal
     *
     * @return int
     */
    public function getBesteldaantal()
    {
        return $this->besteldaantal;
    }
}
