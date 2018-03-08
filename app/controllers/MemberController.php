<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
class MemberController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }
    /**
     * Searches for member
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isMethod('get') ) {
            $query = Criteria::fromInput($this->di, 'Member', $_POST);
            var_dump($getData);exit;
            $this->persistent->parameters = $query->getParams();
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "memberId";
        $member = Member::find($parameters);
        if (count($member) == 0) {
             $this->dispatcher->forward([
                "controller" => "Member",
                "action" => "index"
            ]);
            return;
        }
        $paginator = new Paginator([
            'data' => $member,
            'limit'=> 10,
            'page' => $numberPage
        ]);
        $this->view->page = $paginator->getPaginate();
        $this->view->menuList=[['menuName'=>'文章管理'],['menuName'=>'用户管理'],['menuName'=>'广告管理'],['menuName'=>'系统管理']];
    }
    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->menuList=[['menuName'=>'文章管理'],['menuName'=>'用户管理'],['menuName'=>'广告管理'],['menuName'=>'系统管理']];
    }
    /**
     * Edits a member
     *
     * @param string $memberId
     */
    public function editAction($memberId)
    {
        $this->view->menuList=[['menuName'=>'文章管理'],['menuName'=>'用户管理'],['menuName'=>'广告管理'],['menuName'=>'系统管理']];
        if (!$this->request->isPost()) {
            $member = Member::findFirstBymemberId($memberId);
            if (!$member) {
                $this->flash->error("member was not found");
                $this->dispatcher->forward([
                    'controller' => "member",
                    'action' => 'index'
                ]);
                return;
            }
            $this->view->memberId = $member->memberId;
            $this->tag->setDefault("memberId", $member->memberId);
            $this->tag->setDefault("mobile", $member->mobile);
            $this->tag->setDefault("email", $member->email);
            $this->tag->setDefault("password", $member->password);
            $this->tag->setDefault("encrypt", $member->encrypt);
            $this->tag->setDefault("avatar", $member->avatar);
            $this->tag->setDefault("nickname", $member->nickname);
            $this->tag->setDefault("qqToken", $member->qqToken);
            $this->tag->setDefault("wxToken", $member->wxToken);
            $this->tag->setDefault("lastLogin", $member->lastLogin);
            $this->tag->setDefault("loginIp", $member->loginIp);
            $this->tag->setDefault("registerTime", $member->registerTime);
            
        }
    }
    /**
     * Creates a new member
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'search'
            ]);
            return;
        }
        $postData=$this->request->getPost();
        $member = new Member();
        $member->mobile = $this->request->getPost("mobile");
        $member->email = $this->request->getPost("email", "email");
        $member->encrypt =Utils::createRandomStr(8);
        $member->password = Utils::encodePassword($this->request->getPost("password"),$member->encrypt);
        $member->avatar =$this->request->getPost("avatar");
        $member->nickname = $this->request->getPost("nickname");
        $member->qqToken ='';
        $member->wxToken ='';
        $member->lastLogin = $this->request->getPost("lastLogin");
        $member->loginIp = $this->request->getPost("loginIp");
        $member->registerTime = time();
        
        if (!$member->save()) {
            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'new'
            ]);
            return;
        }
        $this->flash->success("member was created successfully");
        exit;
        $this->dispatcher->forward([
            'controller' => "member",
            'action' => 'search'
        ]);
    }
    /**
     * Saves a member edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);
            return;
        }
        $memberId = $this->request->getPost("memberId");
        $member = Member::findFirstBymemberId($memberId);
        if (!$member) {
            $this->flash->error("member does not exist " . $memberId);
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);
            return;
        }
        $member->mobile = $this->request->getPost("mobile");
        $member->email = $this->request->getPost("email", "email");
        $member->password = $this->request->getPost("password");
        $member->encrypt = $this->request->getPost("encrypt");
        $member->avatar = $this->request->getPost("avatar");
        $member->nickname = $this->request->getPost("nickname");
        $member->qqToken = $this->request->getPost("qqToken");
        $member->wxToken = $this->request->getPost("wxToken");
        $member->lastLogin = $this->request->getPost("lastLogin");
        $member->loginIp = $this->request->getPost("loginIp");
        $member->registerTime = $this->request->getPost("registerTime");
        
        if (!$member->save()) {
            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'edit',
                'params' => [$member->memberId]
            ]);
            return;
        }
        $this->flash->success("member was updated successfully");
        $this->dispatcher->forward([
            'controller' => "member",
            'action' => 'index'
        ]);
    }
    /**
     * Deletes a member
     *
     * @param string $memberId
     */
    public function deleteAction($memberId)
    {
        $member = Member::findFirstBymemberId($memberId);
        if (!$member) {
            $this->flash->error("member was not found");
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'index'
            ]);
            return;
        }
        if (!$member->delete()) {
            foreach ($member->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "member",
                'action' => 'search'
            ]);
            return;
        }
        $this->flash->success("member was deleted successfully");
        $this->dispatcher->forward([
            'controller' => "member",
            'action' => "index"
        ]);
    }
}