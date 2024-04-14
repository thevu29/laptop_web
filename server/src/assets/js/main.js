// hide element when click outside
$(document).on('click', function (e) {
    if (e.target && !e.target.classList.contains('sort-dropdown-button') && e.target.closest('div') && !e.target.closest('div').classList.contains('sort-dropdown-button')) {
        $('.search-product-main .sort-dropdown-button').removeClass('show') 
    }
    $('.search-suggest-container').hide()
    const overSuggest = $('.over-suggest')
    overSuggest.css('opacity', '0')
    overSuggest.css('visibility', 'hidden')
})

// show hide password
const showhidePassword = document.querySelector('.showhide-pwd-icon')
const passwordElement = document.querySelector('.login-password')

if (showhidePassword) {
    showhidePassword.addEventListener('click', e => {
        const passwordIcon = document.querySelector('.showhide-pwd-icon .fa-eye')
        const hidePasswordIcon = document.querySelector('.showhide-pwd-icon .fa-eye-slash')

        if (passwordElement.type === 'password') {
            passwordElement.type = 'text'
            passwordIcon.classList.remove('open')
            hidePasswordIcon.classList.add('open')
        } else {
            passwordElement.type = 'password'
            passwordIcon.classList.add('open')
            hidePasswordIcon.classList.remove('open')
        }

        passwordElement.focus()
    })
}

// show filter product
$(document).on('click', '.show-sort-filter', e => {
    document.querySelector('.sort-filter-menu').classList.toggle('active')
})

// add quantity
$('input.input-qty').each(function () {
    var $this = $(this),
        qty = $this.parent().find(".is-form"),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'));

    if (min == 0) {
        var d = 0;
    }
    else {
        var d = min;
    }
    $(qty).on('click', function () {
        if ($(this).hasClass('minus')) {
            if (d > min) d += -1;
        } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1;
            if (x <= max) d += 1;
        }
        $this.attr('value', d).val(d);
    });
});

// verify otp when sign up
$(document).on('input', '.verify-otp-input', e => {
    $('.verify-otp-input').attr('value', $('.verify-otp-input').val())
    if ($('.verify-otp-input').val().length >= 6) {
        $('.verify-otp-input').addClass('full')
        $('.btn-to-create-pwd').removeClass('disabled')
        $('.btn-to-create-pwd').removeAttr('disabled')
    } else {
        $('.verify-otp-input').removeClass('full')
        $('.btn-to-create-pwd').addClass('disabled')
        $('.btn-to-create-pwd').attr('disabled', true)
    }
})

// count down to confirm otp
function countDownConfirmOtp() {
    let time = 60;
    const countdown = setInterval(() => {
        $('.verify-otp-confirm').html(`Vui lòng xác nhận mã trong ${time} giây`)
        time--
        if (time < 0) {
            clearInterval(countdown)
            $('.verify-otp-resend-title')
                .html(`
                    <span>Bạn vẫn chưa nhận được?</span>
                    <button type="button" class="btn-resend-otp">Gửi lại mã</button>
                `)
            $('.verify-otp-confirm').css('display', 'none')
        }
    }, 1000)
}

// show signup password
$(document).on('change', '#signup-show-pwd', e => {
    if ($('#signup-show-pwd').prop('checked')) {
        $('.create-password-form .signup-password').attr('type', 'text')
    } else {
        $('.create-password-form .signup-password').attr('type', 'password')
    }
})

// count down back homepage when signup success
function countDownBackHomePage() {
    let time = 5;
    const countdown = setInterval(() => {
        $('.signup-success-homepage').html(`Bạn sẽ trở về trang chủ trong ${time} giây`)
        time--
        if (time < 0) {
            clearInterval(countdown)
            window.location.href = 'index.php'
        }
    }, 1000)
}

// configre NProgress
NProgress.configure({
    showSpinner: false,
    trickleSpeed: 50,
})

// open modal
$('.openmodal').click((e) => {
    e.preventDefault();
    $('.modal-cart').addClass('open');
});

$('.closemodal').click((e) => {
    e.preventDefault();
    $('.modal-cart').removeClass('open');
});

$('.modal-cart').click((e) => {
    e.preventDefault();
    $('.modal-cart').removeClass('open');
});

$(".modal-cart-dialog").click((e) => {
    e.stopPropagation();
});

// show search dropdown
$(document).on('click', '.search-product-main .sort-dropdown-button', function (e) {
    $('.search-product-main .sort-dropdown-button').not($(this)).removeClass('show')
    $(this).toggleClass('show')
    e.stopPropagation()
})