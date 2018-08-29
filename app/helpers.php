<?php 

if(!function_exists('yesOrNo')) {
	/**
	 * @param $value
	 * @return string
	 */
	function yesOrNo($value) {
		return $value == 1 ? trans('strings.yes') : trans('strings.no');
	}
}

if(!function_exists('emailExists')) {

	/**
	 * @param $param
	 * @param $id
	 * @return bool
	 */
	function emailExists($param, $id = NULL){
		//Busco o usuário pelo id
		if(isset($id)){
			$user = \App\Model\Backend\User::find($id);
			if(!is_null($user)) {
				//Se o e-mail do usuário for igual ao informado, deixo passar
				if ($user->email == $param) {
					return TRUE;
				}
			}
		}
		//Verificando se o e-mail já existe
		return \App\User::where('email', '=', $param)->get()->isEmpty() == FALSE ? FALSE : TRUE;
	}
}

if (!function_exists('getValueSession')) {

	/**
	 * @param $request
	 * @param string $name
	 * @param string $test
	 * @param string $submit
	 * @param string $default
	 * @return array
	 */
	function getValueSession($request, $name, $test, $submit, $default) {

		$value = $request->input($name, $test);


		if (($submit != '1') && ($value === $test)) {
			$value = $request->session()->get($name, $test);
		}
		if ($value === '' || $value === null) {
			$value = $default;
		}
		
		$request->session()->put($name, $value);
		
		return $value;
	}
}

if(!function_exists('active')){

    function active($condition){
        $url = isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
        $url = explode('/', $url);

        //Prefixo para a aŕea administrativa
        $prefix = isset($url[1]) ? $url[1] : '';

        //Controller
        $controller = isset($url[2]) ? $url[2] : '';

        //Action
        $action = isset($url[3]) ? $url[3] : '';

        //Url a ser verificada
        $verifyUrl = '';

        if(!empty($prefix))
            $verifyUrl .= $prefix;

        if(!empty($controller))
            $verifyUrl .= '/'.$controller;

        if(!empty($action))
            $verifyUrl .= '/'.$action;

        if(is_string($condition)){
            if(strpos($verifyUrl, $condition) !== FALSE){
                return 'active';
            }
        }else if(is_array($condition)){
            foreach($condition as $key => $value){
                if(strpos($verifyUrl, $value) !== FALSE){
                    return 'active';
                }
            }
        }
        return '';
    }

    /*function active($condition){

		$url = isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
		$url = explode('/', $url);
		$root = $url[0];
		$domain = $url[1];
		$action = '';

		if(isset($url[2])){
			if(!empty($url[2])){
				$action = $url[2];
			}
		}

		//$uri = $root.''.$domain.'/'.$action;
		if($condition === $domain && empty($action)){
			return "active";
		}

		$condition = is_array($condition) ? $condition : [$condition];
		$uri = $domain.'/';
		for($i = 2; $i < count($url); $i++){
			$uri .= $url[$i];
			if(in_array($uri, $condition) !== FALSE){
				return "active";
			}
			$uri .= '/';
		}
		/*$t = '';
		foreach($url as $key => $value){
			$t .= $value.'/';
			if(strpos($t, $condition) !== FALSE){
				return "active";
			}
		}
		return "";
	}*/
}

if(!function_exists('string_replace')){
	function string_replace(array $condition, $replace, $str){
		return str_replace($condition, $replace, $str);
	}
}

if (!function_exists('format_with_mask')) {

	/**
	 * Helper to return a Carbon object from a date timestamp
	 * and a custom format
	 *
	 * @param $date
	 * @param $format
	 * @return mixed
	 */
	function format_with_mask($date) {
		if ($date == NULL) {
			return NULL;
		}else{
			return implode('-', array_reverse(explode('/', $date)));
		}
	}

}

if (!function_exists('format_without_mask')) {

	/**
	 * Helper to return a Carbon object from a date timestamp
	 * and a custom format
	 *
	 * @param string $date
	 * @param string $condition
	 * @return mixed
	 */
	function format_without_mask($date, $condition) {
		if ($date == NULL) {
			return NULL;
		} else {
			$date = explode(' ', $date);
			$time = '';
			//$date = explode($condition, $date);
			if(count($date) >= 2) {
				$time = ' '.$date[1];
				$date = $date[0];
			} else {
				$date = $date[0];
			}
			$date = explode($condition, $date);			
			return $date[2].'-'.$date[1].'-'.$date[0].$time;
		}
	}
}

if (!function_exists('format_without_mask_pt_br')) {

	/**
	 * Helper to return a Carbon object from a date timestamp
	 * and a custom format
	 *
	 * @param string $date
	 * @param string $condition
	 * @return mixed
	 */
	function format_without_mask_pt_br($date, $condition) {
		if ($date == NULL) {
			return NULL;
		}else{
			return implode('-', array_reverse(explode($condition, $date)));
		}
	}

}

