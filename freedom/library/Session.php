<?php

function mc_ses_open($path, $name)
{
	 return true;
}

function mc_ses_close()
{
	return true;
}

function mc_ses_read($id)
{
	$id = mc_ses_get_id($id);
	Return  \library\Cache::store('Redis')->get($id);
}

function mc_ses_write($id, $data)
{

	$id=mc_ses_get_id($id);
	$expire = (int) session_cache_expire()*60;
	\library\Cache::store('Redis')->set($id, $data, $expire);
	Return true;
}

function mc_ses_destroy($id)
{
	$id=mc_ses_get_id($id);
	\library\Cache::store('Redis')->rm($id);
	Return true;
}

function mc_ses_get_id($id)
{
	return $id;
}

function mc_ses_gc($maxlt)
{
	// garbage collection is done on the memcached server, no need to do it here...
}

if (!session_set_save_handler ('mc_ses_open', 'mc_ses_close' , 'mc_ses_read', 'mc_ses_write', 'mc_ses_destroy', 'mc_ses_gc'))
{
	die('Set handling for Memory sessioning failed...');
}


