<?php

namespace Sly\Bundle\VMBundle\Form\Type;

use Sly\Bundle\VMBundle\Config\VMCollection;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * VM form type.
 *
 * @uses \Symfony\Component\Form\AbstractType
 * @author Cédric Dugat <cedric@dugat.me>
 */
class VMType extends AbstractType
{
    /**
     * @var \Sly\Bundle\VMBundle\Config\VMCollection
     */
    private $vmCollection;

    /**
     * Constructor.
     *
     * @param \Sly\Bundle\VMBundle\Config\VMCollection $vmCollection VM collection
     */
    public function __construct(VMCollection $vmCollection)
    {
        $this->vmCollection = $vmCollection;
    }

    /**
     * buildForm
     *
     * @param FormBuilder $builder
     * @param array       $options
     * @access public
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $vmConfig = $this->vmCollection->get('default');

        foreach (array_keys($vmConfig) as $configPart) {
            foreach (array_keys($vmConfig[$configPart]) as $configParameter) {
                $fieldName = sprintf('%s_%s', $configPart, $configParameter);

                if (is_bool($vmConfig[$configPart][$configParameter])) {
                    $builder->add($fieldName, 'checkbox', array(
                        'required' => false,
                        'data' => $vmConfig[$configPart][$configParameter],
                    ));
                } else {
                    $builder->add($fieldName, 'text', array(
                        'required' => false,
                        'data' => $vmConfig[$configPart][$configParameter],
                    ));
                }
            }
        }

        $builder
            ->add('file_systemBashRc', 'file', array('required' => false))
            ->add('file_systemBashAliases', 'file', array('required' => false))
            ->add('file_vhost', 'file', array('required' => false))
            ->add('file_phpIni', 'file', array('required' => false))
            ->add('file_phpCliIni', 'file', array('required' => false))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $defaultOptions = array(
            // 'data_class' => 'Sly\Bundle\VMBundle\Model\VM',
        );

        $resolver->setDefaults($defaultOptions);
        $resolver->addAllowedValues(array());
    }

    /**
     * getName
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'sly_vm_form_type_vm';
    }
}
