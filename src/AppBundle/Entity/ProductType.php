<?php
//src/Appbundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\table(name="producttype")
 */
 class ProductType
 {

	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	*/
	private $tid;

 /**
  * @ORM\Column(type="string", length=100)
	*/
	private $beschrijving;

 /**
  * @ORM\OneToMany(targetEntity="Product", mappedBy="producttype")
  */
  private $producten;

  /**
   * Set tid
   *
   * @param integer $tid
   *
   * @return ProductTypen
   */
  public function settid($tid)
  {
      $this->tid = $tid;

      return $this;
  }

  /**
   * Get tid
   *
   * @return int
   */
  public function gettid()
  {
      return $this->tid;
  }

  /**
   * Set beschrijving
   *
   * @param string $beschrijving
   *
   * @return ProductTypen
   */
  public function setBeschrijving($beschrijving)
  {
      $this->beschrijving = $beschrijving;

      return $this;
  }

  /**
   * Get beschrijving
   *
   * @return string
   */
  public function getBeschrijving()
  {
      return $this->beschrijving;
  }
}
?>
