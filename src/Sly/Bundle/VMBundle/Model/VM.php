<?php

namespace Sly\Bundle\VMBundle\Model;

use Sly\Bundle\VMBundle\Config\Config;
use Doctrine\Common\Util\Inflector;

/**
 * VM model.
 *
 * @author Cédric Dugat <cedric@dugat.me>
 */
class VM
{
    /**
     * @var string
     */
    private $kernelRootDir;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $uKey;

    /**
     * @var string
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $vagrantBox;

    /**
     * @var boolean
     */
    protected $vagrantNFS;

    /**
     * @var integer
     */
    protected $vagrantMemory;

    /**
     * @var integer
     */
    protected $vagrantCpu;

    /**
     * @var boolean
     */
    protected $vagrantFinalLaunch;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $hostname;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @var boolean
     */
    protected $apache;

    /**
     * @var string
     */
    protected $apachePort;

    /**
     * @var string
     */
    protected $apacheRootDir;

    /**
     * @var boolean
     */
    protected $apacheSSL;

    /**
     * @var boolean
     */
    protected $php;

    /**
     * @var string
     */
    protected $phpVersion;

    /**
     * @var array
     */
    protected $phpPearComponents;

    /**
     * @var boolean
     */
    protected $phpMyAdmin;

    /**
     * @var array
     */
    protected $phpModules;

    /**
     * @var integer
     */
    protected $phpXDebugMaxNestingLevel;

    /**
     * @var boolean
     */
    protected $nginx;

    /**
     * @var boolean
     */
    protected $varnish;

    /**
     * @var boolean
     */
    protected $mysql;

    /**
     * @var string
     */
    protected $mysqlRootPassword;

    /**
     * @var array
     */
    protected $systemPackages;

    /**
     * @var boolean
     */
    protected $mailCatcher;

    /**
     * @var boolean
     */
    protected $vimConfig;

    /**
     * @var boolean
     */
    protected $composer;

    /**
     * @var boolean
     */
    protected $ohMyZsh;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->uKey = md5(uniqid().time());

        $vmDefaultConfig = Config::getVMDefaultConfig();

        foreach ($vmDefaultConfig as $key => $value) {
            $setter = 'set'.$key;

            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * __toString.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();

    }

    /**
     * Get cache path.
     *
     * @param null|string $prefixPath Prefix path
     * 
     * @return string
     */
    public function getCachePath($prefixPath = null)
    {
        return sprintf(
            '%scache/vm/%s',
            $prefixPath ? $prefixPath.'/' : '',
            $this->getUKey()
        );
    }

    /**
     * Get file name.
     * 
     * @return string
     */
    public function getArchiveFilename()
    {
        return sprintf('%s.tar', Inflector::classify((string) $this));
    }

    /**
     * Get temp file name.
     * 
     * @return string
     */
    public function getTempArchiveFilename($withExtension = true)
    {
        return sprintf('%s.tar', $this->getUKey());
    }

    /**
     * Get archive path.
     *
     * @param null|string $prefixPath Prefix path
     * @param boolean     $internal   Internal filename
     * 
     * @return string
     */
    public function getArchivePath($prefixPath = null)
    {
        return sprintf(
            '%scache/vm/%s',
            $prefixPath ? $prefixPath.'/' : '',
            $this->getUKey().'.tar'
        );
    }

    /**
     * Is Ubuntu box.
     *
     * @return boolean
     */
    public function isUbuntuBox()
    {
        return (bool) preg_match('/(precise.*|lucid.*)/', strtolower($this->getVagrantBox()));
    }

    /**
     * Is Debian box.
     *
     * @return boolean
     */
    public function isDebianBox()
    {
        return (bool) preg_match('/(squeeze.*)/', strtolower($this->getVagrantBox()));
    }

    /**
     * Get Id value.
     *
     * @return integer Id value to get
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get UKey value.
     *
     * @return string UKey value to get
     */
    public function getUKey()
    {
        return $this->uKey;
    }
    
    /**
     * Set UKey value.
     *
     * @param string $uKey UKey value to set
     */
    public function setUKey($uKey)
    {
        $this->uKey = $uKey;
    }

    /**
     * Get Configuration value.
     *
     * @return string Configuration value to get
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }
    
    /**
     * Set Configuration value.
     *
     * @param string $configuration Configuration value to set
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Get VagrantBox value.
     *
     * @return string VagrantBox value to get
     */
    public function getVagrantBox()
    {
        return $this->vagrantBox;
    }
    
    /**
     * Set VagrantBox value.
     *
     * @param string $vagrantBox VagrantBox value to set
     */
    public function setVagrantBox($vagrantBox)
    {
        $this->vagrantBox = $vagrantBox;
    }

    /**
     * Get VagrantNFS.
     *
     * @return boolean VagrantNFS value
     */
    public function getVagrantNFS()
    {
        return $this->vagrantNFS;
    }
    
