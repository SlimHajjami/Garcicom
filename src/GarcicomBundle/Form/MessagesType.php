<?php

namespace GarcicomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;
use GarcicomBundle\Entity\Messages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('message', TextareaType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('recipient', EntityType::class, [
                "class" => User::class,
                "choice_label" => "email",
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('envoyer', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-primary"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}