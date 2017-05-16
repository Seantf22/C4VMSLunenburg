<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\productRepository")
 */
class Product
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="barcode", type="string", length=20, unique=true)
     */
    private $barcode;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=100)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="merk", type="string", length=50, nullable=true)
     */
    private $merk;

    /**
     *@ORM\ManyToOne(targetEntity="ProductType", inversedBy="producten")
     *@ORM\JoinColumn(name="producttype", referencedColumnName="tid")
     */
    private $producttype;

    /**
     * @var string
     *
     * @ORM\Column(name="inkoopprijs", type="decimal", precision=10, scale=2)
     */
    private $inkoopprijs;

    /**
     * @var string
     *
     * @ORM\Column(name="opmerking", type="string", length=255)
     */
    private $opmerking;

    /**
    * @ORM\ManyToOne(targetEntity="producttype", inversedBy="producten")
    * @ORM\JoinColumn(name="producttype", referencedColumnName="tid")
    */
    private $producten;

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
     * Set barcode
     *
     * @param string $barcode
     *
     * @return product
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode
     *
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set naam
     *
     * @param string $naam
     *
     * @return product
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set merk
     *
     * @param string $merk
     *
     * @return product
     */
    public function setMerk($merk)
    {
        $this->merk = $merk;

        return $this;
    }

    /**
     * Get merk
     *
     * @return string
     */
    public function getMerk()
    {
        return $this->merk;
    }

    /**
     * Set producttype
     *
     * @param integer $producttype
     *
     * @return product
     */
    public function setProducttype($producttype)
    {
        $this->producttype = $producttype;

        return $this;
    }

    /**
     * Get producttype
     *
     * @return int
     */
    public function getProducttype()
    {
        return $this->producttype;
    }

    /**
     * Set inkoopprijs
     *
     * @param string $inkoopprijs
     *
     * @return product
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
     * Set opmerking
     *
     * @param string $opmerking
     *
     * @return product
     */
    public function setOpmerking($opmerking)
    {
        $this->opmerking = $opmerking;

        return $this;
    }

    /**
     * Get opmerking
     *
     * @return string
     */
    public function getOpmerking()
    {
        return $this->opmerking;
    }



}
