<?php
/**
 * Project web-firewall.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 2019-01-18
 * Time: 14:23
 */

namespace nguyenanhung\WebFirewall\Filter;

/**
 * Interface FilterIPAccessMyWebServiceInterface
 *
 * @package   nguyenanhung\WebFirewall\Filter
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface FilterIPAccessMyWebServiceInterface
{
    /**
     * Function checkUserConnect
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:22
     *
     * @return bool
     */
    public function checkUserConnect();

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
    public function getIPAddress($convertToInteger = FALSE);

    /**
     * Function errorLogMessage
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:29
     *
     * @return string
     */
    public function errorLogMessage();

    /**
     * Function accessDenied
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2019-01-10 16:29
     *
     * @return string
     */
    public function accessDenied();
}
