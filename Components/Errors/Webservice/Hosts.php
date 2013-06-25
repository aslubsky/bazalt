<?php

namespace Components\Errors\Webservice;

use Framework\CMS\Webservice\Response,
    Framework\System\Session\Session,
    Framework\System\Data as Data,
    Framework\CMS as CMS;
use Framework\Core\Helper\Url;
use Components\Errors\Model\Host;

/**
 * @uri /hosts
 */
class Hosts extends CMS\Webservice\Rest
{    /**
     * @method GET
     * @provides application/json
     * @json
     * @return \Tonic\Response
     */
    public function get()
    {
        $collection = Host::prepareCollection($_GET);
        return new Response(200, $collection);
    }
}
