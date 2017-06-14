<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class SelectBestelform extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
      ->add('bestelordernummer', EntityType::class, array(
        'class' => 'AppBundle:BestelFormulier',
        'choice_label' => function ($bestelordernummer) {
          return $bestelordernummer->getBestelordernummer() . " verwachte leverdatum: " . $bestelordernummer->getLeverdatum()->format('d-M-Y');
        },
      ))
    ;
  }

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\BestelFormulier',
		  ))
    ;
	}
}

?>
