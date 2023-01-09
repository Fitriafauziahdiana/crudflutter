<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods:  POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/produk.php";

$request = $_SERVER['REQUEST_METHOD'];

$conn = $koneksi->connection();

$produk = new Produk($koneksi);

$data = json_decode(file_get_contents("php://input"));

$response =[];

if ($request == "POST"){
    if(
        !empty($data->id) &&
        !empty($data->nama) &&
        !empty($data->detail)
    ){
        $produk->id = $data_>id;
        $produk->nama = $data_>nama;
        $produk->detail = $data_>$detail;

        $data = array (
            'id' => $produk->id,
            'nama' => $produk->nama,
            'detail' => $produk->detail,
        );

        if ($produk->add()){
            $response = array(
                'status' => array(
                    'message' => 'success', 'code' => (http_response_code(200))
                ), 'data' => $data
            );
        }else{
            http_response_code(400);
            $response = array(
                'message'=> 'Add Failed',
                'code' => http_response_code()
            );
        }
    }else{
        http_response_code(400);
        $response = array(
            'status' => array(
                'message' => 'Add Failed - Wrong Parameter', 'code' => http_response_code()
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