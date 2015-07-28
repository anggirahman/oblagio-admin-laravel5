<?php namespace oblagio\Helpers;

class Site
{
	public static function main()
	{
		return [
			'applicationName' => 'Oblagio Task',
			'routeBackend' => 'admin-cp',
			'routeGenerator' => 'obgl',
		];
	}

	public static function routeBackend()
	{
		return self::main()['routeBackend'];
	}
        
        public static function routeGenerator()
	{
		return self::main()['routeGenerator'];
	}

	public static function applicationName()
	{
		return self::main()['applicationName'];
	}

	public static function generateLink($url = "")
	{
		if(empty($url))
		{
			return self::routeBackend()."/".$url;
		}
	}
        
        public static function errorMessages()
        {
            $messages = [
                'required' => ':attribute tidak boleh kosong !',
                'unique' => ':attribute sudah ada didatabase ! , silahkan ganti dengan yang lain',
                'integer' => ':attribute harus berupa angka!',
            ];
            
            return $messages;
        }
        
        public static function withEmpty($var)
        {
            return ['' => ''] + $var->toArray();
        }
        
        public static function arrExplode($controller , $boolean)
        {
            $explode = explode("\\" ,$controller);
           
            if( count($explode) > 1)
            {
                if($boolean == 'namespace')
                {
                    $removeLast = array(array_pop($explode));
                     $result = "\\".implode("\\" , $explode);
                }elseif($boolean == 'controller'){
                   $result = end($explode);
                }
                
            }else{
                if($boolean == 'namespace')
                {
                    $result = '';
                }else{
                   $result = $controller;
                }
                
            }
            
           return $result;
        }
        
        
        public static function aliasUrl($title)
        {
            $replace =  str_replace(" ","-" , $title);  
            return strtolower($replace);
        }
        
public static function generateController($controller)
{
    $namespace = self::arrExplode($controller , 'namespace');
    $fixController = self::arrExplode($controller , 'controller');

return "<?php namespace oblagio\Http\Controllers$namespace;

            use Illuminate\Http\Request;

            use oblagio\Http\Requests;
            use oblagio\Http\Controllers\Controller;
            use Validator;
            use oblagio\Helpers\Site;

            class $fixController extends Controller
            {
                public function getIndex()
                {
                    // Your Elegan code here
                }
            }
";
}

}