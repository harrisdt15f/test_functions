<?php
function add_to_node($child_id, & $structure, $add) {
    foreach( $structure as & $data ) {
        if( isset($data['id']) ) {
            if( $data['id'] == $child_id ) {
                $data['children'][ $add['id'] ] = $add;
                break;
            }
        }

        if( isset($data['children']) ) {
            add_to_node($child_id, $data['children'], $add);
        }
    }
}

// Initial array structure.
$data = array(
    1 => array(
        'id' => 1,
        'children' => array(
            12 => array(
                'id' => 12,
                'children' => array(),
            ),

            15 => array(
                'id' => 15,
                'children' => array(
                    55 => array(
                        'id' => 55,
                    ),
                ),
            ),
        ),
    ),
);

echo '<pre>'.print_r($data,1).'</pre>';

// This code will add new child with ID 44 to parent with id 55.
add_to_node(55, $data, array(
    'id' => 44,
    'text' => 'my text',
));


echo '<pre>'.print_r($data,1).'</pre>';