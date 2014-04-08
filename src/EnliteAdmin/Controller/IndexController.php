<?php
/**
 * @author Evgeny Shpilevsky <evgeny@shpilevsky.com>
 */

namespace EnliteAdmin\Controller;

use EnliteAdmin\Configuration;
use EnliteAdmin\Exception\RuntimeException;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{

    public function commandsAction()
    {
        return [
            'commands' => $this->getCommands()
        ];
    }

    public function executeCommandAction()
    {
        if (!$this->getRequest()->isPost()) {
            throw new RuntimeException('For execute command you need send POST');
        }

        $commands = $this->getCommands();
        $name = $this->params()->fromRoute('command');
        if (!isset($commands[$name])) {
            throw new RuntimeException('Undefined command with name "' . $name . '"');
        }

        $returnVar = null;
        $output = [];
        exec($commands[$name], $output, $returnVar);

        return [
            'name' => $name,
            'command' => $commands[$name],
            'returnVar' => $returnVar,
            'output' => $output,
        ];
    }

    /**
     * @return array
     */
    protected function getCommands()
    {
        /** @var Configuration $config */
        $config = $this->getServiceLocator()->get('EnliteAdminConfiguration');
        return $config->getCommands();
    }

}
