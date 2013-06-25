<?php
/**
 * Data model for table "hosts_ref_users"

 *
 * @property-read int $id
 * @property-read string $host
 */

namespace Components\Errors\Model\Base;

use Framework\CMS as CMS;

abstract class HostRefUser extends \Framework\CMS\ORM\Record
{
    const TABLE_NAME = 'hosts_ref_users';

    const MODEL_NAME = 'Components\Errors\Model\HostRefUser';

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::MODEL_NAME);
    }

    protected function initFields()
    {
        $this->hasColumn('host_id', 'PU:int(10)');
        $this->hasColumn('user_id', 'PU:int(10)');
    }

    public function initRelations()
    {
    }

    public function initPlugins()
    {
    }
}