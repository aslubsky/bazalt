<?php

namespace Components\Errors\Model;

use Framework\CMS as CMS;
use Framework\System\ORM\ORM;

class ErrorArchive extends Base\ErrorArchive
{
    public static function prepareCollection($params)
    {
        $q = ORM::select('Components\Errors\Model\ErrorArchive e', 'e.*,h.host')
            ->innerJoin('Components\Errors\Model\Host h', array('id', 'e.host_id'))
            ->innerJoin('Components\Errors\Model\HostRefUser ref', array('host_id','h.id'))
            ->where('ref.user_id = ?', CMS\User::get()->id);
//        if($host) {
//            $q->andWhere('e.host_id = ?', $host->id);
//        }
        $q->orderBy('e.updated DESC');
//        echo $q->toSql();exit;

        return new CMS\ORM\Collection($q);
    }

    public static function getTotalCount()
    {
        $q = ORM::select('Components\Errors\Model\ErrorArchive e','COUNT(*) as cnt');
        return (int)$q->fetch('stdClass')->cnt;
    }

    public static function getTodayCount()
    {
        $q = ORM::select('Components\Errors\Model\ErrorArchive e','COUNT(*) as cnt')
            ->where('DATE(e.updated) = ?', gmdate('Y-m-d'));
        return (int)$q->fetch('stdClass')->cnt;
    }

    public function toArray()
    {
        $arr = parent::toArray();
        $arr['host'] = isset($this->host) ? $this->host : $this->Host->host;
        return $arr;
    }
}
