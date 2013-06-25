<?php

namespace Components\Errors\Model;

use Framework\CMS as CMS;
use Framework\System\ORM\ORM;

class Host extends Base\Host
{
//    public static function getNewCount($hostId)
//    {
//        $q = \Host::select('COUNT(*) as count')
//            ->where('id > ?', $hostId);
//        return (int)$q->fetch('stdClass')->count;
//    }

//    public static function getLastId()
//    {
//        $q = \Host::select('id')
//            ->orderBy('id DESC')
//            ->limit(1);
//        return (int)$q->fetch('stdClass')->id;
//    }
    
    public static function getOrCreate($hostname)
    {
        $q = \Host::select()
            ->where('host = ?', $hostname)
            ->limit(1);
        $host = $q->fetch();
        if(!$host) {
            $host = new \Host();
            $host->host = $hostname;
            $host->save();
        }
        
        return $host;
    }
    
    public static function getTotalCount()
    {
        $q = ORM::select('Components\Errors\Model\Host h','COUNT(*) as cnt');
        return (int)$q->fetch('stdClass')->cnt;
    }

    public static function getCollection()
    {
        $q = ORM::select('Components\Errors\Model\Host h','h.*')
            ->innerJoin('Components\Errors\Model\HostRefUser ref', array('host_id','p.id'))
            ->where('ref.user_id = ?', CMS\User::get()->id);
        return new CMS\ORM\Collection($q);
    }

    public static function prepareCollection($params)
    {
        $q = ORM::select('Components\Errors\Model\Host h','h.*')
            ->innerJoin('Components\Errors\Model\HostRefUser ref', array('host_id','h.id'))
            ->where('ref.user_id = ?', CMS\User::get()->id);
        return new CMS\ORM\Collection($q);
    }
    
    public static function getList()
    {
        $q = ORM::select('Components\Errors\Model\Host p', 'p.*')
            ->innerJoin('Components\Errors\Model\HostRefUser ref', array('host_id','p.id'))
            ->where('ref.user_id = ?', CMS\User::get()->id);
//        echo$q->toSQL();exit;
        return $q->fetchAll();
    }


    public static function getByIds($ids)
    {
        $q = \Host::select()
            ->whereIn('id', $ids);
        return $q->fetchAll();
    }
}
