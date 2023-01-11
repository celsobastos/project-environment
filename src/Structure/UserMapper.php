<?php

namespace Celso\Environment\Structure;

use Celso\Environment\Controller\Users;

/**
 * Class mapper.
 */
class UserMapper {

  /**
   * The construct method.
   *
   * @return \PDO
   *   Pdo object.
   */
  private function connect(): \PDO {
    try {
      $conn = new \PDO(
            "mysql:host={$_SERVER['DB_HOST']};port={$_SERVER['DB_PORT']};dbname={$_SERVER['DB_DATABASE']}",
            $_SERVER['DB_USER'],
            $_SERVER['DB_PASS'],
        );
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return $conn;

    }
    catch (\PDOException $e) {
      echo 'Error: ' . $e->getMessage();
      die();
    }
  }

  /**
   * Undocumented function.
   *
   * @return array
   *   The user object.
   */
  public function all() : array {
    $conn = $this->connect();
    $stmt = $conn->prepare('SELECT * FROM users');
    $stmt->execute();
    $data = $stmt->fetchAll();
    $users = [];
    foreach ($data as $row) {
      $users[] = new Users($row['name']);
    }

    return $users;
  }

}
