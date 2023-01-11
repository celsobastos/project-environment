<?php

namespace Celso\Environment\Controller;

use Celso\Environment\Model\Funcionario;

/**
 *
 */
class ProcessSalario {

  /**
   * @param Celso\Environment\Model\Funcionario $funcionario
   */
  public function calcSalario(Funcionario $funcionario): float {
    return $funcionario->calculaReajusteSalario();
  }

}
