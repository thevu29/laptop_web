$(document).ready(() => {
    const urlParams = new URLSearchParams(window.location.search)
    if (window.location.pathname === '/admin.php' && urlParams.get('controller') === 'khuyenmai') {
        renderPromotionToAdmin(null)
        clickPage(renderPromotionToAdmin)
        loadPaginationPromo()

        updateStatusPromo()
        getNextPromoId()

        handleAddPromotion()

        renderDeletePromoModal()
        handleDeletePromo()

        renderUpdatePromoModal()
        handleUpdatePromo()
    }
})

async function renderPromotionToAdmin(data) {
    try {
        const dataPromo = data ? data : await getPaginationPromo()

        if (dataPromo && dataPromo.pagination && dataPromo.pagination.length > 0) {
            let html = ''

            for (const item of dataPromo.pagination) {
                html += `
                <tr>
                    <td>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox-${item.ma_km}" name="chk[]" value="${item.ma_km}">
                            <label for="checkbox-${item.ma_km}"></label>
                        </span>
                    </td>
                    <td>${item.ma_km}</td>
                    <td>${item.ten_khuyen_mai}</td>
                    <td>≥ ${formatCurrency(item.dieu_kien)}</td>
                    <td>${convertMucKM(item.muc_khuyen_mai)}</td>
                    <td>${convertDate(item.thoi_gian_bat_dau)}</td>
                    <td>${convertDate(item.thoi_gian_ket_thuc)}</td>
                    <td>${item.tinh_trang}</td>
                    <td>
                        <a href="#updatePromotion" class="edit btn-update-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
                            <i class="material-icons" data-toggle="tooltip" title="Chỉnh sửa">&#xE254;</i>
                        </a>
                        <a href="#deletePromotion" class="delete btn-delete-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
                            <i class="material-icons" data-toggle="tooltip" title="Xóa">&#xE872;</i>
                        </a>
                    </td>
                </tr>
            `
            }
            
            $('.admin-promotion-list').html(html)
            totalPage(dataPromo.count)
        }

    } catch (error) {
        console.log(error);
    }
}

// function renderPromotionToAdmin() {
//     $.ajax({
//         url: 'server/src/controller/KhuyenMaiController.php',
//         method: 'POST',
//         data: { action: 'get-all' },
//         dataType: 'JSON',
//         success: async data => {
//             if (data && data.length > 0) {
//                 let html = ''

//                 data.forEach((item) => {
//                     // html render cho admin
//                     html += `
//                         <tr>
//                             <td>
//                                 <span class="custom-checkbox">
//                                     <input type="checkbox" id="checkbox-${item.ma_km}" name="chk[]" value="${item.ma_km}">
//                                     <label for="checkbox-${item.ma_km}"></label>
//                                 </span>
//                             </td>
//                             <td>${item.ma_km}</td>
//                             <td>${item.ten_khuyen_mai}</td>
//                             <td>≥ ${formatCurrency(item.dieu_kien)}</td>
//                             <td>${convertMucKM(item.muc_khuyen_mai)}</td>
//                             <td>${convertDate(item.thoi_gian_bat_dau)}</td>
//                             <td>${convertDate(item.thoi_gian_ket_thuc)}</td>
//                             <td>${item.tinh_trang}</td>
//                             <td>
//                                 <a href="#updatePromotion" class="edit btn-update-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
//                                     <i class="material-icons" data-toggle="tooltip" title="Chỉnh sửa">&#xE254;</i>
//                                 </a>
//                                 <a href="#deletePromotion" class="delete btn-delete-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
//                                     <i class="material-icons" data-toggle="tooltip" title="Xóa">&#xE872;</i>
//                                 </a>
//                             </td>
//                         </tr>
//                     `
                    
//                 })

//                 $('.admin-promotion-list').html(html)
//             }
//         }
//     })
// }

