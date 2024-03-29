<?php

namespace App\Form;

use App\Entity\ProductoServicio;
use App\Entity\Rubro;
use App\Entity\UnidadMedida;
use App\Entity\CondicionIva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductoServicioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('tipo', ChoiceType::class, [
            'label' => 'Tipo',
            'choices' => [
                'Producto' => 'P',
                'Servicio' => 'S',
            ],
        ])
        ->add('idRubro', EntityType::class, [
            'class' => Rubro::class,
            'label' => 'Rubro',
            'choice_label' => 'rubro',
        ])
        ->add('codigo', TextType::class, [
            'label' => 'Código',
        ])
        ->add('producto_servicio', TextType::class, [
            'label' => 'Producto / Servicio',
        ])
        ->add('idUnidadMedida', EntityType::class, [
            'class' => UnidadMedida::class,
            'label' => 'Unidad de Medida',
            'choice_label' => 'unidad_medida',
        ])
        ->add('idCondicionIva', EntityType::class, [
            'class' => CondicionIva::class,
            'label' => 'Condición de IVA',
            'choice_label' => 'condicion_iva',
        ])
        ->add('precioBrutoUnitario', TextType::class, [
            'label' => 'Precio Unitario',
        ])
            ->add('guardar', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductoServicio::class,
        ]);
    }
}
            