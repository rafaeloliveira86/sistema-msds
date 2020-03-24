<?php
//namespace Models;
use Phalcon\Mvc\Model;

class Couses extends Model {
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $course_cod;

    /**
     *
     * @var string
     */
    public $course_nome;

    /**
     *
     * @var string
     */
    public $url;

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
        $this->setSource("couses");
        $this->belongsTo('status_id', 'Status', 'id', ['alias' => 'Status']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Couses[]|Couses|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Couses|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}