function loadPromotionData() {
    $.ajax({
        url: 'server/src/controller/KhuyenMaiController.php',
        method: 'POST',
        data: { action: 'get-all' },
        dataType: 'JSON',
        success: async data => {
            if (data && data.length > 0) {
                let html = ''
                let html2 = ''
                let maKH = await getMaKH()
                let khuyenMai = JSON.parse(localStorage.getItem('khuyenMai')) || {};
                let conditionKM = false

                data.forEach((item) => {
                    // html render cho admin
                    html += `
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox-${item.ma_km}" name="chk[]" value="${item.ma_km}">
                                    <label for="checkbox-${item.ma_km}"></label>
                                </span>
                            </td>
                            <td>${item.ma_km}</td>
                            <td>${item.ten_khuyen_mai}</td>
                            <td>≥ ${formatCurrency(item.dieu_kien)}</td>
                            <td>${convertMucKM(item.muc_khuyen_mai)}</td>
                            <td>${convertDate(item.thoi_gian_bat_dau)}</td>
                            <td>${convertDate(item.thoi_gian_ket_thuc)}</td>
                            <td>${item.tinh_trang}</td>
                            <td>
                                <a href="#updatePromotion" class="edit btn-update-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
                                    <i class="material-icons" data-toggle="tooltip" title="Chỉnh sửa">&#xE254;</i>
                                </a>
                                <a href="#deletePromotion" class="delete btn-delete-promo-modal" data-toggle="modal" data-id="${item.ma_km}">
                                    <i class="material-icons" data-toggle="tooltip" title="Xóa">&#xE872;</i>
                                </a>
                            </td>
                        </tr>
                    `

                    // render khi đã chọn khuyến mãi phù hợp
                    if(khuyenMai[maKH]) { 
                        var finish_money = $('.cart__right-total-temp').length > 0 
                                            ? parseFloat($('.cart__right-total-temp').text().replace(/[₫.]/g, ""))
                                            : parseFloat($('.checkout-confirm__money-total').text().replace(/[₫.]/g, ""));
                        let promises = khuyenMai[maKH].map(maKM => {
                            return getPromotion(maKM)
                                .then(res => {
                                    let mucKM = parseFloat(res.muc_khuyen_mai)
                                    if(mucKM % 1 === 0 && mucKM !== 0) {
                                        finish_money -= mucKM
                                    }
                                    else {
                                        finish_money -= finish_money*mucKM
                                    }
                                    return `
                                        <li class="modal-promo-item p-2" >
                                            <div class="modal-promo-name d-flex align-items-center" >
                                                <div class="modal-promo-code">${res.ma_km}</div>
                                                <div class="modal-promo-name2 ms-2" style="font-weight: 500;">${res.ten_khuyen_mai}</div>
                                            </div>
                                            <div class="modal-promo-percent" >
                                                Giảm ${convertMucKM(res.muc_khuyen_mai)}
                                            </div>
                                            <div class="modal-promo-bottom d-flex justify-content-between">
                                                <div class="modal-promo-expiry" >HSD: ${convertDate(res.thoi_gian_ket_thuc)}</div>
                                                <div class="modal-promo-del" data-id="${res.ma_km}" >Bỏ chọn</div>
                                            </div>
                                        </li>
                                    `;
                                });
                        });

                        
                        Promise.all(promises).then(results => {
                            $('.cart-list-promo').html(results.join(''));
                            delPromoToLocalStorage()

                            tmp_total = $('.cart__right-total-temp').length > 0 
                                        ? parseFloat($('.cart__right-total-temp').text().replace(/[₫.]/g, ""))
                                        : parseFloat($('.checkout-confirm__tmp-total').text().replace(/[₫.]/g, ""));
                            if(tmp_total != finish_money) {
                                var money_reduce = tmp_total - finish_money
                                $('.cart__right-price-reduce').text("- " + convertMucKM(money_reduce)) 
                                $('.checkout-confirm__promo').text("- " + convertMucKM(money_reduce)) 
                                $('.cart__right-total').text(convertMucKM(finish_money))
                                $('.checkout-confirm__money-total').text(convertMucKM(finish_money))
                            }
                            else {
                                $('.cart__right-price-reduce').text("-0₫")
                                $('.checkout-confirm__promo').text("-0₫")
                            }
                        }).catch(error => console.log(error));

                    }

                    // html2 render cho enduser
                    if(checkValidPromo(item)) {
                        conditionKM = true
                        html2 += `
                            <li class="modal-promo-item apply" >
                                <div class="modal-promo-name d-flex align-items-center" >
                                    <div class="modal-promo-code">${item.ma_km}</div>
                                    <div class="modal-promo-name2 ms-2" style="font-weight: 500;">${item.ten_khuyen_mai}</div>
                                </div>
                                <div class="modal-promo-percent mt-2 mb-2" >
                                    Giảm ${(convertMucKM(item.muc_khuyen_mai))}
                                </div>
                                <div class="modal-promo-bottom d-flex justify-content-between">
                                    <div class="modal-promo-expiry" >HSD: ${convertDate(item.thoi_gian_ket_thuc)}</div>
                                    <div class="modal-promo-add" data-id="${item.ma_km}" >Áp dụng</div>
                                </div>
                            </li>
                        `
                    }
                    
                })

                $('.admin-promotion-list').html(html)
                console.log($('.admin-promotion-list'))
                $('.modal-cart-list').html(html2)

                if(!conditionKM) {
                    $('.cart__right-condition').text("Đơn hàng chưa đủ điều kiện áp dụng khuyến mãi. Vui lòng mua thêm để áp dụng")
                }

                if(khuyenMai[maKH] && khuyenMai[maKH] != '') {
                    $('.cart__right-condition').text("Khuyến mãi đã được áp dụng")
                }
            }
            addPromoToLocalStorage()
        }
    })
}


