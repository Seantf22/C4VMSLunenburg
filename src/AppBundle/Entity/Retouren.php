<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Retouren
 *
 * @ORM\Table(name="retouren")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RetourenRepository")
 */
class Retouren
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="retournummer", type="integer", unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $retournummer;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Artikel", inversedBy="nummers")
     * @ORM\JoinColumn(name="artikel", referencedColumnName="artikelnummer")
     */
    private $artikel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="verwachteleverdatum", type="datetime", nullable=true)
     */
    private $verwachteleverdatum;

    /**
     * @var int
     *
     * @ORM\Column(name="aantal", type="integer")
     */
    private $aantal;

    /**
     * Set retournummer
     *
     * @param integer $retournummer
     *
     * @return Retouren
     */
    public function setRetournummer($retournummer)
    {
        $this->retournummer = $retournummer;

        return $this;
    }

    /**
     * Get retournummer
     *
     * @return int
     */
    public function getRetournummer()
    {
        return $this->retournummer;
    }

    /**
     * Set artikel
     *
     * @param integer $artikel
     *
     * @return Retouren
     */
    public function setArtikel($artikel)
    {
        $this->artikel = $artikel;

        return $this;
    }

    /**
     * Get artikel
     *
     * @return int
     */
    public function getArtikel()
    {
        return $this->artikel;
    }

    /**
     * Set verwachteleverdatum
     *
     * @param \DateTime $verwachteleverdatum
     *
     * @return Retouren
     */
    public function setVerwachteleverdatum($verwachteleverdatum)
    {
        $this->verwachteleverdatum = $verwachteleverdatum;

        return $this;
    }

    /**
     * Get verwachteleverdatum
     *
     * @return \DateTime
     */
    public function getVerwachteleverdatum()
    {
        return $this->verwachteleverdatum;
    }

    /**
     * Set aantal
     *
     * @param integer $aantal
     *
     * @return Retouren
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
