<?php
/**
 * @author     mfris
 * @copyright  PIXELFEDERATION s.r.o.
 */

namespace VitessPdoTest\PDO;

use VitessPdo\PDO\Dsn\Dsn;
use VitessPdo\PDO\Exception as DriverException;
use Exception;

/**
 * Class DsnTest
 *
 * @package VitessPdoTest\PDO
 */
class DsnTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testConstruct()
    {
        $dsnString = "vitess:keyspace=testdb;host=localhost;port=15991;cell=testcell";
        $dsn = null;

        try {
            $dsn = new Dsn($dsnString);
        } catch (Exception $e) {
            self::fail("Error while constructing Dsn object: " . $e->getMessage());
        }

        self::assertNotNull($dsn);
        self::assertNotNull($dsn->getDriver());
        self::assertNotNull($dsn->getConfig());
    }

    /**
     *
     */
    public function testWrongDsn1()
    {
        $dsnString = "vitess-keyspace=testdb;host=localhost;port=15991";

        $this->expectException(DriverException::class);
        $this->expectExceptionMessage("Invalid dsn string - exactly one colon has to be present.");
        new Dsn($dsnString);
    }

    /**
     *
     */
    public function testVtctld()
    {
        $dsnString = "vitess:keyspace=testdb;host=localhost;port=15991;cell=testcell;"
                   . "vtctld_host=localhost;vtctld_port=12345";
        $dsn = null;

        try {
            $dsn = new Dsn($dsnString);
        } catch (Exception $e) {
            self::fail("Error while constructing Dsn object: " . $e->getMessage());
        }

        self::assertNotNull($dsn);
        self::assertNotNull($dsn->getConfig());
        self::assertNotNull($dsn->getConfig()->getVtCtlHost());
        self::assertEquals('localhost', $dsn->getConfig()->getVtCtlHost());
        self::assertNotNull($dsn->getConfig()->getVtCtlPort());
        self::assertEquals(12345, $dsn->getConfig()->getVtCtlPort());
    }
}
