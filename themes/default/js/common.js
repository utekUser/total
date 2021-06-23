$(function () {
    $('.add-more, .add-less').click(function () {
        var input = $(this).parent().find('input[name=price]');
        if ($(this).attr('class') == 'add-more') {
            var amount = parseInt(input.val()) + 1;
            var sumC = $(this).parent().find('input[name=sumCount]');
            if (amount > sumC.val()) {
                amount = sumC.val();
            }
        } else {
            if (parseInt(input.val()) > 1) {
                var amount = parseInt(input.val()) - 1;
            } else {
                var amount = 1;
            }
        }
        input.val(amount);
        var action = $(this).parent().parent().find('.item-action a').attr('class');
        if (action == 'delete-item') {
            var type = $('#catalog-type').val();
            var id = $(input).attr('id')
            changeAmount($(input), type, id);
        }
    });
    $('input[name=price]').bind("change keyup input click", function () {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
        var sumC = $("#sumCount" + $(this).attr('id')).val();          
        if (parseInt(this.value) > parseInt(sumC)) {
            this.value = sumC;
        }
    });
})
$(function () {
    $(".desired-ajax-form").submit(function (event) {
        event.preventDefault();

        var form = $(this),
                name = form.find("input[name=name]").val(),
                url = form.attr("action");

        if (name.trim().length) {
            var posting = $.post(url, {name: name}, 'json');

            posting.done(function (data) {
                if (data.status == 'ok') {
                    var desiredtable = $("#desiredtable");
                    desiredtable.find("table").remove();

                    if (Object.keys(data.data).length) {
                        desiredtable.append('<table style="width: 100%"></table>');
                        var table = $('#desiredtable').children();

                        table.append('<thead><tr><td style="font-weight: 700">Наименование желаемого товара для заказа</td><td></td></tr></thead>');

                        $.each(data.data, function (i, item) {
                            table.append('<tr><td>' + data.data[i].name + '</td><td style="width: 50px; text-align: right"><a id="desired' + data.data[i].id + '" style="margin: 25px 0px 0 0;" href="/delete/">Удалить</a></td></tr>');
                        });

                        if (($(".order-history tbody tr").length - 1) || $("#desiredtable table tbody tr").length) {
                            $(".appr-order-next").removeClass("appr-order_show");
                        }
                    }

                    form.find("input[name=name]").val("")
                }
            });
        } else {
            alert('Введите наименование товара');
        }
    });

    $("a[id^='desired']").live("click", function () {
        var desiredid = $(this).attr('id').replace("desired", ""),
                a = $(this);

        var posting = $.ajax({
            url: '/catalog/desired/' + desiredid,
            type: 'DELETE',
            date: {id: desiredid},
            success: function (result) {
                if (result.status == 'ok') {
                    a.closest('tr').remove();
                    if (!$("#desiredtable table tbody tr").length) {
                        $("#desiredtable table").remove();
                    }
                    if (!(($(".order-history tbody tr").not(".info").length - 1) || $("#desiredtable table tbody tr").length)) {
                        $(".appr-order-next").addClass("appr-order_show");
                    }
                }
            }
        });

        return false;
    });
});

function regCart() {
    alert('Для совершения покупки нужно зарегистрироваться!');
}

function addToBasket(item, type, id) {
    amount = $(item).parent().parent().find("input:text[name=price]").val();

    $.post(
            "/basket/item/",
            {
                id: id,
                type: type,
                amount: amount
            },
            function (data) {
                loadBasket();
                alert('Товар добавлен в корзину!');
            }
    );
}


function loadBasket() {
    var url = "/basket/basket/";
    $('#basket').load(url);
    $('#basket-link').load(url);
}


/**
 Изменение количества товаров в корзине
 **/
function changeAmount(item, type, id) {
    amount = $(item).val();
    $.post(
            "/basket/change/",
            {
                id: id,
                type: type,
                amount: amount
            },
            function (data) {
                loadBasket();
            }
    );
}


/**
 Добавление товара в корзину (из каталога)
 
 **/
function addItem(item, type, id) {
    amount = $(item).parent().parent().find("input:text[name=price]").val();

    $.post(
            "/basket/item/",
            {
                id: id,
                type: type,
                amount: amount
            },
            function (data) {
                loadBasket();
                var new_a = '<a onclick="deleteItem(this, \'' + type + '\', ' + id + ');" href="javascript:{};" class="delete-item">Удалить</a>';
                var new_input = '<input type="checkbox" class="rem-input" checked="checked" onclick="deleteItem(this, \'' + type + '\', ' + id + ');">';
                var parent = $(item).parent().parent();
                parent.find('.item-action').append(new_a).find('.add-to-bask').remove();
                parent.find('.item-check').append(new_input).find('.add-input').remove();
                var new_attr = 'changeAmount(this, \'' + type + '\', ' + id + ');';
                parent.find('.item-amount').find('input').attr('onchange', new_attr);
            }
    );
}




/**
 Удаление товара из корзины (из корзины)
 **/
function deleteToBasket(item, type, id) {
    $(item).parent().parent("tr").remove();
    $.post(
            "/basket/delete/",
            {
                id: id,
                type: type
            },
            function (data) {
                if (data.result) {
                    loadBasket();
                    var sum = data.total_sum + ' руб.';
                    $('.total-sum span').empty().append(sum);
                }
            },
            "json"
            );
}

/**
 Удаление товара из корзины (из каталога)
 **/
function deleteItem(item, type, id) {
    $.post(
            "/basket/delete/",
            {
                id: id,
                type: type
            },
            function (data) {
                if (data.result) {
                    loadBasket();
                    var new_a = '<a onclick="addItem(this, \'' + type + '\', ' + id + ');" href="javascript:{};" class="add-to-bask">В корзину</a>';
                    var new_input = '<input type="checkbox" class="add-input" onclick="addItem(this, \'' + type + '\', ' + id + ');">';
                    var parent = $(item).parent().parent();
                    parent.find('.item-action').append(new_a).find('.delete-item').remove();
                    parent.find('.item-check').append(new_input).find('.rem-input').remove();
                    parent.find('.item-amount').find('input').val(1);
                    parent.find('.item-amount').find('input').removeAttr('onchange');
                }
            },
            "json"
            );
}


$(function ($) {
    // Прокрутка наверх
    var topLink = $('#top-link');
    topLink.css({'padding-bottom': $(window).height()});
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 1) {
            topLink.fadeIn(300);
        } else {
            topLink.fadeOut(300);
        }
    });
    topLink.click(function (e) {
        $("body,html").animate({scrollTop: 0}, 500);
        return false;
    });
});