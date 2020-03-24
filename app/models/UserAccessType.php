<?php
//namespace Models;
use Phalcon\Mvc\Model;

class UserAccessType extends Model {
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $access_name;

    /**
     *
     * @var integer
     */
    public $status_id;

    /**
     *
     * @var integer
     */
    public $created_by_user_id;

    /**
     *
     * @var integer
     */
    public $update_by_user_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("dbmsds");
        $this->setSource("user_access_type");
        $this->belongsTo('status_id', 'Status', 'id', ['alias' => 'Status']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserAccessType[]|UserAccessType|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserAccessType|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}