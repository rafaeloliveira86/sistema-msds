<?php
//namespace Models;
use Phalcon\Mvc\Model;

class Status extends Model {
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $status_name;

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
        $this->setSource("status");
        $this->hasMany('id', 'Categories', 'status_id', ['alias' => 'Categories']);
        $this->hasMany('id', 'Couses', 'status_id', ['alias' => 'Couses']);
        $this->hasMany('id', 'Media', 'status_id', ['alias' => 'Media']);
        $this->hasMany('id', 'Services', 'status_id', ['alias' => 'Services']);
        $this->hasMany('id', 'Spot', 'status_id', ['alias' => 'Spot']);
        $this->hasMany('id', 'User', 'status_id', ['alias' => 'User']);
        $this->hasMany('id', 'UserAccessType', 'status_id', ['alias' => 'UserAccessType']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Status[]|Status|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Status|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}