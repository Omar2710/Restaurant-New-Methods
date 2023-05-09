<?php 
class Admin extends User{
	function __constuct($fullName,$userName,$Email,$password,$addrss,$phone,$groupId){
		super($fullName,$userName,$Email,$password,$addrss,$phone);
		$this->$Id = 1;
	}

    ?>