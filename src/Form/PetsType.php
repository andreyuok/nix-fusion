<?php

namespace App\Form;

use App\Entity\Pets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('pet_type_id')
            ->add('gender')
            ->add('breed_id')
            ->add('image')
            ->add('age')
            ->add('client_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pets::class,
        ]);
    }
}
