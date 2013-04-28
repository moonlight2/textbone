<?php

$json = array(array('name' => 'Ilia'), array('name' => 'Lilia'), array('name' => 'Myaur'),);

$url = $_GET['url'];

if ($url == 2) {
    $json = array(array('name' => 'Ilia2'), array('name' => 'Lilia2'), array('name' => 'Myaur2'),);
} else if ($url == 3) {
    echo '{"COLUMNS":["BRAND","MODEL","COLOR"],"DATA":[["Ford","Figo","RED"],["Ford","Fiesta","BLACK"],["Honda","CRV","GREEN"],["Honda","CITY","WHITE"]]}';
} else if ($url == 4) {

    echo json_encode(array('names' => array(
            'User' => array(
                array('Ilia'),
                array('Lilia')
            )
        )
    ));
    //echo '{"names":["User":{"name":"Ilia"}]}';
}

//echo json_encode($json);
?>
