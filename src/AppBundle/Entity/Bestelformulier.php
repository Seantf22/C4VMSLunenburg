<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BestelFormulier
 *
 * @ORM\Table(name="bestelformulier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\bestelformulierRepository")
 */
class BestelFormulier
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
     * @var int
     *
     * @ORM\Column(name="Bestelordernummer", type="integer", unique=true)
     */
    private $bestelordernummer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Leverdatum", type="datetime")
     */
    private $leverdatum;


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
     * Set bestelordernummer
     *
     * @param integer $bestelordernummer
     *
     * @return BestelFormulier
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
     * Set leverdatum
     *
     * @param \DateTime $leverdatum
     *
     * @return BestelFormulier
     */
    public function setLeverdatum($leverdatum)
    {
        $this->leverdatum = $leverdatum;

        return $this;
    }

    /**
     * Get leverdatum
     *
     * @return \DateTime
     */
    public function getLeverdatum()
    {
        return $this->leverdatum;
    }
}

