<?php
require 'vendor/autoload.php';

class validator{
    public $object;
    
    public function min($column, $min)
    {
        $input = trim($_POST[$column]);
        $this->object[$column]['min'] = strlen($input) < $min ? 'The '.$column.' field must be at least '.$min.' characters in length.' : null;
    }
    
    public function max($column, $max)
    {
        $input = trim($_POST[$column]);
        $this->object[$column]['max'] = strlen($input) > $max ? 'The '.$column.' field cannot exceed '.$max.' characters in length.' : null;
    }
    
    public function between($column, $between = [])
    {
        $input = trim($_POST[$column]);
        $this->object[$column]['between'] = strlen($input) < $between[0] || strlen($input) > $between[1] ? 'The '.$column.' field must be between '.$between[0].' and '.$between[1].' characters in length.' : null;
    }
    
    public function equals($column, $equals)
    {
        $input = strtolower(trim($_POST[$column]));
        $this->object[$column]['equals'] = $input !=  trim($equals) ? 'The '.$column.' field must be equal to '.trim($equals).'.' : null;
    }
    
    public function not_equals($column, $not_equals)
    {   
        $input = strtolower(trim($_POST[$column]));
        $this->object[$column]['not_equals'] = $input == trim($not_equals) ? 'The '.$column.' field must not be equal to '.trim($not_equals).'.' : null;
    }
    
    public function exact_length($column, $exact_length)
    {
        $input = trim($_POST[$column]);
        $this->object[$column]['exact_length'] = strlen($input) != $exact_length ? 'The '.$column.' field must be exactly '.trim($exact_length).' characters in length.' : null;
    }
    
    public function in($column, $in = [])
    {
        $input = trim($_POST[$column]);       
        $this->object[$column]['in'] = in_array($input, $in) === false ? 'The '.$column.' field must be one of: '.implode(',',$in) : null;
    }
    
    public function not_in($column, $in = [])
    {
        $input = trim($_POST[$column]);       
        $this->object[$column]['not_in'] = in_array($input, $in) === true ? 'The '.$column.' field must be any of: '.implode(',',$in) : null;
    }
    
    public function match($column, $match)
    {
        $input = strtolower(trim($_POST[$column]));
        $inputMatchTo = strtolower(trim($_POST[$match]));
        $this->object[$column]['match'] = $input != $inputMatchTo ? 'The '.$column.' field does not match the '.$match.' field.' : null;
    }
    
    public function regex_match($column, $pattern)
    {   
        $input = strtolower(trim($_POST[$column]));
        
        if (strpos($pattern, '/') !== 0) {
            $pattern = '/'.$pattern.'/';
        }
        
        $this->object[$column]['match'] = preg_match($pattern, $input ?? '') == 0 ? 'The '.$column.' field is not in the correct format.' : null;
    }
    
    public function not_match($column, $match)
    {
        $input = strtolower(trim($_POST[$column]));
        $inputMatchTo = strtolower(trim($_POST[$match]));
        $this->object[$column]['not_match'] = $input == $inputMatchTo ? 'The '.$column.' field must not match the '.$match.' field.' : null;
    }
    
    public function min_tags($column, $min)
    {
        $explode = array_filter(explode(',', trim($_POST[$column])));
        $this->object[$column]['min_tags'] = count($explode) < $min ? 'It is necessary to enter at least '.$min.' tags' : null;
    }
    
    public function max_tags($column, $max)
    {
        $explode = array_filter(explode(',', trim($_POST[$column])));
        $this->object[$column]['max_tags'] = count($explode) > $max ? 'You can`t add '.$column.' more than '.$max.'.' : null;
    }
    
    public function equals_case($column, $arr = [])
    {
        if(count($arr) < 3){
            $this->object[$column]['equals_case'] = null;
        }
        else{
            $this->object[$column]['equals_case'] = $arr[0] == $arr[1] ? $arr[2] : null;   
        }
    }
    
    public function string($column)
    {
        $input = trim($_POST[$column]); 
        $this->object[$column]['string'] = is_numeric($input) === true ? 'The '.$column.' field must be a valid string.' : null;
    }
    
    public function numeric($column)
    {
        $input = trim($_POST[$column]); 
        $this->object[$column]['numeric'] = is_numeric($input) === false ? 'The '.$column.' field must contain only numbers.' : null;
    }
    
    public function integer($column)
    {
        $input = trim($_POST[$column]); 
        $this->object[$column]['integer'] = is_int($input) === false ? 'The '.$column.' field must contain an integer.' : null;
    }
    
    public function less_than($column, $less_than)
    {
        $input = (int)trim($_POST[$column]);
        $less_than = (int)$less_than;
        $this->object[$column]['less_than'] = $input > $less_than 
        ? 'The '.$column.' field must be a number less than '.$less_than.'.' : null;
    }
    
