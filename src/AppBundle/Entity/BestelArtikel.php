<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BestelArtikel
 *
 * @ORM\Table(name="bestelartikel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BestelArtikelRepository")
 */
class BestelArtikel
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
     * @var int
     *
     * @ORM\Column(name="Bestelordernummer", type="integer", unique=false)
     */
    private $bestelordernummer;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Artikel")
     * @ORM\JoinColumn(name="artikelnummer", referencedColumnName="artikelnummer")
     */
    private $artikelnummer;

    /**
    * @var int
    *
    * @ORM\Column(name="Aantal", type="integer", unique=false, nullable=false)
    */
   private $aantal;

    /**
     * Set artikelnummer
     *
     * @param integer $artikelnummer
     *
     * @return BestelArtikel
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
     * Set bestelordernummer
     *
     * @param integer $bestelordernummer
     *
     * @return bestelordernummer
     */
    public function setBestelordernummer($bestelordernummer)
    {
        $this->bestelordernummer = $bestelordernummer;

        return $this;
    }

    /**
     * Get bestelordernummer
     *
     * @return int
     */
    public function getBestelordernummer()
    {
        return $this->bestelordernummer;
    }

    /**
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return aantal
     */
    public function setAantal($aantal)
    {
        $this->aantal = $aantal;

        return $this;
    }

    /**
     * Get aantal
     *
     * @return int
     */
    public function getAantal()
    {
        return $this->aantal;
    }
}
