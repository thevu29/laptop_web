<?php
class DanhGiaRepo extends ConnectDB {
    function getAllDanhGia($ma_sp) : array | null {
        $sql = "SELECT * FROM danhgia WHERE ma_sp=$ma_sp";
        $arrDanhGia = [];
        try {
            $result = mysqli_query($this->conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $arrDanhGia[] = $row;
            }
            return $arrDanhGia;
        }
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
        }
        return null;
    }

    function getDanhGia($ma_kh) {
        $sql = "SELECT * FROM danhgia WHERE ma_kh = '$ma_kh'";
        $result = mysqli_query($this->conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row;
        }
        return null;
    }

    function addDanhGia($danhgia) {
        $ma_sp = $danhgia->getMaSP();
        $ma_kh = $danhgia->getMaKH();
        $rating = $danhgia->getRating();
        $thoi_gian_danh_gia = $danhgia->getThoiGian();
        $noi_dung = $danhgia->getNoiDung();
        $trang_thai = $danhgia->getTrangThai();

        $sql = "INSERT INTO danhgia(ma_sp,ma_kh,rating,thoi_gian_danh_gia, noi_dung, trang_thai) 
                VALUES ('$ma_sp', '$ma_kh', '$rating', '$thoi_gian_danh_gia', '$noi_dung', '$trang_thai')";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return true;
        }
        return false;
    }

    function deleteDanhGia($ma_kh) {
        $sql = "UPDATE danhgia SET trang_thai=1 WHERE ma_kh='$ma_kh'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return true;
        }
        return false;
    }

    function updateDanhGia($danhgia) {
        $ma_sp = $danhgia->getMaSP();
        $ma_kh = $danhgia->getMaKH();
        $rating = $danhgia->getRating();
        $thoi_gian_danh_gia = $danhgia->getThoiGian();
        $noi_dung = $danhgia->getNoiDung();

        $sql = "UPDATE danhgia SET rating='$rating', thoi_gian_danh_gia='$thoi_gian_danh_gia', noi_dung='$noi_dung'
                WHERE ma_kh='$ma_kh'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            return true;
        }
        return false;
    }

    function getSizeDanhGia(): int {
        try {
            $sql = "SELECT count(*) as count FROM danhgia";
            $statement = mysqli_query($this->conn, $sql);
            $result = mysqli_fetch_assoc($statement);

            return $result['count'] === null ? - 1 : (int)$result['count'];
        } 
        catch (Exception $e) {
            echo 'Error: ' . $e->getMessage() . '<br>';
            return -1;
        }
    }
}