<?php
/**
 * Data model for table "hosts"

 *
 * @property-read int $id
 * @property-read string $host
 */

namespace Components\Errors\Model\Base;

use Framework\CMS as CMS;

abstract class Host extends \Framework\CMS\ORM\Record
{
    const TABLE_NAME = 'hosts';

    const MODEL_NAME = 'Components\Errors\Model\Host';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::MODEL_NAME);
    }

    protected function initFields()
    {
        $this->hasColumn('id', 'PUA:int(10)');
        $this->hasColumn('host', 'N:varchar(255)');
    }

    public function initRelations()
    {
        $this->hasRelation('Users', new \ORM_Relation_Many2Many('CMS_Model_User', 'host_id', 'Site_Model_HostRefUser', 'user_id'));
    }

    public function initPlugins()
    {
    }
}
