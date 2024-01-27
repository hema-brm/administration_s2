<?php

namespace App\Form\Field;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EasyVowsImageType extends VichImageType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'image_preview_class' => [],
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['image_preview_class'] = $options['image_preview_class'];
        parent::buildView($view, $form, $options);
    }

    public function getBlockPrefix(): string
    {
        return 'easy_vows_image';
    }
}