function checkValidPromo(item) {
    if(item != undefined) {
        var today = new Date().toISOString().slice(0, 10);
        var startDate = item.thoi_gian_bat_dau;
        var endDate = item.thoi_gian_ket_thuc;
        var check = false;

        if (today >= startDate && today <= endDate) {
            check = true
        } else if (today < startDate) {
            check = false
        } else {
            check = false
        }

        if(check) {
            var tmp_total = $('.cart__right-total-temp').text().replace(/[₫.]/g, "");
            if(tmp_total >= item.dieu_kien) {
                check = true
            }
        }

        return check
        
    }
}

function updateStatusPromo() {
    $(document).on('change', '#promotion-date-from, #promotion-date-to', () => {
        var today = new Date().toISOString().slice(0, 10);
        var startDate = $('#promotion-date-from').val();
        var endDate = $('#promotion-date-to').val();
        var promotionStatus = $('#promotion-status');

        console.log(startDate)
        console.log(endDate)

        if(startDate != '' && endDate != '' && startDate >= endDate) {
            alert('Ngày bắt đầu không được lớn hơn ngày kết thúc của chương trình');
            $('#promotion-date-from').val('');
            $('#promotion-date-to').val('');
        }
        else {
            if (today >= startDate && today <= endDate) {
                promotionStatus.val('Đang diễn ra');
            } else if (today < startDate) {
                promotionStatus.val('Chưa bắt đầu');
            } else {
                promotionStatus.val('Đã kết thúc');
            }
        }
    })

    $(document).on('change', '#updatePromotion #promotion-date-from, #updatePromotion #promotion-date-to', () => {
        var today = new Date().toISOString().slice(0, 10);
        var startDate = $('#updatePromotion #promotion-date-from').val();
        var endDate = $('#updatePromotion #promotion-date-to').val();
        var promotionStatus = $('#updatePromotion #promotion-status');

        console.log(startDate)
        console.log(endDate)

        if(startDate != '' && endDate != '' && startDate >= endDate) {
            alert('Ngày bắt đầu không được lớn hơn ngày kết thúc của chương trình');
            $('#updatePromotion #promotion-date-from').val('');
            $('#updatePromotion #promotion-date-to').val('');
        }
        else {
            if (today >= startDate && today <= endDate) {
                promotionStatus.val('Đang diễn ra');
            } else if (today < startDate) {
                promotionStatus.val('Chưa bắt đầu');
            } else {
                promotionStatus.val('Đã kết thúc');
            }
        }
    })
    
}

function validatePromo(promo) {
    if(promo.promoName === '' && promo.promoName != undefined) {
        alert('Vui lòng nhập tên của khuyến mãi')
        $("#promotion-name").focus()
        return false;
    }
    if(promo.promoPercent === '' && promo.promoPercent != undefined) {
        alert('Vui lòng nhập mức giảm của khuyến mãi')
        $("#promotion-percent").focus()
        return false;
    }
    if(promo.promoCondition === '' && promo.promoCondition != undefined) {
        alert('Vui lòng nhập điều kiện khuyến mãi')
        $("#promotion-condition").focus()
        return false;
    }
    if(promo.promoDateFrom === '' && promo.promoDateFrom != undefined) {
        alert('Vui lòng chọn ngày bắt đầu khuyến mãi')
        $("#promotion-date-from").focus()
        return false;
    }
    if(promo.promoDateTo === '' && promo.promoDateTo != undefined) {
        alert('Vui lòng chọn ngày kết thúc khuyến mãi')
        $("#promotion-date-to").focus()
        return false;
    }
    return true
}

function addPromotion(promo) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'server/src/controller/KhuyenMaiController.php',
            method: 'POST',
            data: { action: 'add', promo },
            success: res => {
                resolve(res)
            },
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}

