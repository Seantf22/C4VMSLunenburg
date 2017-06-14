<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * *
     *     * @Assert\Range(
     *      min = 10000,
     *      max = 99999,
     *      minMessage = "Het bestelordernummer moet positief zijn en uit 5 cijfers bestaan.",
     *      maxMessage = "Het bestelordernummer mag maximaal uit 5 cijfers bestaan."
     *     
     * )
     */
    private $bestelordernummer;

    /**
     * @var \Date
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
     * @param \Date $leverdatum
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
     * @return \Date
     */
    public function getLeverdatum()
    {
        return $this->leverdatum;
    }
}
