<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class Member extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $memberId;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=false)
     */
    public $mobile;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=8, nullable=false)
     */
    public $encrypt;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $avatar;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $nickname;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $qqToken;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $wxToken;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $lastLogin;

    /**
     *
     * @var string
     * @Column(type="string", length=16, nullable=false)
     */
    public $loginIp;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $registerTime;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("appbase");
        $this->setSource("ab_member");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ab_member';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbMember[]|AbMember|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbMember|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
