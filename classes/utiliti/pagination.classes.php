<?php
require_once 'db.class.php';
class pagination
 {
	 
        public $pg_error = '';
        public $pg_result = '';
        public $pagination_output = '';
        public $max_pages = '';
        public $page_id = '';
        public $page_numbers_per_page = '';
        public $pg_user_param = '';
		
		
public function pagination()
    {
		
		$this->con=new DB();
       
		
	} 
public function setpagination($sql, $num_results_per_page, $num_page_links_per_page, $pg_param)
{
	//global $pg_error, $pg_result, $max_pages, $page_id, $page_numbers_per_page, $pg_user_param,$obj;
	
	$user_sql = $sql;
	$this->page_numbers_per_page = $num_page_links_per_page;
	$results_per_page = $num_results_per_page;
	$this->pg_user_param = $pg_param;
	
	$all_results=$this->con->queryMultipleObjects($sql);	//get all the results
	if($all_results)
	{	
		if(empty($all_results))
		{
			//if the query returns 0 results set the $total_results to 0
			$total_results = 0; 
		}
		else
		{
			//else set number of returned results to $total_results
			$i=0;
			foreach($all_results as $result)
			 {
				$i++; 
			 }
			$total_results =$i; 
		}
		
		/*
		Calculate max number of pages for the given query
		note why ceil is used
		*/
		$this->max_pages = ceil($total_results / $results_per_page);		
		
		//if url parameter page_id is set		
		if(isset($_GET['page_id']))
		{			
			$this->page_id = (int) $_GET['page_id'];			
			
			//Check for errors in passed $page_id
			if($this->page_id > $this->max_pages || empty($this->page_id))
			{
				$this->page_id = 1;				
			}
		}
		else
		{
			$this->page_id = 1;			
		}
		
		// ($page_id - 1) is because table row index start with 0
		$page_id_temp = ($this->page_id - 1) * $results_per_page;
		
		//sql limit starting point
		$sql_offset = $page_id_temp;
		
		//concatenate limit clause to the $user_sql with the offset and number of results per page
		$user_sql .= " limit $sql_offset, $results_per_page";		
		
		//run the new sql query to get the relavent result set
		$this->pg_result =$this->con->queryMultipleObjects($user_sql);
		
		return $this->pg_result; 
		//Call the function Creating the Links
		
		
	}
	else
	{
		$this->pg_error = 'Error with the sql query you entered: '.mysql_error();
	}
}


	
public function Create_Links($id,$key)
{
	//global $pagination_output, $max_pages, $page_id, $page_numbers_per_page, $pg_user_param;
	//Get the php file name
	$pg_page_name = htmlspecialchars($_SERVER['PHP_SELF'] );
	
	//You only need to create pagination if $max_pages is greater than 1
	if($this->max_pages > 1)
	{		
		//First Link		
		if($this->page_id > 1)
		{			
			$first_link = '<a href="'.$pg_page_name.'?page_id=1'.$this->pg_user_param.'&'.$key.'='.$id.'">First</a> ';
		}
		
		//Last Link		
		if($this->page_id < $this->max_pages)
		{			
			$last_link = '<a href="'.$pg_page_name.'?page_id='.$this->max_pages . $this->pg_user_param.'&'.$key.'='.$id.'">Last</a> ';
		}
		
		//Previous Link
		//previous id will always be 1 minus $page_id and should not equal to 0
		$pre_id = $this->page_id - 1;
		if($pre_id != 0)
		{
			$pre_link = '<a href="'.$pg_page_name.'?page_id='.$pre_id . $this->pg_user_param.'&'.$key.'='.$id.'">Previous</a> ';
		}		
		
		//Next Link
		//next id will always be 1 plus $page_id and should not be greater than $max_pages
		$next_id = $this->page_id + 1;
		if($next_id <= $this->max_pages)
		{
			$next_link = '<a href="'.$pg_page_name.'?page_id='.$next_id . $this->pg_user_param.'&'.$key.'='.$id.'">Next</a> ';
		}
		
		
		//Starting Page Number
		if($this->page_id >= $this->page_numbers_per_page)
		{
			/*
			if current $page_id greater than equal to $page_numbers_per_pages
			shift the starting page number
			*/
			$start_point = ($this->page_id - $this->page_numbers_per_page) + 2;
		}
		else
		{			
			$start_point = 1;
		}
		
		//Loop Amount
		// minus 1 is because inside the for loop its less than or equal
		$loop_num = ($start_point + $this->page_numbers_per_page) - 1; 
		if($loop_num > $this->max_pages)
		{
			//$loop_num cannot be greater than $max_pages
			$loop_num = $this->max_pages;
		}
		
		/* Creating Pagination Output Start */
		
		$pagination_output = '<div class="pagination"> ';
		
		//remove or comment this line if you don't want first link displayed
		$pagination_output .= $first_link;
		//remove or comment this line if you don't want previous link displayed
		$pagination_output .= $pre_link;
		
		for($i = $start_point; $i <= $loop_num; $i++)
		{
			if($i == $this->page_id)
			{
				$pagination_output .= '<a class="current">'.$i.'</a> ';
			}
			else
			{
				$pagination_output .= '<a href="'.$pg_page_name.'?page_id='.$i . $this->pg_user_param.'&'.$key.'='.$id.'">'.$i.'</a> ';
			}
		}
		
		//remove or comment this line if you don't want first link displayed
		$pagination_output .= $next_link;
		//remove or comment this line if you don't want previous link displayed
		$pagination_output .= $last_link;
		
		$pagination_output .= '</div><br />';
		return $pagination_output; 
		/* Creating Pagination Output End */
	}
}
 }


?>
