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
     * @var int
     *
     * @ORM\Column(name="artikelnummer", type="integer", unique=true)
     * @ORM\Id
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
     * @ORM\Column(name="magazijnlocatie", type="string", length=255)
     * @Assert\Length(
	   *		min = 6,
	   *		max = 6,
	   *		exactMessage = "Invoerwaarde moet 6 characters groot zijn")
     * @Assert\Regex(
     *     pattern="/^[0-1]{1}[0-9]{1}|20\/[A-Z]{1}[0-9]|10{1}$/i",
     *     match=true,
     *     message="Gebruik de volgende structuur getal tot de 20 /eenletter getal tot de 10, Bijvoorbeeld de code 04/H07 ")
     * @Assert\Regex(
     *     pattern="/^[2]{1}[1-9]{1}\/[A-Z]{1}[0-9]{1}$/i",
     *     match=false,
     *     message="Het eerste getal mag niet hoger zijn dan 20 ")
     * @Assert\Regex(
     *     pattern="/^[3-9]{1}[0-9]{1}\/[A-Z]{1}[0-9]{1}$/i",
     *     match=false,
     *     message="Het eerste getal mag niet hoger zijn dan 20")
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}\/[A-Z][1]{1}[1-9]{1}$/i",
     *     match=false,
     *     message="Het tweede getal mag niet hoger zijn dan 10")
     * @Assert\Regex(
     *     pattern="/^[0-9]{2}\/[A-Z][2-9]{1}[0-9]{1}$/i",
     *     match=false,
     *     message="Het tweede getal mag niet hoger zijn dan 10")
     * @Assert\Regex(
     *     pattern="/^[0-9A-Za-z]+$/i",
     *     match=false,
     *     message="Gebruik de volgende structuur getal tot de 20 /eenletter getal tot de 10")
     */

    private $magazijnlocatie;

    public function __toString() {
        return $this->omschrijving;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="inkoopprijs", type="decimal", precision=10, scale=2)
          * @Assert\Range(
     *      min = 0,
     *      max = 9999,
     *      minMessage = "Er mag geen negatief bedrag ingevuld worden",
     *      maxMessage = "Weet u zeker dat dit het juiste bedrag is?"
     * )
     */
    private $inkoopprijs;

    /**
     * @var int
     *
     * @ORM\Column(name="code_vervangend_artikel", type="integer", nullable=true)
     */
    private $codeVervangendArtikel;

    /**
     * @var int
     *
     * @ORM\Column(name="minimum_voorraad", type="integer")
     */
    private $minimumVoorraad;

    /**
     * @var int
     *
     * @ORM\Column(name="voorraad_aantal", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 9999,
     *      minMessage = "Er kan geen negatieve voorraad ingevuld worden.",
     *      maxMessage = "Is dit voorraad aantal het juiste?"
     * )
     */
    private $voorraadAantal;

    /**
     * @var int
     *
     * @ORM\Column(name="bestelserie", type="integer")
     */
    private $bestelserie;

    /**
     * @ORM\OneToMany(targetEntity="Bestelformulier", mappedBy="Artikel")
     */
    private $nummers;

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
