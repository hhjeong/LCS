<?
require_once("lib/markdown.php");

function get_input_link( $id ) {
	global $inp_dir;
	$r = "";

	for($i = 1 ; $i <= 2 ; ++$i ) {
		$r = $r . "<a href='$inp_dir/$id"."$i.txt' target='_blank' class='btn btn-primary btn-large'>$id"."$i.txt</a> ";
	}

	return $r;
}

function rep( $s, $id ) {
	$s = str_replace(">=","≥",str_replace("<=","≤",$s));
	$s = str_replace("##input_here##", get_input_link($id), $s );
	$s = preg_replace("/(\d+)\^(\d+)/i","$1<sup>$2</sup>",$s);
	return $s;
}

function get_path( $id ) {
	global $prob_dir;
	return $prob_dir . "/" . $id . ".md";
}

function get_p( $id ) {
	return Markdown(rep(file_get_contents(get_path($id)),$id));
}

?>
