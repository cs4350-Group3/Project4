<?php
/**
 * File name: EndPointManager.php
 *
 * Project: Project3
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   Common\Services
 * @author    stringhamdb <stringhamdb@familysearch.org>
 * @copyright 2015 © Intellectual Reserve, Inc.
 * @license   Trademarked by Intellectual Reserve, Inc.
 * @version   $Revision$
 * @link      https:/ems.ldschurch.org
 *
 * $LastChangedDate$
 * $LastChangedBy$
 */

namespace Common\Services;

use Guzzle\Common\Exception\InvalidArgumentException;


/**
 * Class EndPointManager
 *
 * @category  PHP
 * @package   Common\Services
 * @author    stringhamdb <stringhamdb@familysearch.org>
 * @copyright 2015 © Intellectual Reserve, Inc.
 * @license   Trademarked by Intellectual Reserve, Inc.
 * @version   Release: 0.1
 * @link      https:/ems.ldschurch.org
 */
class EndPointManager
{
    public function __construct($config = null)
    {
        if ($config === null) {
            throw new InvalidArgumentException(
                __METHOD__.' $config has to be set correctly'
            );
        }

        
    }
}
