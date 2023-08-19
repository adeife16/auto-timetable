<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class Database
{
    
    private $pdo;

    // Constructor that establishes a connection to the database
    public function __construct()
    {
    	$host = "localhost";
    	$username = "root";
    	$password = "";
    	$dbname = "fpitable";       


        // $host = "sql305.epizy.com";
        // $username = "epiz_33853196";
        // $password = "5HkAq3KPIwG3J";
        // $dbname = "epiz_33853196_five";

        $dsn = "mysql:host=$host;dbname=$dbname;";
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    // Method that fetches all the fields from a table
    public function fetch($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        // Method that fetches specific fields from a table using a WHERE clause
    public function fetchWhere($table, $whereField, $whereValue, $fields)
    {
        $stmt = $this->pdo->prepare("SELECT $fields FROM $table WHERE $whereField = ?");
        $stmt->execute([$whereValue]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Method that fetches specific fields from a table using multiple where clause
    public function selectWhere($table, $selectFields, $whereClauses)
    {
        $selectFields = implode(',', $selectFields);
        $whereConditions = array();
        $whereValues = array();
        foreach ($whereClauses as $whereClause) {
            $whereConditions[] = "{$whereClause['field']} {$whereClause['operator']} ?";
            $whereValues[] = $whereClause['value'];
        }
        $whereConditions = implode(' AND ', $whereConditions);
        $stmt = $this->pdo->prepare("SELECT $selectFields FROM $table WHERE $whereConditions");
        $stmt->execute($whereValues);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        // Method that inserts a row into a table
    public function insert($table, $data)
    {
        $fields = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $stmt = $this->pdo->prepare("INSERT INTO $table ($fields) VALUES ($values)");
        return $stmt->execute(array_values($data));
        // return $this->pdo->lastInsertId();
    }
// Method that updates specific fields in a table with a new value using a WHERE clause
    public function updateWhere($table, $updateFields, $updateValues, $whereField, $whereValue)
    {
        $setFields = array();
        foreach ($updateFields as $field) {
            $setFields[] = "$field = ?";
        }
        $setFields = implode(',', $setFields);
        $stmt = $this->pdo->prepare("UPDATE $table SET $setFields WHERE $whereField = ?");
        $stmt->execute(array_merge($updateValues, [$whereValue]));
        return $stmt->rowCount();
    }
        // Method that deletes rows from a table using a WHERE clause
    public function deleteWhere($table, $whereField, $whereValue)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $whereField = ?");
        $stmt->execute([$whereValue]);
        return $stmt->rowCount();   
    }
    public function customQuery($tables, $fields, $whereClauses)
    {
        $stmt = $this->pdo->prepare("SELECT ". $fields ." FROM ". $tables ." WHERE ". $whereClauses );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
        public function directQuery($query)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Method that selects all fields using multiple join statements and multiple WHERE clauses
    public function selectWhereJoin($table, $selectFields, $joins, $whereClauses)
    {
        $selectFields = implode(',', $selectFields);
        $joinStatements = '';
        foreach ($joins as $join) {
            $joinStatements .= " {$join['type']} JOIN {$join['table']} ON {$join['on']}";
        }
        
        $whereConditions = array();
        $whereValues = array();
        foreach ($whereClauses as $whereClause) {
            $whereConditions[] = "{$whereClause['field']} {$whereClause['operator']} ?";
            $whereValues[] = $whereClause['value'];
        }
        
        $whereConditions = implode(' AND ', $whereConditions);
        
        $query = "SELECT $selectFields FROM $table$joinStatements";
        
        if (!empty($whereConditions)) {
            $query .= " WHERE $whereConditions";
        }
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($whereValues);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>