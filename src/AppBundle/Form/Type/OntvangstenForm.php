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
class OntvangstenForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		//gebruiken wat je nodig hebt, de id hoeft er niet bij als deze auto increment is
        $builder
        ->add('artikelnummer', EntityType::class, array(
            'class' => 'AppBundle:Artikel',
            'choice_label' => function ($artikel) {
              return $artikel->getArtikelnummer() . ' ' . $artikel->getOmschrijving();
            }
        ))
        ;
        $builder->add('datum', DateType::class, array(
          'widget' => 'choice',
          'format' => 'dd-MMMM-yyy',
          'placeholder' => array(
            'day' => 'Dag', 'month' => 'Maand', 'year' => 'Jaar'),
          'years' => array(
            Date('Y') - 1 => Date('Y') - 1,
            Date('Y') => Date('Y'),
          )
          ))
          ;
          $builder
            ->add('kwaliteit', TextType::class)
          ;
          $builder
            ->add('leverancier', TextType::class)
          ;
          $builder
              ->add('hoeveelheid', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
          ;

    }

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Ontvangsten', //Entiteit vervangen door b.v. Klant
		));
	}
}

?>
