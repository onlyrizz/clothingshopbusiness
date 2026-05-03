<?php
class BrandController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addBrand($brand_name, $country) {
        $sql = "INSERT INTO brands (brand_name, country) VALUES (:brand_name, :country)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':brand_name' => $brand_name, ':country' => $country]);
    }

    public function deleteBrand($brand_id) {
        $sql = "DELETE FROM brands WHERE brand_id = :brand_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':brand_id' => $brand_id]);
    }

    public function updateBrand($brand_id, $brand_name, $country) {
        $sql = "UPDATE brands SET brand_name = :brand_name, country = :country WHERE brand_id = :brand_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':brand_id' => $brand_id,
            ':brand_name' => $brand_name,
            ':country' => $country
        ]);
    }
}
?>
