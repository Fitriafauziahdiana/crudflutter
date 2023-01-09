<?php
class Produk 
{
    public $id;
    public $nama;
    public $detail;

    private $koneksi;
    private $table = "tbl_produk";

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    function fetch()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->koneksi->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get()
    {
        $query = "SELECT * FROM " . $this->table . " p WHERE p.id=? LIMIT 0,1";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bindParam(1, $this->id);

        $stmt->execute();
        
        $produk = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $produk["id"];
        $this->nama = $produk["nama"];
        $this->detail = $produk["produk"];
        return $stmt;
    }

    function add()
    {
        $query = "INSERT INTO
            " . $this->table . "
            SET
                id=:id, nama=:nama, detail=:detail";
        
    $stmt->$this->koneksi->prepare($query);
    $stmt->bindParam('id', $this->id);
    $stmt->bindParam('nama', $this->nama);
    $stmt->bindParam('detail', $this->detail);

    if ($stmt->execute()){
        return true;
    }
        return false;
    }

    function update()
    {
        $query = "UPDATE
            " . $this->table . "
            SET
                nama= :nama, 
                detail= :detail,
            WHERE
                id=:id";
        
    $stmt->$this->koneksi->prepare($query);

    $stmt->bindParam('id', $this->id);
    $stmt->bindParam('nama', $this->nama);
    $stmt->bindParam('detail', $this->detail);

    if ($stmt->execute()){
        return true;
    }
        return false;
    }

    function delete()
    {
        $query = "DELETE * FROM " . $this->table . "WHERE id = ? ";
        $stmt = $this->koneksi->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()){
        return true;
    }
        return false;
    }
}