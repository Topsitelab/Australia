<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $age = [];
        for ($i = 18; $i <= 80; $i++) {
            $age[$i] = $i;
        }

        $height = [];
        for ($j = 155; $j <= 220; $j++) {
            $height[$j] = $j;
        }

        $builder
            ->add('account', TextType::class)
            ->add('country', CountryType::class)
            ->add('city', TextType::class)
            ->add('gender', ChoiceType::class, [
                //'placeholder' => 'Choose your gender',
                'choices'  => [
                    'MALE' => 'MALE',
                    'FEMALE' => 'FEMALE',
                ],
            ])
            ->add('age', ChoiceType::class, [
                //'placeholder' => 'Choose your age',
                'choices'  => $age,
            ])
            ->add('height', ChoiceType::class, [
                //'placeholder' => 'Choose your height, cm',
                'choices'  => $height,
            ])
            ->add('bodytype', ChoiceType::class, [
                //'placeholder' => 'Choose your body type',
                'choices'  => [
                    'SLIM' => 'SLIM',
                    'NORMAL' => 'NORMAL',
                    'ATHLETIC' => 'ATHLETIC',
                    'SLIGHTLY OVERWEIGHT' => 'SLIGHTLY OVERWEIGHT',
                    'OVERWEIGHT' => 'OVERWEIGHT',
                ],
            ])
            ->add('ethnicity', ChoiceType::class, [
                //'placeholder' => 'Choose your ethnicity',
                'choices'  => [
                    'ethnicity 1' => 'ethnicity 1',
                    'ethnicity 2' => 'ethnicity 2',
                    'ethnicity 3' => 'ethnicity 3',
                ],
            ])
            ->add('phone', TextType::class)
            ->add('employment', ChoiceType::class, [
                //'placeholder' => 'Choose your employment',
                'choices'  => [
                    'INDUSTRY' => 'INDUSTRY',
                    'UNEMPLOYED' => 'UNEMPLOYED',
                ],
            ])
            ->add('sexuality', ChoiceType::class, [
                //'placeholder' => 'Choose your sexuality',
                'choices'  => [
                    'STRAIGHT' => 'STRAIGHT',
                    'GAY-LESBIAN' => 'GAY-LESBIAN',
                ],
            ])
            ->add('prefer', ChoiceType::class, [
                //'placeholder' => 'Who would you like to meet',
                'choices'  => [
                    'OLDER' => 'OLDER',
                    'YOUNGER' => 'YOUNGER',
                    'OLDER, SAME AGE' => 'OLDER, SAME AGE',
                    'SPECIFY AGE LIMIT' => 'SPECIFY AGE LIMIT',
                ],
            ])
            ->add('purpose', ChoiceType::class, [
                //'placeholder' => 'Purpose of date',
                'choices'  => [
                    'Ongoing relationship' => 'Ongoing relationship',
                    'Marriage' => 'Marriage',
                    'Casual fun, no strings attached' => 'Casual fun, no strings attached',
                    'Friendship, entirely platonic' => 'Friendship, entirely platonic',
                ],
            ])
            ->add('save', SubmitType::class)
        ;
    }
}