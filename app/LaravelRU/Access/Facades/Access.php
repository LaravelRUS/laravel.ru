<? namespace LaravelRU\Access\Facades;

use Illuminate\Support\Facades\Facade;

class Access extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'access';
	}
}
