<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: X-Requested-With");
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

if ($request == "GET"){
    if ($produk -> id != null ) {
        $data[] = array("id" => $produk->id, "nama" => $produk->nama, "detail" => $produk->detail,);
        $response = array("status"=> array("message" => "Succes", "code"=> http_response_code(200), "data" => $data));
}else {
    http_response_code(404);
    $response = array("status" => array("message" => "Data Not Found", "code" => http_response_code()));
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
