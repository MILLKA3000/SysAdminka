<?php

class CsvComponent{

	/**
	 * Allows the mapping of preg-compatible regular expressions to public or
	 * private methods in this class, where the array key is a /-delimited regular
	 * expression, and the value is a class method.  Similar to the public functionality of
	 * the findBy* / findAllBy* magic methods.
	 *
	 * @var array
	 * @access public
	 */
    public $settings = array();
	public $defaults = array(
		'length' => 0,
		'delimiter' => ',',
		'enclosure' => '"',
		'escape' => '\\',
		'headers' => true
	);

	public function initialize(Controller $controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller = $controller;
		$this->defaults = array_merge($this->defaults, $settings);
	}

	/**
	 * Encoding for foreign characters
	 *
	 * @var array
	 * @access protected
	 */
	protected function _encode($str = '') {
		return iconv("UTF-8","WINDOWS-1257", html_entity_decode($str, ENT_COMPAT, 'utf-8'));
//		return $str;
	}

	/**
	 * Import public function
	 *
	 * @param string $filename path to the file under webroot
	 * @return array of all data from the csv file in [Model][field] format
	 * @author Dean Sofer
	 */
	public function import($filename, $fields = array(), $options = array()) {
		$options = array_merge($this->defaults, $options);
		$data = array();

		// open the file
		if ($file = @fopen($filename, 'r')) {
			if (empty($fields)) {
				// read the 1st row as headings
				$fields = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure']);
			}
			// Row counter
			$r = 0;
			// read each data row in the file
			while ($row = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure'])) {
				// for each header field
				foreach ($fields as $f => $field) {
					// get the data field from Model.field
					if (strpos($field,'.')) {
						$keys = explode('.',$field);
						if (isset($keys[2])) {
							$data[$r][$keys[0]][$keys[1]][$keys[2]] = $row[$f];
						} else {
							$data[$r][$keys[0]][$keys[1]] = $row[$f];
						}
					} else {
						$data[$r][$this->controller->modelClass][$field] = $row[$f];
					}
				}
				$r++;
			}

			// close the file
			fclose($file);

			// return the messages
			return $data;
		} else {
			return false;
		}
	}

	/**
	 * Converts a data array into
	 *
	 * @param string $filename
	 * @param string $data
	 * @return void
	 * @author Dean
	 */
	public function export($filename, $data, $options = array()) {
		$options = array_merge($this->defaults, $options);

		// open the file
		if ($file = @fopen($filename, 'w')) {
			// Iterate through and format data
			$firstRecord = true;
			foreach ($data as $record) {
				$row = array();
				foreach ($record as $model => $fields) {
					// TODO add parsing for HABTM
					foreach ($fields as $field => $value) {
						if (!is_array($value)) {
							if ($firstRecord) {
								$headers[] = $this->_encode($model . '.' . $field);
							}
							$row[] = $this->_encode($value);
						} // TODO due to HABTM potentially being huge, creating an else might not be plausible
					}
				}
				$rows[] = $row;
				$firstRecord = false;
			}

			if ($options['headers']) {
				// write the 1st row as headings
				fputcsv($file, $headers, $options['delimiter'], $options['enclosure']);
			}
			// Row counter
			$r = 0;
			foreach ($rows as $row) {
				fputcsv($file, $row, $options['delimiter'], $options['enclosure']);
				$r++;
			}

			// close the file
			fclose($file);

			return $r;
		} else {
			return false;
		}
	}
    public function setup(Model $model, $config = array()) {
        $this->settings[$model->alias] = array_merge($this->defaults, $config);
    }

    /**
     * Import public function
     *
     * @param string $filename path to the file under webroot
     * @return array of all data from the csv file in [Model][field] format
     * @author Dean Sofer
     */
    public function importCsv(&$model, $content, $fields = array(), $options = array()) {
        $options = array_merge($this->defaults, $options);

        if (!$this->_trigger($model, 'beforeImportCsv', array($content, $fields, $options))) {
            return false;
        }

        if ($options['text']) {
            // store the content to a file and reset
            $file = fopen("php://memory", "rw");
            fwrite($file, $content);
            fseek($file, 0);
        } else {
            $file = fopen($content, 'r');
        }

        // open the file
        if ($file) {

            $data = array();

            if (empty($fields)) {
                // read the 1st row as headings
                $fields = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure']);
            }
            // Row counter
            $r = 0;
            // read each data row in the file
            while ($row = fgetcsv($file, $options['length'], $options['delimiter'], $options['enclosure'])) {
                // for each header field
                foreach ($fields as $f => $field) {
                    if (!isset($row[$f])) {
                        $row[$f] = null;
                    }
                    // get the data field from Model.field
                    if (strpos($field,'.')) {
                        $keys = explode('.',$field);
                        if (isset($keys[2])) {
                            $data[$r][$keys[0]][$keys[1]][$keys[2]] = $row[$f];
                        } else {
                            $data[$r][$keys[0]][$keys[1]] = $row[$f];
                        }
                    } else {
                        $data[$r][$model->alias][$field] = $row[$f];
                    }
                }
                $r++;
            }

            // close the file
            fclose($file);

            $this->_trigger($model, 'afterImportCsv', array($data));

            // return the messages
            return $data;
        } else {
            return false;
        }
    }

    /**
     * Converts a data array into
     *
     * @param string $filename
     * @param string $data
     * @return void
     * @author Dean
     */
    public function exportCsv($filename, $data, $options = array()) {
        $options = array_merge($this->defaults, $options);
        // open the file
        if ($file = fopen($filename, 'w')) {
            // Add BOM for proper display UTF-8 in EXCEL
//            if($options['excel_bom']) {
                fputs($file, chr(239) . chr(187) . chr(191));
//            }
            // Iterate through and format data
            $firstRecord = true;
            foreach ($data as $record) {

                foreach ($record as $model => $fields) {
                    $row = array();
                    foreach ($fields as $field => $value) {
                        if (!is_array($value)) {
                            if ($firstRecord) {
                                $headers[] =  $field;
                            }
                            $row[] = $value;
                        } // TODO due to HABTM potentially being huge, creating an else might not be plausible
                    }
                    $firstRecord = false;
                    $rows[] = $row;
                }

            }

            if ($options['headers']) {
                // write the 1st row as headings
                fputcsv($file, $headers, $options['delimiter'], $options['enclosure']);
            }
            // Row counter
            $r = 0;
            foreach ($rows as $row) {
                fputcsv($file, $row, $options['delimiter'], $options['enclosure']);
                $r++;
            }

            // close the file
            fclose($file);

            return $r;
        } else {
            return false;
        }
    }

    protected function _trigger(&$model, $callback, $parameters) {
        if (method_exists($model, $callback)) {
            return call_user_func_array(array($model, $callback), $parameters);
        } else {
            return true;
        }
    }
}
?>