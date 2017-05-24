<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Paveikslėlis',
                    'required' => false,
                    'attr' => ['accept' =>'image/*']
                ]
            )
            ->add(
                'title',
                TextType::class,
                [
                    'label' => "Pavadinimas*",
                    'attr' => array('class' => 'form-control'),
                    'label_attr' => array('class' => 'control-label'),
                ]
            )
            ->add('date', DateTimeType::class, ['label' => "Data*"])
            ->add('address', TextType::class, ['label' => "Adresas*"])
            ->add('description', TextType::class, ['label' => "Aprašymas*"])
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => 'AppBundle:Category',
                    'label' => 'Kategorija*',
                    'placeholder' => '-'
                ]
            )
            ->add(
                'city',
                EntityType::class,
                [
                    'class' => 'AppBundle:City',
                    'label' => 'Miestas*',
                    'placeholder' => '-'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Event'
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundlecreat_event_form_type';
    }
}
