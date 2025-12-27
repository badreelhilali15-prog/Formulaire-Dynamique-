<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $form, array $options): void
    {
            $form
            ->add('quantity', IntegerType::class, [
            'label' => 'Number of items',
                'required' => true,
                      'data' => 1,
                'attr' => [
                    'min' => 1,
                    'max' => 99,
                    'class' => 'form-control',
                    'placeholder' => 'Qty'
                ]
        ])

                   ->add('color', ChoiceType::class, [
                'label' => 'Product color',
                    'placeholder' => 'Choose a color',
                'choices' => [
                       'Black (Matte)' => 'black',
                        'White (Pearl)' => 'white',
                    'Silver Gray'   => 'silver',
                ],
                  'attr' => [
                    'class' => 'form-select'
                ]
       ])

                ->add('submit', SubmitType::class, [
                'label' => 'Add product',
                'attr' => [
                    'class' => 'btn btn-success w-100'
                ]
            ]);
    }
}

