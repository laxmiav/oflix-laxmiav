<?php

namespace App\Form;

use App\Entity\Casting;
use App\Entity\Person;
use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CastingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role',TextType::class, [
                'label' => 'role',
            ])
            ->add('credit_order',IntegerType::class, [
                'label' => 'rating',
                
            ])
        //     ->add('person',EntityType::class,[ 'class' => Person::class,
        //     'choice_label' => 'name',
        //    'expanded' => true,
        //    'multiple' => true,
        // 'choice_value' => 'id'
        //     ])
        //     ->add('movie',EntityType::class,[ 'class' => Movies::class,
        //     'choice_label' => 'name',
        //    'expanded' => true,
        //    'multiple' => true,
        // 'choice_value' => 'id'
        //     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Casting::class,
        ]);
    }
}
