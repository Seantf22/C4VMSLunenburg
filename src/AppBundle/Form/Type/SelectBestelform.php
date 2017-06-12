<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//vul aan als je andere invoerveld-typen wilt gebruiken in je formulier
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;

//EntiteitType vervangen door b.v. KlantType
class SelectBestelform extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		//gebruiken wat je nodig hebt, de id hoeft er niet bij als deze auto increment is
        $builder
        ->add('bestelordernummer', EntityType::class, array(
            'class' => 'AppBundle:BestelFormulier',
            'choice_label' => function ($bestelordernummer) {
              return $bestelordernummer->getBestelordernummer();
            }
        ))
        ;
    }

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\BestelFormulier', //Entiteit vervangen door b.v. Klant
		));
	}
}

?>
