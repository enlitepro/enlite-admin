<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Entities;

use EnliteAdmin\Exception\RuntimeException;
use Zend\Stdlib\AbstractOptions;

class EntityOptions extends AbstractOptions
{

    const ALLOW_LIST = 'list';
    const ALLOW_CREATE = 'create';
    const ALLOW_EDIT = 'edit';
    const ALLOW_REMOVE = 'remove';

    /**
     * @var string
     */
    protected $entity;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var array
     */
    protected $fields = ['id', 'title'];

    /**
     * @var array
     */
    protected $allow = ['list', 'create', 'edit', 'remove'];

    /**
     * @var array
     */
    protected $filter;
    
    /**
     * The title
     *
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $form;

    /**
     * The postView
     *
     * @var string
     */
    protected $postView;
    
    /**
     * The order
     *
     * @var array For example ['title' => 'asc'] or ['title']
     */
    protected $order = [];

    /**
     * Set value of Entity
     *
     * @param string $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * Return value of Entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set value of Service
     *
     * @param string $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * Return value of Service
     *
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set value of Fields
     *
     * @param  array                             $fields
     * @throws \EnliteAdmin\Exception\RuntimeException
     */
    public function setFields($fields)
    {
        if (!is_array($fields)) {
            throw new RuntimeException('"fields" must be array');
        }
        $this->fields = $fields;
    }

    /**
     * Return value of Fields
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set value of Allow
     *
     * @param array $allow
     */
    public function setAllow($allow)
    {
        $this->allow = $allow;
    }

    /**
     * Return value of Allow
     *
     * @return array
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * Set value of Filter
     *
     * @param  array                             $filter
     * @throws \EnliteAdmin\Exception\RuntimeException
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    /**
     * Return value of Filter
     *
     * @return array
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return string
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return bool
     */
    public function isAllowCreate()
    {
        return in_array(self::ALLOW_CREATE, $this->getAllow());
    }

    /**
     * @return bool
     */
    public function isAllowEdit()
    {
        return in_array(self::ALLOW_EDIT, $this->getAllow());
    }

    /**
     * @return bool
     */
    public function isAllowRemove()
    {
        return in_array(self::ALLOW_REMOVE, $this->getAllow());
    }

    /**
     * @return bool
     */
    public function isAllowList()
    {
        return in_array(self::ALLOW_LIST, $this->getAllow());
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $postView
     */
    public function setPostView($postView)
    {
        $this->postView = $postView;
    }

    /**
     * @return string
     */
    public function getPostView()
    {
        return $this->postView;
    }

    /**
     * @param array $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getOrder()
    {
        return $this->order;
    }

}
