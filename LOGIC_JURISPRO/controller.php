<?php

$dates = __DIR__ . "/dates.json";

function save_data ($existing_data) {
    global $dates;
    file_put_contents($dates, json_encode($existing_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function register_client () {
    global $dates;

    $json_input = file_get_contents('php://input');
    $data_received = json_decode($json_input, true);

    $new_name = trim($data_received["input_name"] ?? '');
    $new_id_card = intval($data_received["input_card"] ?? 0);
    $new_phone = intval($data_received["input_phone"] ?? 0);
    $new_info = trim($data_received["input_info"] ?? '');

    if(
        $new_name === '' ||
        $new_id_card <= 0 ||
        $new_phone <= 0 || 
        $new_info === '' 
    ) {
        echo json_encode(["message" => "Error, campos mal digitados"]);
        return;
    }

    $existing_data = json_decode(file_get_contents($dates), true);
    $existing_data["clients"][] = [
        "names" => $new_name,
        "id_card" => $new_id_card,
        "phone" => $new_phone,      
        "info" => $new_info,        
    ];

    save_data($existing_data);
    echo json_encode(["message" => "Cliente registrado exitosamente"]);
}

register_client();

?>