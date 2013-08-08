<?php
	//GET SQL FILE//
	
	$db = new mysqli("localhost", "user", "pass", "db");
	
	$sql = file_get_contents('contacts.sql');
	mysqli_multi_query($mysqli,$sql);
	
	class AbstractModel {
		
		public function load($id) {
			$db = new mysqli("localhost", "user", "pass", "db");
			
			$result = $db->query("SELECT * FROM {$this->_table} WHERE {$this->_pk} = '$id'");
			
			$row = $result->fetch_assoc();
			$this->info = $row;
			
			return $this;
		}
		
		public function getData($key=false) {
			$data = $this->info;
			
			if($data == null) {
				$this->load($this->newid);
				$data = $this->info;
			}
			
			if($key == false) {
				$data = sprintf("id => %s,<br />name => %s<br />email => %s",$data['id'],$data['name'],$data['email']);
			} else {
				$data = $data[$key];
			}
			
			return $data;
		}
		
		public function setData($arr, $value=false) {
			$rowid = $this->info['id'];
			
			if(is_array($arr)) {
				if($rowid != "") {
					$this->query = 'UPDATE '.$this->_table.' SET name = "'.$arr["name"].'", email = "'.$arr["email"].'" WHERE '.$this->_pk.' = "'.$rowid.'"';
				} else {
					$this->query = 'INSERT INTO '.$this->_table.' (name,email) VALUES ("'.$arr["name"].'","'.$arr["email"].'")';
				}
				
			} else {
				$this->query = 'UPDATE '.$this->_table.' SET '.$arr.' = "'.$value.'" WHERE '.$this->_pk.' = "'.$rowid.'"';
			}
			
			return $this;
		}		
		
		public function save() {
			$db = new mysqli("localhost", "user", "pass", "db");
			
			$db->query($this->query) or die($db->error());
			$this->newid = $db->insert_id;
		}
		
		public function delete() {
			$db = new mysqli("localhost", "user", "pass", "db");
			
			$db->query("DELETE FROM {$this->_table} WHERE {$this->_pk} = '{$this->newid}'");
		}
	}

?>