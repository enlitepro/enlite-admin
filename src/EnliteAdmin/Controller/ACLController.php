<?php

namespace EnliteAdmin\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Permissions\Acl\Acl;

class ACLController extends AbstractActionController
{

    public function indexAction()
    {
        /** @var Acl $acl */
        $acl = $this->getServiceLocator()->get('EnliteAdminACLProvider');
        /** @var Form $filterForm */
        $filterForm = $this->getServiceLocator()->get('EnliteAdminACLFilterForm');
        $filterForm->setData($this->params()->fromQuery());

        if ($filterForm->isValid()) {
            $filter = $filterForm->getData()['filter'];
        } else {
            $filter = null;
        }

        $resources = array();
        $routeResources = array();
        foreach ($acl->getResources() as $resource) {
            if (!$filter || strpos($resource, $filter) !== false) {
                if (strpos($resource, 'route/') === 0) {
                    $routeResources[] = $resource;
                } else {
                    $resources[] = $resource;
                }
            }
        }

        $table = array();
        foreach ($acl->getRoles() as $role) {
            $table[$role] = array();

            foreach ($acl->getResources() as $resource) {
                if (!$filter || strpos($resource, $filter) !== false) {
                    $table[$role][$resource] = $acl->isAllowed($role, $resource);
                }
            }
        }

        return array(
            'filter' => $filterForm,
            'table' => $table,
            'resources' => $resources,
            'routeResources' => $routeResources,
        );
    }

}
