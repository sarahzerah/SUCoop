<?php

	function formatDate($date){
		return date('F j, Y',strtotime($date));
	 }

	 function formatTime($time){
		return date('g:i a',strtotime($time));
	 }


	 function formatMoney($number, $fractional=false) {
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}

		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} 
			else {
				break;
			}
		}
		
		return $number;
	}

	function total() {
		$total = $srp * quantity;
	}

?>