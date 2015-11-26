<?php
/**
 * MySqlModelAbstract.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Model;

use Jepi\Fw\Exceptions\ModelException;

abstract class MySqlModelAbstract implements ModelInterface
{
    /**
     * @var \PDO
     */
    protected $connection;

    protected $name = "";

    /**
     * @param Connections $connections
     * @param null $name
     * @throws \Jepi\Fw\Exceptions\ModelException
     */
    public function __construct(Connections $connections, $name = null) {
        $this->connection = $connections->openMySqlConnection($name);
    }

    /**
     * @param $SQL
     * @return \PDOStatement
     * @throws ModelException
     */
    private function execute($SQL) {
        try {
            $queryPrepare = $this->connection->prepare($SQL);
            $queryPrepare->execute();
        } catch (\PDOException $e) {
            throw new ModelException('Error in the Select QUERY ('.$SQL.') '
                . 'and error message('.$e->getMessage().')');
        }
        return $queryPrepare;
    }

    /**
     * Returns an array of arrays with data
     * @param $query
     * @return mixed
     */
    public function select($query)
    {
        $result = $this->execute($query);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Returns the last inserted Id
     *
     * @param $query
     * @return int
     */
    public function insert($query)
    {
        $this->execute($query);
        return $this->connection->lastInsertId();
    }

    /**
     * Returns the affected number of rows
     *
     * @param $query
     * @return int
     */
    public function update($query)
    {
        $result = $this->execute($query);
        return $result->rowCount();
    }

    /**
     * Returns the number of deleted rows
     *
     * @param $query
     * @return int
     */
    public function delete($query)
    {
        $result = $this->execute($query);
        return $result->rowCount();
    }

    public function beginTransaction()
    {
    }

    public function endTransaction()
    {
    }

    public function rollback()
    {
    }


}