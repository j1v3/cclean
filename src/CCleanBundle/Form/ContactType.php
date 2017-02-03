<?php
/**
 * Created by PhpStorm.
 * User: j1v3
 * Date: 02/02/17
 * Time: 19:40
 */

namespace CCleanBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'Nom',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Entrez votre nom'
            )

        ));
        $builder->add('surname', 'text', array(
            'label' => 'Prénom',
            'required' => false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Entrez votre prénom'
            )
        ));
        $builder->add('mail', 'email', array(
            'label' => 'Email',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Entrez votre email'
            )
        ));
        $builder->add('subject', 'text', array(
            'label' => 'Sujet',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Demande de devis ?'
            )
        ));
        $builder->add('body', 'textarea', array(
            'label' => 'Message',
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Votre message',
                'rows' => '20'
            )
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}