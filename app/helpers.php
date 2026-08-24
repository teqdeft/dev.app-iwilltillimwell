<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\Pages;
use App\Models\Company;
use App\Models\Rssfeed;
use App\Models\Medication;
use App\Models\Permission;
use App\Models\ActivityLog;
use App\Models\Plan;
use App\Models\Promocode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Detection\MobileDetect;
use Illuminate\Support\Arr;

if (!function_exists('titleCase')) {
	function titleCase($value)
	{
		return ucwords(strtolower(str_replace('_', ' ', $value)));
	}
}

if (!function_exists('prePrint')) {
	function prePrint($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		die;
	}
}

if (!function_exists('pre')) {
	function pre($arr, $die = false)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		if ($die) {
			die;
		}
	}
}

if (!function_exists('strToSlug')) {
	function strToSlug($str, $slug = '_')
	{
		return (string) Str::of($str)->slug($slug);
	}
}

if (!function_exists('arrayEleToSlug')) {
	function arrayEleToSlug($array)
	{
		return array_map(function ($value) {
			return strToSlug($value);
		}, $array);
	}
}

if (!function_exists('slugToStr')) {
	function slugToStr($str, $slug = '_')
	{
		return Str::title(str_replace($slug, ' ', $str));
	}
}

if (!function_exists('addZeros')) {
	function addZeros($num)
	{
		return number_format((float)$num, 2, '.', '');
	}
}

if (!function_exists('dateFormat')) {
	function dateFormat($date, $format = 'd/m/Y')
	{
		if (!$date) {
			return 'N/A';
		}
		return Carbon::parse($date)->format($format);
	}
}

if (!function_exists('getTodayDate')) {
	function getTodayDate($addDays = 0, $format = 'Y-m-d')
	{
		return date($format, time() + ($addDays * 86400));
	}
}

if (!function_exists('getNextAlphaNumber')) {
	function getNextAlphaNumber($code, $numberOfAlpha = 1)
	{
		$alphPart = $code[0];
		$numPart = substr($code, 0 + $numberOfAlpha);
		return $alphPart . str_pad(intval($numPart) + 1, strlen($numPart), '0', STR_PAD_LEFT);
	}
}

