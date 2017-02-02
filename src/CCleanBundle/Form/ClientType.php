<?php

namespace CCleanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pseudo')->add('name')->add('surname')->add('adress1')->add('zip1')->add('city1')->add('adress2')->add('zip2')->add('city2')->add('tel1')->add('tel2')->add('fax')->add('mail')->add('createdAt')->add('updatedAt')->add('validatedAt')->add('deletedAt')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCleanBundle\Entity\Client'
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
