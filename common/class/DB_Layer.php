<?php
//# Database Abstraction class
// Creates adaptor functions for MySQLi interaction

define("DBAL_BOTH", MYSQLI_BOTH);
define("DBAL_ASSOC", MYSQLI_ASSOC);
define("DBAL_NUM", MYSQLI_NUM);

class DataBase {

  // Setup variables
  var $vServer;			// Stores the server address or name
  var $vPort;				// Stores the server port
  var $vSocket;			// Stores the server socket name
  var $vUsername;			// Stores the username
  var $vPassword;			// Stores the password
  var $vDatabase;			// Stores the database

  // Status variables
  var $vConnected;		// Stores the connection status

  // Error Variables
  var $vErrorNumber;		// Stores the last error number
  var $vErrorText;		// Stores the last error text
  var $vErrorSource;		// Stores the source of the last error
  var $vLastErrQuery;		// Stores the last error extra message

  // MySQL variables
  var $vConnectionID;		// Connection Identifier with MySQL
  var $vLastQueryID;		// Resource id from last query executed
  var $vLastQueryType;	// Type of last query used for affected rows
  var $vLastQuery;		// The last query executed

  // Debug variables
  var $showQueries;		// List all queries run by executeQuery
  var $showTotalQueries;	// Count all queries run by executeQuery
  var $queries;			// Stores queries and counts

  /// DataBaseLayer Constructor
  /* This function initializes the database component.
  \param iServer <strong>String</strong>/Optional Specifies the server address or name to connect. If not specified the default "localhost" will be used.
  \param iUsername <strong>String</strong>/Optional Specifies the username on the server.
  \param iPassword <strong>String</strong>/Optional Specifies the password.
  \param iDataBase <strong>String</strong>/Optional Specifies the database name to be used. If not specified, the default database for the user will be used.
  \param iPort <strong>String</strong>/Optional Specifies the server port to connect. If not specified the default (3386) will be used.
  \param iSocket <strong>String</strong>/Optional Specifies the socket name to connect to the server.
  \return Nothing.
  \see DataBaseConnect
  */
  public function __construct ($iServer = "", $iUsername = "", $iPassword = "", $iDataBase = "", $iPort = "", $iSocket = "") {

    $this->vConnected = false;
    $this->vErrorNumber = "";
    $this->vErrorText = "";
    $this->vExtraMessage = "";

    $this->vConnectionID = NULL;
    $this->vLastQueryID = NULL;
    $this->vLastQueryType = "";
    $this->vLastQuery = "";

    $this->showQueries = false;
    $this->showTotalQueries = false;
    $this->queries = array();

    (strlen($iServer) > 0) 		? $this->vServer = $iServer 	: $this->vServer = NULL;
    (strlen($iUsername) > 0) 	? $this->vUsername = $iUsername : $this->vUsername = "";
    (strlen($iPassword) > 0) 	? $this->vPassword = $iPassword : $this->vPassword = NULL;
    (strlen($iDataBase) > 0) 	? $this->vDatabase = $iDataBase : $this->vDatabase = NULL;
    (strlen($iPort) > 0) 		? $this->vPort = $iPort 		: $this->vPort = "3306";
    (strlen($iSocket) > 0) 		? $this->vSocket = $iSocket 	: $this->vSocket = NULL;
  }

