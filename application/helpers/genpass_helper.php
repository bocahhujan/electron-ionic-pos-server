<?php

//generator token untuk token user
function gen_tokken($user){
	$d = sha1(date("d"."j"."Y"));
	$u = sha1($user);
	return sha1($d.$u);
}

//generator password
function gen_pass($pass,$tokken){
	return sha1($pass.$tokken);
}
