<?php

namespace App\Form;

use App\Entity\FeedbackRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedbackRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Имя',
                'attr' => [
                    'placeholder' => 'Введите имя'
                ]
            ])
            ->add('email', EmailType::class)
            ->add('topic', ChoiceType::class, [
                'choices' => array_flip(FeedbackRequest::$topics),
                'placeholder' => 'Выберите тему',
                'label' => 'Тема'
            ])
            ->add('message', null, [
                'label' => 'Сообщение'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FeedbackRequest::class,
        ]);
    }
}
