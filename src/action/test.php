<?php 

session_start();
require 'query.php';

echo (is_member(13,23)) ? 'yes' : 'no';
