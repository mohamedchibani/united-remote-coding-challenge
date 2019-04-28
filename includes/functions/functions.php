<?php

	/*
	** Get All functions v2.0
	** Function to get all records from any database table
	*/

	function getAllFrom($table, $where = NULL, $and = NULL, $orderfield, $ordering = 'DESC'){

		global $con;

		$getAll = $con->prepare("SELECT * FROM $table $where $and ORDER BY $orderfield $ordering");
		
		$getAll->execute();
		
		$all = $getAll->fetchAll();

		return $all;
	} 




	/*
	** Title Functionn v1.0
	** Title Function That Echo The Page Title In Case The Page 
	** Has The Variable $pageTitle And Echo Default Title For Other Pages
	*/


	function getTitle(){
 
		global $pageTitle;

		if(isset($pageTitle)){

			echo $pageTitle;
		
		}else {

			echo "Default";

		}

	}




	/*
	** Check Items Function v1.0
	** Function to check items in database [ Function Accept Parameters ]
	** $select = the item to select [ Example : user, item, category ]
	** $from = The table to select from [ Example: users, items, categories ]
	** $value = The value of select [ Example: Mohamed, box, electronics] 
	*/

	function checkItem($select, $from, $value){

		global $con;

		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));

		$count = $statement->rowCount(); //must equal to 1 => > 0 to check that the row exists

		return $count;

	}


