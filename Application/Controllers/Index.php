<?php
namespace HynageExampleApp\Controllers;
use Hynage\MVC\Controller\Action as Action;

class IndexController extends Action
{
    public function indexAction()
    {
        $this->renderViewScript('Index/Index.phtml');
    }
}