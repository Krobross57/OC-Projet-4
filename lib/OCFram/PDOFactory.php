<?php
namespace OCFram;

class PDOFactory
{
  public static function getMysqlConnexion()
  {
    $db = new \PDO('mysql:host=db698380700.db.1and1.com;dbname=db698380700', 'dbo698380700', 'V@nderlaike57');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $db;
  }
}