  /// setServerParams
  /* This function sets the server parameters. If there is a connection already on progress, this will return <strong>false</strong>
  \param iServer <strong>String</strong>/Optional Specifies the server address or name to connect. If not specified the default "localhost" will be used.
  \param iUsername <strong>String</strong>/Optional Specifies the username on the server.
  \param iPassword <strong>String</strong>/Optional Specifies the password.
  \param iDataBase <strong>String</strong>/Optional Specifies the database name to be used. If not specified, the default database for the user will be used.
  \param iPort <strong>String</strong>/Optional Specifies the server port to connect. If not specified the default (3386) will be used.
  \param iSocket <strong>String</strong>/Optional Specifies the socket name to connect to the server.
  \return True on success
  \return False on failure.
  \see DataBaseConnect
  */
  public function setServerParams ($iServer = "", $iUsername = "", $iPassword = "", $iDataBase = "", $iPort = "", $iSocket = "") {
    if ($this->vConnected) {
      $this->vErrorNumber = "DBClass_Error_02";
      $this->vErrorText = DBClass_Error_02;
      $this->vExtraMessage = "There is a connection in progress with " . $this->vServer;
      return false;
    } else {
      (strlen($iServer) > 0) 		? $this->vServer = $iServer 	: $this->vServer = NULL;
      (strlen($iUsername) > 0) 	? $this->vUsername = $iUsername : $this->vUsername = "";
      (strlen($iPassword) > 0) 	? $this->vPassword = $iPassword : $this->vPassword = NULL;
      (strlen($iDataBase) > 0) 	? $this->vDatabase = $iDataBase : $this->vDatabase = NULL;
      (strlen($iPort) > 0) 		? $this->vPort = $iPort 		: $this->vPort = "3306";
      (strlen($iSocket) > 0) 		? $this->vSocket = $iSocket 	: $this->vSocket = NULL;
      return true;
    }
  }


  /// Connects with the MySQL Server.
  /* Takes the server information provided on creation time or set via setServerParams.
  \return <strong>True</strong> on success.
  \return <strong>False</strong> on error.
  \see setServerParams
  */
  public function DataBaseConnect() {
    $iConnected = mysqli_connect($this->vServer, $this->vUsername, $this->vPassword, $this->vDatabase, $this->vPort, $this->vSocket);

    if (mysqli_connect_error()) {
      $this->vConnected = false;
      $this->vErrorNumber = mysqli_connect_errno();
      $this->vErrorText = mysqli_connect_error();
      $this->vErrorSource = "MYSQL";
      $this->vExtraMessage = "Trying to connect to " . $this->vServer;
      $iConnected = false;
    } else {
      $this->vConnected = true;
      $this->vConnectionID = $iConnected;
      $iConnected = true;
    }

    return $iConnected;
  }

  /// Set conection encoding
  /* param iEncoding <strong>String</strong>/Required the character encoding to be set.
  */
  public function setEncoding($iEncoding) {
    $iReturn = mysqli_set_charset($this->vConnectionID, $iEncoding);
    if ($iReturn === true) {
      $this->executeQuery("SET NAMES '" . $this->esc($iEncoding) . "'");
    }
    return $iReturn;
  }

  /// Get list of available charactersets on the database;
  /* \return <strong>Array</strong> with the available charactersets
  */
  public function getCharacterSets() {
    $iResult = $this->executeQuery('SHOW CHARACTER SET');
    $iReturn = array();
    while($iRow = $this->getResult($iResult, DBAL_ASSOC)) {
      $iReturn[$iRow['Charset']] = $iRow['Description'];
    }
    return $iReturn;
  }

  /// Selects the database to operate.
  /* param iDataBase <strong>String</strong>/Optional Specifies the database name to be used. If not specified, the default database for the user will be used.
  \return <strong>True</strong> if the operation was successful, <strong>False</strong> otherwise.
  */
  public function SelectDatabase($iDataBase) {
    $iReturn = mysqli_select_db($this->vConnectionID, $iDataBase);
    return $iReturn;
  }

  /// Closes a connection to the database.
  /* return <strong>True</strong> if the connection was successfully closed, <strong>False</strong> otherwise.
  */
  public function DataBaseClose() {
    if (mysqli_close($this->vConnectionID) === false)  {
      $this->vErrorNumber = mysqli_errno($this->vConnectionID);
      $this->vErrorText = mysqli_error($this->vConnectionID);
      $this->vErrorSource = "MYSQL";
      $this->vExtraMessage = "Trying to close connectio to " . $this->vServer;
      return false;
    } else {
      $this->vConnectionID = NULL;
      $this->vConnected = false;
      return true;
    }
  }

