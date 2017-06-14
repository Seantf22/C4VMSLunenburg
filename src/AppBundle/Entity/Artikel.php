<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * artikel
 *
 * @ORM\Table(name="artikel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\artikelRepository")
 */
class Artikel
{
    /**
     * @var string
     *
     * @ORM\Column(name="artikelnummer", type="text", unique=true)
     * @ORM\Id
     * *
     *     * @Assert\Range(
     *      min = 1000000000,
     *      minMessage = "Dit artikelnummer is te kort moet minimaal 10 cijfers zijn."
     *     
     * )
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
     * @ORM\Column(name="technische_specificaties", type="string", length=255, nullable=true)
     */
    private $technischeSpecificaties;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Magazijnlocatie")
     * @ORM\JoinColumn(name="magazijnlocatie", referencedColumnName="mid")
     */
    private $magazijnlocatie;

    public function __toString() {
        return $this->omschrijving;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="inkoopprijs", type="decimal", precision=10, scale=2)
        * *
     *     * @Assert\Range(
     *      min = 0,
     *      minMessage = "De prijs mag niet negatief zijn."
     *     
     * )
     */

    private $inkoopprijs;

    /**
     * @var int
     *
     * @ORM\OneToOne(targetEntity="Artikel")
     * @ORM\JoinColumn(name="code_vervangend_artikel", referencedColumnName="artikelnummer")
     */
     // ORM\Column(name="code_vervangend_artikel", type="integer", nullable=true)
    private $codeVervangendArtikel;

    /**
     * @var int
     *
     * @ORM\Column(name="minimum_voorraad", type="integer")
             * *
     *     * @Assert\Range(
     *      min = 0,
     *      minMessage = "De minimum voorraad mag niet negatief zijn."
     *     
     * )
     */
    private $minimumVoorraad;

    /**
     * @var int
     *
     * @ORM\Column(name="voorraad_aantal", type="integer")
             * *
     *     * @Assert\Range(
     *      min = 0,
     *      minMessage = "De actuele voorraad mag niet negatief zijn."
     *     
     * )
     */
    private $voorraadAantal;

    /**
     * @var int
     *
     * @ORM\Column(name="bestelserie", type="integer")
             * *
     *     * @Assert\Range(
     *      min = 10000,
     *      minMessage = "De bestel serie moet 5 karakters zijn en moet beginnen met een 1"
     *     
     * )
     */
    private $bestelserie;

################################################################################
    /**
    * @var int
    *
    * @ORM\Column(name="active", type="integer")
    */
    private $active;


    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(){
        return $this->active;
    }

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
     * Set artikelnummer
     *
     * @param integer $artikelnummer
     *
     * @return artikel
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
     * @return artikel
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
     * Set technischeSpecificaties
     *
     * @param string $technischeSpecificaties
     *
     * @return artikel
     */
    public function setTechnischeSpecificaties($technischeSpecificaties)
    {
        $this->technischeSpecificaties = $technischeSpecificaties;

        return $this;
    }

    /**
     * Get technischeSpecificaties
     *
     * @return string
     */
    public function getTechnischeSpecificaties()
    {
        return $this->technischeSpecificaties;
    }

    /**
     * Set magazijnlocatie
     *
     * @param string $magazijnlocatie
     *
     * @return artikel
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
     * Set inkoopprijs
     *
     * @param string $inkoopprijs
     *
     * @return artikel
     */
    public function setInkoopprijs($inkoopprijs)
    {
        $this->inkoopprijs = $inkoopprijs;

        return $this;
    }

    /**
     * Get inkoopprijs
     *
     * @return string
     */
    public function getInkoopprijs()
    {
        return $this->inkoopprijs;
    }

    /**
     * Set codeVervangendArtikel
     *
     * @param integer $codeVervangendArtikel
     *
     * @return artikel
     */
    public function setCodeVervangendArtikel($codeVervangendArtikel)
    {
        $this->codeVervangendArtikel = $codeVervangendArtikel;

        return $this;
    }

    /**
     * Get codeVervangendArtikel
     *
     * @return int
     */
    public function getCodeVervangendArtikel()
    {
        return $this->codeVervangendArtikel;
    }

    /**
     * Set minimumVoorraad
     *
     * @param integer $minimumVoorraad
     *
     * @return artikel
     */
    public function setMinimumVoorraad($minimumVoorraad)
    {
        $this->minimumVoorraad = $minimumVoorraad;

        return $this;
    }

    /**
     * Get minimumVoorraad
     *
     * @return int
     */
    public function getMinimumVoorraad()
    {
        return $this->minimumVoorraad;
    }

    /**
     * Set voorraadAantal
     *
     * @param integer $voorraadAantal
     *
     * @return artikel
     */
    public function setVoorraadAantal($voorraadAantal)
    {
        $this->voorraadAantal = $voorraadAantal;

        return $this;
    }

    /**
     * Get voorraadAantal
     *
     * @return int
     */
    public function getVoorraadAantal()
    {
        return $this->voorraadAantal;
    }

    /**
     * Set bestelserie
     *
     * @param integer $bestelserie
     *
     * @return artikel
     */
    public function setBestelserie($bestelserie)
    {
        $this->bestelserie = $bestelserie;

        return $this;
    }

    /**
     * Get bestelserie
     *
     * @return int
     */
    public function getBestelserie()
    {
        return $this->bestelserie;
    }

    public function __construct()
        {
          $this->nummers = new ArrayCollection();
        }
}
