<?php
//src/Appbundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\table(name="Search")
 */
 class Search
 {

	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	*/
	private $sid;

 /**
  * @ORM\Column(type="string", length=100)
	*/
	private $searching;

 
    /**
   * Set sid
   *
   * @param string $sid
   *
   * @return Search
   */  public function setsid($tid)
  {
      $this->sid = $sid;

      return $this;
  }

  /**
   * Get tid
   *
   * @return int
   */
  public function getsid()
  {
      return $this->sid;
  }

  /**
   * Set search
   *
   * @param string $search
   *
   * @return Search
   */
  public function setsearching($searching)
  {
      $this->searching = $searching;

      return $this;
  }

  /**
   * Get search
   *
   * @return string
   */
  public function getsearching()
  {
      return $this->searching;
  }
}
?>
