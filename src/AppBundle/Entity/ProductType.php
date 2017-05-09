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
	* @ORM\GeneratedValue(strategy="AUTO")
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

	public function settid($tid) {
		$this->$tid = $tid;
	}

	public function gettid() {
		return $this->tid;
	}

	public function setBeschrijving($beschrijving) {
		$this->$beschrijving = $beschrijving;
	}

	public function getBeschrijving () {
		return $this->beschrijving;
  }
}
?>
