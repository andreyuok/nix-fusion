<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AddClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class, [
            'required'   => true,
            'label' => 'Email @',
            'invalid_message' => 'You entered an invalid value, it should include letters',
            'row_attr' => [
                'class' => 'input-group mt-3 mb-3 ',
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Это обязательное поле. Введите email',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
                new Email([
                    'message' => 'Введенный email некорректный. Формат: username@example.com',
                ]),
            ],
        ]);
        $builder->add('firstname', TextType::class, [
            'label' => 'Имя',
            'attr' => [
                'placeholder' => 'имя',
            ],
            'row_attr' => [
                'class' => 'form-floating mt-3 mb-3',
            ],
        ]);
        $builder->add('lastname', TextType::class, [
            'label' => 'Фамилия',
            'attr' => [
                'placeholder' => 'фамилия',
            ],
            'row_attr' => [
                'class' => 'form-floating mt-3 mb-3',
            ],
        ]);
        $builder->add('phone', TelType::class, [
            'label' => 'Телефон',
            'attr' => [
                'placeholder' => 'телефон',
            ],
            'row_attr' => [
                'class' => 'form-floating mt-3 mb-3',
            ],
        ]);
        $builder->add('save', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary mt-3 mb-3'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