    public function less_than_orequal($column, $less_than_orequal)
    {
        $input = (int)trim($_POST[$column]);
        $less_than_orequal = (int)$less_than_orequal;
        $this->object[$column]['less_than_orequal'] = $input > $less_than_orequal && $input != $less_than_orequal 
        ? 'The '.$column.' field must be a number greater than or equal to '.$less_than_orequal.'.' : null;
    }
    
    public function greater_than($column, $greater_than)
    {
        $input = (int)trim($_POST[$column]);
        $greater_than = (int)$greater_than;
        $this->object[$column]['greater_than'] = $input < $greater_than ? 'The '.$column.' field must be a number greater than '.$greater_than.'.' : null;
    }
    
    public function greater_than_orequal($column, $greater_than_orequal)
    {
        $input = (int)trim($_POST[$column]);
        $greater_than_orequal = (int)$greater_than_orequal;
        $this->object[$column]['greater_than_orequal'] = $input < $greater_than_orequal && $input != $greater_than_orequal 
        ? 'The '.$column.' field must be a number greater than or equal to '.$greater_than_orequal.'.' : null;
    }
    
    public function required($column)
    {
        $input = trim($_POST[$column]);
        $this->object[$column]['required'] = $input == "" || $input == null ? 'The '.$column.' field is required.' : null;
    }
    
    public function email($column)
    {
        $str = trim($_POST[$column]);
        
        // @see https://regex101.com/r/wlJG1t/1/
        if (function_exists('idn_to_ascii') && defined('INTL_IDNA_VARIANT_UTS46') && preg_match('#\A([^@]+)@(.+)\z#', $str ?? '', $matches)) {
            $str = $matches[1] . '@' . idn_to_ascii($matches[2], 0, INTL_IDNA_VARIANT_UTS46);
        }
        $this->object[$column]['email'] = filter_var($str, FILTER_VALIDATE_EMAIL) === false ? 'Required to enter a valid email address to the '.$column.' field.' : null;
    }
    
    public function dateformat($column, $format = 'Y-m-d')
    {
        $input = trim($_POST[$column]) ?? '';
        $d = DateTime::createFromFormat($format, $input);
        $this->object[$column]['date'] = $d && $d->format($format) === $input ? null : 'The '.$column.' field does not match the format: '.$format;
    }

    public function file_required($column, $extensions = [])
    {
        $file = $_FILES[$column];
        $this->object[$column]['file_required'] = $file["tmp_name"] == "" ? 'Required to upload a file' : null;
    }
    
    public function image_required($column, $extensions = [])
    {
        $file = $_FILES[$column];
        $this->object[$column]['image_required'] = $file["tmp_name"] == "" &&  strpos($file['type'], 'image') === false ? 'Required to upload an image' : null;
    }
    
    public function ext_in($column, $extensions = [])
    {
        $file = $_FILES[$column];
        if($file["tmp_name"] == ""){
            $this->object[$column]['ext_in'] = null;
        }
        else{
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $this->object[$column]['ext_in'] = in_array($ext, $extensions) === false ? 'It does not have a valid file extension.' : null;
        }
    }
    
    public function mime_in($column, $mimeTypes = [])
    {
        $file = $_FILES[$column];    
        if($file['type'] == ""){
            $this->object[$column]['mime_in'] = null;
        }
        else{
            $this->object[$column]['mime_in'] = in_array($file['type'], $mimeTypes) === false ? 'It does not have a valid mime type.' : null;
        }
    }
    
    public function image($column, $mimeTypes = [])
    {
        $file = $_FILES[$column];
       // var_dump($file);
    
        if($file['type'] == ""){
            $this->object[$column]['image'] = null;
        }
        else{
            $this->object[$column]['image'] = strpos($file['type'], 'image') === false ? 'The file is not image type.' : null;
        }        
    }
    
    public function size($column, $max = 2)
    {
        $file = $_FILES[$column];
    
        if($file['size'] == ""){
            $this->object[$column]['size'] = null;
        }
        else{
            $sizeInMB = round($file['size'] / 1024 / 1024,4);
            $this->object[$column]['size'] = $sizeInMB > $max ? 'The file is too large. The maximum file upload limit is '.$max.'MB.' : null;
        }        
    }
    
    public function min_dims($column, $min_dims = [])
    {
        $file = $_FILES[$column];
        if($file['tmp_name'] == "" || count($min_dims) < 2){
            $this->object[$column]['min_dims'] = null;
        }
        else{
            $img_info = getimagesize($file['tmp_name']);
            $this->object[$column]['min_dims'] = $img_info[0] < $min_dims[0] || $img_info[1] < $min_dims[1] 
            ? 'The image is too narrow or Low.' : null;
        }        
    }
    
