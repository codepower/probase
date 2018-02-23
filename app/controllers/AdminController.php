<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class AdminController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for ab_admin
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Admin', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "userId";

        $ab_admin = Admin::find($parameters);
        if (count($ab_admin) == 0) {
            $this->flash->notice("The search did not find any ab_admin");

            $this->dispatcher->forward([
                "controller" => "ab_admin",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $ab_admin,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a ab_admin
     *
     * @param string $userId
     */
    public function editAction($userId)
    {
        if (!$this->request->isPost()) {

            $ab_admin = Admin::findFirstByuserId($userId);
            if (!$ab_admin) {
                $this->flash->error("ab_admin was not found");

                $this->dispatcher->forward([
                    'controller' => "ab_admin",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->userId = $ab_admin->userId;

            $this->tag->setDefault("userId", $ab_admin->userId);
            $this->tag->setDefault("username", $ab_admin->username);
            $this->tag->setDefault("password", $ab_admin->password);
            $this->tag->setDefault("encrypt", $ab_admin->encrypt);
            $this->tag->setDefault("realname", $ab_admin->realname);
            $this->tag->setDefault("lastloginip", $ab_admin->lastloginip);
            $this->tag->setDefault("lastlogintime", $ab_admin->lastlogintime);
            $this->tag->setDefault("email", $ab_admin->email);
            
        }
    }

    /**
     * Creates a new ab_admin
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'index'
            ]);

            return;
        }

        $ab_admin = new Admin();
        $ab_admin->username = $this->request->getPost("username");
        $ab_admin->password = $this->request->getPost("password");
        $ab_admin->encrypt = $this->request->getPost("encrypt");
        $ab_admin->realname = $this->request->getPost("realname");
        $ab_admin->lastloginip = $this->request->getPost("lastloginip");
        $ab_admin->lastlogintime = $this->request->getPost("lastlogintime");
        $ab_admin->email = $this->request->getPost("email", "email");
        

        if (!$ab_admin->save()) {
            foreach ($ab_admin->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("ab_admin was created successfully");

        $this->dispatcher->forward([
            'controller' => "ab_admin",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a ab_admin edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'index'
            ]);

            return;
        }

        $userId = $this->request->getPost("userId");
        $ab_admin = Admin::findFirstByuserId($userId);

        if (!$ab_admin) {
            $this->flash->error("ab_admin does not exist " . $userId);

            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'index'
            ]);

            return;
        }

        $ab_admin->username = $this->request->getPost("username");
        $ab_admin->password = $this->request->getPost("password");
        $ab_admin->encrypt = $this->request->getPost("encrypt");
        $ab_admin->realname = $this->request->getPost("realname");
        $ab_admin->lastloginip = $this->request->getPost("lastloginip");
        $ab_admin->lastlogintime = $this->request->getPost("lastlogintime");
        $ab_admin->email = $this->request->getPost("email", "email");
        

        if (!$ab_admin->save()) {

            foreach ($ab_admin->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'edit',
                'params' => [$ab_admin->userId]
            ]);

            return;
        }

        $this->flash->success("ab_admin was updated successfully");

        $this->dispatcher->forward([
            'controller' => "ab_admin",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a ab_admin
     *
     * @param string $userId
     */
    public function deleteAction($userId)
    {
        $ab_admin = Admin::findFirstByuserId($userId);
        if (!$ab_admin) {
            $this->flash->error("ab_admin was not found");

            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'index'
            ]);

            return;
        }

        if (!$ab_admin->delete()) {

            foreach ($ab_admin->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "ab_admin",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("ab_admin was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "ab_admin",
            'action' => "index"
        ]);
    }

}
