<?php

/**
 * @version       helper.php 2014-12-15 17:35:00 UTC zanardi
 * @package       GiBi Firewall for RsFiles
 * @author        GiBiLogic <info@gibilogic.com>
 * @authorUrl     http://www.gibilogic.com
 * @copyright     (C) 2014 GiBiLogic. All rights reserved.
 * @license       GNU/GPL v3 or later
 */
defined('_JEXEC') or die();

class plgRsfilesFirewallHelper
{

    /**
     *
     * @var array $ip_list
     */
    private $ip_list = array();

    /**
     *
     * @var \JRegistry $params
     */
    private $params;

    /**
     *
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Check if the current requested download is within a protected folder
     *
     * @return boolean
     */
    public function isProtectedFolder()
    {
        $protected_folders = $this->getFolderList();
        if (empty($protected_folders))
        {
            return true; // if no folder is set in configuration, all are protected
        }

        $download_path = rsfilesHelper::getPath();
        foreach ($protected_folders as $folder)
        {
            $pattern = "|" . ltrim($folder, '/') . "|";
            if (preg_match($pattern, $download_path))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the current client IP is allowed to perform the download
     *
     * @return boolean
     */
    public function isAllowedIp()
    {
        $is_current_ip_listed = $this->isListed($_SERVER['REMOTE_ADDR'], $this->getIpList());
        if ($this->params->get('ip_list_type', 'E') == 'E')
        {
            return $is_current_ip_listed;
        }
        else
        {
            return !$is_current_ip_listed;
        }
    }

    /**
     * Get the folder list from configuration
     *
     * @return array
     */
    private function getFolderList()
    {
        $folder_list = $this->params->get("folder_list", '');

        return array_filter(preg_split('/\s+/', $folder_list));
    }

    /**
     * Get the IP list from configuration
     *
     * @return array
     */
    private function getIpList()
    {
        $ip_list = $this->params->get("ip_list", '');

        return array_filter(preg_split('/\s+/', $ip_list));
    }

    /**
     * See if the current IP matches our IP patterns list.
     *
     * @param   string  $ip
     * @param   array   $ip_list
     * @return  boolean
     */
    private function isListed($ip, $ip_list)
    {
        foreach ($ip_list as $ip_pattern)
        {
            $pattern = '/^' . $ip_pattern . '/';
            if (preg_match($pattern, $ip))
            {
                return true;
            }
        }

        return false;
    }

}
