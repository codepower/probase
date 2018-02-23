<?php

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class AbAdmin extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="userId", type="integer", length=8, nullable=false)
     */
    public $userId;

    /**
     *
     * @var string
     * @Column(column="username", type="string", length=32, nullable=false)
     */
    public $username;

    /**
     *
     * @var string
     * @Column(column="password", type="string", length=32, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(column="encrypt", type="string", length=8, nullable=false)
     */
    public $encrypt;

    /**
     *
     * @var string
     * @Column(column="realname", type="string", length=32, nullable=false)
     */
    public $realname;

    /**
     *
     * @var string
     * @Column(column="lastloginip", type="string", length=20, nullable=false)
     */
    public $lastloginip;

    /**
     *
     * @var integer
     * @Column(column="lastlogintime", type="integer", length=10, nullable=false)
     */
    public $lastlogintime;

    /**
     *
     * @var string
     * @Column(column="email", type="string", length=32, nullable=false)
     */
    public $email;

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
        $this->setSource("ab_admin");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'ab_admin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbAdmin[]|AbAdmin|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AbAdmin|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
