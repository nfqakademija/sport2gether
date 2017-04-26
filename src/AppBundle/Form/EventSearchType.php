<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use AppBundle\Entity\EventSearch;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventSearchType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', EntityType::class, array(
                'class' => 'AppBundle:City',
                'placeholder' => 'Choose a city',
                'required' => false
            ))
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:Category',
                'placeholder' => 'Choose a category',
                'required' => false
            ))
            ->add('title',null, array(
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' =>EventSearch::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_event_search_type';
    }
}
