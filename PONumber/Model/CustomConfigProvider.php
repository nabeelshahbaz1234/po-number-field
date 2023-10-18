<?php
namespace Pixafy\PONumber\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Pixafy\PONumber\Model\Config;

/**
 * class CustomConfigProvider
 */
class CustomConfigProvider implements ConfigProviderInterface
{
    /**
     * @var \Pixafy\PONumber\Model\Config
     */
    protected $config;

    /**
     * @param \Pixafy\PONumber\Model\Config $config
     */
    public function __construct(
       Config $config
    )
    {
        $this->config=$config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $config = [];
        $config['display_po'] = $this->config->isEnabled();
        $config['is_po_required']=$this->config->isRequired();
        return $config;
    }
}