function handleAddPromotion() {
    $(document).on('click', '.btn-add-promotion', e => {
        e.preventDefault();
        const promo = {
            promoName: $('#addPromotion #promotion-name').val().trim(),
            promoPercent: $('#addPromotion #promotion-percent').val().trim(),
            promoCondition: $('#addPromotion #promotion-condition').val().trim(),
            promoDateFrom: $('#addPromotion #promotion-date-from').val().trim(),
            promoDateTo: $('#addPromotion #promotion-date-to').val().trim(),
            promoStatus: $('#addPromotion #promotion-status').val().trim()
        }

        if(!validatePromo(promo)) {
            return
        }

        addPromotion(promo)
            .then(res => {
                if (res) {
                    alert('Thêm khuyến mãi thành công')
                    $('form').trigger('reset')
                    $('#addPromotion').modal('hide')
                    loadPromotionToAdmin()
                } 
                else {
                    alert('Xảy ra lỗi trong quá trình thêm khuyến mãi')
                }
            })
            .catch(error => console.log(error))
    })
}

function getPromotion(promoId) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'server/src/controller/KhuyenMaiController.php',
            method: 'POST',
            data: { action: 'get', promoId },
            dataType: 'JSON',
            success: promo => resolve(promo),
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}

function renderDeletePromoModal() {
    $(document).on('click', '.btn-delete-promo-modal', e => {
        const promoId = e.target.closest('.btn-delete-promo-modal').dataset.id

        if (promoId) {
            getPromotion(promoId)
                .then(promo => {
                    const html = `
                        <p>Bạn có chắc chắn muốn xóa khuyến mãi có mã "<b class="promo-id">${promo.ma_km}</b>" không?</p>
                        <p class="text-warning"><small>Hành động này sẽ không thể hoàn tác</small></p>
                    `
                    $('#deletePromotion .delete-body').html(html)
                })
        }
    })

    $('.btn-delete-checked-promo-modal').on('click', () => {
        const html = `
            <p>Bạn có chắc muốn xóa các khuyến mãi được chọn không ?</p>
            <p class="text-warning"><small>Hành động này sẽ không thể hoàn tác</small></p>
        `
        $('#deletePromotion .delete-body').html(html)
    })
}

function deletePromotion(promoId) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'server/src/controller/KhuyenMaiController.php',
            method: 'POST',
            data: { action: 'delete', promoId },
            success: data => {
                resolve(data)
            },
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}

function handleDeletePromo() {
    $(document).on('click', '#confirm-delete', () => {
        const promoId = $('#deletePromotion .promo-id').text()

        if (promoId) {
            deletePromotion(promoId)
                .then(res => {
                    if (res === 'success') {
                        alert('Xóa khuyến mãi thành công')
                        $('#deletePromotion').modal('hide')
                        loadPromotionToAdmin()
                    } 
                    else if(res === 'fail') {
                        alert('Không thể xóa khuyến mãi có chương trình "Đang diễn ra"')
                    }
                    else {
                        alert('Xảy ra lỗi trong quá trình xóa khuyến mãi')
                    }
                })
                .catch(error => console.log(error))
        }
    })
}

function getNextPromoId() {
    $.ajax({
        url: 'server/src/controller/KhuyenMaiController.php',
        method: 'POST',
        data: { action: 'get-size' },
        dataType: 'JSON',
        success: size => {
            if(size >= 0) {
                id = 'KM' + String(size+1).padStart(3, '0');
                $("#promotion-id").val(id)
            }
        },
        error: (xhr, status, error) => {
            console.log(error)
        }
    })

    return 1;
}

function renderUpdatePromoModal() {
    $(document).on('click', '.btn-update-promo-modal', async e => {
        const promoId = e.target.closest('.btn-update-promo-modal').dataset.id

        const promo = await getPromotion(promoId)
        $('#updatePromotion #promotion-id').val(promo.ma_km)
        $('#updatePromotion #promotion-name').val(promo.ten_khuyen_mai)
        $('#updatePromotion #promotion-percent').val(promo.muc_khuyen_mai)
        $('#updatePromotion #promotion-condition').val(promo.dieu_kien)
        $('#updatePromotion #promotion-date-from').val(promo.thoi_gian_bat_dau)
        $('#updatePromotion #promotion-date-to').val(promo.thoi_gian_ket_thuc)
        $('#updatePromotion #promotion-status').val(promo.tinh_trang)
    })
}

function updatePromo(promo) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'server/src/controller/KhuyenMaiController.php',
            method: 'POST',
            data: { action: 'update', promo },
            success: res => {
                if (res == 'success') {
                    resolve(true)
                } 
                else {
                    console.log(res)
                    resolve(false)
                }
            },
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}

