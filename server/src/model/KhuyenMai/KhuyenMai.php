<?php
class KhuyenMai {
    private $ma_km;
    private $ten_khuyen_mai;
    private $muc_khuyen_mai;
    private $dieu_kien;
    private $thoi_gian_bat_dau;
    private $thoi_gian_ket_thuc;
    private $tinh_trang;
    private $trang_thai;

    // Constructor
    public function __construct($ma_km, $ten_khuyen_mai, $muc_khuyen_mai, $dieu_kien, $thoi_gian_bat_dau, $thoi_gian_ket_thuc, $tinh_trang, $trang_thai) {
        $this->ma_km = $ma_km;
        $this->ten_khuyen_mai = $ten_khuyen_mai;
        $this->muc_khuyen_mai = $muc_khuyen_mai;
        $this->dieu_kien = $dieu_kien;
        $this->thoi_gian_bat_dau = $thoi_gian_bat_dau;
        $this->thoi_gian_ket_thuc = $thoi_gian_ket_thuc;
        $this->tinh_trang = $tinh_trang;
        $this->trang_thai = $trang_thai;
    }

    // Getter methods
    public function getMaKm() {
        return $this->ma_km;
    }

    public function getTenKhuyenMai() {
        return $this->ten_khuyen_mai;
    }

    public function getMucKhuyenMai() {
        return $this->muc_khuyen_mai;
    }

    public function getDieuKien() {
        return $this->dieu_kien;
    }

    public function getThoiGianBatDau() {
        return $this->thoi_gian_bat_dau;
    }

    public function getThoiGianKetThuc() {
        return $this->thoi_gian_ket_thuc;
    }

    public function getTinhTrang() {
        return $this->tinh_trang;
    }

    public function getTrangThai() {
        return $this->trang_thai;
    }
}