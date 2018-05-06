<?php
namespace ArtinCMS\LBDM;
use Illuminate\Support\Facades\Facade;

class LBDFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'LBDMC';
	}
}