<?php
/*
  Copyright (C)  2014 Abdelrhamane benhammou
*/
function voc($str)
{
	if(array_key_exists($str, $GLOBALS['voc']))
	{
		return $GLOBALS['voc'][$str];
	}
	else 
	{
		throw new Exception($str." undefined in voc");
	}
}

function urlpage($page)
{
	return "index.php?page=".$page;
}

function have_user_access()
{
	if (isset($_SESSION['user']) and isset($_SESSION['account']))
	{
		$user = unserialize($_SESSION['user']);
		$account = unserialize($_SESSION['account']);
		if ($user->id_account == $account->id)
		{
			return true;
		}
	}
	return false;
}

function have_tenant_access()
{
	if (isset($_SESSION['tenant']) and isset($_SESSION['account']))
	{
		$tenant = unserialize($_SESSION['tenant']);
		$account = unserialize($_SESSION['account']);
		if ($tenant->id_account == $account->id)
		{
			return true;
		}
	}
	return false;
}

function cassetoi()
{
	header('location:index.php');
}