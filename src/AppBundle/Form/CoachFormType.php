<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Coach;

class CoachFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('image', FileType::class, [
                'label'=>'Paveikslėlis',
                'required' => false
            ])
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'label' =>'Kategorija*',
                'placeholder' => '-'
            ))
            ->add('city', EntityType::class, array(
                'class' => 'AppBundle:City',
                'label' =>'Miestas*',
                'placeholder' => '-'
            ))
            ->add('phoneNumber',TextType::class, [
                'label' =>'Telefono numeris',
                'required'=>false,
            ])
            ->add('firstName',TextType::class, [
                'label' =>'Vardas',
                'required'=>false,
            ])
            ->add('lastName',TextType::class, [
                'label' =>'Pavardė',
                'required'=>false,
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Coach'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_coach_form_type';
    }
}
