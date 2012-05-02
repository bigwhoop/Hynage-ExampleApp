<?php
namespace HynageExampleApp\Controllers;
use Hynage\MVC\Controller\Action as Action;

class AboutController extends Action
{
    public function indexAction()
    {
        $this->redirect('/about/hynage');
    }
    
    public function hynageAction()
    {
        $this->renderViewScript('About/Hynage.phtml');
    }
}