<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods:  DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/produk.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$produk = new Produk($conn);
$produk->id = isset ($_GET ["id"])  ? $_GET["id"] : die();

$produk->get();

$response =[];

if ($request == "DELETE"){
    if(
        !empty($data->id)
    ){
        $produk->id =$data->id;
        if($produk->delete()){
            $response =array (
                'status' => array (
                    'message' => 'Success', 'code' => (http_response_code(200))
                )
                );
        }else{
            http_response_code(400);
            $response = array(
                'message'=> 'Delete Failed',
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