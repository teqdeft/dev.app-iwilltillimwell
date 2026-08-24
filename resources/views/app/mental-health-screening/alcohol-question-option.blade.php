<tr class="quiz-type-div-list alchol-question-row">
	<?php 
	
	$first_option_heading = "";
	$second_option_heading = "";
	$thirld_option_heading = "";
	$fourth_option_heading = "";
	$five_option_heading = "";
	
	if($ind==0) {
		$first_option_heading = "Never";
		$second_option_heading = "Monthly or less";
		$thirld_option_heading = "2 to 4 times a month";
		$fourth_option_heading = "2 to 3 times a week";
		$five_option_heading = "4 or more times a week";
	} else if($ind==1) {
		$first_option_heading = "1 or 2";
		$second_option_heading = "3 or 4";
		$thirld_option_heading = "5 or 6";
		$fourth_option_heading = "7, 8, or 9";
		$five_option_heading = "10 or more";

	} else if($ind==2) {
		
		$first_option_heading  = "Never";
		$second_option_heading = "Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading   = "Daily or almost daily";
		
	} else if($ind==3) {
		
		$first_option_heading = "Never";
		$second_option_heading = " Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading = " Daily or almost daily";
		
	} else if($ind==4) {
		
		$first_option_heading = "Never";
		$second_option_heading = "Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading = "Daily or almost daily";
		
	} else if($ind==5) {
		
		$first_option_heading = "Never";
		$second_option_heading = "Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading = "Daily or almost daily";
		
	} else if($ind==6) {
		
		$first_option_heading = "Never";
		$second_option_heading = "Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading = "Daily or almost daily";
		
	} else if($ind==7) {
		
		$first_option_heading = "Never";
		$second_option_heading = "Less than monthly";
		$thirld_option_heading = "Monthly";
		$fourth_option_heading = "Weekly";
		$five_option_heading   = "Daily or almost daily";
	
		
	} else if($ind==8) {
		
		$first_option_heading = "No";
		$second_option_heading = "Yes, but not in the last year";
		$thirld_option_heading = "Yes, during the last year";
		
	
	
	} else if($ind==9) {
		
		$first_option_heading = "No";
		$second_option_heading = " Yes, but not in the last year";
		$thirld_option_heading = " Yes, during the last year";
		$fourth_option_heading = "";
		$five_option_heading = "";
	
	}
	
	?>

	<td>
		<div class="left-head-table alchol-question"><strong><?= $key + 1 ?>.</strong> {{$q->question}}</div>
	</td>
	
	<td><label class="custom-radio alchol-radio"><input type="radio" onclick="updateCount({{$ind}}, 0, 0, {{$q->id}})" name="radio{{$key}}"><span class="checkmark"></span><?php echo $first_option_heading?></label></td>
	
	<td><label class="custom-radio alchol-radio"><input type="radio" onclick="updateCount({{$ind}}, 1, 1, {{$q->id}})" name="radio{{$key}}"><span class="checkmark"></span><?php echo $second_option_heading?></label></td>
								
	<td><label class="custom-radio alchol-radio"><input type="radio" onclick="updateCount({{$ind}}, 2, 2, {{$q->id}})" name="radio{{$key}}"><span class="checkmark"></span><?php echo $thirld_option_heading?></label></td>
								
	<td>
		<?php if($fourth_option_heading) {?>
			<label class="custom-radio alchol-radio"><input type="radio" onclick="updateCount({{$ind}}, 3, 3, {{$q->id}})" name="radio{{$key}}"><span class="checkmark"></span><?php echo $fourth_option_heading?></label>
		<?php } ?>
	</td>
	
	<td>
		<?php if($five_option_heading) {?>
			<label class="custom-radio alchol-radio"><input type="radio" onclick="updateCount({{$ind}}, 3, 3, {{$q->id}})" name="radio{{$key}}"><span class="checkmark"></span><?php echo $five_option_heading?></label>
		<?php } ?>
	</td>
	
	
								
</tr>