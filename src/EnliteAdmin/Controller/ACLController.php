<?php

namespace Admin\Controller;

use BjyAuthorize\Service\Authorize;
use Zend\Mvc\Controller\AbstractActionController;

class ACLController extends AbstractActionController
{

    public function indexAction()
    {
        if (!class_exists('BjyAuthorize\Module')) {
            return $this->createHttpNotFoundModel($this->getResponse());
        }

        $filter = $this->params()->fromQuery('filter');

        /** @var Authorize $auth */
        $auth = $this->getServiceLocator()->get('BjyAuthorize\Service\Authorize');
        $acl = $auth->getAcl();

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
            'filter' => $filter,
            'table' => $table,
            'resources' => $resources,
            'routeResources' => $routeResources,
        );
    }

}
