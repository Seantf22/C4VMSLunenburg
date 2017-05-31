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

//EntiteitType vervangen door b.v. KlantType
class ArtikelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

		//gebruiken wat je nodig hebt, de id hoeft er niet bij als deze auto increment is
        $builder
            ->add('artikelnummer', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('omschrijving', TextType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('technischeSpecificaties', TextType::class, //naam is b.v. een attribuut of variabele van klant
            array('required' => false))
        ;
        // $builder
        //     ->add('magazijnlocatie', TextType::class)
        // ;
        $builder->add('magazijnlocatie', EntityType::class, array(
          'class' => 'AppBundle:Magazijnlocatie',
          'query_builder' => function (EntityRepository $er) {
            return $er->createQueryBuilder('u')
            ->where('u.artikelid is NULL');
          },
          'choice_label' => 'magazijnlocatie'
          ))
        ;
        $builder
            ->add('inkoopprijs', MoneyType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        // $builder
        //     ->add('codeVervangendArtikel', IntegerType::class, //naam is b.v. een attribuut of variabele van klant
        //     array('required' => false))
        // ;
        $builder->add('codeVervangendArtikel', EntityType::class, array(
          // query choices from this entity
          'class' => 'AppBundle:Artikel',
          'choice_label' => function ($artikel) {
            return $artikel->getArtikelnummer() . ' ' . $artikel->getOmschrijving();
          },
          'required' => false,
          ))
        ;
        $builder
            ->add('minimumVoorraad', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('voorraadAantal', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
        $builder
            ->add('bestelserie', IntegerType::class) //naam is b.v. een attribuut of variabele van klant
        ;
		//zie
		//http://symfony.com/doc/current/forms.html#built-in-field-types
		//voor meer typen invoer
    }

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Artikel', //Entiteit vervangen door b.v. Klant
		));
	}
}

?>
