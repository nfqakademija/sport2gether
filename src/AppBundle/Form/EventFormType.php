<?php

namespace AppBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title',TextType::class,['label' => 'Pavadinimas'])
            ->add('date',TextType::class)
            ->add('address',TextType::class)
            ->add('description',TextType::class)
            ->add('coach',TextType::class)
            ->add('category',TextType::class)
            ->add('city',TextType::class)
            ->add('attendees',TextType::class)
        ;
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
