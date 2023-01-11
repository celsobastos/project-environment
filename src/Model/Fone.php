<?php

namespace Celso\Environment\Model;

class Fone {
    public function __construct(
        protected string $code,
        protected string $fone,
    ) {}
}