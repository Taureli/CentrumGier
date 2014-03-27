<?php

session_start();  //pobieramy aktualną sesję
session_destroy(); //i ją kończymy
header("location: ../index.php"); //wraca na strone główną
exit();

