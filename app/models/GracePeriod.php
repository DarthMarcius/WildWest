<?php

class GracePeriod extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
            'days' => 'integer',
            'hours' => 'integer',
            'minutes' => 'integer',
            'miliseconds' => 'integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['days','hours','minutes','miliseconds'];

}