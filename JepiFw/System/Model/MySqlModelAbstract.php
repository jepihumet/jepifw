<?php
/**
 * MySqlModelAbstract.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\System\Model;


class MySqlModelAbstract implements ModelInterface
{
    public function __construct($name = null) {
        if(is_null($name)){ //Open the connection send in the parameter $name.
            $this->connection = $this->openConnection($name);
        } else { //Open the default connection.
            $this->connection = $connection->openConnection();
        }
    }

    public function select($query)
    {
        // TODO: Implement select() method.
    }

    public function insert($query)
    {
        // TODO: Implement insert() method.
    }

    public function update($query)
    {
        // TODO: Implement update() method.
    }

    public function delete($query)
    {
        // TODO: Implement delete() method.
    }

    public function beginTransaction()
    {
        // TODO: Implement beginTransaction() method.
    }

    public function endTransaction()
    {
        // TODO: Implement endTransaction() method.
    }

    public function rollback()
    {
        // TODO: Implement rollback() method.
    }

}