<?php

require_once __DIR__ . '/../model/ConnectDB.php';
include __DIR__ . '/../model/ChiTietSanPham/ChiTietSanPham.php';
include __DIR__ . '/../model/ChiTietSanPham/ChiTietSanPhamRepo.php';

class CTSanPhamController {
    private $ctspRepo;

    public function __construct() {
        $this->ctspRepo = new ChiTietSanPhamRepo();
    }

    public function getData($productId) {
        $productDetails = $this->ctspRepo->getData($productId);
        $result = [];

        foreach ($productDetails as $productDetail) {
            if ($productDetail['trang_thai'] == 0) {
                $result[] = $productDetail;
            }
        }
        
        echo json_encode($result);
    }

    public function getAllProductDetails($productId) {
        echo json_encode($this->ctspRepo->getData($productId));
    }

    public function getProductDetail($productDetailId) {
        echo json_encode($this->ctspRepo->getProductDetail($productDetailId));
    }

    public function getProductDetailByProductId($productDetailId) {
        echo json_encode($this->ctspRepo->getProductDetailByProductId($productDetailId));
    }

    public function getProductDetailId($productId, $colorId, $ram, $rom) {
        echo $this->ctspRepo->getProductDetailId($productId, $colorId, $ram, $rom);
    }

    public function getProductDetailsLength() : int {
        return $this->ctspRepo->getProductDetailsLength();
    }

    public function addProductDetail($productDetail) {
        if ($this->ctspRepo->addProductDetail($productDetail)) {
            echo $productDetail->getMaCtsp();
        } else {
            echo null;
        }
    }

    public function updateProductDetailPrice($productDetailId, $chietkhau, $price) {
        if ($this->ctspRepo->updateProductDetailPrice($productDetailId, $chietkhau, $price)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function updateProductDetailChietkhau($productDetailId, $chietkhau) {
        if ($this->ctspRepo->updateProductDetailChietkhau($productDetailId, $chietkhau)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function deleteProductDetail($productDetailId) {
        if ($this->ctspRepo->deleteProductDetail($productDetailId)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
}

$ctspCtl = new CTSanPhamController();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'get-data':
        $productId = $_POST['productId'];
        $ctspCtl->getData($productId);
        break;
    case 'get-all':
        $productId = $_POST['productId'];
        $ctspCtl->getAllProductDetails($productId);
        break;
    case 'get':
        $productDetailId = $_POST['productDetailId'];
        $ctspCtl->getProductDetail($productDetailId);
        break;
    case 'get-by-product-id':
        $productId = $_POST['productId'];
        $ctspCtl->getProductDetailByProductId($productId);
        break;
    case 'get-id':
        $productId = $_POST['productId'];
        $colorId = $_POST['colorId'];
        $ram = $_POST['ram'];
        $rom = $_POST['rom'];
        $ctspCtl->getProductDetailId($productId, $colorId, $ram, $rom);
        break;
    case 'add':
        $length = $ctspCtl->getProductDetailsLength();
        if ($length >= 0) {
            $length += 1;
            $productDetailId = 'CTSP'.sprintf('%04d', $length);
            $obj = json_decode(json_encode($_POST['productDetail']));
            $productId = $_POST['productId'];
            $importPrice = 0;
            $chietkhau  = 0;
            $price = 0;
            $quantity = 0;
            
            $productDetail = new ChiTietSanPham(
                $productDetailId,
                $productId,
                $obj->{'cpuId'},
                $obj->{'colorId'},
                $obj->{'gpuId'},
                $obj->{'ram'},
                $obj->{'rom'},
                $importPrice,
                $chietkhau,
                $price,
                $quantity,
                0
            );
            $ctspCtl->addProductDetail($productDetail);
        }
        break;
    case 'update-price':
        $productDetailId = $_POST['productDetailId'];
        $chietkhau = $_POST['chietkhau'];
        $price = $_POST['price'];
        $ctspCtl->updateProductDetailPrice($productDetailId, $chietkhau, $price);
        break;
    case 'update-chietkhau':
        $productDetailId = $_POST['productDetailId'];
        $chietkhau = $_POST['chietkhau'];
        $ctspCtl->updateProductDetailChietkhau($productDetailId, $chietkhau);
        break;
    case 'delete':
        $productDetailId = $_POST['productDetailId'];
        $ctspCtl->deleteProductDetail($productDetailId);
        break;
    default:
        break;
}