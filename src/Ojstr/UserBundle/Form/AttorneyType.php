<?php

namespace Ojstr\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttorneyType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('attorneyUserId')
                ->add('targetUserId')
                ->add('untilDatetime')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Ojstr\UserBundle\Entity\Attorney'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'ojstr_userbundle_attorney';
    }

}
