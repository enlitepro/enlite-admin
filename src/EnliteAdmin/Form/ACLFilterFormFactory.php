<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Form;


use Zend\Form\Element;
use Zend\Form\Form;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ACLFilterFormFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new Form();
        $form->add(new Element\Text('filter'), ['label' => 'Resource']);
        $form->add(new Element\Button('submit'), ['label' => 'filter']);

        $form->setAttribute('method', 'GET');
        $form->get('submit')->setAttribute('type', 'submit');

        return $form;
    }
}