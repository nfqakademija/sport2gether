<?php

namespace AppBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/*
 * @Todo
 */
//use Symfony\Component\HttpFoundation\Response;
//$this->get('translator')->trans('Symfony is great')

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title',TextType::class,['label' => "Pavadinimas"])
            ->add('date',TextType::class,['label' => "Data"])
            ->add('address',TextType::class,['label' => "Adresas"])
            ->add('description',TextType::class,['label' => "Aprasymas"])
            ->add('coach',TextType::class,['label' => "Treneris"])
            ->add('category',TextType::class,['label' => "Kategorija"])
            ->add('city',TextType::class,['label' => "Miestas"])
            ->add('attendees',TextType::class,['label' => "Dalyviai"])
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
