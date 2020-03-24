<?php
//namespace Models;
use Phalcon\Mvc\Model;

class Spot extends Model {
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $spot_name;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $cellphone;

    /**
     *
     * @var string
     */
    public $email_adress;

    /**
     *
     * @var string
     */
    public $adress;

    /**
     *
     * @var string
     */
    public $about;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $facebook;

    /**
     *
     * @var string
     */
    public $instagram;

    /**
     *
     * @var string
     */
    public $youtube;

    /**
     *
     * @var string
     */
    public $twitter;

    /**
     *
     * @var string
     */
    public $start_time;

    /**
     *
     * @var string
     */
    public $end_time;

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
        $this->setSource("spot");
        $this->belongsTo('status_id', 'Status', 'id', ['alias' => 'Status']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spot[]|Spot|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Spot|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}