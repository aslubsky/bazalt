<?php
/**
 * Query.php
 *
 * @category   ORM
 * @package    BAZALT
 * @subpackage System
 * @copyright  2010 Equalteam
 * @license    GPLv3
 * @version    $Revision: 133 $
 */

/**
 * ORM_Query
 *
 * @category   ORM
 * @package    BAZALT
 * @subpackage System
 * @copyright  2010 Equalteam
 * @license    GPLv3
 * @version    $Revision: 133 $
 */
class ORM_Exception_Query extends ORM_Exception_Base
{
    protected $parentMessage = null;

    protected $query = null;

    protected $params = array();

    /**
     * Contructor
     *
     * @param PDOException $ex     PDO Exception
     * @param string       $query  Query that generated the exception
     * @param array        $params Query params
     */
    public function __construct(PDOException $ex, $query, $params)
    {
        parent::__construct($ex);

        $errMessage = $ex->getMessage();
        //$errMessage = 'SQLSTATE[42S02]: Base table or view not found: 1146 Table \'cms_options\' doesn\'t exist';
        //$errMessage = 'SQLSTATE[42000] [1049] Unknown database \'test\'';
        preg_match('/SQLSTATE\[(\w+)\](: (.*): (\d+) | \[(\w+)\] )?(.*)/', $errMessage, $matches);
        if (count($matches) < 7) {
            $matches = array(
                null, 0, null, '', 0, '', $errMessage
            );
        }
        $driverCode = $matches[1];

        // Message like 'Base table or view not found';
        if (!empty($matches[3])) {
            $this->parentMessage = $matches[3];
        }
        $exCode = $matches[4];
        $message = $matches[6];

        $this->query = $query;
        $this->params = $params;

        $query = ORM_Query::getFullQuery($this->query, $this->params);
        Logger::getInstance()->crit($query, __CLASS__);

        $this->code = (int)$exCode;
        $this->message = (string)$message;
    }

    public function getDetails()
    {
        $query = ORM_Query::getFullQuery($this->query, $this->params);

        $colorQuery = preg_replace('/\b(SELECT|FROM|AND|OR|ON|IS|NULL|AS|LIMIT|ASC|COUNT|DESC|WHERE|LEFT JOIN|INNER JOIN|RIGHT JOIN|ORDER BY|GROUP BY|IN|LIKE|DISTINCT|DELETE|INSERT|INTO|VALUES)\b/',
                    '<span style="color: blue">\\1</span>',
                    $query);

        $details = '';
        if (!empty($this->parentMessage)) {
            $details = 'Parent message: ' . $this->parentMessage . "\n";
        }

        $details .= "Query:\n\t"  . $colorQuery;

        return $details;
    }
}