<?php

session_start();

// unset na session 
unset($_SESSION['num_matricula_logado']);

header("Location: ../");