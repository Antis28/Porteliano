/**
 * Created by dmitrij on 24.11.2016.
 */

var semaphore = false;

(function ($) {

    //$(".add-to-cart").on('click', addToCart);
    //$(".add-to-wish").on('click', addToWish);

    var jCart = $("#basket");
    var jWish = $('#wishlist');
    var tWish = $('div#other-panel > a > span:first');
    var tCart = $('div#other-panel > a > span:last');

    getQuantity('getcart', jCart);
    getQuantity('getwish', jWish);
    getQuantity('getcart', tCart);
    getQuantity('getwish', tWish);


    // $("#modal-cart .modal-body").on('click','.del-item', function () {
    //     delItem('cart',$(this).data('id'));
    //
    // })
    // $("#modal-wish .modal-body").on('click','.del-item', function () {
    //     delItem('wish', $(this).data('id'));
    //
    // })
    semaphore = false;
})(jQuery);

function getCurrentSection(novetly) {

    var section = novetly.data("section");

    if (section)
        return section;
    else
        return '2'; //перегородки
}

function getCurrentElements(novetly) {
    var currentId = {};
    var elements = novetly.children();
    for (i = 0 ; i < elements.length; i++) {
        currentId[i] = elements.eq(i).data('id');
    }
    return currentId;

}

function nextDownload(e,left, quant) {

    e.preventDefault();
    if (semaphore) return;

    semaphore = true;
    var currentButton = $(e.target);

    var novetly = currentButton.parent().siblings(".novelty-folders").find(".ribbon-ul");
    var active = currentButton.parent().siblings(".novelty-folders").find(".active > > > .ribbon-ul  ");
    novetly = (active.length > 0)? active : novetly;

    var giveMore = $(".catalog-elements");
    novetly = (giveMore.length > 0) ? giveMore : novetly;

    var section = getCurrentSection(novetly);
    var elements = getCurrentElements(novetly);

    var dataAjax = {section: section,
        elements: elements,
        quant: quant
    };

    if (giveMore.length > 0) {
        dataAjax.material = $("div .material").find(".btn-default").data('id');
        dataAjax.manufacturer = $("div .manufacturer").find(".btn-default").data('id');
        dataAjax.style = $("div .style").find(".btn-default").data('id');
        dataAjax.price = $("div .block-1-price").find(".btn-default").data('id');
        dataAjax.section = $(".section-title").data('id');
    }

    $.ajax({
        url: '/catalog/download',
        data: dataAjax,
        type: 'POST',
        success: function (res) {
            if (left)
                novetly.prepend(res);
            else
                novetly.append(res);
            semaphore = false;
        },
        error: function () {
            console.log('error downloading');
            semaphore = false;
        }
    });

}

function delItem(e, cartWish, id) {

    if (cartWish == 'cart')
        var jtag = $('#basket');
    else
        var jtag = $('#wishlist');

    $.ajax({
            url: '/cart/delelement',
            data: {
                id: id,
                cartwish: cartWish
            },
            type: 'GET',
            success: function (res) {
                //showModal('#modal-'+cartWish,res);
                getQuantity('get' + cartWish, jtag);
                $(e.target).parents(".goods-row").remove();
                getQuantity('get' + cartWish, $("#counter-goods"), '0'); //would be altered
            },
            error: function () {
                console.log('error delete');

            }
        }
    )
}

function getQuantity(action, jtag, zero) {
    $.ajax({
            url: '/cart/' + action,

            type: 'GET',
            success: function (res) {
                callbackQuantity(res, jtag, zero);
            },
            error: function () {
                console.log('error');

            }
        }
    )
}

function setGlyphiconHeart(jtag, state) {

    if (state == 0) {
        jtag.removeClass("glyphicon-heart");
        jtag.addClass("glyphicon-heart-empty");
    }
    else {
        jtag.addClass("glyphicon-heart");
        jtag.removeClass("glyphicon-heart-empty");
    }
}

