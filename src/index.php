<?php

require "core/Router.php";

$url = $_GET['url'] ?? '';

Router::route($url);