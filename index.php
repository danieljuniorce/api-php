<?php
  ini_set('display_errors', 'On');
  //Requerimento da pasta do autoload em PSR-4;
  require 'vendor/autoload.php';

  //Require da configuração global;
  require 'config.php';

  //Inicialização da classe de load do projeto;
  new \Core\Core();
