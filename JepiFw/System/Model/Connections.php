<?php
/**
 * Connections.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Model;

use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Exceptions\ModelException;

class Connections
{
    /**
     * @var ConfigInterface
     */
    private $config = null;

    /**
     * @var array({name, link}).
     */
    private $connections = array();

    public function __construct(ConfigInterface $config) {
        $this->config = $config;
    }

    /**
     * Open connection if is not already open.
     *
     * @param string $name optional parameter if nothing is send it gets
     * the default connection.
     * @return \PDO
     * @throws ModelException
     */

    public function openMySqlConnection($name = null) {
        $defaultConnection = $this->config->get('Database', 'defaultConnection');
        if (is_null($name)){
            $name = $defaultConnection;
        }
        foreach ($this->connections as $connection) {
            if($connection->name == $name && !is_null($connection->link)) {
                return $connection->link;
            }
        }
        //Open new connection
        try {
            //Get the configuration of the connection.
            $host = $this->config->get('Database', 'host');
            $port = $this->config->get('Database', 'port');
            $user = $this->config->get('Database', 'user');
            $pass = $this->config->get('Database', 'pass');
            $db = $this->config->get('Database', 'name');

            //Create the new connection.
            $connection = new \PDO($connData = 'mysql:host=' . $host[$name] . ';port=' . $port[$name] . ';dbname=' . $db[$name], $user[$name], $pass[$name],
                array(\PDO::MYSQL_ATTR_FOUND_ROWS => true, \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ));
            $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->connections[] = (object)array('name'=>$name,'link'=>$connection);

            return $connection;
        } catch (Exception $e) {
            throw new ModelException("Error trying to connect to database [$name]");
        }
    }

    /**
     * Close connection if is still open.
     *
     * @param string $name optional parameter if nothing is send it gets
     * the default connection
     * @return bool
     */
    public function closeConnection($name = null) {
        $defaultConnection = $this->config->get('Database', 'defaultConnection');
        if (is_null($name)){
            $name = $defaultConnection;
        }
        foreach ($this->connections as $key => $connection) {
            if($connection->name == $name) {
                $this->connections[$key]->link = null; //closing the connection
                array_splice($this->connections, $key, 1);
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function closeConnections(){
        foreach($this->connections as $key => $connection){
            $this->connections[$key]->link = null;
        }
        return true;
    }
}