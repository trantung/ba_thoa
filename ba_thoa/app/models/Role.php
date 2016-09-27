<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Role extends Eloquent {
	
	use SoftDeletingTrait;
	
	protected $table = 'roles';
	protected $fillable = array('role_name', 'description');
	protected $dates = ['deleted_at'];
}
