<?php
class Database {
	private $conn;
	public function __construct(){
		$this->open();
	}
	private function open(){
		$this->conn = mysql_pconnect(DB_HOST, DB_USER, DB_PASS);
		if(!$this->conn){
			die("Database conn Failed: ". mysql_error());    
		}
		else {
			$this->select_db();
		}
	}
	private function select_db(){
		$db_select= mysql_select_db(DB_NAME, $this->conn);    
		if(!$db_select){
			die("Databse Selection Failed: ".mysql_error());    
		}    
	}
	
	public function sqlSafe($value) {
		$value = stripslashes(strip_tags(trim($value)));
		if (phpversion() >= '4.3.0') {
			$value = mysql_real_escape_string($value);
		}
		else {
			$value = mysql_escape_string($value);
		}	
		return $value;
	}
	public function query($sql){
		$result = mysql_query($sql, $this->conn);
		if(!$result){
			die("Database Query Failed: " . mysql_error());
		}
		else{
			return $result;
		}
	}
	public function fetchArray($sql_result){
		return mysql_fetch_array($sql_result);
	}
	public function numRows($result_set){
		return mysql_num_rows($result_set);
	}	
	public function close(){
		mysql_close($this->conn);
		unset($this->conn);
	}
	public function createPagination($table, $per_page = 10,$page = 1, $url = '?'){        
    	$sql = "SELECT COUNT(*) as `num` FROM {$table}";
    	$result = $this->query($sql);
		$row = $this->fetchArray($result);
    	$total = $row['num'];
        $adjacents = "2"; 
		
    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    $pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}page=$next'>Next</a></li>";
                $pagination.= "<li><a href='{$url}page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next</a></li>";
                $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
        return $pagination;
    } 
}  
 ?>