<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Controller;

use EnliteAdmin\Entities\Entity;
use EnliteAdmin\Service\EntityService;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;

class EntityController extends AbstractActionController
{

    /**
     * @var EntityService
     */
    protected $entityService;

    /**
     * @return array
     */
    public function indexAction()
    {
        return array(
            'entities' => $this->getEntityService()->getEntities()->getEntities()
        );
    }

    /**
     * @return array
     */
    public function listAction()
    {
        $entity = $this->loadEntity();

        if (!$entity->getOptions()->isAllowList()) {
            return $this->notFoundAction();
        }

        $filter = $entity->getService()->getFilterForm();
        $filter->setData($this->params()->fromQuery());
        $filter->isValid();

        $list = $entity->getService()->getList($filter->getData());
        $list->setCurrentPageNumber($this->params()->fromRoute('page'));

        $table = $this->getEntityService()->createTable($entity, $list);

        return array(
            'entity' => $entity,
            'paginator' => $list,
            'table' => $table,
            'filter' => $filter,
            'filter_open' => count($this->params()->fromQuery()),
            'flashMessages' => $this->getMessages()
        );
    }

    public function createAction()
    {
        $entityName = $this->params()->fromRoute('entity');
        $entity = $this->getEntityService()->getEntity($entityName);

        if (!$entity->getOptions()->isAllowCreate()) {
            return $this->notFoundAction();
        }

        $form = $this->editModel($entity, $entity->getService()->factory());

        return array(
            'entity' => $entity,
            'form' => $form
        );
    }

    public function editAction()
    {
        $entityName = $this->params()->fromRoute('entity');
        $entity = $this->getEntityService()->getEntity($entityName);

        if (!$entity->getOptions()->isAllowEdit()) {
            return $this->notFoundAction();
        }

        $model = $entity->getService()->loadById($this->params()->fromRoute('id'));

        $form = $this->editModel($entity, $model);

        return array(
            'entity' => $entity,
            'model' => $model,
            'form' => $form
        );
    }

    public function removeAction()
    {
        $entity = $this->loadEntity();

        if (!$entity->getOptions()->isAllowRemove()) {
            return $this->notFoundAction();
        }

        $model = $entity->getService()->loadById($this->params()->fromPost('id'));
        $entity->getService()->remove($model);
        $this->getEntityManager()->flush();

        return $this->redirect()->toRoute('admin/entity/entity', ['entity' => $entity->getName()]);
    }

    /**
     * @param Entity $entity
     * @param $model
     * @return array
     */
    public function editModel($entity, $model)
    {
        $form = $entity->getService()->getForm();
        $form->bind($model);

        if ($this->getRequest()->isPost()) {
            $form->setData(array_merge($this->params()->fromPost(), $this->params()->fromFiles()));
            if ($form->isValid()) {
                $entity->getService()->save($model);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addSuccessMessage('Saved');
                $this->redirect()->toRoute('admin/entity/entity', ['entity' => $entity->getName()]);
            }
        }

        return $form;
    }

    /**
     * @return Entity
     */
    public function loadEntity()
    {
        $entityName = $this->params()->fromRoute('entity');
        return $this->getEntityService()->getEntity($entityName);
    }

    /**
     * @return \EnliteAdmin\Service\EntityService
     */
    public function getEntityService()
    {
        if (null === $this->entityService) {
            $this->entityService = $this->getServiceLocator()->get('EnliteAdminEntityService');
        }

        return $this->entityService;
    }

    /**
     * @param \EnliteAdmin\Service\EntityService $entityService
     */
    public function setEntityService($entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->flashMessenger()->getSuccessMessages();
    }

}
