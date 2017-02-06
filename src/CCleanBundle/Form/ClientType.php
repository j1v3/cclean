<?php

namespace CCleanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use CCleanBundle\Entity\Client;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', array(
            'label' => 'Nom d\'utilisateur',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Entrez votre nom d\'utilisateur'
                )
            ))
            ->add('name', 'text', array(
            'label' => 'Nom',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Entrez votre nom'
                )
            ))
            ->add('surname', 'text', array(
                'label' => 'Prénom',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre prénom'
                )
            ))
//            ->add('adress1')
//            ->add('zip1')
//            ->add('city1')
//            ->add('adress2')
//            ->add('zip2')
//            ->add('city2')
//            ->add('tel1')
//            ->add('tel2')
//            ->add('fax')
            ->add('mail', 'email', array(
                'label' => 'Email',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre email'
                )
            ))
            ->add('company', 'text', array(
                'label' => 'Entreprise',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom de votre entreprise'
                )
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'label' => 'Mot de passe',
                'invalid_message' => 'Les mots de passes doivent correspondre !',
                'options' => array(
                    'attr' => array(
                        'class' => 'password-field form-control',
                        'placeholder' => 'Mot de passe'
                        )),
                'required' => true,
                'first_options'  => array('label' => ' '),
                'second_options' => array('label' => ' '),
            ))
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt')
//            ->add('validatedAt')
//            ->add('deletedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Client::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ccleanbundle_client';
    }


}
