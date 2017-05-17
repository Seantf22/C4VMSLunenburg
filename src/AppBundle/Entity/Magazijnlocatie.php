<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Magazijnlocatie
 *
 * @ORM\Table(name="magazijnlocatie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MagazijnlocatieRepository")
 */
class Magazijnlocatie
{
    /**
     * @var int
     *
     * @ORM\Column(name="mid", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $mid;

    /**
     * @var int
     *
     * @ORM\Column(name="magazijnlocatie", type="string", length=6, unique=true)
     */
    private $magazijnlocatie;

    /**
     * @var int
     *
     * @ORM\Column(name="artikelid", type="integer", nullable=true)
     */
    private $artikelid;

    /**
     * Set mid
     *
     * @param string $mid
     *
     * @return Mid
     */
    public function setMid($mid)
    {
        $this->mid = $mid;

        return $this;
    }

    /**
     * Get mid
     *
     * @return string
     */
    public function getMid()
    {
        return $this->mid;
    }

    /**
     * Set magazijnlocatie
     *
     * @param string $magazijnlocatie
     *
     * @return Magazijnlocatie
     */
    public function setMagazijnlocatie($magazijnlocatie)
    {
        $this->magazijnlocatie = $magazijnlocatie;

        return $this;
    }

    /**
     * Get magazijnlocatie
     *
     * @return string
     */
    public function getMagazijnlocatie()
    {
        return $this->magazijnlocatie;
    }

    /**
     * Set artikelid
     *
     * @param integer $artikelid
     *
     * @return Magazijnlocatie
     */
    public function setArtikelid($artikelid)
    {
        $this->artikelid = $artikelid;

        return $this;
    }

    /**
     * Get artikelid
     *
     * @return int
     */
    public function getArtikelid()
    {
        return $this->artikelid;
    }
}
