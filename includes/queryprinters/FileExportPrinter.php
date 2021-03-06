<?php

namespace SMW;

use SMWQueryResult;

/**
 * Base for export result printers.
 *
 * @since 1.8
 *
 * @file
 *
 * @license GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * Base class for file export result printers
 *
 * @ingroup QueryPrinter
 */
abstract class FileExportPrinter extends ResultPrinter implements ExportPrinter {

	/**
	 * @see ExportPrinter::isExportFormat
	 *
	 * @since 1.8
	 *
	 * @return boolean
	 */
	public final function isExportFormat() {
		return true;
	}

	/**
	 * @see ExportPrinter::outputAsFile
	 *
	 * @since 1.8
	 *
	 * @param SMWQueryResult $queryResult
	 * @param array $params
	 */
	public function outputAsFile( SMWQueryResult $queryResult, array $params ) {
		$result = $this->getResult( $queryResult, $params, SMW_OUTPUT_FILE );

		header( 'Content-type: ' . $this->getMimeType( $queryResult ) . '; charset=UTF-8' );

		$fileName = $this->getFileName( $queryResult );

		if ( $fileName !== false ) {
			header( "content-disposition: attachment; filename=$fileName" );
		}

		echo $result;
	}

	/**
	 * @see ExportPrinter::getFileName
	 *
	 * @since 1.8
	 *
	 * @param SMWQueryResult $queryResult
	 *
	 * @return string|boolean
	 */
	public function getFileName( SMWQueryResult $queryResult ) {
		return false;
	}

}
