<?php

namespace App\Repositories\App\NotificationMethodsRepositories;

use App\Models\NotificationMethods;
use App\Repositories\Interfaces\NotificationMethodsInterfaces\NotificationMethodsInterface;

class NotificationMethodsRepository implements NotificationMethodsInterface
{
	public function index(): object
	{
		$res = NotificationMethods::all();
		return $res;
	}
}