if (!function_exists('format_without_mask_en_us')) {

	/**
	 * Helper to return a Carbon object from a date timestamp
	 * and a custom format
	 *
	 * @param string $date
	 * @param string $condition
	 * @return mixed
	 */
	function format_without_mask_en_us($date, $condition = '/') {
		if ($date == NULL) {
			return NULL;
		} else {
			$date = explode($condition, $date);
			return $date[2].'-'.$date[0].'-'.$date[1];
		}
	}

}



if (!function_exists('format')) {

	/**
	 * Helper to return a Carbon object from a date timestamp
	 * and a custom format
	 *
	 * @param $date
	 * @param $format
	 * @return mixed
	 */
	function format($date, $format, $locale = null) {
		if ($date == null) {
			return "";
		}
		
		if($locale != null && $locale != '') {
			switch($locale) {
				case 'pt_BR' && strpos($date, '/') : {
					$date = format_without_mask_pt_br($date, '/');
					break;
				}
				case 'es_ES' && strpos($date, '/'): {
					$date = format_without_mask_pt_br($date, '/');
					break;
				}
				case 'en_US' && strpos($date, '/'): {
					$date = format_without_mask_pt_br($date, '/');
					break;
				}
				default: {
					//$date = format_without_mask_en_us($date, '/');
					$date = format_without_mask_pt_br($date, '/');
					break;
				}
			}
		}
		return Carbon\Carbon::parse($date)->format($format);		
	}

}

if(!function_exists('birth_date')){
	function birth_date($date){
		$date = explode('-', $date);
		$date = Carbon\Carbon::create($date[0], $date[1], $date[2]);
		$age = $date->diff(Carbon\Carbon::now())->y;
		//$age = $date->diff(Carbon\Carbon::now())->format('%y Year, %m Months and %d Days');
		return $age;
	}
}

if(!function_exists('age')){
	function age($date){
		if(!is_null($date)){
			$date = explode('-', $date);
			$date = Carbon\Carbon::create($date[0], $date[1], $date[2]);
			$age = $date->diff(Carbon\Carbon::now())->y;
			//$age = $date->diff(Carbon\Carbon::now())->format('%y Year, %m Months and %d Days');
			return $age;
		}
		return NULL;
	}
}

if (!function_exists('format_datebr')) {
	/**
	 * Helper to return a Carbon object from a date timestamp
	 *
	 * @param $date
	 * @return mixed
	 */
	function format_datebr($date) {
		if ($date == null)
			return "";
		else
			return Carbon\Carbon::parse($date)->format('d/m/Y');
	}
}

if (!function_exists('format_datetimebr')) {

	/**
	 * Helper to return a Carbon object from a datetime timestamp
	 *
	 * @param $datetime
	 * @return mixed
	 */
	function format_datetimebr($datetime) {
		if ($datetime == null)
			return "";
		else
			return Carbon\Carbon::parse($datetime)->format('d/m/Y H:i');
	}

}



if (!function_exists('imageurl')) {

	/**
	 * @param $entity
	 * @param $id
	 * @param $photo
	 * @param int $size
	 * @param string $alternate
	 * @return mixed|string
	 * @throws Exception
	 */
	function imageurl($entity, $photo, $size = 0, $square = false) {
		
		if(is_null($photo)){
			return "";
		}
		if ($size === 0) {
			$size = '';
		} else {
			if ($square) {
				$size = '_square' . $size;
			} else {
				$size = '_size' . $size;
			}
		}

		if(!empty($size)){
			$photo = explode(';', $photo);
			foreach($photo as $value){
				if(strpos($value, $size)){
					$photo = $value;
					continue;
				}
			}
		}else{
			$photo = explode(';', $photo)[0];
		}

		$photo = '/uploads/images/' . $entity  . '/' . $photo;

		//O getimagesize funciona melhor que o file_exists nesse caso. O @ � usado para a fun��o retornar false ao inv�s
		//de atirar um erro.
		if(file_exists(public_path().''.$photo)){
			return $photo;
		}
		return "";
	}

}

if (!function_exists('img_sizes')) {

	/**
	 * @param $path
	 * @param $img
	 * @return array
	 */
	function img_sizes($path, $img) {
		if (!preg_match('/\.(gif|jpg|jpeg|tiff|png)$/', $img))
			return NULL;

		list($img_name, $img_extension) = explode('.', $img);

		$dimensions = Config::get('imageupload.dimensions');

		$sources = [];
		$sources['original'] = $path . '/' . $img;
		foreach ($dimensions as $key => $dimension) {
			$sources[$key] = $path . '/' . $img_name . '_' . $key . '.' . $img_extension;
		}

		return $sources;
	}

}

if(!function_exists('addDaysToDate')){
	function addDaysToDate($date, $days, $format){
		if(!is_null($date)){
			$date = new DateTime($date);
			$date->modify('+'.$days.' day');
			return $date->format($format);
		}
		return NULL;
	}
}