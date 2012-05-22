<?php

class VKontakte_Application
{
    const CURRENT_API_VERSION = '3.0';

    protected $apiId;

    protected $appKey;

    protected $appSecret;

    protected $apiUrl = 'http://api.vk.com/api.php';

    protected $viewerId;

    protected $sessionId = null;

    protected $secret = null;

    public function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

    public function initIFrame()
    {
        $this->apiUrl = $_GET['api_url'];// � ��� ����� ������� API, �� �������� ���������� ������������ �������.
        $this->apiId = $_GET['api_id'];//� ��� id ����������� ����������.
        $user_id = $_GET['user_id'];// � ��� id ������������, �� �������� �������� ���� �������� ����������. ���� ���������� �������� �� �� �������� ������������, �� �������� ����� 0.
        $this->sessionId = $_GET['sid'];// � id ������ ��� ������������� �������� � API
        $this->secret = $_GET['secret'];// � ������, ����������� ��� ������������� ������� �������� � API
        $group_id = $_GET['group_id'];// � ��� id ������, �� �������� ������� ���� �������� ����������. ���� ���������� �������� �� �� �������� ������, �� �������� ����� 0.
        $this->viewerId = $_GET['viewer_id'];// � ��� id ������������, ������� ������������� ����������.
        $is_app_user = $_GET['is_app_user'];// � ���� ������������ ��������� ���������� � 1, ����� � 0.
        $viewer_type = $_GET['viewer_type'];// � ��� ��� ������������, ������� ������������� ���������� (��������� �������� ������� ����).
        $auth_key = $_GET['auth_key'];// � ��� ����, ����������� ��� ����������� ������������ �� ��������� ������� (��. �������� ����).
        $language = $_GET['language'];// � ��� id ����� ������������, ���������������� ���������� (��. ������ ������ ����).
        $api_result = $_GET['api_result'];// � ��� ��������� ������� API-�������, ������� ����������� ��� �������� ���������� (��. �������� ����).
        $api_settings = $_GET['api_settings'];// � ������� ����� �������� �������� ������������ � ������ ���������� (��������� ��. � �������� ������ getUserSettings).

        $serverAuthKey = md5($this->apiId . '_' . $this->viewerId . '_' . $this->appSecret);

        if ($serverAuthKey != $auth_key) {
            throw new Exception('Application error');
        }
    }

    public function api($method, $params = false, $secure = false)
    {
        if (!$params) {
            $params = array();
        }

        $params['api_id'] = $this->apiId;
        $params['method'] = $method;
        $params['timestamp'] = time();
        $params['format'] = 'json';
        $params['random'] = rand(0,10000);
        $params['v'] = self::CURRENT_API_VERSION;

        ksort($params);
        $sig = '';

        foreach ($params as $k => $v) {
            $sig .= $k . '=' . $v;
        }

        if (!$secure && $this->sessionId != null) {
            $params['sid'] = $this->sessionId;
        }

        ksort($params);
        if ($secure) {
            $params['sig'] = md5($sig . $this->appSecret);
        } else {
            $params['sig'] = md5($this->viewerId . $sig . $this->secret);
        }

        $query = $this->apiUrl . '?' . self::concatParams($params);

        $res = file_get_contents($query);

        $res = json_decode($res, true);
        if (array_key_exists('error', $res)) {
            throw new Exception($res['error']['error_msg'] . ' ' . $query, (int)$res['error']['error_code']);
        }
        return $res['response'];
    }

    protected static function concatParams($params)
    {
        $pice = array();
        foreach ($params as $k => $v) {
            $pice[] = $k . '=' . urlencode($v);
        }
        return implode('&', $pice);
    }

    public function getViewer()
    {
        return $this->getUserProfile($this->viewerId);
    }

    public function getUserProfile($id)
    {
        return new VKontakte_User($this, $id);
    }
}