    /**
     * Set VagrantNFS.
     *
     * @param boolean $vagrantNFS VagrantNFS value
     */
    public function setVagrantNFS($vagrantNFS)
    {
        $this->vagrantNFS = $vagrantNFS;
    }

    /**
     * Get VagrantMemory.
     *
     * @return integer VagrantMemory value
     */
    public function getVagrantMemory()
    {
        return $this->vagrantMemory;
    }
    
    /**
     * Set VagrantMemory.
     *
     * @param integer $vagrantMemory VagrantMemory value
     */
    public function setVagrantMemory($vagrantMemory)
    {
        $this->vagrantMemory = $vagrantMemory;
    }

    /**
     * Get VagrantCpu.
     *
     * @return integer VagrantCpu value
     */
    public function getVagrantCpu()
    {
        return $this->vagrantCpu;
    }
    
    /**
     * Set VagrantCpu.
     *
     * @param integer $vagrantCpu VagrantCpu value
     */
    public function setVagrantCpu($vagrantCpu)
    {
        $this->vagrantCpu = $vagrantCpu;
    }

    /**
     * Get VagrantFinalLaunch value.
     *
     * @return boolean VagrantFinalLaunch value to get
     */
    public function getVagrantFinalLaunch()
    {
        return $this->vagrantFinalLaunch;
    }
    
    /**
     * Set VagrantFinalLaunch value.
     *
     * @param boolean $vagrantFinalLaunch VagrantFinalLaunch value to set
     */
    public function setVagrantFinalLaunch($vagrantFinalLaunch)
    {
        $this->vagrantFinalLaunch = $vagrantFinalLaunch;
    }

    /**
     * Get Name value.
     *
     * @return string Name value to get
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set Name value.
     *
     * @param string $name Name value to set
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get Hostname value.
     *
     * @return string Hostname value to get
     */
    public function getHostname()
    {
        return $this->hostname;
    }
    
    /**
     * Set Hostname value.
     *
     * @param string $hostname Hostname value to set
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * Get Ip value.
     *
     * @return string Ip value to get
     */
    public function getIp()
    {
        return $this->ip;
    }
    
    /**
     * Set Ip value.
     *
     * @param string $ip Ip value to set
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Get Timezone value.
     *
     * @return string Timezone value to get
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
    
    /**
     * Set Timezone value.
     *
     * @param string $timezone Timezone value to set
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * Get Apache value.
     *
     * @return boolean Apache value to get
     */
    public function getApache()
    {
        return $this->apache;
    }
    
    /**
     * Set Apache value.
     *
     * @param boolean $apache Apache value to set
     */
    public function setApache($apache)
    {
        $this->apache = $apache;
    }

    /**
     * Get ApachePort value.
     *
     * @return integer ApachePort value to get
     */
    public function getApachePort()
    {
        return $this->apachePort;
    }
    
    /**
     * Set ApachePort value.
     *
     * @param integer $apachePort ApachePort value to set
     */
    public function setApachePort($apachePort)
    {
        $this->apachePort = $apachePort;
    }

    /**
     * Get ApacheRootDir value.
     *
     * @return string ApacheRootDir value to get
     */
    public function getApacheRootDir()
    {
        return $this->apacheRootDir;
    }
    
    /**
     * Set ApacheRootDir value.
     *
     * @param string $apacheRootDir ApacheRootDir value to set
     */
    public function setApacheRootDir($apacheRootDir)
    {
        $this->apacheRootDir = $apacheRootDir;
    }

    /**
     * Get ApacheSSL value.
     *
     * @return boolean ApacheSSL value to get
     */
    public function getApacheSSL()
    {
        return $this->apacheSSL;
    }
    
    /**
     * Set ApacheSSL value.
     *
     * @param boolean $apacheSSL ApacheSSL value to set
     */
    public function setApacheSSL($apacheSSL)
    {
        $this->apacheSSL = $apacheSSL;
    }

    /**
     * Get Nginx value.
     *
     * @return boolean Nginx value to get
     */
    public function getNginx()
    {
        return $this->nginx;
    }
    
    /**
     * Set Nginx value.
     *
     * @param boolean $nginx Nginx value to set
     */
    public function setNginx($nginx)
    {
        $this->nginx = $nginx;
    }

    /**
     * Get Mysql value.
     *
     * @return boolean Mysql value to get
     */
    public function getMysql()
    {
        return $this->mysql;
    }
    
    /**
     * Set Mysql value.
     *
     * @param boolean $mysql Mysql value to set
     */
    public function setMysql($mysql)
    {
        $this->mysql = $mysql;
    }

    /**
     * Get MysqlRootPassword value.
     *
     * @return string MysqlRootPassword value to get
     */
    public function getMysqlRootPassword()
    {
        return $this->mysqlRootPassword;
    }
    
    /**
     * Set MysqlRootPassword value.
     *
     * @param string $mysqlRootPassword MysqlRootPassword value to set
     */
    public function setMysqlRootPassword($mysqlRootPassword)
    {
        $this->mysqlRootPassword = $mysqlRootPassword;
    }

