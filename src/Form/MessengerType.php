<?php

namespace App\Form;

use App\Entity\Messenger;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessengerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FromUser',EmailType::class,[
                'label'=>'From'
            ])
            ->add('ToUsers',EmailType::class,[
                'label'=>'To'
            ])
            ->add('title',TextType::class,[
                'label'=>'title'
            ])
            ->add('description',TextType::class,[
                'label'=>'description'
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
