<?php
//namespace Models;
use Phalcon\Mvc\Model;

class SpotServices extends Model {
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $spot_id;

    /**
     *
     * @var integer
     */
    public $service_id;

    /**
     *
     * @var integer
     */
    public $created_by_user_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("dbmsds");
        $this->setSource("spot_services");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SpotServices[]|SpotServices|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SpotServices|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}