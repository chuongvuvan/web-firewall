<?php
/**
 * Project web-firewall.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2019-01-18
 * Time: 14:21
 */

namespace nguyenanhung\WebFirewall\Filter;

/**
 * Class FilterIPAccessMyWebService
 *
 * @package   nguyenanhung\WebFirewall\Filter
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class FilterIPAccessMyWebService implements FilterIPAccessMyWebServiceInterface
{
    // Cấu hình những IP nào được phép gọi vào hệ thống
    private $ipWhiteList = array('127.0.0.1');

    /**
     * FilterIPAccessMyWebService constructor.
     *
     * @param array $ipWhiteList
     */
    public function __construct($ipWhiteList = array())
    {
        if (!empty($ipWhiteList)) {
            $this->ipWhiteList = $ipWhiteList;
        }
    }

    /**
     * Function checkUserConnect
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:22
     *
     * @return bool
     */
    public function checkUserConnect()
    {
        $ips = $this->getIPAddress();
        if (empty($ips)) {
            return FALSE;
        }
        if (in_array($ips, $this->ipWhiteList)) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Function getIPAddress
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:24
     *
     * @param bool $convertToInteger
     *
     * @return bool|int|string
     */
    public function getIPAddress($convertToInteger = FALSE)
    {
        $ip_keys = array(
            0 => 'HTTP_X_FORWARDED_FOR',
            1 => 'HTTP_X_FORWARDED',
            2 => 'HTTP_X_IPADDRESS',
            3 => 'HTTP_X_CLUSTER_CLIENT_IP',
            4 => 'HTTP_FORWARDED_FOR',
            5 => 'HTTP_FORWARDED',
            6 => 'HTTP_CLIENT_IP',
            7 => 'HTTP_IP',
            8 => 'REMOTE_ADDR'
        );
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === TRUE) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if ($convertToInteger === TRUE) {
                        $result = ip2long($ip);

                        return $result;
                    }

                    return $ip;
                }
            }
        }

        return FALSE;
    }

    /**
     * Function errorLogMessage
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:29
     *
     * @return string
     */
    public function errorLogMessage()
    {
        $message = date('Y-m-d H:i:s') . ' -> IP: ' . $this->getIPAddress() . ' -> is not Whitelist IP access to WebService';

        return $message;
    }

    /**
     * Function accessDenied
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:29
     *
     * @return string
     */
    public function accessDenied()
    {
        return 'Access Denied!';
    }
}
