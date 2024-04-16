$(document).ready(() => {
    renderReviewAdmin(null)
    clickPage(renderReviewAdmin)

    handleAddReview()

    renderListReview('CTSP0008')
})

function renderListReview(ctspId) {
    $.ajax({
        url: 'server/src/controller/DanhGiaController.php',
        method: 'POST',
        data: { action: 'get-all' , ctspId},
        dataType: 'JSON',
        success: data => {
            if (data && data.length > 0) {
                let html = ''
                console.log(data)

                data.forEach((item, index) => {
                    html += `
                        <div class="d-flex flex-start mb-4">
                            <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(32).webp" alt="avatar" width="65" height="65" />
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="">
                                        <h5 class="m-0">Johny Cash</h5>
                                        <p class="small">${convertDate(item.thoi_gian_danh_gia)}</p>
                                        <p class="m-0">
                                            ${item.noi_dung}
                                        </p>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <ul class="rating d-flex">
                                                <li class="rate">
                                                    <i class="far fa-star star ${item.rating > 0 ? 'fas rate-active' : '' }"></i>
                                                </li>
                                                <li class="rate">
                                                    <i class="far fa-star star ${item.rating - 1 > 0 ? 'fas rate-active' : '' }"></i>
                                                </li>
                                                <li class="rate">
                                                    <i class="far fa-star star ${item.rating - 2 > 0 ? 'fas rate-active' : '' }"></i>
                                                </li>
                                                <li class="rate">
                                                    <i class="far fa-star star ${item.rating - 3 > 0 ? 'fas rate-active' : '' }"></i>
                                                </li>
                                                <li class="rate">
                                                    <i class="far fa-star star ${item.rating - 4 > 0 ? 'fas rate-active' : '' }"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                })

                $('.list-review').html(html)
            }
        },
        error: (xhr, status, error) => {
            console.log(error)
        }
    })
}

async function renderReviewAdmin(data) {
    let productDetailId = $('#admin-review-main #product-detail-id').val()

    if (productDetailId) {
        // productDetailId = productDetailId.toUpperCase().trim()
        // renderProductName(productDetailId)

        const dataReview = data ? data : await getPaginationReview(productDetailId)

        if (dataReview && dataReview.pagination && dataReview.pagination.length > 0) {
            let html = ''

            dataReview.pagination.forEach((review, index) => {
                if(review.ma_ctsp === productDetailId) {
                    html += `
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox-${review.ma_kh}" name="chk[]" value="${review.ma_kh}">
                                    <label for="checkbox-${review.ma_kh}"></label>
                                </span>
                            </td>
                            <td>${review.ma_kh}</td>
                            <td>${review.rating}</td>
                            <td>${review.thoi_gian_danh_gia}</td>
                            <td>${review.noi_dung}</td>
                            <td>
                                <a href="#deleteReviewModal" class="delete btn-delete-product-detail-modal" data-toggle="modal" data-id=${review.ma_kh}>
                                    <i class="material-icons" data-toggle="tooltip" title="Xóa">&#xE872;</i>
                                </a>
                            </td>
                        </tr>
                    `
                }
            })

            $('.admin-review-list').html(html)
            totalPage(dataReview.count)
        } else {
            $('.admin-review-list').html('')
        }
    } else {
        $('.admin-review-list').html('')
    }
}

function getPaginationReview(productDetailId) {
    return new Promise((resolve, reject) => {
        const page = $('#currentpage').val()
        $.ajax({
            url: 'server/src/controller/PaginationController.php',
            method: 'GET',
            data: { action: 'pagination', table: 'danhgia', page, id: productDetailId },
            dataType: 'JSON',
            success: review => resolve(review),
            error: (xhr, status, error) => {
                console.log(error)
                reject(error)
            }
        })
    })
}

function validateReviewEmpty(review) {
    if(review.productDetailId === '' || review.productDetailId == undefined) {
        alert('Lỗi không tìm thấy id sản phẩm')
        return false;
    }
    if(review.customerId === '' || review.customerId == undefined) {
        alert('Vui lòng đăng nhập để có thể đánh giá')
        // *** Quay lại trang đăng nhập
        return false;
    }
    if(review.rating === '' || review.rating == undefined) {
        alert('Hãy đánh giá số sao cho sản phẩm này')
        return false;
    }
    if(review.content === '' || review.content == undefined) {
        alert('Vui lòng điền nội dung đánh giá')
        return false;
    }
    return true
}

function addReview(review) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: 'server/src/controller/DanhGiaController.php',
            method: 'POST',
            data: { action: 'add', review },
            success: data => {
                if (data && data.length > 0) {
                    resolve(true)
                }
                else {
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

function handleAddReview() {
    $(document).on('click', '#btn-add-review', (e) => {
        var currentDate = new Date();
        var formattedDate = currentDate.toISOString().slice(0, 10);

        ctspId = $('.btn-add-cart').attr('data-id');

        const dataReview = {
            productDetailId: ctspId,
            customerId: 'KH002',
            rating: $('#review-index .rating input[type="radio"].rate-active').val(),
            time: formattedDate,
            content: $('#review-index #content-review').val(),
        }

        if (!validateReviewEmpty(dataReview)) {
            return
        }

        console.log(dataReview.productDetailId)
        console.log(dataReview.customerId)
        console.log(dataReview.rating)
        console.log(dataReview.time)
        console.log(dataReview.content)

        addReview(dataReview)
            .then(data => {
                if (data) {
                    alert('Đánh giá thành công')
                } else {
                    alert('Xảy ra lỗi trong quá trình đánh giá')
                }
            })
            .catch(error => console.log(error))
    })
}