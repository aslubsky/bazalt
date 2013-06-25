<?php
/**
 * Data model for table "errors"
 *
 * @category  DataModel
 * @package   DataModel
 * @author    DataModel Generator v1.1
 * @version   Revision
 *
 * @property-read int id
 * @property-read int host_id
 * @property-read int redmine_id
 * @property-read int code
 * @property-read string message
 */

namespace Components\Errors\Model\Base;

use Framework\CMS as CMS;

abstract class Error extends \Framework\CMS\ORM\Record
{
    const TABLE_NAME = 'errors';

    const MODEL_NAME = 'Components\Errors\Model\Error';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::MODEL_NAME);
    }

    protected function initFields()
    {
        $this->hasColumn('id', 'PUA:int(10)');
        $this->hasColumn('host_id', 'U:int(10)');
        $this->hasColumn('code', 'U:int(10)');
        $this->hasColumn('message', 'N:text');
        $this->hasColumn('file', 'N:varchar(255)');
        $this->hasColumn('count', 'U:int(10)');
        $this->hasColumn('trace', 'N:text');
        $this->hasColumn('request', 'N:text');
        $this->hasColumn('session', 'N:text');
        $this->hasColumn('url', 'N:varchar(255)');
    }

    public function initRelations()
    {
        $this->hasRelation('Host', new \ORM_Relation_One2One('Components\Errors\Model\Host', 'host_id', 'id'));
    }

    public function initPlugins()
    {
        $this->hasPlugin('Framework\System\ORM\Plugin\Timestampable', [
            'created' => 'created',
            'updated' => 'updated'
        ]);
    }
}