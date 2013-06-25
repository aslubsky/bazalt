<?php

namespace Components\Errors\Model\Webservice;

use Components\Errors\Model\ErrorArchive;
use Framework\CMS\Webservice\Response,
    Framework\System\Session\Session,
    Framework\System\Data as Data,
    Framework\CMS as CMS;
use Framework\Core\Helper\Url;
use Components\Errors\Model\Error;

/**
 * @uri /errors
 */
class Errors extends CMS\Webservice\Rest
{
    /**
     * @method GET
     * @provides application/json
     * @json
     * @return \Tonic\Response
     */
    public function get()
    {
        $id = (int)$_GET['id'];
        if($id) {
            $error = Error::getById($id);
            if(!$error) {//may in archive
                $error = ErrorArchive::getById($id);
            }
            if(!$error) {
                return new Response(404);
            }
            return new Response(200, $error);
        }
        return new Response(200, $this->_getCollection());
    }

    protected function _getCollection()
    {
        $collection = Error::prepareCollection($_GET);

        $filters = isset($_GET['filter']) && $_GET['filter'] ? json_decode($_GET['filter'], true) : array();
        if(count($filters) > 0) {
            if(isset($filters['message'])) {
                $collection->filter('message', $filters['message']);
            }
            if(isset($filters['host'])) {
                $collection->filter('host', $filters['host'], function($val, $collection){
                    $collection->andWhere('e.host_id = ?', $val);
                });
            }
        }
        return $collection;
    }

    /**
     * @method DELETE
     * @provides application/json
     * @json
     * @return \Tonic\Response
     */
    public function delete()
    {
        $id = (int)$_GET['id'];
        $error = Error::getById($id);
        if(!$error) {
            return new Response(404);
        }
        $error->moveToArchive();
        return new Response(200, $this->_getCollection());
    }
}
