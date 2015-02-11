<?php namespace LaravelRU\User\Models;

interface ActivityInterface {

	public function touchLastActivityAt();

	public function touchLastLoginAt();

	public function isCurrentlyActive();

}
