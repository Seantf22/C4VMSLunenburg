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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

//EntiteitType vervangen door b.v. KlantType
class BestelformulierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leverancier', TextType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('bestelordernr', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
        ->add('artikel', EntityType::class, array(
            'class' => 'AppBundle:Artikel',
            'choice_label' => function ($artikel) {
              return $artikel->getArtikelnummer() . ' ' . $artikel->getOmschrijving();
            }
        ))
        ;
        $builder
            ->add('besteldaantal', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder->add('verwachteleverdatum', DateType::class, array(
          'widget' => 'choice',
          'format' => 'dd-MM-yyy',
          'placeholder' => array(
            'day' => 'Dag', 'month' => 'Maand', 'year' => 'Jaar'),
          'years' => array(
            Date('Y') => Date('Y'),
            Date('Y') + 1 => Date('Y') + 1,
            Date('Y') + 2 => Date('Y') + 2,
            Date('Y') + 3 => Date('Y') + 3,
            Date('Y') + 4 => Date('Y') + 4,
          )
          ))
          ;
		//zie
		//http://symfony.com/doc/current/forms.html#built-in-field-types
		//voor meer typen invoer
    }

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Bestelformulier', //Entiteit vervangen door b.v. Klant
		));
	}
}

?>
