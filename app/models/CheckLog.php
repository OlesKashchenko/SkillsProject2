<?php

class CheckLog extends Eloquent
{

	protected $table = 'check_logs';
	protected $fillable = array('id_user', 'identifier', 'log', 'created_at', 'updated_at');
}