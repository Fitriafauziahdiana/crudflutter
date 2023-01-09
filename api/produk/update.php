<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods:  PUT");
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/produk.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$produk = new Produk($conn);
$data = json_decode(file_get_contents("php://input"));

$produk->id = $data->id;

$response =[];


if ($request == "PUT"){
    if(
        !empty($data->id) &&
        !empty($data->nama) &&
        !empty($data->detail)
    ){
        $produk->id = $data->id;
        $produk->nama = $data->nama;
        $produk->detail = $data->$detail;

        $data = array (
            'id' => $produk->id,
            'nama' => $produk->nama,
            'detail' => $produk->detail,
        );

        if ($produk->update()){
            $response = array(
                'status' => array(
                    'message' => 'success', 'code' => (http_response_code(200))
                ), 'data' => $data
            );
        }else{
            http_response_code(400);
            $response = array(
                'message'=> 'Update Failed',
                'code' => http_response_code()
            );
        }
    }else{
        http_response_code(400);
        $response = array(
            'status' => array(
                'message' => 'Update Failed - Wrong Parameter', 'code' => http_response_code()
            )
            );
    }
}else{
    http_response_code(405);
    $response = array(
        'status' => array(
            'message' => 'Method Not Allowed', 'code' => http_response_code()
        )
        );
}

echo json_encode($response);
