<?php
    include "header.php";
?>

<div class="cart-main">
    <div class="container">
        <div class="cart__top d-flex p-2 justify-content-between">
            <div class="d-flex justify-content-between" style="width: 68%;">
                <div style="font-size: 24px; font-weight: 500;">Giỏ hàng</div>
                <div class="btn btn-danger btn-delete-all-cart">Xóa tất cả</div>
            </div>
        </div>

        <div class="d-flex p-2 justify-content-between">
            <div class="cart__left bg-white col-6">
                <div class="cart__left-title d-flex p-2">
                    <span class="d-flex justify-content-between w-100">
                        <div class="w-50 p-2">Sản phẩm</div>
                        <div class="p-2">Đơn giá</div>
                        <div class="p-2">Số lượng</div>
                        <div class="p-2">Thành tiền</div>
                    </span>
                </div>
                <ul class="cart__left-product">
                    
                </ul>
            </div>
            <div class="cart__right d-flex flex-column col-4">
                <div class="cart__right-promotion bg-white mb-4 p-4 rounded-3">
                    <div class="d-flex justify-content-between" >
                        <h6 style="font-weight: 700;" >Khuyến mãi</h6>
                        <a href="#"class="openmodal select-promo">Chọn khuyến mãi</a>
                    </div>
                    <div class="cart__right-condition" style="color: #828EB1;" ></div>
                    <ul class="cart-list-promo" style="max-height: 270px; overflow: auto;" >
                    
                    </ul>
                </div>
                <div class="cart__right-pay bg-white mb-4 p-4 rounded-3">
                    <h6 class="cart__right-header" style="font-weight: 700;">Thanh toán</h6>
                    <div class="cart__right-checkout-summary">
                        <div class="d-flex justify-content-between" >
                            <div>Tổng tạm tính</div>
                            <div class="cart__right-total-temp">0₫</div>
                        </div>
                        <div class="d-flex justify-content-between" >
                            <div>Giảm giá</div>
                            <div class="cart__right-price-reduce">-0₫</div>
                        </div>
                        <div class="d-flex justify-content-between" >
                            <div>Thành tiền</div>
                            <div class="cart__right-total">0₫</div>
                        </div>
                    </div>
                    <a href="index.php?thanh-toan" class="continue-checkout btn btn-success w-100" >Tiếp tục</a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal-cart">
            <div class="modal-cart-dialog">
                <div class="modal-cart-header">
                    <h2>Khuyến mãi và mã giảm giá</h2>
                    <i class="fa-solid fa-xmark closemodal"></i>
                </div>

                <div class="modal-cart-body" style="min-height: 450px;" >
                    <div class="modal-cart-promotion">
                        <div class="modal-cart-code">
                            <input class="w-100" type="text" placeholder="Mã giảm giá/phiếu mua hàng">
                        </div>
                        <button class="btn disabled">Tìm kiếm</button>
                    </div>

                    <ul class="modal-cart-list" style="max-height: 400px;" >

                    </ul>
                </div>

                <div class="modal-cart-footer">
                    <button class="btn btn-danger closemodal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const input = document.querySelector(".modal-cart-code input");
    const button = document.querySelector(".modal-cart-promotion button");
    input.addEventListener('input', function() {
        if (input.value.trim() === '') {
            button.classList.add('disabled');
        } else {
            button.classList.remove('disabled');
        }
    });
</script>

<?php
    include "footer.php";
?>