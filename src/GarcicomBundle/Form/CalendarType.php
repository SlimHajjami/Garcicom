<?php

namespace GarcicomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
            ->add('start', DateTimeType::class,[
                'date_widget' => 'single_text'
                ])
            ->add('end', DateTimeType::class,[
                'date_widget' => 'single_text'
            ])
            ->add('description')
            ->add('allDay')
            ->add('backgroundcolor')
            ->add('borderColor')
            ->add('textcolor')
            ->add('add',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarcicomBundle\Entity\Calendar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garcicombundle_calendar';
    }


}
