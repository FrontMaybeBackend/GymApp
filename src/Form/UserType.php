<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Image;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('description', TextareaType::class)
            ->add('avatar',FileType::class,[
                'label'=>'avatar (IMG FILE)',
                'mapped'=>false,
                'required'=>false,
              'constraints'=>[
                    new Image([
                        'minWidth' => 50,
                        'maxWidth' => 100,
                        'minHeight' => 50,
                        'maxHeight' => 100,
                    ])
                ]
            ])
            ->add('workout', ChoiceType::class, [
                'choices' => [
                    'Workout' => '',
                    'Calisthenics' => 'Calisthenics',
                    'Powerlifting' => 'Powerlifting',
                    'Bodybuilding' => 'Bodybuilding',
                ],
            ])
            ->add('trainingDays', ChoiceType::class, [
                'choices' => [
                    'Training Days' => '',
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
