<?php

include_once('numbers.php');
include_once('strings.php');
include_once('dates.php');

function json_response_ok()
{
	return 'OK';
}

function json_response_fail()
{
	return 'ERROR';
}

function mkClassColLabel(
	$col_xs=12, $col_sm=12, $col_md=12, $col_lg=12, 
	$col_xs_offset=0, $col_sm_offset=0, $col_md_offset=0, $col_lg_offset=0)
{
	$lbl_xs = '';
	$lbl_sm = '';
	$lbl_md = '';
	$lbl_lg = '';
	$lbl_xs_offset = '';
	$lbl_sm_offset = '';
	$lbl_md_offset = '';
	$lbl_lg_offset = '';

	$col_xs = intoRange($col_xs,1,12);
	$col_sm = intoRange($col_sm,1,12);
	$col_md = intoRange($col_md,1,12);
	$col_lg = intoRange($col_lg,1,12);

	$col_xs_offset = intoRange($col_xs_offset,0,12-$col_xs);
	$col_sm_offset = intoRange($col_sm_offset,0,12-$col_sm);
	$col_md_offset = intoRange($col_md_offset,0,12-$col_md);
	$col_lg_offset = intoRange($col_lg_offset,0,12-$col_lg);

	if ($col_xs>0) { $lbl_xs = 'col-xs-' . $col_xs; }
	if ($col_sm>0) { $lbl_sm = 'col-sm-' . $col_sm; }
	if ($col_md>0) { $lbl_md = 'col-md-' . $col_md; }
	if ($col_lg>0) { $lbl_lg = 'col-lg-' . $col_lg; }
	if ($col_xs_offset>0) { $lbl_xs_offset = 'col-xs-offset-' . $col_xs_offset; }
	if ($col_sm_offset>0) { $lbl_sm_offset = 'col-sm-offset-' . $col_sm_offset; }
	if ($col_md_offset>0) { $lbl_md_offset = 'col-md-offset-' . $col_md_offset; }
	if ($col_lg_offset>0) { $lbl_lg_offset = 'col-lg-offset-' . $col_lg_offset; }
	// ************************************************

	$lbl_col_class = '';
	$lbl_col_class .= ' '. $lbl_xs;
	$lbl_col_class .= ' '. $lbl_sm;
	$lbl_col_class .= ' '. $lbl_md;
	$lbl_col_class .= ' '. $lbl_lg;
	$lbl_col_class .= ' '. $lbl_xs_offset;
	$lbl_col_class .= ' '. $lbl_sm_offset;
	$lbl_col_class .= ' '. $lbl_md_offset;
	$lbl_col_class .= ' '. $lbl_lg_offset;
	$lbl_col_class = trim($lbl_col_class);
	
	return $lbl_col_class;
}