    /**
     * Get Varnish value.
     *
     * @return boolean Varnish value to get
     */
    public function getVarnish()
    {
        return $this->varnish;
    }
    
    /**
     * Set Varnish value.
     *
     * @param boolean $varnish Varnish value to set
     */
    public function setVarnish($varnish)
    {
        $this->varnish = $varnish;
    }

    /**
     * Get Php value.
     *
     * @return boolean Php value to get
     */
    public function getPhp()
    {
        return $this->php;
    }
    
    /**
     * Set Php value.
     *
     * @param boolean $php Php value to set
     */
    public function setPhp($php)
    {
        $this->php = $php;
    }

    /**
     * Get PhpXDebugMaxNestingLevel value.
     *
     * @return integer PhpXDebugMaxNestingLevel value to get
     */
    public function getPhpXDebugMaxNestingLevel()
    {
        return $this->phpXDebugMaxNestingLevel;
    }
    
    /**
     * Set PhpXDebugMaxNestingLevel value.
     *
     * @param integer $phpXDebugMaxNestingLevel PhpXDebugMaxNestingLevel value to set
     */
    public function setPhpXDebugMaxNestingLevel($phpXDebugMaxNestingLevel)
    {
        $this->phpXDebugMaxNestingLevel = $phpXDebugMaxNestingLevel;
    }

    /**
     * Get PhpVersion value.
     *
     * @return string PhpVersion value to get
     */
    public function getPhpVersion()
    {
        return $this->phpVersion;
    }
    
    /**
     * Set PhpVersion value.
     *
     * @param string $phpVersion PhpVersion value to set
     */
    public function setPhpVersion($phpVersion)
    {
        $this->phpVersion = $phpVersion;
    }

    /**
     * Get PhpPearComponents value.
     *
     * @return array PhpPearComponents value to get
     */
    public function getPhpPearComponents()
    {
        return $this->phpPearComponents;
    }
    
    /**
     * Set PhpPearComponents value.
     *
     * @param array $phpPearComponents PhpPearComponents value to set
     */
    public function setPhpPearComponents($phpPearComponents)
    {
        $this->phpPearComponents = $phpPearComponents;
    }

    /**
     * Get PhpMyAdmin value.
     *
     * @return boolean PhpMyAdmin value to get
     */
    public function getPhpMyAdmin()
    {
        return $this->phpMyAdmin;
    }
    
    /**
     * Set PhpMyAdmin value.
     *
     * @param boolean $phpMyAdmin PhpMyAdmin value to set
     */
    public function setPhpMyAdmin($phpMyAdmin)
    {
        $this->phpMyAdmin = $phpMyAdmin;
    }

    /**
     * Get PhpModules value.
     *
     * @return array PhpModules value to get
     */
    public function getPhpModules()
    {
        return $this->phpModules;
    }
    
    /**
     * Set PhpModules value.
     *
     * @param array $phpModules PhpModules value to set
     */
    public function setPhpModules($phpModules)
    {
        $this->phpModules = $phpModules;
    }

    /**
     * Get SystemPackages value.
     *
     * @return array SystemPackages value to get
     */
    public function getSystemPackages()
    {
        return $this->systemPackages;
    }
    
    /**
     * Set SystemPackages value.
     *
     * @param array $systemPackages SystemPackages value to set
     */
    public function setSystemPackages($systemPackages)
    {
        $this->systemPackages = $systemPackages;
    }

    /**
     * Get MailCatcher.
     *
     * @return boolean MailCatcher value
     */
    public function getMailCatcher()
    {
        return $this->mailCatcher;
    }
    
    /**
     * Set MailCatcher.
     *
     * @param boolean $mailCatcher MailCatcher value
     */
    public function setMailCatcher($mailCatcher)
    {
        $this->mailCatcher = $mailCatcher;
    }

    /**
     * Get VimConfig value.
     *
     * @return boolean VimConfig value to get
     */
    public function getVimConfig()
    {
        return $this->vimConfig;
    }
    
    /**
     * Set VimConfig value.
     *
     * @param boolean $vimConfig VimConfig value to set
     */
    public function setVimConfig($vimConfig)
    {
        $this->vimConfig = $vimConfig;
    }

    /**
     * Get Composer value.
     *
     * @return boolean Composer value to get
     */
    public function getComposer()
    {
        return $this->composer;
    }
    
    /**
     * Set Composer value.
     *
     * @param boolean $composer Composer value to set
     */
    public function setComposer($composer)
    {
        $this->composer = $composer;
    }

    /**
     * Get OhMyZsh value.
     *
     * @return boolean OhMyZsh value to get
     */
    public function getOhMyZsh()
    {
        return $this->ohMyZsh;
    }
    
    /**
     * Set OhMyZsh value.
     *
     * @param boolean $ohMyZsh OhMyZsh value to set
     */
    public function setOhMyZsh($ohMyZsh)
    {
        $this->ohMyZsh = $ohMyZsh;
    }
}
