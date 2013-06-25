<?php

namespace Components\Errors\Model;

use Framework\CMS as CMS;
use Framework\System\ORM\ORM;

class Error extends Base\Error
{
    public static function prepareCollection($params)
    {
        $q = ORM::select('Components\Errors\Model\Error e', 'e.*,h.host')
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
        $q = ORM::select('Components\Errors\Model\Error e','COUNT(*) as cnt');
        return (int)$q->fetch('stdClass')->cnt;
    }

    public static function getTodayCount()
    {
        $q = ORM::select('Components\Errors\Model\Error e','COUNT(*) as cnt')
            ->where('DATE(e.updated) = ?', gmdate('Y-m-d'));
        return (int)$q->fetch('stdClass')->cnt;
    }

//    public static function getCollection($host = null)
//    {
//        $q = ORM::select('Site_Model_Error e', 'e.*,p.host')
//            ->innerJoin('Site_Model_Host p', array('id', 'e.host_id'));
//        if($host) {
//            $q->andWhere('e.host_id = ?', $host->id);
//        }
//        $q->orderBy('e.updated DESC');
//
//        return new CMS_ORM_Collection($q);
//    }
//
//    public static function getByIds($ids)
//    {
//        $q = Site_Model_Error::select()
//                    ->whereIn('id', $ids);
//
//        return $q->fetchAll();
//    }
//
//    public static function getNewCount($lastDate)
//    {
//        $q = Site_Model_Error::select('COUNT(*) as count');
//        if ($lastDate) {
//            $q->where('updated > FROM_UNIXTIME(?)', (int)$lastDate);
//        }
//        return (float)$q->fetch('stdClass')->count;
//    }
//
//    public static function create(Site_Model_Host $host, $errorData)
//    {
//        $o = new Site_Model_Error();
//        $o->fromArray($errorData);
//        $o->host_id = $host->id;
//        $o->count = 1;
//
//        return $o;
//    }
//
    public function toArray()
    {
        $arr = parent::toArray();
        $arr['host'] = isset($this->host) ? $this->host : $this->Host->host;
        return $arr;
    }

    public function moveToArchive()
    {
        $arr = $this->toArray();
        $item = new ErrorArchive();
        $item->fromArray($arr);
        $item->save();

        $this->delete();
    }

//    public static function find(Site_Model_Host $host, $errorData)
//    {
//        $q = Site_Model_Error::select()
//            ->where('code = ?', $errorData['code'])
//            ->andWhere('message = ?', $errorData['message'])
//            ->andWhere('file = ?', $errorData['file'])
//            ->andWhere('url = ?', $errorData['url'])
//            ->andWhere('host_id = ?', $host->id)
//            ->limit(1);
//        return $q->fetch();
//    }
}
