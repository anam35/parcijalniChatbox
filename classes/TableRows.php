<?php
namespace TableRows;
use \RecursiveIteratorIterator;

echo "<table style='border: solid 1px black;'>";
echo "<tr style='border:1px solid black;'><th>username</th><th>text</th><th>timestamp</th></tr>";

class TableRows extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}

	function current() {
		return "<td style='border:1px solid black;'>" . parent::current(). "</td>";
	}

	function beginChildren() {
		echo "<tr>";
	}

	function endChildren() {
		echo "</tr>" . "\n";
	}
}

?>