    public function max_dims($column, $max_dims = [])
    {
        $file = $_FILES[$column];
        if($file['tmp_name'] == "" || count($max_dims) < 2){
            $this->object[$column]['max_dims'] = null;
        }
        else{
            $img_info = getimagesize($file['tmp_name']);
            $this->object[$column]['max_dims'] = $img_info[0] > $max_dims[0] || $img_info[1] > $max_dims[1] 
            ? 'The image is too wide or tall.' : null;
        }        
    }
    
    public function ratio($column, $ratio = 'any')
    {
        $file = $_FILES[$column];
        if($file['tmp_name'] == "" || $ratio == 'any'){
            $this->object[$column]['ratio'] = null;
        }
        else{
            $img_info = getimagesize($file['tmp_name']);
            // 'mobile', // mobile, screen, square, any
            if($ratio == 'mobile'){
                $this->object[$column]['ratio'] = $img_info[0] > $img_info[1]
                ? 'The image width should be less than its height.' : null;
            }
            elseif($ratio == 'screen'){
                $this->object[$column]['ratio'] = $img_info[0] < $img_info[1]
                ? 'The image width required to be greater than its height.' : null;
            }
            elseif($ratio == 'square'){
                $this->object[$column]['ratio'] = $img_info[0] != $img_info[1]
                ? 'The width and height of the image must be equal.' : null;
            }
            else{
                $this->object[$column]['ratio'] = null;
            }         
        }        
    }

    public function rules ($rules = [])
    {
        foreach ($rules as $column => $rule) {
            foreach ($rule as $rule_column => $rule_val) {
                if(is_numeric($rule_column)){
                    $this->$rule_val($column);
                }
                else{
                    $this->$rule_column($column, $rule_val); 
                }
            } 
        }
        return (object) $this->object;
    }
    
    public function errorsObject($column = '') {
        if($column == ''){
            $filteredErrorsArray = [];
            foreach ($this->object as $key => $value) {
                $filteredErrorsArray[$key] = is_array($value) ? array_filter($value) : $value;
            }
            return (object) $filteredErrorsArray;
        }
        return (object) array_filter($this->object[$column]);
    }
    
    public function errors($column = '') {
        $filteredErrorsArray = [];
        
        foreach ($this->object as $key => $value) {
            foreach ($value as $columnKey => $message) {
                if($message) $filteredErrorsArray[$key][] = $message;
            }
        }
        
        if($column == ''){
            return (object) $filteredErrorsArray;
        }
        
        return $filteredErrorsArray[$column];
    }
    
    public function first($column = '') {
        // it should return the errors array and that we want to out first error from the array
        return $this->errors($column);
    }    
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){    
    
    // Uploads disable by administrator
    $disable_uploads = 'yes';
    
    // Validation example
    $validate = new validator();
    
    $validate->rules([
        'username' => [
            'required',
            'string',
            'min' => 15,
            'max' => 2,
            'between' => [3, 7],
            'equals' => 'HM Officialsooo',
            'not_equals' => 'MH Official',
            'exact_length' => 5,
        ],
        'age' => [
            'required',
            'numeric',
            'integer',
            'less_than' => 18,
            'less_than_orequal' => 16,
            'greater_than' => 25,
            'greater_than_orequal' => 26,
            'in' => [16, 18, 20, 23],
            'not_in' => [16, 18, 20, 23],
            'regex_match' => '^[0-9]+$'
        ],
        'text' => [
            'required',
            'match' => 'age',
            'not_match' => 'age',
            'regex_match' => '^[A-Za-z0-9_ .]+$'
        ],
        'email' => [
            'required', 
            'email'
        ],
        'date' => [
            'dateformat' => 'Y-m-d'
        ],
        'upload_file' => [
            'ext_in' => [
                'mp3', 'mp4', 'png', 'jpg'
            ],
            'mime_in' => [
                'image/png',
                'image/jpeg'
            ],
            'image',
            'file_required',
            'image_required',
            'size' => 2, // MB
            'min_dims' => [
                320, 480
            ],
            'max_dims' => [
                720, 1640
            ],
            'ratio' => 'mobile', // mobile, screen, square, any
            'equals_case' => [
                $disable_uploads,
                'yes', // if $disable_uploads equals to 'yes'
                'File uploads has been disabled by the website administration' // throw error
            ]
        ],
        'tags' => [
            'min_tags' => 22,
            'max_tags' => 7,
        ]
    ]);
    
    // dump($validate->errorsObject()); // get errors object
    // dump($validate->errorsObject('username')); // get errors object for specified input
    dump($validate->errors()->username);
    dump($validate->errors()->first('username'));

}

// array_key_first

require 'form.php';