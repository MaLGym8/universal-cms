<?php



class db extends MySQLi {

/**
* префикс таблиц по умолчанию
 *
* @access public static
* @var string
*/

static $prefix = 'cms_';

static $instance = null;

/**
* Параметры подключения для статического конструктора
 *
* @access static
* @var array
*/
static $config = null;

static $debug = true; // режим debug

static $debug_sql = array();

static function debug_html($exit = false) {
	$ret = '<div style="background-color: white; color: #000;">'.
		implode('<hr color="black">',self::$debug_sql).
	'</div>';
	if ($exit) { exit($ret); } else { return $ret; }
}
/**
* статический конструктор класса db
 * 
* @return db
*/
static function getInstance() {
	if (self::$instance == null) {
		if (is_array(self::$config)) { 
			self::$instance = new db(self::$config);
			return self::$instance;
		}
	} 		
	if (self::$instance==null) {
		self::show_Error('Инициализация класса базы данных не возможна, не задан параметр <b>db::$config</b>');  
	} else {
		return self::$instance;
	}
}

/**
* Символ кавычки для обертки строковых параметров SQL запросов
 *
* @access public
* @var string
*/
public $q = "'";


/**
* Флаг включения экранирования HTML тегов внутри функций es, es_all, es_array
* по-умолчанию = false;
* 
* @access public
* @var boolean
*/
public $es_html = false; // отключено

/**
* Флаг отключения экранирования внутри функций es, es_all, es_array
* по-умолчанию = false;
* 
* @access public
* @var boolean
*/
public $es_disable = false; // отключить экранирование

/**
* Фукция вывода отчета от ошибке.
 * Запускается при обнаружении ошибок в соединении с базой. 
 * Аварийно завершает все вызовы на сайте через exit;
*
* @return null
*/
static function show_Error($er = '') { // отчет об ошибке
    echo '<body bgcolor="#FAEBD7"><center><font color=blue size=+2><b>Проблема с базой данных, технические неполадки, зайдите позже</b></font></center><hr>';
    echo mysqli_connect_error().' | '.$er;
    echo '<hr><b>db_mysqli.php</b>';
    exit;
}

private $connect_params;

/**
* Конструктор класса db
 * Запускается при создании класса db
* @param array $conn_config параметры подключения
*
* @return db
*/
protected function __construct($conn_config) {
	foreach($conn_config as $key=>$c) { $this->connect_params[$key]=$c; }
	//self::$instance = $this;
}

private $connected = false;

private function connect_to() {
	if (!$this->connected) {
		@$this->connect(
			$this->connect_params['host'],
			$this->connect_params['user'],
			$this->connect_params['passw'],
			$this->connect_params['dbname']
		);
		mysqli_connect_errno() && self::show_Error('ошибка подключения');
		$this->set_charset($this->connect_params['charset']);
		$this->connected = true;
	}
}

/**
*  функция экранирует строку и по следующим правилам:
 * если параметр $this->es_html = true , тогда в строке экранируются все HTML теги
 * сама строка экранируется согласно стандарту функции MYSQL_REAL_ESCAPE_STRING
 * дополнительно заданные кавычки в переменной $this->q ставятся в начале и конце искомой строки
 * 
* @param string $str входная строка для обработки
*
* @return string
*/
public function es($str) { 
	$this->connect_to();
	if ($this->es_disable) { return $str; }
    if ($this->es_html) { $str = htmlspecialchars($str); }
    return $this->q.$this->escape_string($str).$this->q;
}

/**
*  функция экранирует любое количество переданных праметров с помощью функции es($str)
 * при вызове наличие знака & перед каждым параметром строго обязательно
 * 
*  es_all(&$name, &$email, &$user_last_name)
 * 
* @return null
*/
public function es_all() { 
    $trace = debug_backtrace();
    $args = $trace[0]['args'];
    foreach ($args as &$a) {
        $a = $this->es($a);
    }
}

/**
*  универсальное экранирование для LIKE переменных поиска
 * фукнция применятся для строковых параметров, передаваемых для оператора LIKE в SQL запросах
 * 
 *  $c = $mysql->query('SELECT * FROM users WHERE username LIKE '.$mysql->es_like('L',' %'));
 *  //в $c будут выведены все пользователи чье имя начинается на L
 *  $c = $mysql->query('SELECT * FROM users WHERE username LIKE '.$mysql->es_like('L','%%'));
 *  //в $c будут выведены все пользователи чье имя содержит на L
 *  $c = $mysql->query('SELECT * FROM users WHERE username LIKE '.$mysql->es_like('L','% '));
 *  //в $c будут выведены все пользователи чье имя оканчивается на L
 * 
 * @param string $str текст
 * @param string $between строка обертки (2 символа). ' ' ничего не ставится % - ставится %
 * 
* @return string
*/
public function es_like($str, $between = '%%') {
	$this->connect_to();
	if ($between{0}==' ') { $ret = ''; } else { $ret = $between{0}; }
	$ret .=
		str_replace('*','%',addCslashes($this->escape_string(str_replace('\\','\\\\',
			$str 
		)), '_% '));
	if ($between{1}!=' ') { $ret .= $between{1}; }
	return $this->q.$ret.$this->q;
}

/**
*  функция экранируется переданные данные с помощью функции es($str)
*  согласно строке типов данных $strtypes
 * если строка $strtypes не указана то все занчения будут экранированы
 * если строка $strtypes короче массива то экранирование будет идти в порядке,
 * указанным строкой в цикле читая строку заново
 * $strtypes - s - строка i - числа, и все остальные типы
 * 
 *  es_array(&$array); // все значения массива $array будут экранированы
 *  es_array(&$array, 'sssis'); // первое второе третье занчение будут экранированы, 
 *  // четвертое имеет флаг i что запрещает обработку этого значения
 *  // четвертое значение остается без изменений
 *  // пятое значение экранировано
 * 
 * @param mixed $array значения для экранирования. допускается передавать значения не являющиеся массивами
 * @param string $strtypes строка представляет собой последовательность типов данных в массиве
 * 
* @return null
*/
public function es_array(&$array,$strtypes = '') {
    if (!is_array($array)) { $array = array($array); }
    if ($strtypes == '') { $ts  = 's'; } else { $ts = $strtypes; }
    $strtypes = str_pad($strtypes,count($array),$ts,STR_PAD_RIGHT);
     foreach ($array as $key=>&$ar) {
        if ($strtypes{$key}=='s') {
            $ar = $this->es($ar);
        } elseif ($strtypes{$key}=='k') {
			$ar = $this->es_like($ar,'  ');
		} elseif ($strtypes{$key}=='K') {
			$ar = $this->es_like($ar,' %');
		}
    }
}

protected function replacePrefix( $sql ) {
	if (isset($this->connect_params['prefix'])) {
		if ((preg_match('/(select)(.+)(where)(.+)$/ims',$sql,$s))||
			(preg_match('/(update)(.+)(set)(.+)$/ims',$sql,$s))||
			(preg_match('/(insert)(.+)(values)(.+)$/ims',$sql,$s))||
			(preg_match('/(delete)(.+)(where)(.+)$/ims',$sql,$s))) {
			$s[2] = str_replace(self::$prefix, $this->connect_params['prefix'], $s[2]);
        return $s[1].$s[2].$s[3].$s[4];
	} else {
        return str_replace(self::$prefix, $this->connect_params['prefix'], $sql);
	}
	} else {
		return $sql;
	}
}

/**
* Функция выполняет действия mysqli::query
 * 
* @param string $query текст запроса
*
* @return mysql_result
*/
public function query( $query)  {
	$this->connect_to();
	if (self::$debug) { self::$debug_sql[] = $this->replacePrefix($query); }
	$ret = parent::query($this->replacePrefix($query));
	if ((self::$debug) && (!$ret)) {
		self::$debug_sql[] = "<font color=red><b>Errormessage:</b></font> ". $this->error;
		self::debug_html(true);
	}
	if (isset($ret->num_rows)) { 
		if ($ret->num_rows==0) { return null; }
	}
    return $ret;
}

/**
* Функция выполняет чтение превой строки результата запроса
 * 
* @param string $query текст запроса
* @param MYSQLI_CONST $type [необязательный] MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
*
* @return array
*/
public function read($query, $type = MYSQLI_ASSOC) {//MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
	if ($res = $this->query($query.' limit 1')) {
		if ($ret = $res->fetch_array($type)) {
			$res->free();
			return $ret;
		}
		$res->free();
	} else { return null; }
}

/**
* Функция выполняет чтение первой ячейки результата запроса
 * 
* @param string $query текст запроса
*
* @return mixed
*/
public function read_one($query) {
    if ($ret=$this->read($query,MYSQLI_NUM)) {
        if (is_array($ret)) {return $ret[0]; }
    }
    return null;
}

public function last_id(){
	return $this->read_one('SELECT LAST_INSERT_ID()');
}

/**
* помещает результат запроса mysql_result в двумерный массив
 * при пустом запросе возвращет null , при $array=true возвращает array()
 * 
 * @param string $query текст запроса
 * @param boolean $array режим массива, при true всегда в результате получается массив
 * @param MYSQLI_CONST $type MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
*
* @return array
*/
public function read_all($query, $array = false, $type = MYSQLI_ASSOC) { //MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
	if ($res = $this->query($query)) { 
		while ($row=$res->fetch_array($type)) { $ret[]=$row; }
		$res->free();
		if (isset($ret)) { return $ret; }
	}
    if ($array) { return array(); }
    return null;
}
/**
* помещает результат запроса mysql_result в двумерный массив, таким образом 
 * что индексы массива равны первой колонке, а значения второй колонке
 * при пустом запросе возвращет null 
 * 
 * @param string $query текст запроса
*
* @return array
*/
public function readTableAsArray($query) {
	if ($res = $this->query($query)) { 
		while ($row=$res->fetch_array(MYSQLI_NUM)) { $ret[$row[0]]=$row; }
		$res->free();
		if (isset($ret)) { return $ret; }
	}
	return null;
}

private function preSql ($query, $params, $strtypes='') {
	$this->es_array($params,$strtypes);
	$p = explode('?',$query);
	for ($i=0; $i<count($p)-1; $i++) {
		$p[$i] .= $params[$i];
	}
	return implode('',$p);
}

/**
* Функция выполняет действия mysqli::query
 * Через расширенный ввод запроса в формате prepared
 * 
* @param string $query текст запроса
* @param mixed $params параметры
* @param string $strtypes строка типов данных
*
* @return mysql_result
*/
public function preQuery($query, $params, $strtypes='') {
	return $this->query($this->preSql($query, $params, $strtypes));
}

/**
* Функция помещает первую строку запроса в массив
 * Через расширенный ввод запроса в формате prepared (см документацию)
 * 
* @param string $query текст запроса
* @param mixed $params параметры
* @param string $strtypes строка типов данных
* @param MYSQLI_CONST $type [необязательный] MYSQLI_ASSOC, MYSQLI_NUM, or MYSQLI_BOTH
*
* @return array
*/
public function preRead($query, $params, $strtypes='',$type = MYSQLI_ASSOC) {
	return $this->read($this->preSql($query, $params, $strtypes),$type);
}

/**
* Функция читает первую ячейку запроса
 * Через расширенный ввод запроса в формате prepared (см документацию)
 * 
* @param string $query текст запроса
* @param mixed $params параметры
* @param string $strtypes строка типов данных
*
* @return mixed
*/
public function preRead_one($query, $params, $strtypes='') {
	return $this->read_one($this->preSql($query, $params, $strtypes));
}

/**
* функция составляет запрос для вставки строки данных в таблицу.
 * 
 * @param string $tableFields  'table (id, user, password, about)' строка информации о структуре полей таблицы
 * @param mixed $values ОДНОМЕРНЫЙ массив с чиловыми индексами или ЗНАЧЕНИЕ, с данными которые будут вставлены в таблицу
 * @param string $strtypes строка типов полей. см. функцию es_array
 * 
 *  $mysql->insert('table (id, user, password, about)', array(0,'alex','123456','15 лет школьник'),'isss');
 *
 * @return mysql_result
*/
public function insert($tableFields, $values, $strtypes = '') {
    $this->es_array($values,$strtypes);
    return $this->query(
        'INSERT INTO '.$tableFields.' VALUES ('.implode(', ',$values).')'
    );
}

/**
* функция составляет запрос для ОБНОВЛЕНИЯ данных в таблице.
 * 
 * @param string $tableFields  'table (user, password)' строка информации о структуре полей таблицы
 * @param mixed $values ОДНОМЕРНЫЙ массив  с чиловыми индексами или ЗНАЧЕНИЕ, с данными которые будут обновлены
 * @param string $where SQL условие для выбора данных для обновления
 * @param string $strtypes строка типов полей. см. функцию es_array
 * 
 *  $mysql->update('table (user, password)', array('Lesha','241746'),'id = 1');
  *  $mysql->update('table (user, password)', array('Lesha','241746'),'id = 1','ss');
 *
 * @return mysql_result
*/
public function update($tableFields,  $values, $where, $strtypes = '') {
    preg_match_all ('/\w+/',$tableFields,$t);
    $this->es_array($values,$strtypes);
	if (strlen($where)<3) { $where = '1=1'; }
    $table=array_shift($t[0]);
    $qu = '';
    for($i=0; $i<count($values); $i++) {
        $qu .= '`'.$t[0][$i].'` = '.$values[$i].',';
    }
    $qu{strlen($qu)-1} = ' ';
    return $this->query(
        'UPDATE `'.$table.'` SET '.$qu.'WHERE '.$where
    );
}

public function delete($table, $where) {
    return $this->query('DELETE FROM '.$table.' WHERE '.$where);
}

} // end class

