<?php
/**
 * Created by PhpStorm.
 * User: shenzhe
 * Date: 2016/11/21
 * Time: 11:38
 */

namespace sdk;

use common\Utils;
use ZPHP\Client\Rpc\Udp;
use scheduler\Scheduler;
use ZPHP\Core\Config as ZConfig;

use common\Consts;


class MonitorClient
{

    /**
     * @param $api
     * @param $time
     * @desc 服务方耗时上报
     */
    public static function serviceDot($api, $time)
    {
        if (ZConfig::get('project_name') == Consts::MONITOR_SERVER_NAME ||
            ZConfig::get('project_name') == Consts::REGISTER_SERVER_NAME
        ) {
            return;
        }
        try {
            $client = UdpClient::getService(Consts::MONITOR_SERVER_NAME, 3000, [], 0);
            $serverIp = ZConfig::getField('soa', 'serverIp', ZConfig::getField('socket', 'host'));
            if ('0.0.0.0' == $serverIp) {
                $serverIp = Utils::getLocalIp();
            }
            $client->setApi('dot')->setDot(0)->call('service',
                [
                    'serviceName' => ZConfig::getField('soa', 'serverName', ZConfig::get('project_name')),
                    'serviceIp' => $serverIp,
                    'servicePort' => ZConfig::getField('soa', 'serverPort', ZConfig::getField('socket', 'port')),
                    'api' => $api,
                    'time' => $time
                ]
            );
        } catch (\Exception $e) {

        }
    }

    /**
     * @param $api
     * @param $time
     * @desc 调用方耗时上线
     */
    public static function clientDot($api, $time)
    {
        if (ZConfig::get('project_name') == Consts::MONITOR_SERVER_NAME ||
            ZConfig::get('project_name') == Consts::REGISTER_SERVER_NAME
        ) {
            return;
        }
        try {
            $client = UdpClient::getService(Consts::MONITOR_SERVER_NAME, 3000, [], 0);
            $serverIp = ZConfig::getField('soa', 'serverIp', ZConfig::getField('socket', 'host'));
            if ('0.0.0.0' == $serverIp) {
                $serverIp = Utils::getLocalIp();
            }
            $client->setApi('dot')->setDot(0)->call('client',
                [
                    'serviceName' => ZConfig::getField('soa', 'serverName', ZConfig::get('project_name')),
                    'serviceIp' => $serverIp,
                    'servicePort' => ZConfig::getField('soa', 'serverPort', ZConfig::getField('socket', 'port')),
                    'api' => $api,
                    'time' => $time
                ]
            );
        } catch (\Exception $e) {

        }
    }

    /**
     * @param $api
     * @param $time
     * @desc task任务耗时
     */
    public static function taskDot($api, $time)
    {
        if (ZConfig::get('project_name') == Consts::MONITOR_SERVER_NAME ||
            ZConfig::get('project_name') == Consts::REGISTER_SERVER_NAME
        ) {
            return;
        }
        try {
            $client = UdpClient::getService(Consts::MONITOR_SERVER_NAME, 3000, [], 0);
            $serverIp = ZConfig::getField('soa', 'serverIp', ZConfig::getField('socket', 'host'));
            if ('0.0.0.0' == $serverIp) {
                $serverIp = Utils::getLocalIp();
            }
            $client->setApi('dot')->setDot(0)->call('task',
                [
                    'serviceName' => ZConfig::getField('soa', 'serverName', ZConfig::get('project_name')),
                    'serviceIp' => $serverIp,
                    'servicePort' => ZConfig::getField('soa', 'serverPort', ZConfig::getField('socket', 'port')),
                    'api' => $api,
                    'time' => $time
                ]
            );
        } catch (\Exception $e) {

        }
    }
}