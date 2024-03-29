<?php

namespace App\Form;

use App\Entity\UnidadMedida;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadMedidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigo', TextType::class, [
                'label' => 'Codigo',
            ])
            ->add('unidad_medida', TextType::class, [
                'label' => 'Unidad de Medida',
            ])
            ->add('guardar', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UnidadMedida::class,
        ]);
    }
}
            