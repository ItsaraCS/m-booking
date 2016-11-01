<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	function library_asset($nameType = null, $nameFile = null){
		$path = base_url().'assets/scripts/';
		$assetUrl = '';

		if(!empty($nameType) && !empty($nameFile)){
			$typeFile = explode('.', $nameFile)[count(explode('.', $nameFile)) - 1];

			switch(strtolower($nameType)){
				case 'jquery':
					$path .= 'jquery/'.$nameFile;
					return $assetUrl .= '<script src="'.$path.'" type="text/javascript"></script>';
					break;
				case 'bootstrap':
					$path .= 'bootstrap/';
					if($typeFile == 'js')
						return $assetUrl .= '<script src="'.$path.'js/'.$nameFile.'" type="text/javascript"></script>';
					else if($typeFile == 'css')
						return $assetUrl .= '<link href="'.$path.'css/'.$nameFile.'" rel="stylesheet" type="text/css">';
					break;
				case 'fontawesome':
					$path .= 'fontawesome/css/'.$nameFile;
					return $assetUrl .= '<link href="'.$path.'" rel="stylesheet" type="text/css">';
					break;
				case 'angularjs':
					$path .= 'angularjs/'.$nameFile;
					return $assetUrl .= '<script src="'.$path.'" type="text/javascript"></script>';
					break;
				case 'app':
					$path .= 'angularjs/app/'.$nameFile;
					return $assetUrl .= '<script src="'.$path.'" type="text/javascript"></script>';
					break;
				case 'fullcalendar':
					$path .= 'fullcalendar/'.$nameFile;
					if($typeFile == 'js')
						return $assetUrl .= '<script src="'.$path.'" type="text/javascript"></script>';
					else if($typeFile == 'css')
						return $assetUrl .= '<link href="'.$path.'" rel="stylesheet" type="text/css">';
					break;
				default:
					return false;
			}
		}else{
			switch(strtolower($nameType)){
				case 'jquery':
					$path .= 'jquery/';
					$assetUrl .= '<script src="'.$path.'jquery-11.0.min.js" type="text/javascript"></script>';
					$assetUrl .= '<link href="'.$path.'jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">';
					$assetUrl .= '<script src="'.$path.'jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>';
					$assetUrl .= '<link href="'.$path.'jquery-ui-1.12.1.custom/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">';
					$assetUrl .= '<script src="'.$path.'jquery-ui-1.12.1.custom/jquery-ui-timepicker-addon.js" type="text/javascript"></script>';
					return $assetUrl;
					break;
				case 'bootstrap':
					$path .= 'bootstrap/';
					$assetUrl .= '<link href="'.$path.'css/bootstrap.css" rel="stylesheet" type="text/css">';
					$assetUrl .= '<script src="'.$path.'js/bootstrap.min.js" type="text/javascript"></script>';
					return $assetUrl;
					break;
				case 'fontawesome':
					$path .= 'fontawesome/css/';
					return $assetUrl .= '<link href="'.$path.'font-awesome.min.css" rel="stylesheet" type="text/css">';
					break;
				case 'angularjs':
					$path .= 'angularjs/';
					return $assetUrl .= '<script src="'.$path.'angular.min.js" type="text/javascript"></script>';
					break;
				case 'app':
					$path .= 'app/';
					$obj =& get_instance();
					$obj->load->helper('directory');
					$pathCtrl = './assets/scripts/app/controllers/';
					$map = directory_map($pathCtrl);
					$assetUrl .= '<script src="'.$path.'controllers/main_app.js" type="text/javascript"></script>';
					foreach($map as $file){
						if($file != 'main_app.js')
							$assetUrl .= '<script src="'.$path.'controllers/'.$file.'" type="text/javascript"></script>';
					}

					$assetUrl .= '<script src="'.$path.'directive.js" type="text/javascript"></script>';
					$assetUrl .= '<script src="'.$path.'factory.js" type="text/javascript"></script>';
					$assetUrl .= '<script src="'.$path.'route.js" type="text/javascript"></script>';
					return $assetUrl;
					break;
				case 'fullcalendar':
					$path .= 'fullcalendar/';
					$assetUrl .= '<link href="'.$path.'fullcalendar.css" rel="stylesheet" type="text/css">';
					$assetUrl .= '<script src="'.$path.'fullcalendar.js" type="text/javascript"></script>';
					return $assetUrl;
					break;
				default:
					return false;
			}
		}
	}

	function file_asset($nameFile = null){
		$path = base_url().'assets/';
		$assetUrl = '';

		if(!empty($nameFile)){
			$typeFile = explode('.', $nameFile)[count(explode('.', $nameFile)) - 1];

			if($typeFile == 'js'){
				$path .= 'scripts/'.$nameFile;
				return $assetUrl .= '<script src="'.$path.'" type="text/javascript"></script>';
			}else if($typeFile == 'css'){
				$path .= 'styles/'.$nameFile;
				return $assetUrl .= '<link href="'.$path.'" rel="stylesheet" type="text/css">';
			}
		}
	}

	function image_asset($nameFile = null){
		$path = base_url().'assets/';
		$assetUrl = '';

		if(!empty($nameFile))
			return $path .= 'images/'.$nameFile;
	}
?>