<?php

require_once "../model/ConnectDB.php";
include "../model/ChiTietHoaDon/ChiTietHoaDon.php";
include "../model/ChiTietHoaDon/ChiTietHoaDonRepo.php";
include "../controller/CTSanPhamController.php";
include "../controller/ImeiController.php";

class CTHDController {
    private $chitietHDRepo;
    private $ctspController;
    private $imeiController;

    public function __construct() {
        $this->chitietHDRepo = new ChiTietHoaDonRepo();
        $this->ctspController = new CTSanPhamController();
        $this->imeiController = new ImeiController();
    }

    public function getAllChiTietHoaDon() {
        echo json_encode($this->chitietHDRepo->getAllChiTietHoaDon());
    }

    public function getOnlyChiTietHoaDon($ma_hd) {
        return $this->chitietHDRepo->getOnlyChiTietHoaDon($ma_hd);
    }

    public function getChiTietHoaDon($ma_hd) {
        echo json_encode($this->chitietHDRepo->getChiTietHoaDon($ma_hd));
    }

    public function getChiTietHoaDonInHoaDon($ma_hd) {
        echo json_encode($this->chitietHDRepo->getChiTietHoaDonInHoaDon($ma_hd));
    }

    public function getTotalQuantity($orderId) {
        echo json_encode($this->chitietHDRepo->getTotalQuantity($orderId));
    }

    public function addCTHD($ma_hd, $ma_ctsp, $so_luong, $gia_sp) {
        if ($this->chitietHDRepo->addCTHD($ma_hd, $ma_ctsp, $so_luong, $gia_sp)) {
            $cthds = $this->chitietHDRepo->getOnlyChiTietHoaDon($ma_hd);
            foreach ($cthds as $cthd) {
                if (!$this->imeiController->deleteImei($cthd['ma_imei'])) {
                    return $this->imeiController->deleteImei($cthd['ma_imei']);
                }
            }
            $cthdQuantity = $this->chitietHDRepo->getChiTietHoaDon($ma_hd);
            foreach ($cthdQuantity as $cthd) {
                if (!$this->ctspController->addOrderUpdateProductQuantity($cthd['ma_ctsp'], $cthd['so_luong'])) {
                    return $this->ctspController->addOrderUpdateProductQuantity($cthd['ma_ctsp'], $cthd['so_luong']);
                }
            }
            return true;
        }
        return $this->chitietHDRepo->addCTHD($ma_hd, $ma_ctsp, $so_luong, $gia_sp);
    }

    public function getCTHDByAdmin($ma_hd) {
        echo json_encode($this->chitietHDRepo->getCTHDByAdmin($ma_hd));
    }

    public function ConfirmBill($ma_hd, $ma_nv) {
        if ($this->chitietHDRepo->ConfirmBill($ma_hd, $ma_nv)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }
}

$ctHDctl = new CTHDController();
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

switch ($action){
    case 'get-cthd':
        $ma_hd = $_POST['ma_hd'];
        $ctHDctl->getChiTietHoaDon($ma_hd);
        break;
    case 'get-cthd-admin':
        $ma_hd = $_POST['ma_hd'];
        $ctHDctl->getCTHDByAdmin($ma_hd);
        break;
    case 'confirm-bill':
        $ma_hd = $_POST['ma_hd'];
        $ma_nv = $_POST['ma_nv'];
        $ctHDctl->ConfirmBill($ma_hd, $ma_nv);
        break;
    case 'getcthd':
        $ma_hd = $_POST['mahoadon'];
        $ctHDctl->getChiTietHoaDonInHoaDon($ma_hd);
        break;
    case 'get-total-quantity':
        $orderId = $_POST['orderId'];
        $ctHDctl->getTotalQuantity($orderId);
        break;
    case 'add-cthd':
        $obj = json_decode(json_encode($_POST['cthd']));
        echo json_encode($ctHDctl->addCTHD($obj->{'maHD'}, $obj->{'maCTSP'}, $obj->{'soLuong'}, $obj->{'giaSP'}));
    default:
        break;
}