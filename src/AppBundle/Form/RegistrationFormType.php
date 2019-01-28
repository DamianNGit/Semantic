<?php


namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;


use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imie', null, [
                'label' => false,
                'attr' => array('placeholder' => 'Podaj imię')
            ])
            ->add('nazwisko', null, [
                'label' => false,
                'attr' => array('placeholder' => 'Podaj Nazwisko')
            ])
            ->add('email', EmailType::class, array('label' => false,'attr' => array('placeholder' => 'Podaj e-mail'), 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => false,'attr' => array('placeholder' => 'Podaj nazwę użytkownika'), 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => false, 'attr' => array('placeholder' => 'Podaj hasło')),
                'second_options' => array('label' => false, 'attr' => array('placeholder' => 'Powtórz hasło')),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;
    }


}