function refreshCart(quantity, jtag, zero) {

    if (quantity == 0) {
        jtag.text((!!zero) ? zero : '');
        if (jtag.attr('id') == 'wishlist') {
            jtag.removeClass("glyphicon-heart");
            jtag.addClass("glyphicon-heart-empty");
        }
    }
    else {
        jtag.html('<span class="circle-number">' + quantity + '</span>');
        if (jtag.attr('id') == 'wishlist') {
            jtag.addClass("glyphicon-heart");
            jtag.removeClass("glyphicon-heart-empty");

        }
    }

}

function addToCart(e) {


    e.preventDefault();
    var jtag = $('#basket');
    var tCart = $('div#other-panel > a > span:last');

    var id = $(e.target).data('id');

    $.ajax({
            url: '/cart/add',
            data: {
                id: id
            },
            type: 'GET',
            success: function (res) {
                callbackQuantity(res, jtag);
                callbackQuantity(res, tCart);


                //getCart('cart');

            },
            error: function () {
                console.log('error');

            }
        }
    )

}

function clearCart(cartWish) {

    if (cartWish == 'cart')
        var jtag = $('#basket');
    else
        var jtag = $('#wishlist');

    $.ajax({
            url: '/cart/clear',
            data: {
                cartwish: cartWish
            },
            type: 'GET',
            success: function (res) {
                refreshCart(0, jtag);
                $("#tab-cart").html("");
            },
            error: function () {
                console.log('error clear');

            }
        }
    )
}

function addToWish(e) {

    e.preventDefault();

    var jtag = $('#wishlist');
    var tWish = $('div#other-panel > a > span:first');

    var id = $(e.target).data('id');

    $.ajax({
            url: '/cart/addwish',
            data: {
                id: id
            },
            type: 'GET',
            success: function (res) {
                callbackQuantity(res, jtag);
                callbackQuantity(res, tWish);
                setGlyphiconHeart($(e.target), 1);
                //getCart('wish');
            },
            error: function () {
                console.log('error');

            }
        }
    )

}

function getCart(cartWish) {

    $.ajax(
        {
            url: '/cart/gettab',
            data: {cartwish: cartWish},
            type: 'GET',
            success: function (res) {
                showModal('#modal-' + cartWish, res);
            },
            error: function () {
                console.log('Error tab');
            }
        }
    )

}

function isWished(id, tag) {

    $.ajax({
        url: '/cart/iswished',
        data: {
            id: id
        },
        type: 'GET',
        success: function (res) {
            setGlyphiconHeart(res);
        },
        error: function () {
            console.log('error isWished');

        }
    });
}

function callbackQuantity(res, jtag, zero) {
    if (!!jtag) {

        refreshCart(res, jtag, zero);
    }
}

function showModal(id, tab) {

    $(id + ' .modal-body').html(tab);
    $(id).modal();
}

function eventClickDropMenu(item) {
    if (item.target.tagName == 'A') {
        var idItem = $(item.target).data('id');
        var button = $(item.target).parents(".btn-group").children(".btn-default:first");

        button.text(item.target.innerHTML);
        button.attr('data-id', idItem);
    }
}


function eventClickSelectButton(item) {

    console.log('click');
    var material = $("div .material").find(".btn-default").data('id');
    var manufacturer = $("div .manufacturer").find(".btn-default").data('id');
    var style = $("div .style").find(".btn-default").data('id');
    var price = $("div .block-1-price").find(".btn-default").data('id');
    var section = $(".section-title").data('id');

console.log(price);

    $(location).attr('href',
        '/catalog/?'
        + ((!!section) ? '&section=' + section : '')
        + ((!!material) ? '&material=' + material : '')
        + ((!!manufacturer) ? '&manufacturer=' + manufacturer : '')
        + ((!!style) ? '&style=' + style : '')
        + ((!!price) ? '&price=' + price : ''));
}

// для 03_dveri-catalog
$('ul.dropdown-menu > li > a').on('click', function (event) {
    $(this)
        .parents(".btn-group")
        .children(".btn-default:first")
        .text($(this).text());
});
