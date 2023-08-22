<?php

namespace App\Form;

use App\Entity\Messenger;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessengerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FromUser',EntityType::class,[
                'label'=>'From',
                'attr' =>['class' =>'form-control'],
                'class'=>User::class,
            ])
            ->add('ToUsers',EntityType::class,[
                'label'=>'To',
                'attr' =>['class' =>'form-control'],
                'class'=>User::class
            ])
            ->add('title',TextType::class,[
                'label'=>'title',
                'attr' =>['class' =>'form-control']
            ])
            ->add('description',TextareaType::class,[
                'label'=>'description',
                'attr' =>['class' =>'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messenger::class,
        ]);
    }
}
