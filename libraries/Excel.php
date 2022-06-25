<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Excel
 * A CodeIgniter library with PHPExcel
 *
 * @package        CodeIgniter
 * @category       Libraries
 * @author         Thinkplug Dev Team.
 * @version        0.1
 *
 * ---------------------------------------------------------------------------------------------------------------------
 *
 * @method PHPExcel_Worksheet createSheet(string $hostname)
 * @method PHPExcel_Worksheet getActiveSheet()
 * @method PHPExcel_Worksheet addSheet(PHPExcel_Worksheet $pSheet, int | null $iSheetIndex = NULL)
 * @method PHPExcel_Worksheet removeSheetByIndex(int | null $iSheetIndex = NULL)
 * @method PHPExcel_Worksheet getSheet(int $pIndex = 0)
 * @method PHPExcel_Worksheet[] getAllSheets()
 */
require_once dirname(__FILE__) . '/PHPExcel/PHPExcel.php';

class Excel extends PHPExcel
{
	/**
	 * @var \PHPExcel
	 */
	private $_excel;
	private static $_extension_types = [
		'xlsx' => 'Excel2007',
		'xlsm' => 'Excel2007',
		'xltx' => 'Excel2007',
		'xltm' => 'Excel2007',
		'xls' => 'Excel5',
		'xlt' => 'Excel5',
		'ods' => 'SYLK',
		'ots' => 'SYLK',
		'slk' => 'SYLK',
		'xml' => 'Excel2003XML',
		'gnumeric' => 'Gnumeric',
		'htm' => 'HTML',
		'html' => 'HTML',
		'csv' => 'CSV',
	];

	/**
	 * Excel constructor.
	 * @param array $params
	 */
	public function __construct($params = [])
	{
        parent::__construct();
        log_message('debug', 'Excel Class Initialized');
	}

	// ------------------------------------------------------------------------

	/**
	 *
	 * @param array $creator
	 *  -. LastModifiedBy
	 * -. Title
	 * -. Subject
	 * -. Description
	 * -. Keywords
	 * -. Category
	 * @return $this
	 */
	public function create($creator = [])
	{

		$this->_excel = new PHPExcel();
		$Creator = $this->_excel->getProperties()->setCreator($creator['LastModifiedBy']);

		foreach ($creator as $name => $value) {
			$method_name = 'set' . $name;
			if (!method_exists($Creator, $method_name)) continue;
			$Creator->$method_name($value);
		}

		return $this;
	}

	// ------------------------------------------------------------------------

	/**
	 * @param $filePath
	 * @param array $values
	 * @param array $creator
	 * @return bool
	 */
	public function save($filePath, $values = NULL, $creator = [])
	{

		if (is_null($this->_excel)) $this->create($creator);
		if (!empty($values)) $this->_excel->getActiveSheet()->fromArray($values);

		$ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));


		(PHPExcel_IOFactory::createWriter($this->_excel, self::$_extension_types[$ext]))->save($filePath);
		return file_exists($filePath);
	}

	// ------------------------------------------------------------------------

	/**
	 * only Excel2007
	 * @param $fileName
	 * @param array $values
	 * @param array $creator
	 * @return bool
	 */
	public function export($fileName, $values = NULL, $creator = [])
	{
		if (is_null($this->_excel)) $this->create($creator);
		if (!empty($values)) $this->_excel->getActiveSheet()->fromArray($values);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="01simple.xlsx"');
		header('Cache-Control: max-age=0');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		header('Content-Disposition: inline; filename="' . $fileName . '"');
		(PHPExcel_IOFactory::createWriter($this->_excel, 'Excel2007'))->save('php://output');

		die;
	}

	// ------------------------------------------------------------------------

	/**
	 * 폐기
	 */
	public function destroy()
	{
		if (!is_null($this->_excel)) $this->_excel->__destruct();
		unset($this->phpexcel);
	}

	// ------------------------------------------------------------------------

	/**
	 * @param $name
	 * @param $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments = NULL)
	{
		if (method_exists($this, $name)) {
			return call_user_func_array([$this, $name], $arguments);
		}
		else if (!is_null($this->_excel)) {
			if (method_exists($this->_excel, $name))
				return call_user_func_array([$this->_excel, $name], $arguments);

			$sheet = &$this->_excel->getActiveSheet();
			if (!is_null($sheet)) {
				if (method_exists($sheet, $name))
					return call_user_func_array([$sheet, $name], $arguments);
			}
		}

		show_error('Fatal error: Call to a member function ' . __CLASS__ . '::' . $name . '() on a non-object ');
	}


	/**
	 * Destructor
	 *
	 * Kill the connection
	 * @return    void
	 */
	function __destruct()
	{
		$this->destroy();
	}
}