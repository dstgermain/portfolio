<?php
header('Content-Type:text/html; charset=UTF-8');
include('../vendor/simplehtmldom_1_5/simple_html_dom.php');
$html = file_get_html('https://www.linkedin.com/in/dan-st-germain-594a0923');
$positions = Array(
    (object) Array(
        'title' => 'Experience',
    )
);
foreach ( $html->find('li.position') as $element ) {
    array_push( $positions,
        (object) Array(
            'title'       => $element->find('.item-title', 0)->plaintext,
            'subtitle'    => $element->find('.item-subtitle', 0)->plaintext,
            'meta'        => $element->find('.meta', 0)->plaintext,
            'description' => $element->find('.description', 0)->innertext
        )
    );
}
array_push( $positions,
    (object) Array(
        'title'       => 'Education',
    )
);
foreach ( $html->find('.schools li[class=school]') as $element ) {
    array_push( $positions,
        (object) Array(
            'title'    => $element->find('.item-title', 0)->plaintext,
            'subtitle' => $element->find('.item-subtitle', 0)->plaintext,
            'meta'     => $element->find('.meta', 0)->plaintext,
        )
    );
}

print_r(json_encode($positions));
?>