if (!function_exists('generateRandomString')) {
	function generateRandomString($length = 20)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

if (!function_exists('showSelectedValue')) {
	function showSelectedValue($target = false, $point = false)
	{
		if ($point && $target)
			return ($target == $point) ? "selected" : "";
		else
			return false;
	}
}

if (!function_exists('curlRequest')) {
	function curlRequest($url = false, $data = [], $post_method = false, $headers = [], $requestHeader = false)
	{
		if ($url) {
			try {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				if ($post_method && $data) {
					if ($requestHeader) {
						curl_setopt($ch, CURLOPT_HEADER, true);
					}
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
				$response = curl_exec($ch);
				curl_close($ch);
				return $response;
			} catch (Exception $e) {
				return $e->getMessage();
			}
		}
	}
}

if (!function_exists('getAge')) {
	function getAge($dob)	{		if ($dob) {			$dob = str_replace(' ', '', $dob);			return Carbon::createFromFormat('d/m/Y', $dob)->age;		} else {			return 0;		}	}
}

if (!function_exists('findAge')) {
	function findAge($dob)
	{
		if ($dob) {
			$carbon = Carbon::parse($dob)->diff(Carbon::now());
			$y = $carbon->format('%y y');
			$m = $carbon->format('%m m');
			$d = $carbon->format('%d d');
			$h = $carbon->format('%h h');
			$i = $carbon->format('%i min');
			if ($y > 0) {
				return $y;
			} elseif ($m > 0) {
				return $m;
			} elseif ($d > 0) {
				return $d;
			} elseif ($h > 0) {
				return $h;
			} elseif ($i > 0) {
				return $i;
			} else {
				return 'Just now';
			}
		} else {
			return "";
		}
	}
}

/**
 * Get user details.
 */
if (!function_exists('single_user_details')) {
	function single_user_details($id = "" )
	{
        if( empty($id) ){
            $id = Auth::user()->id;
        }
		return User::where('id', $id)->first();
	}
}

/**
 * Get medication details of a user.
 */
if (!function_exists('get_medications')) {
	function get_medications($id)
	{
		return Medication::where('userId', $id)->get();
	}
}

/**
 * Get payment expiry date.
 */
if (!function_exists('get_payment_expiry_date')) {
	function get_payment_expiry_date($interval)
	{
		if ($interval == "monthly") {
			$expiry_date = Carbon::now()->addMonths(1);
		} else if ($interval == "Quarterly") {
			$expiry_date = Carbon::now()->addMonths(3);
		} else if ($interval == "four-month-package") {
			$expiry_date = Carbon::now()->addMonths(4);
		} else if ($interval == "semiannual") {
			$expiry_date = Carbon::now()->addMonths(6);
		} else {
			$expiry_date = Carbon::now()->addMonths(12);
		}
		return $expiry_date;
	}
}

if (!function_exists('get_all_modules')) {
	function get_all_modules()
	{
		$array = [];
		$all = ['View' => '_view', 'Add' => '_add', 'Edit' => '_edit', 'Delete' => '_delete'];
		foreach (Config::get('constants.MODULENAME') as $key => $value) {
			$module_id = str_replace(' ', '_', strtolower($value));
			foreach ($all as $allKey => $allValue) {
				if ($value == 'Dashboard') {
					if ($allValue == '_view') {
						$array[$module_id]['module_prefix'] = $module_id;
						$array[$module_id]['module_name'] = $value;
						$array[$module_id]['module_type'][$allKey] = $module_id . $allValue;
					}
				} elseif ($value == 'Manage Content') {
					if ($allValue == '_view') {
						$array[$module_id]['module_prefix'] = $module_id;
						$array[$module_id]['module_name'] = $value;
						$array[$module_id]['module_type'][$allKey . ' & ' . 'Edit'] = $module_id . $allValue;
					}
				} else {
					$array[$module_id]['module_prefix'] = $module_id;
					$array[$module_id]['module_name'] = $value;
					$array[$module_id]['module_type'][$allKey] = $module_id . $allValue;
				}
			}
		}
		return $array;
	}
}

if (!function_exists('ucfirst_and_remove')) {
	function ucfirst_and_remove($data, $symbol = '_')
	{
		return str_replace('_', ' ', ucfirst($data));
	}
}

if (!function_exists('permission_head_check')) {
	function permission_head_check($allData, $jsonData)
	{
		if ($allData && $jsonData) {
			$totalModule = count($allData);
			$i = 0;
			foreach ($allData as $key => $value) {
				if (in_array($value, $jsonData)) {
					$i++;
				}
			}
			if ($totalModule == $i) {
				return "checked";
			}
		}
		return '';
	}
}

if (!function_exists('get_permissions')) {
	function get_permissions()
	{
		return Permission::where('role_id', Auth::user()->admin_managers)
			->pluck('permissions')->first();
	}
}

if (!function_exists('get_user_type')) {
	function get_user_type()
	{
		return Auth::user()->user_role;
	}
}

if (!function_exists('permission_exist')) {
	function permission_exist($moduleName, $givenPermission = "")
	{
		if (Auth::user()->isAdmin()) {
			return true;
		}
		if (empty($givenPermission)) {
			$givenPermission = get_permissions();
		}
		if (Auth::user()->userRole->status) {
			if ($moduleName != '' && $givenPermission != '') {
				if (in_array($moduleName, json_decode($givenPermission))) {
					return true;
				}
			}
		}
		return false;
	}
}

if (!function_exists('firstRssFeed')) {
	function firstRssFeed()
	{
		if ($slug = Rssfeed::take(1)->first()) {
			return $slug['slug'];
		}
		return false;
	}
}

if (!function_exists('getOldData')) {
	function getOldData()
	{
	}
}

/* if (!function_exists('activityLog')) {
	function activityLog($old,$newData,$msg) {
		if( Schema::hasTable($old['table']) ) {
			$key = array_keys($old['where']);
			if(Schema::hasColumn($old['table'],$key[0])){
				$oldDetails = DB::table($old['table'])->where($old['where'])->first();
				if( $oldDetails ){

				}else{

				}
				ActivityLog::insert([
					'user_id' => Auth::user()->id,
					'old'     => json_encode($oldDetails),
					'new'     => json_encode($newData),
					'msg'	  => $msg,
					'created_at' => date('Y-m-d H:m:s')
				]);
				return true;
			}
			dd("{$key[0]} ({$old['table']}) column not exist");
		}
		dd("{$old['table']} Table not exist ");
	}
} */

if (!function_exists('activityLog')) {
	/*
		$msg    = Activity Msg
		$meta   = Extra data add
		$module = Add module name
	*/
	function activityLog($msg, $meta = "", $module = "", $customMsg = true)
	{
		if ($module && $customMsg) {
			$msgModule =  str_replace('-', " ", $module);
			$msg = "{$msg} in {$msgModule}";
		}
		if (isset(Auth::user()->id)) {
			ActivityLog::insert([
				'user_id'    => Auth::user()->id,
				'msg'	     => $msg,
				'meta'	     => json_encode($meta),
				'module'	 => $module,
				'created_at' => Carbon::now()
			]);
		}
	}
}

if (!function_exists('convert_number')) {
	function convert_number($number)
	{
		if (($number < 0) || ($number > 999999999)) {
			throw new Exception("Number is out of range");
		}
		$giga = floor($number / 1000000);
		$number -= $giga * 1000000;
		$kilo = floor($number / 1000);
		$number -= $kilo * 1000;
		$hecto = floor($number / 100);
		$number -= $hecto * 100;
		$deca = floor($number / 10);
		$n = $number % 10;
		$result = "";
		if ($giga) {
			$result .= $this->convert_number($giga) .  "Million";
		}
		if ($kilo) {
			$result .= (empty($result) ? "" : " ") . $this->convert_number($kilo) . " Thousand";
		}
		if ($hecto) {
			$result .= (empty($result) ? "" : " ") . $this->convert_number($hecto) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($deca || $n) {
			if (!empty($result)) {
				$result .= " and ";
			}
			if ($deca < 2) {
				$result .= $ones[$deca * 10 + $n];
			} else {
				$result .= $tens[$deca];
				if ($n) {
					$result .= "-" . $ones[$n];
				}
			}
		}
		if (empty($result)) {
			$result = "zero";
		}
		return $result;
	}
}

if (!function_exists('jsConvertPhpDate')) {
	function jsConvertPhpDate($jsDate)
	{
		$counsltJsDate = $jsDate;
		$counsltJsDate = str_replace(',', '', $counsltJsDate);
		$convertArray = explode(' ', $counsltJsDate);
		$y = date('Y', strtotime($convertArray[3]));
		$m = date('m', strtotime($convertArray[0]));
		$d = date('d', strtotime($convertArray[2]));
		$t = date('h:i A', strtotime($convertArray[4]));
		return "{$d}-{$m}-{$y} {$t}";
	}
}

if (!function_exists('labelh5')) {
	function labelh5($text)
	{
		return "<div class='col-md-12 p-3'>
				<label>
					<h5>{$text}</h5>
				</label>
			</div>";
	}
}

if (!function_exists('comTitleNDesc')) {
	function comTitleNDesc($titlename, $descName,$slugValue = '', $titlevalue = "", $descValue = "")
	{
		return "<div class='servicesTitleAndDes'>
            <div class='titleADes form-group'>
                <label>Title</label>
                <input type='text' class='form-control' name='{$titlename}' value='{$titlevalue}'>
            </div>
            <div class='titleADes form-group'>
                <label>Slug</label>
                <input type='text' class='form-control' name='company-details[slug]' value='{$slugValue}'>
            </div>
            <div class='titleADes form-group'>
                <label>Description</label>
                <textarea class='form-control servicesDescription' name='{$descName}' id='{$descName}'>{$descValue}</textarea>
            </div>
        </div>";
	}
}

if (!function_exists('titleNDesc')) {
	function titleNDesc($titlename, $descName, $titlevalue = "", $descValue = "")
	{
		return "<div class='servicesTitleAndDes'>
            <div class='titleADes form-group'>
                <label>Title</label>
                <input type='text' class='form-control' name='{$titlename}' value='{$titlevalue}'>
            </div>
            <div class='titleADes form-group'>
                <label>Description</label>
                <textarea class='form-control servicesDescription' name='{$descName}' id='{$descName}'>{$descValue}</textarea>
            </div>
        </div>";
	}
}

if (!function_exists('titleNDescWithOutCKD')) {
	function titleNDescWithOutCKD($titlename, $descName, $titlevalue = "", $descValue = "")
	{
		return "<div class='servicesTitleAndDes'>
            <div class='titleADes form-group'>
                <label>Title</label>
                <input type='text' class='form-control' name='{$titlename}' value='{$titlevalue}'>
            </div>
            <div class='titleADes form-group'>
                <label>Description</label>
                <textarea rows='6' class='form-control servicesWckdDescription' name='{$descName}' id='{$descName}'>{$descValue}</textarea>
            </div>
        </div>";
	}
}

if (!function_exists('imageSelector')) {
	function imageSelector($name, $unique = "companyDetails", $style = "", $image = "", $showClose = 0)
	{
		$id = "";
		if (isset($image['id'])) {
			$id = $image['id'];
		}
		if (empty($image)) {
			$image = 'images/dummy.jpg';
		} else {
			if (is_array($image)) {
				$image =  $image['image'];
			} else {
				$image =  $image;
			}
		}
		$image = asset($image);
		if ($showClose) {
			$remove = "<div class='serviceimagesRemove'><i class='fas fa-times'></i></div>";
		} else {
			$remove = "<div class='serviceimagesRemove'></div>";
		}
		return "<div class='avatar-upload'>
            <div class='avatar-edit'>
                <input type='file' name='{$name}' data-page-id='{$unique}{$id}' data-is-changed='no' data-editor-index='{$unique}{$id}' data-section-name='section3-left' id='filePhoto{$unique}{$id}' class='required borrowerImageFile custom-file-input changeExistImage' data-element-type='old' image-id='{$id}'>
                <label for='filePhoto{$unique}{$id}'></label>
            </div>
            <div class='avatar-preview'>
                <img class='profile-user-img {$name} img-responsive img-circle' id='previewHolder{$unique}{$id}' src='{$image}' style='{$style}'>
            </div>
			{$remove}
        </div>";
	}
}


if (!function_exists('changeStatus')) {
	function changeStatus($name,$checked = 0)
	{
		$check = '';
		if( $checked ){
			$check ='checked';
		}

		return "<div class='servicesStatus avatar-upload'>
			<label class='switch'>
				<input type='checkbox' name='{$name}' {$check}>
				<span class='slider round'></span>
			</label>
		</div>";
	}
}


if (!function_exists('servicesName')) {
	function servicesName()
	{
		$compnay =  Company::where('status', 1)->get()->toArray();
		if (!empty($compnay)) {
			$html = "";
			foreach ($compnay as $key => $value) {
				$href = "services/{$value['slug']}";
				$name = $value['name'];
				$html .= "<li><a class='dropdown-item' href='{$href}'>{$name}</a></li>";
			}
			return $html;
		}
		return false;
	}
}

if( !function_exists('get_all_menu') ){
	function get_all_menu(){
        $menu = Pages::where('status',1)->orderBy('sort','asc')->get()->toArray();
        return menu_reorder($menu);
    }
}

if( !function_exists('has_children') ){
	function has_children($rows,$id){
        foreach ($rows as $row) {
            if ($row['parent_id'] == $id)
            return true;
        }
        return false;
    }
}

if( !function_exists('menu_reorder') ){
	function menu_reorder($rows,$parent=0){
		$i = 1;
		if( $parent == 0 ){
			$result = '<ul class="navbar-nav mr-auto mt-2 mt-lg-0">';
		}else{
			$result = '<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
		}
        foreach ($rows as $row)
        {
			$pageName = trim($row['page_name']);
			$slug = 'javascript:void(0)';
            if(!empty($row['slug'])){
				$slug = url($row['slug']);
			}
			if ($row['parent_id'] == $parent){
				if( $parent == 0 ){
					if( $row['slug'] ){
						$result.= "<li class='nav-item'>
						<a class='nav-link' href='{$slug}'>{$pageName}</a>";
					}else{
						$result.= "<li class='nav-item dropdown'>
							<a class='nav-link dropdown-toggle' href='{$slug}' id='navbarDropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
								{$pageName}
							</a>";
					}
				}else{
					if( $row['slug'] ){
						$result .= "<li>
									<a class='dropdown-item' href='{$slug}'>{$pageName}</a>";
					}else{
						$result .= "<li class='dropdown-submenu'>
									<a class='dropdown-item dropdown-toggle' href='{$slug}'>{$pageName}</a>";
					}
				}
				if (has_children($rows,$row['id'])){
					$result.= menu_reorder($rows,$row['id']);
				}
            $result.= "</li>";
            $i++;
            }
        }
        $result.= "</ul>";
        return $result;
	}

}

if( !function_exists('removeEmptyRows') ){
	function removeEmptyRows($rows){
		$returnData = [];
		$rows = (isset($rows[0]))?$rows[0]:'';
		if( !empty($rows) ){
			$i = 1;
			foreach($rows as $key => $value){
				if( !empty($value[0]) || !empty($value[1]) || !empty($value[2]) || !empty($value[3])
					|| !empty($value[4]) || !empty($value[5]) ){
					$returnData[] = $value;
					$i = 1;
				}else{
					$i++;
				}
				if( $i > 10 ){
					goto end;
				}
			}
			end:
		}
		return $returnData;
	}
}

if( !function_exists('checkTimezone') ){
	function checkTimezone($data,$name){
		$id = 0;
		if( $name ){
			foreach($data as $value){
				$timeExplode = explode('(',$value['name']);
				if(str_contains($timeExplode[0],$name)){
					$id = $value['id'];
				}
			}
		}
		return $id;
	}
}

if( !function_exists('telemedicineArray') ){
	function telemedicineArray($input,$password){
		$gender = 'm';
		if( isset($input['gender']) ){
			if( $input['gender'] == 'Male' ){
				$gender = 'm';
			}else{
				$gender = 'f';
			}
		}
		return [
                "primaryExternalId" => $input['id'],
                "planDetailsId" => $input['planDetailsId'],
                "firstname" => $input['fname'],
                "lastname" => $input['lname'],
                "gender" => $gender,
                "primaryPhone" => $input['primaryPhone'],
				'address2'     => $input['address2'],
                "groupCode" => Config::get('constants.groupCode'),
                "planid" => $input['planid'],
                "dob" => $input['dob'],
                "email" => $input['email'],
                "password" => $password,
                "heightFeet" => isset($input['heightFeet']) ? $input['heightFeet'] : 0,
                "heightInches" => isset($input['heightInches']) ? $input['heightInches'] : 0,
                "weight" => isset($input['weight']) ? $input['weight'] : 0,
                "address" => $input['address'],
                "zipCode" => $input['zipCode'],
                "city" => $input['city'],
                "stateid" => $input['stateid'],
                "disableNotifications" => isset($input['disableNotifications']) ? $input['disableNotifications'] : 0,
                "sendRegistrationNotification" => isset($input['sendRegistrationNotification']) ? $input['sendRegistrationNotification'] : 1,
                "numAllowedDependents" => isset($input['numAllowedDependents']) ? $input['numAllowedDependents'] : 8,
				"timezoneId" => $input['timezoneId'],
		];
	}
}

if( !function_exists('checkSubscription') ){
	function checkSubscription($row,$start,$end){
		if( !isset($row[4][1]) || empty($row[4][1]) ){
			return 0;
		}
		$groupId = 0;
		for($i = $start;$i <= $end;$i++  ){
			if( !empty($row[4][1]) ){
				$checkSubs = explode(')',$row[$i][0]);
				$groupData = explode('Group#',$row[$i][0]);
				if( $checkSubs[0] == $row[4][1] ){
					if( isset($groupData[1]) && !empty($groupData[1]) ){
						$groupId = (int)trim($groupData[1]);
					}
				}
			}
		}
		return $groupId;
	}

}

if( !function_exists('getStateId') ){
	function getStateId($state,$stateName){
		$stateId = "";
		foreach($state as $key => $value){
			if( $value['name'] == $stateName ){
				$stateId = $value['id'];
				goto end;
			}
		}
		end:
		return $stateId;
	}
}

if( !function_exists('extractImportData') ){
		function extractImportData($value){
			$explodeName = explode(' ',$value[0]);
			return ['name'         => trim($value[0]),
					'fname'        => $explodeName[0],
					'lname'        => $explodeName[1]??$explodeName[0],
                    'dob'          => Date::excelToDateTimeObject($value[2])->format('d/m/Y'),
                    'gender'       => trim($value[3]),
					'email'   	   => trim($value[4]),
                    'primaryPhone' => trim($value[5]),
                    'address'      => trim($value[6]),
                    'address2'     => trim($value[7]),
                    'city'         => trim($value[8]),
                    'state'        => trim($value[9]),
                    'zipCode'      => trim($value[10]),
                    'user_role'    => 'user',
			];
		}
}

if( !function_exists('checkEmptyColumn') ){
	function checkEmptyColumn($value,$errorIndex){
		$emptyColumn = false;
		for($empty = 0; $empty <= 12; $empty++ ){
			if( empty($value[$empty]) ){
				$emptyColumn = true;
				goto end;
			}
		}
		end:
		return $emptyColumn;
	}
}

if( !function_exists('chartJsData') ){
	function chartJsData($chartData,$type,$dataType = 'Month'){
		if( $chartData ){

			$dayStart = 1;
			$dayEnd   = date('t');
			$label = $data = [];
			$start = 1;
			$end   = date('t');

			if( $dataType == 'Week' ){
				$start = removeZero(date('d',strtotime('-6 Days')));
				$end = removeZero(date('d'));
			}elseif( $dataType == 'Year' ){
				$year['labals'] = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
				$end = count($year['labals']);
			}

			for($i = $start;$i <= $end;$i++){
					$label['labals'][] =  "{$i}";
				if( isset($chartData[$type][$i]) && !empty($chartData[$type][$i])  ){
					foreach($chartData[$type][$i] as $key => $value){
						$data['graphData'][$key]['name'] =  $value['mood_name'];
						$data['graphData'][$key]['values'][$i] =  count($value['mood_count']);
						$data['graphData'][$key]['colors'] = rand_color();
					}
				}

			}

			$newArray = [];
			$j = 0;
			if( !empty($data['graphData']) ){

				foreach($data['graphData'] as $key => $value ){
					$newArray['graphData'][$j]['name'] = $value['name'];

					for($i = 0;$i < count($label['labals']) ;$i++){

						if( isset($value['values'][$label['labals'][$i]])  ){
							$newArray['graphData'][$j]['values'][$i] = $value['values'][$label['labals'][$i]];
							$newArray['graphColor'][$j]['colors'][$i] = $value['colors'];
						}else{
							$newArray['graphData'][$j]['values'][$i] = 0;
							$newArray['graphColor'][$j]['colors'][$i] = 0;
						}

					}

					$j++;
				}
				if( $dataType == 'Year' ){
					$newData = $year + $newArray;
				}else{
					$newData = $label + $newArray;
				}
				return json_encode($newData);
			}
		}
		return false;
	}
}

if( !function_exists('rand_color') ){
	function rand_color(){
		return "#" .  str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}
}

if( !function_exists('removeZero') ){
	function removeZero($date){
		if( $date < 9 ){
                $date = str_replace(0,'',$date);
        }
		return $date;
	}
}
if( !function_exists('graphDataBydate') ){
	function graphDataBydate($type = ''){
		
		if (!empty(request('startDate')) && !empty(request('endDate'))) {
			$start = Carbon::parse(request('startDate'))->format('j M');
			$end = Carbon::parse(request('endDate'))->format('j M');
			
		} else {
			$startDate = Carbon::now()->subMonths(12);
			$endDate = Carbon::now();
			$start = $startDate->format('j M');
			$end = $endDate->format('j M');	
			/* $date = (date('1 M')." - ".date('t M') );
			if( $type == 'Week' ){
				$start = date('d',strtotime('-6 Days'))." ".date('M');
				$end = date('d')." ".date('M');
				$date = ($start ." - ". $end);
			}elseif($type == 'Year'){
				$date = "Jan - Dec ";
			} */
			
		
		}
		return $date = " $start - $end ";
	}
}

if( !function_exists('emojiCustomImg') ){

	function emojiCustomImg($mood){
		switch($mood){
			case ':HAPPY:':
				return 'emoji-css/happy.png';
			break;
			case ':SAD:':
				return 'emoji-css/sad.png';
			break;
			case ':DISGUST:':
				return 'emoji-css/disgust.png';
			break;
			case ':ANGER:':
				return 'emoji-css/angry.png';
			break;
			case ':FEAR:':
				return 'emoji-css/fear.png';
			break;
			case ':SURPRISE:':
				return 'emoji-css/surprise.png';
			break;
		}
		return '';
	}

	function emojiCustomImgMobile($mood){
		switch($mood){
			case ':HAPPY:':
				return 'assets/dashboard/assets/images/happy-imozi-svg.svg';
			break;
			case ':SAD:':
				return 'assets/dashboard/assets/images/sad-imozi-svg.svg';
			break;
			case ':DISGUST:':
				return 'assets/dashboard/assets/images/disgusted-imozi-svg.svg';
			break;
			case ':ANGER:':
				return 'assets/dashboard/assets/images/angry-imozi-svg.svg';
			break;
			case ':FEAR:':
				return 'assets/dashboard/assets/images/fearful-imozi-svg.svg';
			break;
			case ':SURPRISE:':
				return 'assets/dashboard/assets/images/surpriced-imozi-svg.svg';
			break;
		}
		return '';
	}
}

if( !function_exists('converToTz') ){
	function converToTz($time="",$toTz='',$fromTz=''){
		/* echo $time;
		echo '<br>';
		echo $toTz;
		echo '<br>';
		echo $fromTz;
		die; */
        $date = new DateTime($time, new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time= $date->format('Y-m-d H:i:s');
        return $time;
    }
}


if( !function_exists('userMedicalDetails') ){
	function userMedicalDetails ()
	{
        $payment = User::where(['payment_status' => 1,'id' => Auth::user()->id])->count();
		$um = UserMeta::where(['user_id' => Auth::user()->id,'meta_key' =>'medical_process','prefix'=>'iwilltilimwell' ])->get();
		if( (!isset($um[0]) && empty($um[0])) && ($payment > 0 ) ){
			return true;
		}
		return false;

	}
}

if( !function_exists('orgServicesName') ){
	function orgServicesName ($name)
	{
        $name = json_decode($name,true);
        $nameKey = array_keys($name);
        $newArray = "<ul>";
        foreach($nameKey as $value){

            if( isset($name[$value]) && $name[$value] ){
                if( $value == 'emotional-wellness' ){
                    $newArray .= "<li>Mental Health</li>";
                }elseif( $value == 'medical-care' ){
                    $newArray .= "<li>Medical Care</li>";
                }elseif( $value == 'tele-pet-now' ){
                    $newArray .= "<li>Pet</li>";
                }
            }
        }
        $newArray .= "<ul>";
        if( $newArray ){
            return $newArray;
        }
        return 'N/A';

	}
}

if( !function_exists('singleArray') ){
    function singleArray($singleArray){
        $result = [];
        if( !empty($singleArray) ){
            foreach($singleArray as $key => $value){
                foreach($value as $keySub => $keyValue){
                    $result[$keySub] = $keyValue;
                }
            }
        }
        return $result;
    }
}

if( !function_exists('selectedOption') ){
    function selectedOption($selectedVar="",$equalTwo=""){
        if(  $selectedVar == $equalTwo && !empty($selectedVar) ){
            return 'selected';
        }
        return "";
    }

}


if( !function_exists('checkedIcon') ){
    function checkedIcon($equalTwo, $checkVar = ""){
        if( !empty($checkVar) && $checkVar == $equalTwo ){
            return 'checked';
        }
        return "";
    }
}

if( !function_exists('menu_access') ){
    function menu_access($menuName){
        /* $services = json_decode(Auth::user()->companyData->services_status,true);
        if( !empty($services) ){
            foreach($services as $key => $value){
                if( $key == $menuName && $value ){
                    return true;
                }
            }
        } */
        return true;
    }

}

if( !function_exists('checkProfileComplete') ){
    function checkProfileComplete(){
        $user = Auth::user();
		if(!isset($user->id) ){
			return false;
		}

        $check = UserMeta::where(['user_id' => $user->id, 'meta_key' => 'counseling-type','meta_value' => 'counseling-consent','prefix' =>   'iwilltilimwell'])->count();
        $userPayment = User::where('id',$user->id)->pluck('payment_status');
        if( $check || (isset($userPayment[0]) && !$userPayment[0] )){
            return false;
        }
        return true;
    }

}

if( !function_exists('checkHealthRecordStart') ){
    function checkHealthRecordStart(){
        $user = Auth::user();
        if(!isset($user->id)){
			return false;
		}

        $check = $user->doctor_step;
        if( $check == 0){
            return true;
        }
        return false;
    }

}

if( !function_exists('finalStepComplete') ){
    function finalStepComplete(){
        $user = Auth::user();
        if(!isset($user->id)){
			return false;
		}
        $check = $user->doctor_step;
        if( $check == 5){
            return true;
        }
        return false;
    }
}

if( !function_exists('getStepHealth') ){
    function getStepHealth(){
        $user = Auth::user();
        if(!isset($user->id)){
			return 0;
		}
        return $user->doctor_step;
    }

}

if( !function_exists('personalSettingComplete') ){
    function personalSettingComplete(){
        $user = Auth::user();
        if(!isset($user->id)){
            return false;
        }

       $check = UserMeta::where(['user_id' => $user->id, 'meta_key' => 'personal_setting','prefix' => 'iwilltilimwell'])->count();
        if( $check   ){
            return false;
        }
        return true;
    }
}

if( !function_exists('checkSettingComplete') ){
    function checkSettingComplete(){
        $user = Auth::user();
        if(!isset($user->id)){
			return false;
		}

        $check = UserMeta::where(['user_id' => $user->id, 'meta_key' => 'checkSettingComplete','prefix' => 'iwilltilimwell'])->count();
        if( $check ){
            return false;
        }
        return true;
    }
}

if( !function_exists('checkAppComplete') ){
    function checkAppComplete(){
        $user = Auth::user();
        if(!isset($user->id)){
			return false;
		}

        $check = UserMeta::where(['user_id' => $user->id, 'meta_key' => 'checkAppComplete','prefix' => 'iwilltilimwell'])->count();
        if( $check ){
            return false;
        }
        return true;
    }
}

if( !function_exists('getMenuLink') ){
    function getMenuLink($segment = 0){
        $link = [];
        if( $segment ){
            for($i = 1;$i <= $segment;$i++ ){
                if( !empty(getSegment($i)) ){
                    $link[] = getSegment($i);
                }

            }
        }
        if( $link ){
            $link = implode('/',$link);
        }
        return $link;

    }
}

if( !function_exists('getSegment') ){
    function getSegment($segment){
        $explode = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $explodeCheck = isset($explode[$segment])?$explode[$segment]:'';
        $checkSubDomain = $explode[1]??'';
        if( $checkSubDomain == 'imwell' ){
            $segment = $segment + 1;
            $explodeCheck = isset($explode[$segment])?$explode[$segment]:'';
        }
        return $explodeCheck;
    }

}

if( !function_exists('getBrowser') ){
	function getBrowser()
	{
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		
		if (strpos($userAgent, 'Chrome') !== false) {
			return 'Google Chrome';
		} elseif (strpos($userAgent, 'Firefox') !== false) {
			return 'Mozilla Firefox';
		} elseif (strpos($userAgent, 'Safari') !== false) {
			return 'Apple Safari';
		} elseif (strpos($userAgent, 'Edge') !== false) {
			return 'Microsoft Edge';
		} elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident/') !== false) {
			return 'Internet Explorer';
		} else {
			return 'Unknown Browser';
		}
	}
}

if( !function_exists('isMobile') ){
    function isMobile(){
	
        $detect = new MobileDetect();
		$isMobile = $detect->isMobile();
		$isMobile  = ($isMobile) ? true : false;
		if($isMobile) {
			return $isMobile;
		} else {
			 $getBrowser = getBrowser();
			if($getBrowser=="Apple Safari") {
				return true;
			}
		}
		return false;
    }
}

if (!function_exists('sendSmsViaTextBelt')) {
	function sendSmsViaTextBelt ($number = null, $msg = "") {

		if(env('TEXT_BELT_MODE')=="active") {
				try {
					if ($number && $msg) {
						$ch = curl_init(env('TEXT_BELT_URL'));
						$data = array(
							'phone' => $number,
							'message' => $msg,
							'key' => env('TEXT_BELT_KEY'),
						);

						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

						$response = curl_exec($ch);
						curl_close($ch);
						return $response;
					} else {
						return false;
					}
				} catch (Exception $err) {
					return $err->getMessage();
				}
		} else {

			return  '{"success":true,"textId":"643921734675705538","quotaRemaining":2524}';

		}
	}
}

if (!function_exists('GetFinalAmountOfPayment')) {
	function GetFinalAmountOfPayment() {

	$user = User::where("id",Auth::user()->id)->first();
	$braintree_amount = 0;
	if($user->plan) {
		$plan =  $user->plan;
		$planDetails = Plan::where('id', $plan)->first();
		$final_amount = NULL;
		$braintree_amount = $planDetails->amount;
		if($user->promo_code_id) {
			$promoDetails = Promocode::where('id', $user->promo_code_id)->first();
			$discount_amount = $promoDetails->member_discount_type == "fixed" ? $promoDetails->member_discount_amount :  round(($planDetails->amount * $promoDetails->member_discount_amount / 100), 2);
			$final_amount = round(($planDetails->amount - $discount_amount), 2);
			$braintree_amount = $final_amount;
		}
	}

	$optionalAmount = GetPackageOptionalAmount();
	if($optionalAmount) {
		$braintree_amount +=$optionalAmount;
	}
	
	return number_format($braintree_amount,2);
}
}

function GetPackageOptionalService() {
	return  UserMeta::where('user_id', Auth::user()->id)->where('meta_key', 'optional_service')->value('meta_value');
}
function GetPackageOptionalAmount() {
	return  UserMeta::where('user_id', Auth::user()->id)->where('meta_key', 'optional_amount')->value('meta_value');
}
function GetSelectedPackageServiceList() {
	return  UserMeta::where('user_id',Auth::user()->id)->where('meta_key', 'package_service_list')->pluck('meta_value')->first();
}
function  GetUserMetaWithMetaKey($meta_key,$user_id) {
	return  UserMeta::where('user_id',Auth::user()->id)->where('meta_key',$meta_key)->pluck('meta_value')->first();
}
function GetPackageOptionalBundleID() {
	return  UserMeta::where('user_id',Auth::user()->id)->where('meta_key', 'bundle_id')->pluck('meta_value')->first();
}



if (!function_exists('GetHealthRecordProcessBarPercentage')) {
    function GetHealthRecordProcessBarPercentage($request_from=null)
    {
		
		$completed_steps =  0;
		$steps = GetTableList();
		$completed_steps = getCompletedSteps($steps);
		$onestep_value = 100/count($steps);
		$completed_process_percentage = $completed_steps*$onestep_value;
		$heading = "Finish Your Profile 01";
		if($completed_process_percentage==100) {
			$heading = "Completed";
		}
        $html = '<section class="progress-main">
			<div class="cust-container-md">
				<div class="custom-progress">
					<div class="bar-title">
						<div class="left">
							<p><a href="'.url('/personal-record').'">Health Record</a></p>
						</div>
						<div class="right">
							<p><a href="'.url('/personal-record').'">'.$heading.'</a></p>
						</div>
					</div>
					<div class="bar-value">
						<progress id="progress-bar-1" value="'.$completed_process_percentage.'" max="100">'.$completed_process_percentage.' %</progress>
						<output id="progress-output-1">'.$completed_process_percentage.'%</output>
					</div>
				</div>
			</div>
		</section>';
		
		if($request_from=="web-dashboard"){
			
			$html ='<div class="bar-title"><p><a href="'.url('/personal-record').'">Health Record</a></p><p><a href="'.url('/personal-record').'">'.$heading.'</a></p></div><div class="custom-progress"><div class="bar-value"><progress id="progress-bar-1" value="'.$completed_process_percentage.'" max="100">'.$completed_process_percentage.' %</progress><output id="progress-output-1">'.$completed_process_percentage.'%</output></div></div>';
		}
		
		return $html; 
    }
}

if (!function_exists('GetTableList')) {
	function GetTableList() {
		$steps = [
			['table' => 'user_details', 'match_id' => 'user_id'],
			['table' => 'medication', 'match_id' => 'userId'],
			['table' => 'medication_allergy', 'match_id' => 'userId'],
			['table' => 'medical_conditions', 'match_id' => 'userId'], 
			['table' => 'users', 'match_id' => 'userid']
		];
		return $steps;
	}
}
if (!function_exists('getCompletedSteps')) {
	function getCompletedSteps($steps) {
		$user_info = Auth::user();
		$completed_steps = 0; 
		if($user_info->doctor_step==5){
			$completed_steps = 5;
		}else if($user_info->doctor_step==4){
			$completed_steps = 4;
		}
		/* $login_id = Auth::user()->id;
		
		$user_info = DB::table('users')->where('id', $login_id)->get(); */
	
		/* foreach ($steps as $index => $step) {

			if($step['table']=="users") {
				$exists = DB::table($step['table'])->where('id', $login_id)->where('doctor_step', '5')->exists();
			} else {
				if($step['table']=="user_details"){
					$exists = DB::table($step['table'])->where($step['match_id'], $login_id)->exists();
				} else {
					$exists = DB::table($step['table'])->where($step['match_id'], $login_id)->whereNull('deleted_at')->exists();
				}
				
			}
			if ($exists) {
				$completed_steps++;
			}
			
		} */
		return $completed_steps;
	}
}


if( !function_exists('convertDateToUserTimeZone') ){
    function convertDateToUserTimeZone($date) {
        if (!$date) {
            return false;
        }
        
        // Get user's IP address
        $userIpAddress = $_SERVER['REMOTE_ADDR'];
    
        // Get user's timezone based on their IP address
        $timezoneData = json_decode(file_get_contents('http://ip-api.com/json/' . $userIpAddress));
    
        // Default to UTC if timezone detection fails
        $userTimezone = $timezoneData->timezone ?? 'UTC';
    
        // Convert date to user's timezone and format it
        $formattedDate = Carbon::parse($date)->timezone($userTimezone)->format('D M d Y H:i');
    
        return $formattedDate;
    }
}

if( !function_exists('randomColor') ){
	function randomColor ($value)
	{
		switch ($value) {
			case 0:
				return '';
			case 1:
				return '#cce5ff';
			case 2:
				return '#e2e3e5';
			case 3:
				return '#fff3cd';
			case 4:
				return '#d4edda';
			case 5:
				return '#f8d7da';
			case 6:
				return '#d1ecf1';
		}

	}
}

function usformatting($phone){

    // Pass phone number in preg_match function
    if(preg_match(
        '/^\+[0-9]([0-9]{3})([0-9]{3})([0-9]{4})$/',
    $phone, $value)) {
        return $format = "+1". "($value[1])" . '-' .
            $value[2] . '-' . $value[3];
    }
}
function getPackageServiceList($plan_id) {
	
	$data[1] = [1,2,3];
	$data[3] = [1,2,3,16];
	$data[5] = [1,2,3,16,19];
	$data[7] = [1,2,3,4,5,15,16,19,9];
	
	$data[2] = [1,2,3];
	$data[4] = [1,2,3,16];
	$data[6] = [1,2,3,16,19];
	$data[8] = [1,2,3,4,5,15,16,19];
	
	return $data[$plan_id];
	
}
function getPackageIncludeList() {
	
	/*
	1 -> A Package 
	2 -> A + Family 
	3 -> B Package 
	4 -> B + Family 
	5 ->
	6 ->
	7 -> D Package Psychology
	8 -> 
	TelePet 
	*/ 
	
	$data[] = array("id"=>"1","name"=>"Virtual Urgent Care","include_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"option_ids"=>[],"price"=>"0","description"=>"");
	$data[] = array("id"=>"2","name"=>"Message a Specialist","include_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"option_ids"=>[],"price"=>"0");
	$data[] = array("id"=>"3","name"=>"Care Coordinators","include_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"option_ids"=>[],"price"=>"0");
	$data[] = array("id"=>"4","name"=>"Dermatology","include_ids"=>[7,8,13,14,15,16],"option_ids"=>[],"price"=>"0");
	
	$data[] = array("id"=>"5","name"=>"Virtual Primary Care","include_ids"=>[7,8,13,14,15,16],"option_ids"=>[],"price"=>"0"); 
	
	/*
	$data[] = array("id"=>"6","name"=>"Psychology","include_ids"=>[3,4,5,6,7,8],"option_ids"=>[],"price"=>"10");
	$data[] = array("id"=>"7","name"=>"Psychiatry","include_ids"=>[3,4,5,6,7,8],"option_ids"=>[],"price"=>"10");
	
	
	//$data[] = array("id"=>"8","name"=>"Care Navigators","include_ids"=>[1,2,3,4,7,9],"option_ids"=>[],"price"=>"10");
	*/ 
	$data[] = array("id"=>"9","name"=>"TeleVet Pet Care","include_ids"=>[],"option_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"price"=>"20","fm_price"=>"20","description"=>"Virtual Veterinary Care for Pets.");
	
	/*
	//$data[] = array("id"=>"10","name"=>"Psychiatry + Psychology","price"=>"10","option_ids"=>[1,2],"include_ids"=>[]);
	//$data[] = array("id"=>"11","name"=>"Prescription","price"=>"10","option_ids"=>[1,2,3,4],"include_ids"=>[]);
	*/
	
	$data[] = array("id"=>"12","name"=>"Weight Loss Management","option_ids"=>[1,3,5,7],"include_ids"=>[],"price"=>"300","fm_price"=>"0","description"=>"Promotes Appetite Control and Weight Loss."); 
	
	/*
	$data[] = array("id"=>"13","name"=>"Prescriptions","option_ids"=>[1,2,3,4],"include_ids"=>[],"price"=>"10");
	 
	$data[] = array("id"=>"14","name"=>"Affirmations Sharing","option_ids"=>[],"include_ids"=>[1,2,3,4,5,6,7,8],"price"=>"10");
    
	*/
	$data[] = array("id"=>"15","name"=>"Labs","option_ids"=>[],"include_ids"=>[7,8,13,14,15,16],"price"=>"10");    
	
	$data[] = array("id"=>"16","name"=>"Behavioral Health","option_ids"=>[1,2],"include_ids"=>[3,4,5,6,7,8,13,14,15,16],"price"=>"20","fm_price"=>"30","description"=>"Psychology, Psychiatry");    
	
	
	
	$data[] = array("id"=>"19","name"=>"Advanced Behavioral Health","option_ids"=>[1,2,3,4],"include_ids"=>[5,6,7,8,13,14,15,16],"price"=>"10","fm_price"=>"12","description"=>"Mood, Journals, Safety Plans, CBT, GAD-7, PHQ-9");  

	$data[] = array("id"=>"17","name"=>"Silver Prescription Plan","option_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"include_ids"=>[],"price"=>"10","fm_price"=>"10","description"=>"");    
	$data[] = array("id"=>"18","name"=>"Gold Prescription Plan","option_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"include_ids"=>[],"price"=>"15","fm_price"=>"15","description"=>"");
	$data[] = array("id"=>"20","name"=>"Platinum Prescription Plan","option_ids"=>[1,2,3,4,5,6,7,8,13,14,15,16],"include_ids"=>[],"price"=>"20","fm_price"=>"20","description"=>"");
	

 	return $data;
}



function getPackageServiceBundleList() {

	$data = [
				'1_2' => [

					'5042' => [1,2,3,9,12,16],
					'5042_0000' => [1,2,3,9,12,16,19],
					
					'5043' => [1,2,3,9,12],
					'5043_0000' => [1,2,3,9,12,19],
					
					'5044' => [1,2,3,9,16],
					'5044_0000' => [1,2,3,9,16,19],
					
					'5045' => [1,2,3,9],
					'5045_0000' => [1,2,3,9,19],
					
					'5050' => [1,2,3,12,16],
					'5050_0000' => [1,2,3,12,16,19],
					
					'5051' => [1,2,3,12],
					'5051_0000' => [1,2,3,12,19],
					
					'5052' => [1,2,3,16],
					'5052_0000' => [1,2,3,16,19],
					
					'5053' => [1,2,3],
					'5053_0000' => [1,2,3,19],
					
				],
				'3_4' => [
				
					'5052' => [1,2,3,16],
					'5052_0000' => [1,2,3,16,19],
					
					'5044' => [1,2,3,16,9],
					'5044_0000' => [1,2,3,16,9,19],
					
					'5050' => [1,2,3,16,12],
					'5050_0000' => [1,2,3,16,12,19],
					
					'5043' => [1,2,3,16,9,12],
					'5043_0000' => [1,2,3,16,9,12,19],
				],
				'5_6' => [
					
					'5044' => [1,2,3,9,16,19],
					'5052' => [1,2,3,16,19],
					'5050' => [1,2,3,12,16,19],
					'5042' => [1,2,3,16,19,9,12],
					
				],
				'7_8' => [
				
					'5064' => [1,2,3,4,5,15,16,19],				
					'5055' => [1,2,3,4,5,15,16,19,9],				
					'5056' => [1,2,3,4,5,15,16,19,9,12],				
					'5057' => [1,2,3,4,5,15,16,19,12],				
			
				],
				'13_14_15_16' => [
				
					'5064' => [1,2,3,4,5,15,16,19]				
			
				]

			];

	return $data;
}
function getPackageServiceBundleList_removeAff() {

	$data = [
				'1_2' => [

					'5042' => [1,2,3,14,9,12,16],
					'5042_0000' => [1,2,3,14,9,12,16,19],
					
					'5043' => [1,2,3,14,9,12],
					'5043_0000' => [1,2,3,14,9,12,19],
					
					'5044' => [1,2,3,14,9,16],
					'5044_0000' => [1,2,3,14,9,16,19],
					
					'5045' => [1,2,3,14,9],
					'5045_0000' => [1,2,3,14,9,19],
					
					'5050' => [1,2,3,14,12,16],
					'5050_0000' => [1,2,3,14,12,16,19],
					
					'5051' => [1,2,3,14,12],
					'5051_0000' => [1,2,3,14,12,19],
					
					'5052' => [1,2,3,14,16],
					'5052_0000' => [1,2,3,14,16,19],
					
					'5053' => [1,2,3,14],
					'5053_0000' => [1,2,3,14,19],
					
				],
				'3_4' => [
				
					'5052' => [1,2,3,14,16],
					'5052_0000' => [1,2,3,14,16,19],
					
					'5044' => [1,2,3,14,16,9],
					'5044_0000' => [1,2,3,14,16,9,19],
					
					'5050' => [1,2,3,14,16,12],
					'5050_0000' => [1,2,3,14,16,12,19],
					
					'5043' => [1,2,3,14,16,9,12],
					'5043_0000' => [1,2,3,14,16,9,12,19],
				],
				'5_6' => [
					
					'5044' => [1,2,3,14,9,16,19],
					'5052' => [1,2,3,14,16,19],
					'5050' => [1,2,3,14,12,16,19],
					'5042' => [1,2,3,14,16,19,9,12],
					
				],
				
				'7_8' => [
				
					'5064' => [1,2,3,4,5,14,15,16,19],				
					'5055' => [1,2,3,4,5,14,15,16,19,9],				
					'5056' => [1,2,3,4,5,14,15,16,19,9,12],				
					'5057' => [1,2,3,4,5,14,15,16,19,12],				
			
				],
				
				'13_14' => [
				
					'5064' => [1,2,3,4,5,15,16,19]			
					
				]

			];

	return $data;
}

function getPackageServiceBundleList_Backup() {

	$data = [
				'1_2' => [

					'5037' => [1,2,3,8,6,7,9,12,13],			 // Package-A 	9 	->1 
					'5038' => [1,2,3,8,9,12,13],     			 // Package-A 	7 	->2
					'5039' => [1,2,3,6,7,8,9,13],    			 // Package-A 	8 	->3
					'5040' => [1,2,3,8,9,13],        			 // Package-A 	6 	->4
					'5042' => [1,2,3,6,7,8,9,12],    			 // Package-A 	8 	->5
					'5043' => [1,2,3,8,9,12],		 			 // Package-A 	6 	->6
					'5044' => [1,2,3,6,7,8,9],       			 // Package-A 	7 	->7
					'5045' => [1,2,3,8,9],           			 // Package-A 	5 	->8
					'5046' => [1,2,3,6,7,8,12,13],   			 // Package-A 	8 	->9
					'5047' => [1,2,3,8,12,13],       			 // Package-A	6 	->10
					'5048' => [1,2,3,6,7,8,13],      			 // Package-A 	7 	->11 
					'5049' => [1,2,3,8,13],						 // Package-A 	5 	->12
					'5050' => [1,2,3,6,7,8,12],      			 // Package-A 	7 	->13
					'5051' => [1,2,3,8,12],			 			 // Package-A 	5	->14
					'5052' => [1,2,3,6,7,8],	     			 // Package-A 	6 	->15
					'5053' => [1,2,3,8],						 // Packag-A 	4 	->16
					'5053' => [1,2,3,14],						 // Packag-A 	4 	->16
				],
				'3_4' => [
					'5054' => [1,2,3,4,5,6,7,8,9,13],            // Package-B 	10 	->17
					'5055' => [1,2,3,4,5,6,7,8,9],		 		 // Package-B   9	->18
					'5056' => [1,2,3,4,5,6,7,8,9,12],     		 // Package-B   10  ->19 
					'5057' => [1,2,3,4,5,6,7,8,12],	     		 // Package-B   9   ->20
					'5058' => [1,2,3,4,5,6,7,8,9,12,13],   		 // Package-B   11  ->21
					'5059' => [1,2,3,4,5,6,7,8,9,13],      		 // Package -B  10  ->22 Same Service 5054 Confirm to Client
					'5060' => [1,2,3,4,5,6,7,8,12,13],       	 // Package -B 	10  ->23
					'5061' => [1,2,3,4,5,6,7,8],				 // Package -B  8 	->24
					'5062' => [1,2,3,4,5,6,7,8,13],				 // Package -B 	9 	->25
				],
				'5_6' => [
					'5063' => [9],								 // Package -C  1 	->26
				],
				'7_8' => [
					'5064' => [1,2,3,4,5,6,7,8],				 // Package -D  8   ->27
					'5065' => [1,2,3,4,5,6,7,8,9]                // Pakcage -D  9   ->28 
					
				]

			];

	return $data;
}
function getMatchedBundleAccordingServicesMatched($data,$service_list){
	if($data) {
		foreach($data as $key=>$value) {
			if (count($service_list) === count($value) && empty(array_diff($service_list, $value)) && empty(array_diff($value, $service_list))) {
				return str_replace("_0000","",$key);
			} 
		}
	}
}
function getMatchedBundleAccordingServices($package_id,$service_list) {
	$service_list = array_diff($service_list, ['17','18','20']);
	$bundle_list = getPackageServiceBundleList();
	$matched_bundle = "";
	if($bundle_list) {
		foreach($bundle_list as $key=>$value) {
			$key_exports = explode('_', $key);
			if(in_array($package_id,$key_exports)) {
				$matched_bundle = getMatchedBundleAccordingServicesMatched($value,$service_list);
			}
		}
	}
	return  $matched_bundle;
}


function getClassNamePackageList($include_id_list,$extraclass_name) {
	if($include_id_list) {
		$modifiedArray = array_map(fn($num) => "{$extraclass_name}_{$num}", $include_id_list);
		if($modifiedArray) {
			return  implode(" ", $modifiedArray);  
		}
	}
	return false;
}

function getUserPlanIDAccordingEnv() {
	$app_mode = env('APP_MODE');
	$data['plan_id'] = Config::get('constants.planid');
	if($app_mode=="LIVE"){
		$data['plan_id'] = Auth::user()->bundle_id;
	} 
	return $data;
}

function getGraphPercentage($data,$key){
	if($data) {
		if(isset($data['mood'][$key])) {
			return $data['mood'][$key];
		}
	}
	return 0;
}
function LoginUserBToBVerification(){
	$user = Auth::user();
	if(isset($user) && $user->payment_status === 1 && isset($user->access_site) &&  in_array("imwell", json_decode($user->access_site, true))) 
	{
		return true;
	}
	return true;	
}
function LoginUserBToBVerificationMSG() {
	echo "<div class='alert alert-danger'><strong>Permission!</strong> Sorry Don't have permission to  access page. Please Upgrade Plan or Contact Admin.</div>";
}

function getSafetyPlanData($title){
	
    $title = ucfirst(html_entity_decode($title));
	$title = trim(preg_replace('/<\/?p[^>]*>/', '', $title));
	$title = str_replace('"', '', $title);
	$data = DB::table("safty_plan_users")->where("user_id",Auth::user()->id)->where('safty_title',$title)->orderby("id","DESC")->first();
	if($data) {
		return $data->plan_data;
	}
}
function getAgeNumber($birth) {
	if($birth) {
		$birth = date("Y-m-d",strtotime($birth));
		return Carbon::parse($birth)->age;
	}
	return 0;
}
function getAgeNumberWithMonth($birth) {    if($birth) {        $birth = date("Y-m-d", strtotime($birth));        $diff = \Carbon\Carbon::parse($birth)->diff(\Carbon\Carbon::now());                $years  = $diff->y;        $months = $diff->m;        if($years > 0 && $months > 0) {            return $years . 'y ' . $months . 'm';        } elseif($years > 0) {            return $years . 'y';        } elseif($months > 0) {            return $months . 'm';        } else {            return $diff->d . 'd';        }    }    return 0;}
function getDOBFormat($dob){
	if($dob) {
		$date = DateTime::createFromFormat("m-d-Y", $dob);
		if ($date) {
            return $date->format("m/d/Y");
        }
	}
	return $dob;
}
function getConsultantHeading($action) {
	$title = array("urgentcare"=>"Urgent Care","primarycare"=>"Primary Care","psychiatry"=>"Psychiatry","psychology"=>"Psychology","dermatology"=>"Dermatology");
	return $title[$action]?? 'Unknown';;
}
function GetMyPackageServiceList() {
	
	$userId = Auth::user()->id;
	$parentId = Auth::user()->parentId;
	if($parentId) {
		$userId = $parentId;
	}
	
	return  DB::table('braintree_subscription')
    ->selectRaw("TRIM(BOTH ',' FROM CONCAT_WS(',', package_service_list, optional_service)) AS services_list")
    ->where('user_id', $userId)
    ->where('subscription_status', 'active')
    ->where(function ($query) {
        $query->whereNotNull('package_service_list')
              ->where('package_service_list', '!=', '')
              ->orWhere(function ($q) {
                  $q->whereNotNull('optional_service')
                    ->where('optional_service', '!=', '');
              });
    })
    ->first();
}
function checkServiceEnabled($mypackageservicelist,$service_id) {
	if(isset($mypackageservicelist->services_list)) {
		$serice_list = explode(',',$mypackageservicelist->services_list);
		if(in_array($service_id, $serice_list)) {
			return true;
		}
	}
	return false;
	
}
function getMyCurrentPlanRecords($id){
	
	return  DB::table('braintree_subscription')->where('user_id', $id)->where('subscription_status', 'active')->orderByDesc('id')->first();
	
}
function getGraphChartData($data_array) {
	
	
	$userId = Auth::id();
	$moodMap = [
		':HAPPY:'    => 'happy',
		':SAD:'      => 'sad',
		':ANGER:'    => 'anger',
		':FEAR:'     => 'fear',
		':SURPRISE:' => 'surprise',
		':DISGUSTED:'=> 'disgust',
	];
	
	
	$data_graph = array_fill_keys(array_values($moodMap), 0);
	$data = DB::table('user_moods')
		->select(DB::raw('SUM(mood_number) as mood_number'), 'mood')
		->where('user_id', $userId)
		->when(!empty($data_array['start_date']) && !empty($data_array['end_date']), function ($query) use ($data_array) {
			return $query->whereBetween('emoji_date', [$data_array['start_date'], $data_array['end_date']]);
		})
		->groupBy('mood')
		->orderBy('mood_number', 'ASC')
		->get();
	if($data->isNotEmpty()) { 	
		foreach ($data as $list) {
			if (isset($moodMap[$list->mood])) {
				$data_graph[$moodMap[$list->mood]] = (int) $list->mood_number;
			}
		}
	}
	return $data_graph; 
}
function getBrainTreeSubscriptionActive($user_id){
	
	$today = Carbon::now()->toDateString();
	return  DB::table('braintree_subscription')->where('user_id',$user_id)->whereDate('subscription_start_date', '<=', $today)->whereDate('subscription_end_date', '>=', $today)->where('subscription_status','active')->count();
			
}
function GetGroupAnalytics() {
	
	$organization_id  = Auth::user()->organization_id;
	return DB::table('organizations')->where('id', $organization_id)->where('group_analytics', 'enable')->exists();
	
}
function formatScreeningHistory($startDate,$endDate) {
	
	$start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);
	
	return $date = " " . $start->format('j M Y') . " - " . $end->format('j M Y') . " ";

}
function getAffirmationID($user) {
	
    if($user->affirmation_id) {
        $next = DB::table('affirmations')->where('id', '>', $user->affirmation_id)->orderBy('id')->first();
        if($next) {
            return $next->id;
        } else {
            $first = DB::table('affirmations')->orderBy('id')->first();
            return $first ? $first->id : null;
        }
    }
    $first = DB::table('affirmations')->orderBy('id')->first();
    return $first ? $first->id : null;
	
}

if(!function_exists('calculateAge')) {
    function calculateAge($date, $format = 'm/d/Y') {
        return \Carbon\Carbon::createFromFormat($format, $date)->age;
    }
}
if(!function_exists('getGender')) {
    function getGender($gender) {
        if($gender=="m") {
			return "Male";
		} else if($gender=="f") {
			return "Female";
		}
		return "";
    }
}
function ConsultantDateFormat($date, $format = 'm/d/Y @ g:i A'){
	
	$date = str_replace(',', '', $date);
	return Carbon::parse($date)->format($format);
	
}
if(! function_exists('convertToLocal')) {
    function convertToLocal($date, $timezone = 'Asia/Kolkata', $format = 'm/d/Y g:i A T')
    {
        $date = str_replace(',', '', $date);
        return Carbon::parse($date)->setTimezone($timezone)->format($format);
    }
}
function getExtraDaysForGraph($anxiety_categories){
	$totalDays = 25;
	$anxiety_categories = json_decode($anxiety_categories,true);
	if(empty($anxiety_categories)) {
		$anxiety_categories[] =  date('d M');
		$totalDays = 10;
	}
	
	if($anxiety_categories) { 
		if(count($anxiety_categories) < $totalDays) {
			$lastDate = DateTime::createFromFormat('d M', end($anxiety_categories));
			while (count($anxiety_categories) < $totalDays) {
				$lastDate->modify('+1 day');
				$anxiety_categories[] = $lastDate->format('d M');
			} 
		}
	}
	return  json_encode($anxiety_categories);
}
function DataCovertAccordingYearly($data) {
	
	$arrayData = (array)$data;
	$months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	$totals = array_fill_keys($months, 0);
	$counts = array_fill_keys($months, 0);
	
	foreach ($arrayData as $date => $value) {
		$month = date('M', strtotime($date));
		$totals[$month] += $value;
		$counts[$month] += 1;
	}

	$averages = [];
	foreach ($months as $month) {
		$averages[] = $counts[$month] > 0 ? number_format($totals[$month] / $counts[$month],2) : 0;
	}
	
	return array("keys"=>$months,"values"=>$averages);
	
}

function getSeperateDataOfGraph($action, $data) {
	
	$dailyAverage = [
		'anxiety'    => [],
		'depression' => [],
		'alcohol'    => [],
	];

	$last7Days = [];
	for ($i = 6; $i >= 0; $i--) {
		$last7Days[] = Carbon::today()->subDays($i)->format('l');
	}

	// Step 1: sum answers per visitor per day (visitor total score)
	$perVisitorDay = []; // $perVisitorDay[$type][$day][$visitorId] = totalScore

	foreach ($data as $item) {
		$type = $item['test_type'];
		$visitorId = $item['id']; // or $item['user_id'] depending on your identifier

		foreach ($item['quiz_answer'] as $quiz) {
			// you can use $item['created_at'] if all quiz answers share the same timestamp,
			// otherwise keep quiz['created_at'] as you had it.
			$day = Carbon::parse($quiz['created_at'])->format('l');

			if (!isset($perVisitorDay[$type][$day][$visitorId])) {
				$perVisitorDay[$type][$day][$visitorId] = 0;
			}

			$perVisitorDay[$type][$day][$visitorId] += (float) $quiz['value'];
		}
	}

	
	foreach (array_keys($dailyAverage) as $type) {
		$ordered = [];
		foreach ($last7Days as $day) {
			if (isset($perVisitorDay[$type][$day])) {
				$visitorTotals = $perVisitorDay[$type][$day]; 
				$sumOfTotals = array_sum($visitorTotals);     
				$countVisitors = count($visitorTotals);     

				$ordered[$day] = $countVisitors > 0
					? number_format($sumOfTotals / $countVisitors, 2)
					: 0;
			} else {
				$ordered[$day] = 0;
			}
		}
		$dailyAverage[$type] = $ordered;
	}

	return $dailyAverage;

}
function getHourlyGraphAvg($action, $data){
	
	$hourlyAverage = [
		'anxiety'    => [],
		'depression' => [],
		'alcohol'    => [],
	];

	// Step 1: collect sums + counts by hour
	foreach ($data as $item) {
		$type = $item['test_type'];

		foreach ($item['quiz_answer'] as $quiz) {
			$hour = Carbon::parse($quiz['created_at'])->format('g A'); // 1 AM, 2 AM … 12 PM

			if (!isset($hourlyAverage[$type][$hour])) {
				$hourlyAverage[$type][$hour] = ['sum' => 0, 'count' => 0];
			}

			$hourlyAverage[$type][$hour]['sum']   += $quiz['value'];
			$hourlyAverage[$type][$hour]['count'] += 1;
		}
	}

	// Step 2: prepare all 12-hour formatted labels
	$hours12 = [];
	for ($h = 0; $h < 24; $h++) {
		$hours12[] = Carbon::createFromTime($h)->format('g A'); // 12 AM, 1 AM …
	}

	// Step 3: calculate averages & fill missing
	foreach ($hourlyAverage as $type => $hours) {
		$ordered = [];
		foreach ($hours12 as $hourLabel) {
			if (isset($hours[$hourLabel])) {
				$ordered[$hourLabel] = $hours[$hourLabel]['count'] > 0
					? number_format($hours[$hourLabel]['sum'], 2)
					: 0;
			} else {
				$ordered[$hourLabel] = 0;
			}
		}
		$hourlyAverage[$type] = $ordered;
	}

	return $hourlyAverage;
}
function checkCurrentDatePass($dateString)
{
	$dateString = str_replace(',', '', $dateString);
    $givenDate = Carbon::parse($dateString);
    if ($givenDate->isPast()) {
        return true;
    }
}
function getSeperateDataOfGraphMonthly($action,$data) {
	
	$dailyAverage = [
		'anxiety'    => [],
		'depression' => [],
		'alcohol'    => [],
	];

	// Step 1: collect per visitor per day
	$perVisitorDay = []; // [$type][$date][$visitorId] = totalScore

	foreach ($data as $item) {
		$type = $item['test_type'];
		$visitorId = $item['id']; // or $item['user_id']

		foreach ($item['quiz_answer'] as $quiz) {
			$date = Carbon::parse($quiz['created_at'])->format('d M'); // e.g. "24 Sep"

			if (!isset($perVisitorDay[$type][$date][$visitorId])) {
				$perVisitorDay[$type][$date][$visitorId] = 0;
			}

			$perVisitorDay[$type][$date][$visitorId] += (float) $quiz['value'];
		}
	}

	// Step 2: calculate average per day
	foreach ($perVisitorDay as $type => $dates) {
		foreach ($dates as $date => $visitorTotals) {
			$sumOfTotals   = array_sum($visitorTotals);
			$countVisitors = count($visitorTotals);

			$dailyAverage[$type][$date] = $countVisitors > 0
				? number_format($sumOfTotals / $countVisitors, 2)
				: 0;
		}
	}

	// Step 3: add future dates if total length < 25
	foreach ($dailyAverage as $type => $dates) {
		$currentDates = array_keys($dates);
		$count = count($currentDates);

		if ($count < 25) {
			$lastDate = !empty($currentDates) 
				? Carbon::createFromFormat('d M', end($currentDates)) 
				: Carbon::today();

			for ($i = 1; $i <= (25 - $count); $i++) {
				$nextDate = $lastDate->copy()->addDays($i)->format('d M');
				$dailyAverage[$type][$nextDate] = 0;
			}
		}

		// optional: sort by date
		//ksort($dailyAverage[$type]);
	}

	return $dailyAverage;
}
function getSeperateDataOfGraphYearly($action,$data) {
	
	$monthlyAverage = [
		'anxiety'    => [],
		'depression' => [],
		'alcohol'    => [],
	];

	
	$perVisitorMonth = [];

	foreach ($data as $item) {
		$type      = $item['test_type'];
		$visitorId = $item['id'];

		foreach ($item['quiz_answer'] as $quiz) {
			$monthKey = Carbon::parse($quiz['created_at'])->format('Y-m'); 

			if (!isset($perVisitorMonth[$type][$monthKey][$visitorId])) {
				$perVisitorMonth[$type][$monthKey][$visitorId] = 0;
			}

			$perVisitorMonth[$type][$monthKey][$visitorId] += (float) $quiz['value'];
		}
	}
	foreach ($perVisitorMonth as $type => $months) {
		foreach ($months as $monthKey => $visitorTotals) {
			$sumOfTotals   = array_sum($visitorTotals);
			$countVisitors = count($visitorTotals);

			$monthName = Carbon::createFromFormat('Y-m', $monthKey)->format('M'); // Jan, Feb...

			$monthlyAverage[$type][$monthName] = $countVisitors > 0
				? number_format($sumOfTotals / $countVisitors, 2)
				: 0;
		}
	}

	$allMonths = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

	foreach ($monthlyAverage as $type => &$months) {
		foreach ($allMonths as $m) {
			if (!isset($months[$m])) {
				$months[$m] = 0;
			}
		}
		$months = array_replace(array_flip($allMonths), $months);
	}

	return $monthlyAverage;
}
function getDashNotificationPUpdate(){
	

	$acknowledge = GetUserMetaWithMetaKey('dashboard-acknowledge',Auth::id());
	if($acknowledge) {
		return false;
	}
	
	$today = \Carbon\Carbon::now()->startOfDay()->toDateString();
    $next7 = \Carbon\Carbon::now()->addDays(7)->toDateString();
	
	return DB::table('braintree_subscription')
        ->whereIn('subscription_type', ['four-month', 'twelve-month'])
        ->where('subscription_status', 'active')
        ->where('user_id', Auth::id())
        ->whereBetween('subscription_end_date', [$today, $next7])
        ->orderBy('id', 'DESC')
        ->select('id', 'subscription_type', 'subscription_end_date')
        ->first();
	
	
}

function getTotalRefMemberInfu($influencer_id) { 

 return DB::table('braintree_subscription as a')
			->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
			->where('a.activation_type', 'activation')
			->where('a.promo_code_id', '!=', '')
			->where('b.influencer_id', $influencer_id)
			->count('a.id');
}

function getActiveMemberAccordingMonth($influencer_id,$month) {
	
	$start_date = $month."-01 00:00:00";
	$end_date = $month."-31 23:59:59";
	
return  DB::table('braintree_subscription as a')
			->join('promocodes as b', 'a.promo_code_id', '=', 'b.id')
			->join('users as u', 'a.user_id', '=', 'u.id')
			->whereNotNull('a.promo_code_id')
			->where('a.activation_type', 'activation')
			->where('b.influencer_id', $influencer_id)
			->whereBetween('u.activation_date', [
				$start_date,
				$end_date
			])->count();
}

function getCurrentMonthActiveUser($influencer_id,$month) {
	
	$start_date = $month."-01";
	$end_date = $month."-31";
	
	return  DB::table('braintree_subscription as a')
    ->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
    ->whereNotNull('a.promo_code_id')
    ->where('a.promo_code_id', '!=', '')
    ->where('b.influencer_id', $influencer_id)
    ->whereBetween('a.subscription_start_date', [$start_date,$end_date])
    ->count();

}

function getCommissionInfulantionerRate($influencer_id) {
	
	$interset_rate  = 10;
	$total_users = getTotalRefMemberInfu($influencer_id);
	
	if($total_users > 3000) {
		$interset_rate = 12;
	}
	
	$promo = DB::table('promocodes')
    ->select(
        'id',
        'created_at',
        DB::raw('TIMESTAMPDIFF(YEAR, created_at, CURDATE()) AS years'),
        DB::raw('MOD(TIMESTAMPDIFF(MONTH, created_at, CURDATE()), 12) AS months')
    )
    ->where('influencer_id', $influencer_id)
    ->where('coupon_mode', 'package')
    ->orderByDesc('id')
    ->first();
	
	
	return $interset_rate;
	
}
function getInfluenceWallet($influencer_id) {
	
	$total_users = getTotalRefMemberInfu($influencer_id);
			
			
	$total_codes = Promocode::where(array('influencer_id' => $influencer_id))->count();
	$total_commission = DB::table('braintree_subscription as a')
			->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
			->where('b.influencer_id', $influencer_id)
			->sum('a.commission_amount');
			
	$total_withdrawal =DB::table('payouts')
						->where('user_id', auth()->id())
						->whereIn('status', ['pending', 'approved'])
						->sum('paid_payout');	
	$total_balance = 	$total_commission - $total_withdrawal;	
	
	$data_info['total_users'] 	   = $total_users ?? '0';
	$data_info['total_codes'] 	   = $total_codes ?? '0';
	$data_info['total_commission'] = $total_commission ?? '0';
	$data_info['total_withdrawal'] = $total_withdrawal ?? '0';
	$data_info['total_balance']	   = $total_balance ?? '0';


	return 	$data_info;
}


if (!function_exists('getFirstBillingDetails')) {

    function getFirstBillingDetails($purchaseDate = null, float $monthlyAmount = 0): array
    {
        $BILLING_DAY = config('constants.billing-cycle-date');

        $purchaseDate = $purchaseDate
            ? Carbon::parse($purchaseDate)
            : Carbon::now();

        $billingDate = $purchaseDate->copy();
        $firstChargeAmount = $monthlyAmount;
        $extraDays = 0;
        $extraAmount = 0;

       
        if ($purchaseDate->day <= $BILLING_DAY) {

            $billingDate->day($BILLING_DAY);

        } else {
          
            $billingDate->addMonth()->day($BILLING_DAY);

            $daysInMonth = $purchaseDate->daysInMonth;
            $extraDays = $daysInMonth - $purchaseDate->day;

            $perDayAmount = $monthlyAmount / $daysInMonth;

            $extraAmount = round($extraDays * $perDayAmount, 2);
            $firstChargeAmount = round($monthlyAmount + $extraAmount, 2);
        }

        $nextBillingDate = $billingDate->copy()->addMonth();

        return [
            'first_billing_date' => $billingDate->toDateString(),
            'next_billing_date'  => $nextBillingDate->toDateString(),
            'first_charge_amount'=> $firstChargeAmount,
            'extra_days'         => $extraDays,
            'extra_amount'       => $extraAmount,
        ];
    }
}


if (!function_exists('getLandingPromoCode')) {
    function getLandingPromoCode()
    {
        $map = config('constants.landing_promo_filters', []);

        // Accept the code from the URL (?promo=CODE) OR a previously captured
        // session value, so /dashboard?promo=NABV000 AND the external-app ->
        // /?promo=... -> register -> dashboard flow both work.
               // Resolve the code from, in order:
        //  1. the current URL (?promo=CODE)
        //  2. a previously captured session value (same browsing session)
        //  3. the logged-in user's saved promo code (survives logout/login)
        $code = request()->query('promo');
        if (!$code) {
            $code = session('landing_promo');
        }
        if (!$code && auth()->check()) {
            $code = optional(auth()->user()->promocode)->code;
        }

        if ($code && isset($map[$code]) && !empty($map[$code])) {
            // Persist for subsequent requests in this session.
            session(['landing_promo' => $code]);
            return $code;
        }
        return null;
    }
}

if (!function_exists('filterPlansForLandingPromo')) {
    function filterPlansForLandingPromo($plan)
    {
        $code = getLandingPromoCode();
        if (!$code) {
            return $plan;
        }

        $map     = config('constants.landing_promo_filters', []);
        $allowed = array_map(function ($n) {
            return strtolower(trim($n));
        }, $map[$code]);

        $filtered = $plan->filter(function ($p) use ($allowed) {
            return in_array(strtolower(trim($p->name)), $allowed, true);
        })->values();

        // Safety net: if names matched nothing, keep the full list.
        return $filtered->isEmpty() ? $plan : $filtered;
    }
}