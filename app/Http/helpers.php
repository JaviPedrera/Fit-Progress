<?php 

/*
 * This file will be loaded with composer
 */

/**
 * [printColorBar will return a string depending of the time passed since the workout finished]
 * @param  [type] 	$hours [Hours since the workout finished]
 * @return [string]        [This string will be the appropiate according to the progress amount]
 */
function printColorBar($hours)
{
	if ($hours <= 18) {
		return 'progress-bar progress-bar-danger progress-bar-striped active';
	} elseif($hours <= 36) {
		return 'progress-bar progress-bar-warning progress-bar-striped active';
	} elseif($hours <= 48) {
		return 'progress-bar progress-bar-info progress-bar-striped active';
	} elseif($hours >= 72) {
		return 'progress-bar progress-bar-success';
	}
}