function handleUpdatePromo() {
    $(document).on('click', '.btn-update-promo', () => {
        const promo = {
            promoId: $('#updatePromotion #promotion-id').val().trim(),
            promoName: $('#updatePromotion #promotion-name').val().trim(),
            promoPercent: $('#updatePromotion #promotion-percent').val().trim(),
            promoCondition: $('#updatePromotion #promotion-condition').val().trim(),
            promoDateFrom: $('#updatePromotion #promotion-date-from').val().trim(),
            promoDateTo: $('#updatePromotion #promotion-date-to').val().trim(),
            promoStatus: $('#updatePromotion #promotion-status').val().trim()
        }

        if(!validatePromo(promo)) {
            return
        }

        updatePromo(promo)
            .then(res => {
                if(res) {
                    alert('Cập nhật khuyến mãi thành công')
                    $('form').trigger('reset')
                    $('#updatePromotion').modal('hide')
                    loadPromotionToAdmin()
                } 
                else {
                    alert('Xảy ra lỗi trong quá trình cập nhật khuyến mãi')
                }
            })
            .catch(error => console.log(error))
    })
}

function renderPromoByMaKH() {
    $.ajax({
        url: 'server/src/controller/KhuyenMaiController.php',
        method: 'POST',
        data: { action: 'get-all'},
        success: async data => {
            if (data && data.length > 0) {
                let html = ''
                let maKH = await getMaKH()
                let khuyenMai = JSON.parse(localStorage.getItem('khuyenMai')) || {};
                
                if(khuyenMai[maKH]) {
                    data.forEach((item, index) => {
                        if(data.ma_km)
                        html += `
                            <li class="modal-promo-item p-2" >
                                <div class="modal-promo-name d-flex align-items-center" >
                                    <div class="modal-promo-code">${data.ma_km}</div>
                                    <div class="modal-promo-name2 ms-2" style="font-weight: 500;">${data.ten_khuyen_mai}</div>
                                </div>
                                <div class="modal-promo-percent" >
                                    ${data.muc_khuyen_mai}
                                </div>
                                <div class="modal-promo-bottom d-flex justify-content-between">
                                    <div class="modal-promo-expiry" >HSD: ${data.thoi_gian_ket_thuc}</div>
                                    <div class="modal-promo-del" >Bỏ chọn</div>
                                </div>
                            </li>
                        `
                    })
                }
                
            }
        },
        error: (xhr, status, error) => {
            console.log(error)
        }
    })
}

function addPromoToLocalStorage() {
    $('.modal-promo-add').click(async function() {
        const maKM = $(this).attr('data-id');
        const maKH = await getMaKH()

        let khuyenMai = JSON.parse(localStorage.getItem('khuyenMai')) || {};
        
        if (!khuyenMai[maKH]) {
            khuyenMai[maKH] = [];
        }

        if (!khuyenMai[maKH].includes(maKM)) {
            khuyenMai[maKH].push(maKM);
            alert("Áp dụng khuyến mãi thành công")
        }

        loadPromotionData()

        localStorage.setItem('khuyenMai', JSON.stringify(khuyenMai));
    })
}

function delPromoToLocalStorage() {
    $('.modal-promo-del').click(async function() {
        const maKM = $(this).attr('data-id');
        const maKH = await getMaKH();
    
        let khuyenMai = JSON.parse(localStorage.getItem('khuyenMai')) || {};
    
        if (khuyenMai[maKH]) {
            const index = khuyenMai[maKH].indexOf(maKM);
            if (index !== -1) {
                khuyenMai[maKH].splice(index, 1);
                localStorage.setItem('khuyenMai', JSON.stringify(khuyenMai));
                alert("Xóa khuyến mãi thành công");
                $(this).closest('.modal-promo-item').remove();
                $('.cart__right-condition').text("")
            }
        }
        loadPromotionData()
    });
}

function delPromoToLocalByMaKH(maKH) {
    let khuyenMai = JSON.parse(localStorage.getItem('khuyenMai')) || {};
    
    if (khuyenMai[maKH]) {
        delete khuyenMai[maKH];
        localStorage.setItem('khuyenMai', JSON.stringify(khuyenMai));
    }
}

function getPaginationPromo() {
    return new Promise((resolve, reject) => {
        const page = $('#currentpage').val()
        $.ajax({
            url: 'server/src/controller/PaginationController.php',
            method: 'GET',
            data: { action: 'pagination', table: 'khuyenmai', page },
            dataType: 'JSON',
            success: review => resolve(review),
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}