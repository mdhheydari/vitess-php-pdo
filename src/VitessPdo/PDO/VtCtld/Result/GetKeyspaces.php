<?php
/**
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o
 */

namespace VitessPdo\PDO\VtCtld\Result;

use VitessPdo\PDO\Exception;

/**
 * Description of class GetKeyspaces
 *
 * @author  mfris
 * @package VitessPdo\PDO\VtCtld\Result
 */
class GetKeyspaces extends Result
{

    /**
     *
     * @throws Exception
     */
    protected function parse()
    {
        $this->data = explode("\n", trim($this->responseString));
    }
}
