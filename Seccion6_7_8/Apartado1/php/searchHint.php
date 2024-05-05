<?php

$cities = ['Los Angeles', 'Florida', 'New York', 'New Jersey', 'Almería', 'Delaware', 'New Brunswick', 'Hessen', 'Zamora']; // Example data

// Get the search query from the request
$q = $_REQUEST["q"];
$hint = "";

// If the query is not empty
if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($cities as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            // Notice that we are not using inline 'onclick' attribute here
            $hint .= '<div class="suggestion-item">' . htmlspecialchars($name) . '</div>';
        }
    }
}

echo $hint === "" ? "no suggestion" : $hint;
?>
