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

/* 
Method: fetch
public function fetch($table)

This method fetches all fields from the specified table.

Parameters:
$table (string): The name of the table to fetch data from.
Example:

$db = new Database();
$result = $db->fetch("users");
print_r($result);


Method: fetchWhere
public function fetchWhere($table, $whereField, $whereValue, $fields)

This method fetches specific fields from the specified table based on a WHERE clause.

Parameters:

$table (string): The name of the table to fetch data from.
$whereField (string): The field to apply the WHERE condition on.
$whereValue (mixed): The value to compare with in the WHERE condition.
$fields (string): Comma-separated list of fields to fetch.
Example:

$db = new Database();
$result = $db->fetchWhere("products", "category", "Electronics", "name, price");
print_r($result);



Method: selectWhere
public function selectWhere($table, $selectFields, $whereClauses)

This method fetches specific fields from the specified table using multiple WHERE clauses.

Parameters:

$table (string): The name of the table to fetch data from.
$selectFields (array): Array of fields to select.
$whereClauses (array): Array of associative arrays containing field, operator, and value for each WHERE condition.
Example:

$db = new Database();
$whereClauses = [
    ['field' => 'category', 'operator' => '=', 'value' => 'Clothing'],
    ['field' => 'price', 'operator' => '<', 'value' => 50]
];
$result = $db->selectWhere("products", ["name", "price"], $whereClauses);
print_r($result);



Method: insert
public function insert($table, $data)

This method inserts a new row into the specified table.

Parameters:

$table (string): The name of the table to insert data into.
$data (array): Associative array of data to be inserted (field => value).
Example:

$db = new Database();
$newProduct = [
    'name' => 'New Product',
    'category' => 'Electronics',
    'price' => 199.99
];
$result = $db->insert("products", $newProduct);
if ($result) {
    echo "Row inserted successfully!";
}




Method: updateWhere
public function updateWhere($table, $updateFields, $updateValues, $whereField, $whereValue)

This method updates specific fields in a table using a WHERE clause.

Parameters:

$table (string): The name of the table to update data in.
$updateFields (array): Array of fields to update.
$updateValues (array): Array of values corresponding to the update fields.
$whereField (string): The field to apply the WHERE condition on.
$whereValue (mixed): The value to compare with in the WHERE condition.
Example:

$db = new Database();
$updateFields = ['quantity', 'price'];
$updateValues = [10, 149.99];
$result = $db->updateWhere("products", $updateFields, $updateValues, "id", 5);
if ($result > 0) {
    echo "Rows updated: " . $result;
}



Method: deleteWhere
public function deleteWhere($table, $whereField, $whereValue)

This method deletes rows from a table using a WHERE clause.

Parameters:

$table (string): The name of the table to delete data from.
$whereField (string): The field to apply the WHERE condition on.
$whereValue (mixed): The value to compare with in the WHERE condition.
Example:

$db = new Database();
$result = $db->deleteWhere("products", "category", "Obsolete");
if ($result > 0) {
    echo "Rows deleted: " . $result;
}



Method: customQuery
public function customQuery($tables, $fields, $whereClauses)

This method executes a custom SELECT query on specified tables with provided fields and WHERE clauses.

Parameters:

$tables (string): Comma-separated list of tables.
$fields (string): Fields to be selected.
$whereClauses (string): WHERE clauses for filtering.

Example:

$db = new Database();
$queryResult = $db->customQuery("orders o, customers c", "o.*, c.name", "o.customer_id = c.id AND o.total > 100");
print_r($queryResult);




Method: directQuery
public function directQuery($query)

This method executes a custom SQL query directly.

Parameters:

$query (string): The SQL query to be executed.
Example:

$db = new Database();
$query = "SELECT name, email FROM users WHERE status = 'active'";
$queryResult = $db->directQuery($query);
print_r($queryResult);




Method: selectWhereJoin
public function selectWhereJoin($table, $selectFields, $joins, $whereClauses)

This method selects fields using multiple join statements and multiple WHERE clauses.

Parameters:

$table (string): The main table to select from.
$selectFields (array): Array of fields to select.
$joins (array): Array of associative arrays containing join details.
$whereClauses (array): Array of associative arrays containing WHERE clause details.
Example:


$db = new Database();
$joins = [
    ['type' => 'INNER', 'table' => 'categories', 'on' => 'products.category_id = categories.id'],
    ['type' => 'LEFT', 'table' => 'brands', 'on' => 'products.brand_id = brands.id']
];
$whereClauses = [
    ['field' => 'categories.name', 'operator' => '=', 'value' => 'Electronics'],
    ['field' => 'products.price', 'operator' => '<', 'value' => 500]
];
$result = $db->selectWhereJoin("products", ["products.name", "categories.name as category"], $joins, $whereClauses);
print_r($result);

*/