  /// Escapes strings properly.
  /* Escapes the specified string properly considering the current connection character set.
  \param iString <strong>String</strong>/Required The string to be escaped.
  \return <strong>String</strong> The escaped string to be used.
  */
  public function esc($iString) {
    $iReturn = mysqli_real_escape_string($this->vConnectionID, $iString);
    return $iReturn;
  }

  /// Executes a query.
  /* Executes the specified query on the currently connected server
  \param iQuery <strong>String</strong>/Required The query to be executed.
  \return <strong>Result Identifier</strong> for SELECT, SHOW, DESCRIBE and Explain queries
  \return <strong>True</strong> for other queries
  \return <strong>False</strong> on error
  \see getResult getInsertID getAffectedRows
  */
  public function executeQuery($iQuery) {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      return false;
    } else {
      $iReturn = mysqli_query($this->vConnectionID, $iQuery);

      if ($iReturn === false) {
        $this->vErrorNumber = mysqli_errno($this->vConnectionID);
        $this->vErrorText = mysqli_error($this->vConnectionID);
        $this->vErrorSource = "MYSQL";
        $this->vExtraMessage = $iQuery;
        $iDebugText = $this->vErrorText;
        $iDebugResult = false;
      } else {
        $this->vLastQueryID = $iReturn;
        $iType = explode(" ", trim($iQuery));
        $this->vLastQueryType = strtoupper($iType[0]);
        $iType = NULL;
        $this->vLastQuery = $iQuery;
        $iDebugText = 'Query successfull - ' . $this->getAffectedRows() . ' rows affected/returned';
        $iDebugResult = true;
      }
      if ($this->showQueries || $this->showTotalQueries) {
        $this->queries[] = array("query" => $iQuery, "result" => $iDebugResult, "message" => $iDebugText);
      }
      return $iReturn;
    }
  }

  /// Clears the result of a query.
  /* Clears the Result Identifier of a query, freeing the memory allocated by it.
  \return Nothing.
  \see executeQuery
  */
  public function freeResult($iResult) {
    mysqli_free_result($iResult);
  }

  /// Retrieve the result of a query.
  /* Returns an Array containing the result of a <strong>SELECT</strong>, <strong>SHOW</strong>, <strong>DESCRIBE</strong> or <strong>Explain</strong> query.
  \param iResultID <strong>Result Identifier</strong>/Required Result Identifier for the query. Must be obtained via executeQuery.
  \param iMode <strong>Result Mode</strong>/Optional Sets the result mode of the array. If not specified, <strong>DBAL_BOTH</strong> will be assumed.
  \return <strong>Array</strong> containing a row of the resultset.
  \return If iMode is <strong>DBAL_NUM</strong>, the elements of the array will be numerals, from 0 to the number of fields on the query.
  \return If iMode is <strong>DBAL_ASSOC</strong>, the elements of the array will be literals matching the name of the fields.
  \return If iMode is <strong>DBAL_BOTH</strong>, the elemens of the array will be both, numerals and literals.
  \see executeQuery
  */
  public function getResult($iResultID, $iMode = DBAL_ASSOC) {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      $iReturn = false;
    } else {
      $iReturn = mysqli_fetch_array($iResultID, $iMode);
      if ($iReturn === false) {
        $this->vErrorNumber = mysqli_errno($this->vConnectionID);
        $this->vErrorText = mysqli_error($this->vConnectionID);
        $this->vExtraMessage = "Trying to fetch result array";
        $this->vErrorSource = "MYSQL";
      }
    }
    return $iReturn;
  }

  /// Retrieve number of rows affected in last query.
  /* This function returns the number of rows existent in a SELECT query, or the number of rows affected in UPDATE, DELETE and INSERT queries.
  \return <strong>Integer</strong> representing the value of an Auto Increment field created with the last query, <strong>False</strong> on error.
  \see executeQuery
  */
  public function getInsertID() {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      $iReturn = false;
    } else {
      if (($this->vLastQueryType !== "INSERT") and ($this->vLastQueryType !== "UPDATE")) {
        $this->vErrorNumber = "DBClass_Error_03";
        $this->vErrorText = DBClass_Error_03;
        $this->vExtraMessage = "Trying get insert id from \"" . $this->vLastQuery . "\"";
        $this->vErrorSource = "MYSQL";
        $iReturn = false;
      } else {
        $iReturn = mysqli_insert_id($this->vConnectionID);
      }
    }
    return $iReturn;
  }

  /// Retrieve number of rows affected in last query.
  /* This function returns the number of rows existent in a SELECT query, or the number of rows affected in UPDATE, DELETE and INSERT queries.
  \return <strong>Integer</strong> with the number of rows, <strong>False</strong> on error
  \see executeQuery
  */
  public function getAffectedRows() {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      $iReturn = false;
    } else {
      if ($this->vLastQueryType == "SELECT") {
        $iReturn = mysqli_num_rows($this->vLastQueryID);
      } else {
        $iReturn = mysqli_affected_rows($this->vConnectionID);
      }

      if ($iReturn == -1) {
        $this->vErrorNumber = mysqli_errno($this->vConnectionID);
        $this->vErrorText = mysqli_error($this->vConnectionID);
        $this->vExtraMessage = "Trying get affected rows from \"" . $this->vLastQuery . "\"";
        $this->vErrorSource = "MYSQL";
        $iReturn = false;
      }
    }
    return $iReturn;
  }

  /// Retrieve the value of a single field query.
  /* This function returns the value of the field on a single field query.
  \return <strong>Mixed</strong> representing the field value, <strong>False</strong> on error
  \see executeQuery
  */
  public function getSingleValue($iQuery) {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      $iReturn = false;
    } else {
      $iResult = $this->executeQuery($iQuery);
      if ($iResult == false) {
        $iReturn = false;
      } else {
        $iReturn = $this->getResult($iResult, DBAL_NUM);
        $this->freeResult($iResult);
        $iReturn = $iReturn[0];
      }
    }
    return $iReturn;
  }

  /// Retrieve the first record of a query.
  /* This function returns the value of the first row on a query.
  \return <strong>Array</strong> associative containing the record values, <strong>False</strong> on error
  \see executeQuery
  */
  public function getSingleRecord($iQuery) {
    if ($this->vConnected === false) {
      $this->vErrorNumber = "DBClass_Error_01";
      $this->vErrorText = DBClass_Error_01;
      $this->vErrorSource = "DBClass";
      $this->vExtraMessage = "You are trying to execute a query on a closed connection";
      $iReturn = false;
    } else {
      $iResult = $this->executeQuery($iQuery);
      if ($iResult == false) {
        $iReturn = false;
      } else {
        $iReturn = $this->getResult($iResult, DBAL_ASSOC);
        $this->freeResult($iResult);
      }
    }
    return $iReturn;
  }

  /// Retrieve the last execution error.
  /* Returns an Array containing the details of the last error encontered during MySQL executions. The error is cleared after getError is called.
  \return <strong>Array</strong> containing the details of the error.
  \return "Text" The error message.
  \return "Number" The error number.
  \return "ExtraMessage" Extra information that may be helpful to solve the error.
  \return "Source" The source of the error.
  \return <strong>False</strong> if there is no errors to return.
  */
  public function getError() {
    if ((strlen($this->vErrorNumber) > 0) and (strlen($this->vErrorText) > 0)) {
      $iError = array();
      $iError["Text"] = $this->vErrorText;
      $iError["Number"] = "MySQL " . $this->vErrorNumber;
      (strlen($this->vLastErrQuery) > 0) ? $iError["ExtraMessage"] = "Last Query: " . $this->vLastErrQuery :	$iError["ExtraMessage"] = "Last Query: " . $this->vExtraMessage;
      $iError["Source"] = $this->vErrorSource;
      $this->vErrorNumber = "";
      $this->vErrorText = "";
      $this->vExtraMessage = "";
      $this->vErrorSource = "";
    } else {
      $iError = false;
    }
    return $iError;
  }
}
/*@}*/
