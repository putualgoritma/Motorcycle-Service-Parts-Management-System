function product_order_sale() {
    var e = !1,
        t = "",
        r = $("#product_orderdetails_price").val(),
        a = parseFloat($("#product_orderdetails_sprice_hidden").val()),
        d = parseFloat($("#product_orderdetails_bprice_hidden").val());
    r = parseFloat(r.replace(/,/g, ""));
    var i = $("#kpb_product_yesno_hidden").val();
    if (
        (r < d && 0 == i ? ((t = "Harga jual lebih kecil dari harga beli. Lanjutkan proses?"), (e = !0), (update_master = 0)) : r != a && 0 == i && ((t = "Harga jual berubah, Update Harga di Master Data?"), (e = !0), (update_master = 1)),
        e)
    )
        if (confirm(t)) gen_product_order_sale_list(update_master);
        else {
            if (1 != update_master) return !1;
            gen_product_order_sale_list();
        }
    else gen_product_order_sale_list();
}
function gen_product_order_sale_list(e) {
    void 0 === e && (e = 0);
    var t = $("#product_scode").val(),
        r = $("#product_orderdetails_price").val(),
        z = $("#product_orderdetails_het_price").val(),
        a = $("#product_orderdetails_bprice_hidden").val(),
        d = $("#product_orderdetails_quantity").val(),
        i = $("#product_orderdetails_subtotal").val(),
        s = r.replace(/,/g, ""),
        o = d.replace(/,/g, ""),
        c = i.replace(/,/g, ""),
        _ = $("#product_orderdetails_discount").val(),
        l = $("#product_orderdetails_discount_val").val(),
        n = $("#product_orderdetails_tax").val(),
        v = _.replace(/,/g, ""),
        u = l.replace(/,/g, ""),
        p = n.replace(/,/g, ""),
        h = $("#product_shtquantity_hidden").val(),
        m = $("#product_spoquantity_hidden").val(),
        y = $("#product_quantity_hidden").val(),
        f = $("#product_bpoquantity_hidden").val(),
        b = "<tr>";
    (b += '<td class="listnum_product_order_sale">#</td>'),
        (b +=
            '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">' +
            t +
            '</div><input name="product_scode_hidden[]" type="hidden" value="' +
            t +
            '"/><input name="kpb_product_yesno_hidden[]" type="hidden" value="' +
            $("#kpb_product_yesno_hidden").val() +
            '"/></a></td>'),
        (b +=
            '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_het_price">' +
            z +
            '</div></a></td>'),
        (b +=
            '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price">' +
            r +
            '</div><input name="product_orderdetails_price_hidden[]" type="hidden" value="' +
            s +
            '"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="' +
            a +
            '"/></a></td>'),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity">' + d + '</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="' + o + '"/></a></td>'),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount">' + _ + '</div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="' + v + '"/></a></td>'),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val">' + l + '</div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="' + u + '"/></a></td>'),
        (b += '<td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax">' + n + '</div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="' + p + '"/></a></td>'),
        (b +=
            '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal">' +
            i +
            '</div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="' +
            c +
            '"/></a></td>'),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_shtquantity">' + h + "</div></a></td>"),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_spoquantity">' + m + "</div></a></td>"),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_quantity">' + y + "</div></a></td>"),
        (b += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_bpoquantity">' + f + "</div></a></td>"),
        (b += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
        (b += "</tr>"),
        $(".dyn_product_order_sale").append($(b)),
        $(".dyn_product_order_sale").append($()),
        calc_service_order_sale(),
        $(".typehead_product #product_scode").typeahead("val", ""),
        $("#product_orderdetails_price").val(""),
        $("#product_orderdetails_het_price").val(""),
        $("#product_orderdetails_bprice_hidden").val(""),
        $("#product_orderdetails_quantity").val(""),
        $("#product_orderdetails_subtotal").val(""),
        $("#product_orderdetails_discount").val(""),
        $("#product_orderdetails_discount_val").val(""),
        $("#product_orderdetails_tax").val(""),
        $("span.product_shtquantity").html(""),
        $("span.product_spoquantity").html(""),
        $("span.product_quantity").html(""),
        $("span.product_bpoquantity").html(""),
        $("#product_scode").focus();
    var g = t.split(" - ")[0];
    1 == e && $.ajax({ type: "POST", url: "../inventory/ajax/product-master-edit.php?product_code=" + g + "&product_orderdetails_price=" + s, success: function (e) {} });
}
function product_order_sale_cal() {
    $(this)
        .closest("table")
        .find("tr")
        .each(function () {
            var e = $(this),
                t = $("#product_orderdetails_price", e).val() * $("#product_orderdetails_quantity", e).val();
            t, $("#product_orderdetails_subtotal", e).val("$" + t.toFixed(2));
        });
}
function remove_product_order_sale(e) {
    1 == $(e).closest("tr").find("input[name='kpb_product_yesno_hidden[]']").val() ? alert("Tidak Bisa Dihapus, Part Terkait KPB 1") : ($(e).closest("tr").remove(), $("#product_scode").focus(), calc_service_order_sale());
}
function pscode_onchange(_) {
    $("#service_order_id").val();
    return (
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../inventory/ajax/product-getcode.php?scode=" + _,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.product_id) alert("Kode Salah"), $("#myloading").fadeOut(500), $(".typehead_product #product_scode").typeahead("val", ""), $("#product_scode").focus();
                else {
                    var t = e.product_name,
                        r = e.product_sprice,
                        z = e.product_het_price,
                        a = e.product_bprice,
                        d = e.product_stock_ht,
                        i = e.product_stock_so,
                        s = e.product_stock,
                        o = e.product_stock_po,
                        c = e.product_code + " - " + t;
                    if (product_on_list_exist(_)) alert("Maaf Item Sudah Masuk List"), $("#myloading").fadeOut(500), $(".typehead_product #product_scode").typeahead("val", ""), $("#product_scode").focus();
                    else if (s - i < 1 && 1 == e.company_stock_block) alert("Maaf Stok Tidak Mencukupi"), $("#myloading").fadeOut(500), $(".typehead_product #product_scode").typeahead("val", ""), $("#product_scode").focus();
                    else
                        $(".typehead_product #product_scode").typeahead("val", c),
                            $("#product_orderdetails_price").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 })),
                            $("#product_orderdetails_het_price").val(z.toLocaleString("en-US", { minimumFractionDigits: 2 })),
                            $("#product_orderdetails_sprice_hidden").val(r),
                            $("#product_orderdetails_bprice_hidden").val(a),
                            $("#product_shtquantity_hidden").val(d),
                            $("span.product_shtquantity").html(d),
                            $("#product_spoquantity_hidden").val(i),
                            $("span.product_spoquantity").html(i),
                            $("#product_quantity_hidden").val(s),
                            $("span.product_quantity").html(s),
                            $("#product_bpoquantity_hidden").val(o),
                            $("span.product_bpoquantity").html(o),
                            $("#product_orderdetails_quantity").val(1),
                            $("#product_orderdetails_discount").val(0),
                            $("#product_orderdetails_discount_val").val(0),
                            $("#kpb_product_yesno_hidden").val(0),
                            $("#product_orderdetails_subtotal").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 })),
                            $("#product_orderdetails_quantity").focus(),
                            (jQuery.Event("keydown").which = 13);
                }
                $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function gen_product_order_sale_editlist(e) {
    void 0 === e && (e = 0);
    var t = $("#myModal"),
        r = $("#product_scode", t).val(),
        a = $("#product_orderdetails_price", t).val(),
        z = $("#product_orderdetails_het_price", t).val(),
        d = ($("#product_orderdetails_sprice_hidden", t).val(), $("#product_orderdetails_bprice_hidden", t).val()),
        i = $("#product_orderdetails_quantity", t).val(),
        s = $("#product_orderdetails_discount", t).val(),
        o = $("#product_orderdetails_discount_val", t).val(),
        c = $("#product_orderdetails_tax", t).val(),
        _ = s.replace(/,/g, ""),
        l = o.replace(/,/g, ""),
        n = c.replace(/,/g, ""),
        v = a.replace(/,/g, ""),
        u = i.replace(/,/g, ""),
        p = (v - _) * u,
        h = p.toLocaleString("en-US", { minimumFractionDigits: 2 }),
        m = $("#inner_id_hidden", t).val(),
        y = $("#product_shtquantity_hidden", t).val(),
        f = $("#product_spoquantity_hidden", t).val(),
        b = $("#product_quantity_hidden", t).val(),
        g = $("#product_bpoquantity_hidden", t).val(),
        k = 0;
    0 < $("#service_order_id", t).val() && (k = $("#product_orderdetails_quantityold_hidden", t).val());
    var S = $("#kpb_product_yesno_hidden", t).val();
    if (b - f - (i - k) < 0 && 1 == company_stock_block) alert("Maaf Stok Tidak Mencukupi"), $(".ajax_loader", t).hide(), $("#myModal").modal("hide");
    else {
        $("#" + m);
        var x = '<td class="listnum_product_order_sale">#</td>';
        (x +=
            '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_scode">' +
            r +
            '</div><input name="product_scode_hidden[]" type="hidden" value="' +
            r +
            '"/><input name="kpb_product_yesno_hidden[]" type="hidden" value="' +
            S +
            '"/></a></td>'),
            (x +=
                '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_price">' +
                a +
                '</div><input name="product_orderdetails_price_hidden[]" type="hidden" value="' +
                v +
                '"/><input name="product_orderdetails_bprice_hidden[]" type="hidden" value="' +
                d +
                '"/></a></td>'),
            (x +=
                '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_het_price">' +
                z +
                '</div></a></td>'),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_quantity">' + i + '</div><input name="product_orderdetails_quantity_hidden[]" type="hidden" value="' + u + '"/></a></td>'),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount">' + s + '</div><input name="product_orderdetails_discount_hidden[]" type="hidden" value="' + _ + '"/></a></td>'),
            (x +=
                '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_discount_val">' + o + '</div><input name="product_orderdetails_discount_val_hidden[]" type="hidden" value="' + l + '"/></a></td>'),
            (x += '<td class="td_hide"><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_tax">' + c + '</div><input name="product_orderdetails_tax_hidden[]" type="hidden" value="' + n + '"/></a></td>'),
            (x +=
                '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_orderdetails_subtotal">' +
                h +
                '</div><input class="subtotal_hidden" name="product_orderdetails_subtotal_hidden[]" type="hidden" value="' +
                p +
                '"/></a></td>'),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_shtquantity">' + y + "</div></a></td>"),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_spoquantity">' + f + "</div></a></td>"),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_quantity">' + b + "</div></a></td>"),
            (x += '<td><a href="#" class="link_table product_order_sale_edit"><div class="product_bpoquantity">' + g + "</div></a></td>"),
            (x += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_product_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
            $("#" + m)
                .first()
                .html($(x)),
            $(".ajax_loader", t).hide(),
            calc_service_order_sale(),
            $("#myModal").modal("hide");
        var q = r.split(" - ")[0];
        1 == e && $.ajax({ type: "POST", url: "../inventory/ajax/product-master-edit.php?product_code=" + q + "&product_orderdetails_price=" + v, success: function (e) {} });
    }
}
function service_order_sale() {
    var e = $("#service_scode").val(),
        t = $("#service_orderdetails_price").val(),
        r = $("#service_orderdetails_bprice_hidden").val(),
        a = $("#service_orderdetails_quantity").val(),
        d = $("#service_orderdetails_subtotal").val(),
        i = t.replace(/,/g, ""),
        s = a.replace(/,/g, ""),
        o = d.replace(/,/g, ""),
        c = $("#service_orderdetails_discount").val(),
        _ = $("#service_orderdetails_discount_val").val(),
        l = $("#service_orderdetails_tax").val(),
        n = c.replace(/,/g, ""),
        v = _.replace(/,/g, ""),
        u = l.replace(/,/g, ""),
        p = $("#service_shtquantity_hidden").val(),
        h = $("#service_spoquantity_hidden").val(),
        m = $("#service_quantity_hidden").val(),
        y = $("#service_bpoquantity_hidden").val(),
        f = "<tr>";
    (f += '<td class="listnum_service_order_sale">#</td>'),
        (f +=
            '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_scode">' +
            e +
            '</div><input name="service_scode_hidden[]" type="hidden" value="' +
            e +
            '"/><input name="kpb_service_yesno_hidden[]" type="hidden" value="' +
            $("#kpb_service_yesno_hidden").val() +
            '"/></a></td>'),
        (f +=
            '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_price">' +
            t +
            '</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="' +
            i +
            '"/><input name="service_orderdetails_bprice_hidden[]" type="hidden" value="' +
            r +
            '"/></a></td>'),
        (f += '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_quantity">' + a + '</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="' + s + '"/></a></td>'),
        (f += '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount">' + c + '</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="' + n + '"/></a></td>'),
        (f += '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount_val">' + _ + '</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="' + v + '"/></a></td>'),
        (f += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_tax">' + l + '</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="' + u + '"/></a></td>'),
        (f +=
            '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_subtotal">' +
            d +
            '</div><input class="service_subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="' +
            o +
            '"/></a></td>'),
        (f += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_shtquantity">' + p + "</div></a></td>"),
        (f += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_spoquantity">' + h + "</div></a></td>"),
        (f += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_quantity">' + m + "</div></a></td>"),
        (f += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_bpoquantity">' + y + "</div></a></td>"),
        (f += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
        (f += "</tr>"),
        $(".dyn_service_order_sale").append($(f)),
        $(".dyn_service_order_sale").append($()),
        calc_service_order_sale(),
        $(".typehead_service #service_scode").typeahead("val", ""),
        $("#service_orderdetails_price").val(""),
        $("#service_orderdetails_bprice_hidden").val(""),
        $("#service_orderdetails_quantity").val(""),
        $("#service_orderdetails_subtotal").val(""),
        $("#service_orderdetails_discount").val(""),
        $("#service_orderdetails_discount_val").val(""),
        $("#service_orderdetails_tax").val(""),
        $("span.service_shtquantity").html(""),
        $("span.service_spoquantity").html(""),
        $("span.service_quantity").html(""),
        $("span.service_bpoquantity").html(""),
        $("#service_scode").focus();
}
function service_order_sale_cal() {
    $(this)
        .closest("table")
        .find("tr")
        .each(function () {
            var e = $(this),
                t = $("#service_orderdetails_price", e).val() * $("#service_orderdetails_quantity", e).val();
            t, $("#service_orderdetails_subtotal", e).val("$" + t.toFixed(2));
        });
}
function remove_service_order_sale(e) {
    1 == $(e).closest("tr").find("input[name='kpb_service_yesno_hidden[]']").val() &&
        $(".subtotal_hidden").each(function (e, t) {
            1 == $(this).closest("tr").find("input[name='kpb_product_yesno_hidden[]']").val() && $(this).closest("tr").remove();
        }),
        $(e).closest("tr").remove(),
        $("#service_scode").focus(),
        calc_service_order_sale();
}
function service_scode_onchange(_) {
    $("#service_order_id").val();
    return (
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../inventory/ajax/service-getcode.php?scode=" + _,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.service_id) alert("Kode Salah"), $("#myloading").fadeOut(500), $(".typehead_service #service_scode").typeahead("val", "");
                else {
                    e.service_name;
                    var t = e.service_sprice,
                        r = e.service_bprice,
                        a = e.category_code;
                    if (service_on_list_exist(_)) alert("Maaf Item Sudah Masuk List"), $("#myloading").fadeOut(500), $(".typehead_service #service_scode").typeahead("val", ""), $("#service_scode").focus();
                    else {
                        if (
                            ($("#service_orderdetails_price").val(t.toLocaleString("en-US", { minimumFractionDigits: 2 })),
                            $("#service_orderdetails_bprice_hidden").val(r),
                            $("#service_shtquantity_hidden").val(0),
                            $("span.service_shtquantity").html(0),
                            $("#service_spoquantity_hidden").val(0),
                            $("span.service_spoquantity").html(0),
                            $("#service_quantity_hidden").val(0),
                            $("span.service_quantity").html(0),
                            $("#service_bpoquantity_hidden").val(0),
                            $("span.service_bpoquantity").html(0),
                            $("#service_orderdetails_quantity").val(1),
                            $("#service_orderdetails_discount").val(0),
                            $("#service_orderdetails_discount_val").val(0),
                            $("#kpb_service_yesno_hidden").val(0),
                            "ASS1" === a || "ASS2" === a || "ASS3" === a || "ASS4" === a)
                        ) {
                            $("#kpb_service_yesno_hidden").val(1);
                            var d = $("#motorcycle_code").val();
                            if (null == d || "" === d) alert("No. Polisi Kososng"), $("#motorcycle_code").focus(), $("#myloading").fadeOut(500), $(".typehead_service #service_scode").typeahead("val", "");
                            else {
                                var i = $("#myModalkpb"),
                                    s = a.replace("ASS", "");
                                $("#kpb_online_num", i).val(s);
                                var o = d.split(" - ")[0];
                                $.ajax({
                                    type: "POST",
                                    url: "../inventory/ajax/motorcycle-isexist.php?motorcycle_code_val=" + o,
                                    cache: !1,
                                    async: !0,
                                    dataType: "json",
                                    error: function (e) {
                                        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
                                    },
                                    success: function (e) {
                                        if (
                                            "" != $.trim($("#motorcycle_type_code").val()) &&
                                            "" != $.trim($("#motorcycle_machine_no").val()) &&
                                            "" != $.trim($("#motorcycle_buy_register").val()) &&
                                            "" != $.trim($("#motorcycle_book_service_no").val())
                                        ) {
                                            var t = $("#motorcycle_type_code").val();
                                            $("#motorcycle_code").val();
                                            return (
                                                $.ajax({
                                                    type: "POST",
                                                    url: "../inventory/motorcycle-kpb-get.php?motorcycle_type_code=" + t + "&kpb_online_num=" + s,
                                                    cache: !1,
                                                    async: !0,
                                                    dataType: "json",
                                                    error: function (e) {
                                                        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
                                                    },
                                                    success: function (e) {
                                                        if (0 == e.motorcycle_type_code)
                                                            $(".typehead_service #service_scode").typeahead("val", ""),
                                                                $("#service_orderdetails_price").val(""),
                                                                $("#service_orderdetails_quantity").val(""),
                                                                $("#service_orderdetails_discount").val(""),
                                                                $("#service_orderdetails_discount_val").val(""),
                                                                alert("Data Type Kendaraan Salah."),
                                                                $("#motorcycle_type_code").focus();
                                                        else {
                                                            var t = e.product_code,
                                                                r = e.motorcycle_type_oil_service_bprice,
                                                                a = e.motorcycle_model_oil_service_sprice,
                                                                d = e.motorcycle_type_kpb_service_sprice;
                                                            if (1 == s) {
                                                                $("#product_scode").val(t),
                                                                    $("#product_orderdetails_price").val(a),
                                                                    $("#product_orderdetails_bprice_hidden").val(r),
                                                                    $("#product_orderdetails_quantity").val(1),
                                                                    $("#product_orderdetails_discount").val(0),
                                                                    $("#product_orderdetails_discount_val").val(0),
                                                                    $("#kpb_product_yesno_hidden").val(1);
                                                                var i = jQuery.Event("keydown");
                                                                (i.which = 13), $("input#product_orderdetails_discount_val").trigger(i);
                                                            }
                                                            $("#service_orderdetails_price").val(d), service_order_sale();
                                                        }
                                                        $("#myloading").fadeOut(500);
                                                    },
                                                }),
                                                !1
                                            );
                                        }
                                        $(".typehead_service #service_scode").typeahead("val", ""),
                                            $("#service_orderdetails_price").val(""),
                                            $("#service_orderdetails_quantity").val(""),
                                            $("#service_orderdetails_discount").val(""),
                                            $("#service_orderdetails_discount_val").val(""),
                                            alert("Data KPB belum lengkap."),
                                            $("#motorcycle_type_code").focus(),
                                            $("#myloading").fadeOut(500);
                                    },
                                });
                            }
                        } else {
                            var c = jQuery.Event("keydown");
                            (c.which = 13), $("input#service_orderdetails_discount_val").trigger(c);
                        }
                        $("#myloading").fadeOut(500);
                    }
                }
            },
        }),
        !1
    );
}
function motorcycle_buy_register_onchange(e) {
    var t = $("#date_register").val();
    return (
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../inventory/kpb-daterange-get.php?date_service=" + t + "&motorcycle_buy_register=" + e,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                $("span#motorcycle_numdays").html(e), $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function calc_service_order_sale(e) {
    null == e && (e = 0);
    var u = 0,
        p = 0,
        h = 0,
        m = 0,
        y = 0,
        f = 0,
        b = 0,
        g = 0,
        k = 0,
        S = 0,
        x = 0,
        q = 0,
        w = 0;
    $(".service_subtotal_hidden").each(function (e, t) {
        var r = e + 1;
        $(this)
            .closest("tr")
            .find("td.listnum_service_order_sale")
            .html(r + "."),
            $(this)
                .closest("tr")
                .attr("id", "service_inner" + r);
        var a = $("#service_order_discount").val(),
            d = $(this).closest("tr").find("input[name='service_orderdetails_tax_hidden[]']").val(),
            i = $(this).closest("tr").find("input[name='service_orderdetails_price_hidden[]']").val(),
            s = $(this).closest("tr").find("input[name='service_orderdetails_quantity_hidden[]']").val(),
            o = $(this).closest("tr").find("input[name='service_orderdetails_discount_val_hidden[]']").val(),
            c = $(this).closest("tr").find("input[name='service_orderdetails_bprice_hidden[]']").val() * s,
            _ = (i - o) * s,
            l = _ - _ * (a / 100),
            n = l.toLocaleString("en-US", { minimumFractionDigits: 2 }),
            v = l - c;
        1 == $(this).closest("tr").find("input[name='kpb_service_yesno_hidden[]']").val() && ((b += l), (k += _ * (a / 100)), (S += l * (d / 100)), (w += l)),
            $(this).closest("tr").find("div.service_orderdetails_subtotal").html(n),
            $(this).closest("tr").find("input[name='service_orderdetails_subtotal_hidden[]']").val(l),
            (h += _ * (a / 100)),
            (p += l * (d / 100)),
            (u += l),
            v,
            (m += c),
            (f += l);
    }),
        $(".subtotal_hidden").each(function (e, t) {
            var r = e + 1;
            $(this)
                .closest("tr")
                .find("td.listnum_product_order_sale")
                .html(r + "."),
                $(this)
                    .closest("tr")
                    .attr("id", "product_inner" + r);
            var a = $("#service_order_discount").val(),
                d = $(this).closest("tr").find("input[name='product_orderdetails_tax_hidden[]']").val(),
                i = $(this).closest("tr").find("input[name='product_orderdetails_price_hidden[]']").val(),
                s = $(this).closest("tr").find("input[name='product_orderdetails_quantity_hidden[]']").val(),
                o = $(this).closest("tr").find("input[name='product_orderdetails_discount_val_hidden[]']").val(),
                c = $(this).closest("tr").find("input[name='product_orderdetails_bprice_hidden[]']").val() * s,
                _ = (i - o) * s,
                l = _ - _ * (a / 100),
                n = l.toLocaleString("en-US", { minimumFractionDigits: 2 }),
                v = l - c;
            1 == $(this).closest("tr").find("input[name='kpb_product_yesno_hidden[]']").val() && ((g += l), (k += _ * (a / 100)), (S += l * (d / 100)), (x += v), (q += c)),
                $(this).closest("tr").find("div.product_orderdetails_subtotal").html(n),
                $(this).closest("tr").find("input[name='product_orderdetails_subtotal_hidden[]']").val(l),
                (h += _ * (a / 100)),
                (p += l * (d / 100)),
                (u += l),
                v,
                (m += c),
                (y += v);
        }),
        (u -= g + b);
    var t = $("#service_order_cost").val();
    (t = t.replace(/,/g, "")), (t = parseFloat(t));
    var r = u + p + t,
        a = u.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_orderdetails_total").val(a), $("#service_orderdetails_total_hidden").val(u);
    var d = p.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_order_tax").val(d), $("#service_order_tax_hidden").val(p);
    var i = r.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_order_total").val(i),
        $("#service_order_total_cash").val(i),
        $("span.amount_total").html(i),
        $("#service_order_total_bank").val(i),
        $("#service_order_total_credit").val(i),
        $("#service_order_total_hidden").val(r),
        0 == e && $("#service_order_discount_val").val(h.toLocaleString("en-US", { minimumFractionDigits: 2 })),
        $("#service_order_discount_val_hidden").val(h);
    var s = b.toLocaleString("en-US", { minimumFractionDigits: 2 }),
        o = g.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_order_kpb_service").val(s),
        $("#service_order_kpb_product").val(o),
        $("#service_order_kpb_service_hidden").val(b),
        $("#service_order_kpb_product_hidden").val(g),
        $("#service_order_discount_kpb").val(k),
        $("#service_order_tax_kpb").val(S),
        $("#income_trade_kpb").val(x),
        $("#stock_trade_kpb").val(q),
        $("#income_service_kpb").val(w),
        $("#income_trade_hidden").val(y),
        $("#stock_trade_hidden").val(m),
        $("#income_service_hidden").val(f);
}
function service_on_list_exist(e) {
    var r = !1,
        a = e.split(" - ")[0];
    return (
        $(".service_subtotal_hidden").each(function (e, t) {
            $(this).closest("tr").find("input[name='service_scode_hidden[]']").val().split(" - ")[0] == a && (r = !0);
        }),
        r
    );
}
function product_on_list_exist(e) {
    var r = !1,
        a = e.split(" - ")[0];
    return (
        $(".subtotal_hidden").each(function (e, t) {
            $(this).closest("tr").find("input[name='product_scode_hidden[]']").val().split(" - ")[0] == a && (r = !0);
        }),
        r
    );
}
function users_code_reset() {
    $("#users_status").val(""),
        $("#users_idnumber").val(""),
        $("#users_name").val(""),
        $("#users_address").val(""),
        $("#users_phone").val(""),
        $("#users_email").val(""),
        $("#religion_code").val(""),
        $("#village_code").val(""),
        $("#area_code").val(""),
        $("#users_code_hidden").val(0);
}
function users_code_set() {
    $("#users_code_hidden").val(1);
}
function users_code_exist(n) {
    null == n && (n = ""), $("#myloading").fadeIn(500);
    var v = $("#users_code").val().split(" - ")[0];
    return (
        $.ajax({
            type: "POST",
            url: "../../users/ajax/customer-exist-json.php?customer_code_val=" + v,
            data: { get_param: "value" },
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.users_id) $(".typehead_customer #users_code").typeahead("val", e.users_code), users_code_reset(), $("#users_name").val(v), $("#users_name").focus(), $("#users_clone").is(":checked") && users2_clone();
                else {
                    var t = e.users_code,
                        r = e.users_status,
                        a = e.users_idnumber,
                        d = e.users_name,
                        i = e.users_address,
                        s = e.users_phone,
                        o = e.users_email,
                        c = (e.users_birthday, e.religion_code),
                        _ = e.village_code + " - " + e.village_name,
                        l = e.area_code;
                    $(".typehead_customer #users_code").typeahead("val", t),
                        $("#users_status").val(r),
                        $("#users_idnumber").val(a),
                        $("#users_name").val(d),
                        $("#users_address").val(i),
                        $("#users_phone").val(s),
                        $("#users_email").val(o),
                        $("#religion_code").val(c),
                        $(".typehead_village #village_code").typeahead("val", _),
                        $("#area_code").val(l),
                        users_code_set(),
                        "" == n && $("#users_name").focus(),
                        $("#users_clone").is(":checked") && users2_clone();
                }
                $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function users2_clone() {
    var e = $("#users_code").val(),
        t = $("#users_status").val(),
        r = $("#users_idnumber").val(),
        a = $("#users_name").val(),
        d = $("#users_address").val(),
        i = $("#users_phone").val(),
        s = $("#users_email").val(),
        o = ($("#users_birthday").val(), $("#religion_code").val()),
        c = $("#village_code").val(),
        _ = $("#area_code").val();
    $(".typehead_customer #users2_code").typeahead("val", e),
        $("#users2_status").val(t),
        $("#users2_idnumber").val(r),
        $("#users2_name").val(a),
        $("#users2_address").val(d),
        $("#users2_phone").val(i),
        $("#users2_email").val(s),
        $("#religion2_code").val(o),
        $(".typehead_village #village2_code").typeahead("val", c),
        $("#area2_code").val(_);
}
function users2_reset() {
    $(".typehead_customer #users2_code").typeahead("val", ""), users2_code_reset();
}
function users2_code_reset() {
    $("#users2_status").val(""),
        $("#users2_idnumber").val(""),
        $("#users2_name").val(""),
        $("#users2_address").val(""),
        $("#users2_phone").val(""),
        $("#users2_email").val(""),
        $("#religion2_code").val(""),
        $("#village2_code").val(""),
        $("#area2_code").val(""),
        $("#users2_code_hidden").val(0);
}
function users2_code_set() {
    $("#users2_code_hidden").val(1);
}
function users2_code_exist(n) {
    null == n && (n = ""), $("#myloading").fadeIn(500);
    var v = $("#users2_code").val().split(" - ")[0];
    return (
        $.ajax({
            type: "POST",
            url: "../../users/ajax/customer-exist-json.php?customer_code_val=" + v,
            data: { get_param: "value" },
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.users_id) $(".typehead_customer #users2_code").typeahead("val", e.users_code), users2_code_reset(), $("#users2_name").val(v), $("#users2_name").focus();
                else {
                    var t = e.users_code,
                        r = e.users_status,
                        a = e.users_idnumber,
                        d = e.users_name,
                        i = e.users_address,
                        s = e.users_phone,
                        o = e.users_email,
                        c = (e.users_birthday, e.religion_code),
                        _ = e.village_code + " - " + e.village_name,
                        l = e.area_code;
                    $(".typehead_customer #users2_code").typeahead("val", t),
                        $("#users2_status").val(r),
                        $("#users2_idnumber").val(a),
                        $("#users2_name").val(d),
                        $("#users2_address").val(i),
                        $("#users2_phone").val(s),
                        $("#users2_email").val(o),
                        $("#religion2_code").val(c),
                        $(".typehead_village #village2_code").typeahead("val", _),
                        $("#area2_code").val(l),
                        users2_code_set(),
                        "" == n && $("#users2_name").focus();
                }
                $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function users_check_checked() {
    var t = $("#motorcycle_new_modal"),
        e = $("#users_code").val();
    $(".typehead_customer #users_code", t).typeahead("val", e);
    var r = e.split(" - ")[0];
    return (
        $("#users_code", t).prop("readonly", !0),
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../../users/ajax/customer-exist-json.php?customer_code_val=" + r,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                e.users_code;
                0 == e.users_id
                    ? (alert("Kode Pembawa kosong."), $("#users_code").focus(), t.modal("hide"))
                    : ($("#users_status", t).val(e.users_status), $("#users_phone", t).val(e.users_phone), $("#users_status", t).prop("disabled", !0), $("#users_phone", t).prop("disabled", !0)),
                    $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function users_check_unchecked() {
    var e = $("#motorcycle_new_modal");
    $(".typehead_customer #users_code", e).typeahead("val", ""),
        $("#users_code", e).prop("readonly", !1),
        $("#users_code", e).focus(),
        $("#users_status", e).val("male"),
        $("#users_phone", e).val(""),
        $("#users_status", e).prop("disabled", !1),
        $("#users_phone", e).prop("disabled", !1);
}
function mcode_onchange(n, v) {
    null == v && (v = ""), (n = n.split(" - ")[0]);
    var e = $("#date_register").val();
    return (
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../inventory/motorcycle-getcode.php?mcode=" + n + "&date_service=" + e,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.motorcycle_id)
                    $(".typehead_motorcycle #motorcycle_code").typeahead("val", n),
                        $(".typehead_motorcycle_type #motorcycle_type_code").typeahead("val", ""),
                        $("#color_code").val(""),
                        $("#motorcycle_manufacture").val(""),
                        $("#motorcycle_frame_no").val(""),
                        $("#motorcycle_machine_no").val(""),
                        $("#motorcycle_buy_register").val(""),
                        $("#motorcycle_book_service_no").val(""),
                        $("#motorcycle_description").val(""),
                        $("#motorcycle_type_name").focus();
                else {
                    var t = e.motorcycle_machine_no,
                        r = e.color_code,
                        a = e.motorcycle_manufacture,
                        d = e.motorcycle_frame_no,
                        i = e.motorcycle_buy_register,
                        s = e.motorcycle_book_service_no,
                        o = e.motorcycle_type_code,
                        c = e.users_code,
                        _ = e.motorcycle_code,
                        l = e.motorcycle_description;
                    c = e.users_code;
                    $(".typehead_motorcycle #motorcycle_code").typeahead("val", _),
                        $(".typehead_motorcycle_type #motorcycle_type_code").typeahead("val", o),
                        $("#color_code").val(r),
                        $("#motorcycle_manufacture").val(a),
                        $("#motorcycle_frame_no").val(d),
                        $("#motorcycle_machine_no").val(t),
                        $("#motorcycle_buy_register").val(i),
                        $("#motorcycle_book_service_no").val(s),
                        $("#motorcycle_description").val(l),
                        "" != i && motorcycle_buy_register_onchange(i),
                        $(".typehead_customer #users_code").typeahead("val", c),
                        users_code_exist("motorcycle_type_code"),
                        "" == v ? $("#motorcycle_type_code").focus() : $("#" + v).focus();
                }
                $("#myloading").fadeOut(500);
            },
        }),
        !1
    );
}
function typehead_modal(e, t, r, a, d, i, s) {
    Math.floor(100 * Math.random() + 1);
    $("#" + r, i)
        .closest("div")
        .attr("class", "col-md-8 " + e);
    var o = String.fromCharCode(65 + Math.floor(26 * Math.random())) + Date.now(),
        c = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 10,
            remote: {
                ttl: 1,
                url: a,
                wildcard: "%QUERY",
                filter: function (e) {
                    return $.map(e, function (e) {
                        return { name: e };
                    });
                },
            },
        });
    c.initialize(), $("." + e + " #" + r, i).typeahead(null, { name: "" + e + o, displayKey: "name", source: c.ttAdapter() });
}
function edit_to_proc(e) {
    $("#btn_proc span", e).text("PROSES"), $("#btn_proc i", e).attr("class", "fa fa-play-circle");
}
function proc_to_edit(e) {
    $("#btn_proc span", e).text("EDIT"), $("#btn_proc i", e).attr("class", "fa fa-edit");
}
function pause_to_play(e, t) {
    $("#btn_pause span", e).text("PLAY"), $("#btn_pause i", e).attr("class", "fa fa-play-circle");
    var r = "location.href='service-pause.php?service_order_id=" + t + "&play=1'";
    $("button#btn_pause", e).attr("onclick", r);
}
function play_to_pause(e, t) {
    $("#btn_pause span", e).text("PAUSE"), $("#btn_pause i", e).attr("class", "fa fa-pause-circle");
    var r = "location.href='service-pause.php?service_order_id=" + t + "&play=0'";
    $("button#btn_pause", e).attr("onclick", r);
}
function sbcode_onchange(e) {
    $("#service_order_id").val();
    return (
        $("#myloading").fadeIn(500),
        $.ajax({
            type: "POST",
            url: "../inventory/ajax/service-getcode.php?scode=" + e,
            cache: !1,
            async: !0,
            dataType: "json",
            complete: function () {
                $("#myloading").fadeOut(500);
            },
            error: function (e) {
                alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
            },
            success: function (e) {
                if (0 == e.service_id) alert("Kode Salah"), $("#myloading").fadeOut(500);
                else {
                    var t = e.service_name,
                        r = e.service_sprice,
                        a = e.service_code + " - " + t;
                    $(".typehead_service #service_bcode").typeahead("val", a),
                        $("#service_orderdetails_price").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 })),
                        $("#service_orderdetails_quantity").focus(),
                        $("#myloading").fadeOut(500);
                }
            },
        }),
        !1
    );
}
function service_vendor() {
    var e = $("#service_bcode").val(),
        t = $("#service_orderdetails_price").val(),
        r = $("#service_orderdetails_quantity").val(),
        a = $("#service_orderdetails_subtotal").val(),
        d = t.replace(/,/g, ""),
        i = r.replace(/,/g, ""),
        s = a.replace(/,/g, ""),
        o = $("#service_orderdetails_discount").val(),
        c = $("#service_orderdetails_discount_val").val(),
        _ = $("#service_orderdetails_tax").val(),
        l = o.replace(/,/g, ""),
        n = c.replace(/,/g, ""),
        v = _.replace(/,/g, ""),
        u = "<tr>";
    (u += '<td class="listnum_service_vendor">#</td>'),
        (u += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_bcode">' + e + '</div><input name="service_bcode_hidden[]" type="hidden" value="' + e + '"/></a></td>'),
        (u += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_price">' + t + '</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="' + d + '"/></a></td>'),
        (u += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_quantity">' + r + '</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="' + i + '"/></a></td>'),
        (u += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount">' + o + '</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="' + l + '"/></a></td>'),
        (u += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount_val">' + c + '</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="' + n + '"/></a></td>'),
        (u += '<td class="td_hide"><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_tax">' + _ + '</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="' + v + '"/></a></td>'),
        (u +=
            '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_subtotal">' +
            a +
            '</div><input class="subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="' +
            s +
            '"/></a></td>'),
        (u += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_vendor(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
        (u += "</tr>"),
        $(".dyn_service_vendor").append($(u)),
        $(".dyn_service_vendor").append($()),
        calc_service_vendor(),
        $(".typehead_service #service_bcode").typeahead("val", ""),
        $("#service_orderdetails_price").val(""),
        $("#service_orderdetails_quantity").val(""),
        $("#service_orderdetails_subtotal").val(""),
        $("#service_orderdetails_discount").val(""),
        $("#service_orderdetails_discount_val").val(""),
        $("#service_orderdetails_tax").val(""),
        $("#service_bcode").focus();
}
function remove_service_vendor(e) {
    $(e).closest("tr").remove(), $("#service_bcode").focus(), calc_service_vendor();
}
function calc_service_vendor(e) {
    null == e && (e = 0);
    var l = 0,
        n = 0,
        v = 0;
    $(".subtotal_hidden").each(function (e, t) {
        var r = e + 1;
        $(this)
            .closest("tr")
            .find("td.listnum_service_vendor")
            .html(r + "."),
            $(this)
                .closest("tr")
                .attr("id", "inner" + r);
        var a = $("#service_order_discount").val(),
            d = $(this).closest("tr").find("input[name='service_orderdetails_tax_hidden[]']").val(),
            i = $(this).closest("tr").find("input[name='service_orderdetails_price_hidden[]']").val(),
            s = $(this).closest("tr").find("input[name='service_orderdetails_quantity_hidden[]']").val(),
            o = (i - $(this).closest("tr").find("input[name='service_orderdetails_discount_val_hidden[]']").val()) * s,
            c = o - o * (a / 100),
            _ = c.toLocaleString("en-US", { minimumFractionDigits: 2 });
        $(this).closest("tr").find("div.service_orderdetails_subtotal").html(_), $(this).closest("tr").find("input[name='service_orderdetails_subtotal_hidden[]']").val(c), (v += o * (a / 100)), (n += c * (d / 100)), (l += c);
    });
    var t = $("#service_order_cost").val();
    (t = t.replace(/,/g, "")), (t = parseFloat(t));
    var r = l + n + t,
        a = l.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_orderdetails_total").val(a), $("#service_orderdetails_total_hidden").val(l);
    var d = n.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_order_tax").val(d), $("#service_order_tax_hidden").val(n);
    var i = r.toLocaleString("en-US", { minimumFractionDigits: 2 });
    $("#service_order_total").val(i),
        $("#service_order_total_cash").val(i),
        $("#service_order_total_bank").val(i),
        $("#service_order_total_credit").val(i),
        $("#service_order_total_hidden").val(r),
        0 == e && $("#service_order_discount_val").val(v.toLocaleString("en-US", { minimumFractionDigits: 2 })),
        $("#service_order_discount_val_hidden").val(v);
}
function village_code_exist() {
    $("#myloading").fadeIn(500);
    var a = $("#village_code").val(),
        e = a.split(" - ")[0];
    $.ajax({
        type: "POST",
        url: "../../users/ajax/village-exist-json.php?village_code_val=" + e,
        data: { get_param: "value" },
        dataType: "json",
        complete: function () {
            $("#myloading").fadeOut(500);
        },
        error: function (e) {
            alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
        },
        success: function (e) {
            var t = e.village_code;
            if (0 == e.village_id) {
                var r = $("#village_new_modal");
                $("#village_name", r).val(a),
                    typehead_modal("typehead_village", "village_code", "village_code", "../../users/village-list.php?search=%QUERY", "", r, "append_div_area"),
                    $(".typehead_village #village_code", r).typeahead("val", t),
                    r.modal("show");
            }
            $("#myloading").fadeOut(500);
        },
    });
}
$(function () {
    $(".product_order_sale").on("change", function () {
        var e = $("#product_orderdetails_price").val(),
            t = $("#product_orderdetails_quantity").val(),
            r = $("#product_orderdetails_discount_val").val();
        (e = e.replace(/,/g, "")), (t = t.replace(/,/g, ""));
        var a = (e - (r = r.replace(/,/g, ""))) * t;
        $("#product_orderdetails_subtotal").val(a.toLocaleString("en-US", { minimumFractionDigits: 2 }));
    });
}),
    $(function () {
        $(".product_order_sale").on("keyup", function () {
            var e = $("#product_orderdetails_discount").val(),
                t = $("#product_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
            $("#product_orderdetails_discount_val").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $("#product_orderdetails_discount_val").on("keyup", function () {
            var e = $("#product_orderdetails_discount_val").val(),
                t = $("#product_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
            $("#product_orderdetails_discount").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $(".product_order_sale_total").on("keyup", function () {
            calc_service_order_sale();
        });
    }),
    $("#product_scode").on("change", function (e) {
        var t = $(this).val();
        $("#product_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg"), pscode_onchange(t);
    }),
    $("#product_scode").on("keyup", function (e) {
        "" == $.trim($(this).val()) ? $("#product_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg") : $("#product_ov_flw").find("div.clear").attr("class", "clear hidden-sm hidden-md hidden-lg");
    }),
    $(function () {
        var s = $("#myModal");
        $(".product_order_sale_edit_details2", s).click(function () {
            $(".ajax_loader", s).show();
            var e = !1,
                t = "",
                r = $("#product_orderdetails_price", s).val(),
                a = $("#product_orderdetails_sprice_hidden", s).val(),
                d = $("#product_orderdetails_bprice_hidden", s).val();
            (r = parseFloat(r.replace(/,/g, ""))), (a = parseFloat(a.replace(/,/g, ""))), (d = parseFloat(d.replace(/,/g, "")));
            var i = $("#kpb_product_yesno_hidden", s).val();
            if (
                (r < d && 0 == i
                    ? ((t = "Harga jual lebih kecil dari harga beli. Lanjutkan proses?"), (e = !0), (update_master = 0))
                    : r != a && 0 == i && ((t = "Harga jual berubah, Update Harga di Master Data?"), (e = !0), (update_master = 1)),
                e)
            )
                if (confirm(t)) gen_product_order_sale_editlist(update_master);
                else {
                    if (1 != update_master) return !1;
                    gen_product_order_sale_editlist();
                }
            else gen_product_order_sale_editlist();
        });
    }),
    $(function () {
        $(".dyn_product_order_sale").on("click", "a.product_order_sale_edit", function () {
            var a = $("#myModal"),
                e = $(this).closest("tr").find("input[name='product_scode_hidden[]']").val(),
                t = $(this).closest("tr").attr("id"),
                r = $(this).closest("tr").find("div.product_orderdetails_price").html(),
                z = $(this).closest("tr").find("div.product_orderdetails_het_price").html(),
                d = $(this).closest("tr").find("input[name='product_orderdetails_bprice_hidden[]']").val(),
                i = $(this).closest("tr").find("div.product_orderdetails_quantity").html(),
                s = $(this).closest("tr").find("div.product_orderdetails_discount").html(),
                o = $(this).closest("tr").find("div.product_orderdetails_discount_val").html(),
                c = $(this).closest("tr").find("div.product_orderdetails_tax").html(),
                _ = $(this).closest("tr").find("div.product_shtquantity").html(),
                l = $(this).closest("tr").find("div.product_spoquantity").html(),
                n = $(this).closest("tr").find("div.product_quantity").html(),
                v = $(this).closest("tr").find("div.product_bpoquantity").html(),
                u = i,
                p = $(this).closest("tr").find("input[name='kpb_product_yesno_hidden[]']").val();
            $("#product_scode", a).val(e),
                $("#product_orderdetails_price", a).val(r),
                $("#product_orderdetails_het_price", a).val(z),
                $("#product_orderdetails_sprice_hidden", a).val(r),
                $("#product_orderdetails_bprice_hidden", a).val(d),
                $("#product_orderdetails_quantity", a).val(i),
                $("#product_orderdetails_discount", a).val(s),
                $("#product_orderdetails_discount_val", a).val(o),
                $("#product_orderdetails_tax", a).val(c),
                $("#inner_id_hidden", a).val(t),
                $("#product_shtquantity_hidden", a).val(_),
                $("#product_spoquantity_hidden", a).val(l),
                $("#product_quantity_hidden", a).val(n),
                $("#product_bpoquantity_hidden", a).val(v),
                $("#product_orderdetails_quantityold_hidden", a).val(u),
                $("#kpb_product_yesno_hidden", a).val(p);
            Math.floor(100 * Math.random() + 1);
            return (
                $(".auto_foc").keydown(function (e) {
                    if (13 == e.which) return e.preventDefault(), $(".auto_foc_trg").focus(), !1;
                }),
                $("#product_orderdetails_price", a).on("keyup", function () {
                    var e = $("#product_orderdetails_discount", a).val(),
                        t = $("#product_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#product_orderdetails_discount_val", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#product_orderdetails_discount", a).on("keyup", function () {
                    var e = $("#product_orderdetails_discount", a).val(),
                        t = $("#product_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#product_orderdetails_discount_val", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#product_orderdetails_discount_val", a).on("keyup", function () {
                    var e = $("#product_orderdetails_discount_val", a).val(),
                        t = $("#product_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
                    $("#product_orderdetails_discount", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                a.modal({ show: !0 }),
                !1
            );
        });
    }),
    $(function () {
        $(".service_order_sale").on("keyup", function () {
            var e = $("#service_orderdetails_price").val(),
                t = $("#service_orderdetails_quantity").val(),
                r = $("#service_orderdetails_discount_val").val();
            (e = e.replace(/,/g, "")), (t = t.replace(/,/g, ""));
            var a = (e - (r = r.replace(/,/g, ""))) * t;
            $("#service_orderdetails_subtotal").val(a.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $(".service_order_sale_total").on("keyup", function () {
            calc_service_order_sale();
        });
    }),
    $(function () {
        $("#service_orderdetails_discount").on("keyup", function () {
            var e = $("#service_orderdetails_discount").val(),
                t = $("#service_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
            $("#service_orderdetails_discount_val").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $("#service_orderdetails_discount_val").on("keyup", function () {
            var e = $("#service_orderdetails_discount_val").val(),
                t = $("#service_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
            $("#service_orderdetails_discount").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $("#service_order_discount_val").on("keyup", function () {
            var e = $("#service_order_discount").val();
            e = parseFloat(e) || 0;
            var t = $("#service_order_discount_val").val();
            t = t.replace(/,/g, "");
            var r = $("#service_order_discount_val_hidden").val(),
                a = ((r = parseFloat(r) || 0) / e) * 100;
            0 == r && (a = $("#service_orderdetails_total_hidden").val());
            var d = (t / a) * 100;
            (d = parseFloat(d) || 0), $("#service_order_discount").val(d.toLocaleString("en-US", { minimumFractionDigits: 2 })), calc_service_order_sale(1);
        });
    }),
    $("#service_scode").on("change", function (e) {
        var t = $(this).val();
        $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg"), service_scode_onchange(t);
    }),
    $("#service_scode").on("keyup", function (e) {
        "" == $.trim($(this).val()) ? $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg") : $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-sm hidden-md hidden-lg");
    }),
    $(function () {
        var c = $("#myModalkpb");
        $("#form_kpb", c).submit(function (e) {
            e.preventDefault(), $(".ajax_loader", c).show();
            var s = jQuery.Event("keydown");
            s.which = 13;
            var t = $("#motorcycle_code").val(),
                r = $("#form_kpb"),
                o = $("#kpb_online_num", c).val();
            $("#motorcycle_type_code_kpb", c).val();
            $.ajax({
                type: "POST",
                url: "../inventory/motorcycle-kpb-update.php?motorcycle_code=" + t,
                data: r.serialize(),
                success: function (e) {
                    console.log(e);
                    var t = e.split(";");
                    if ("" != t[4]) {
                        var r = t[0],
                            a = t[1],
                            d = t[2],
                            i = t[3];
                        1 == o &&
                            ($("#product_scode").val(r),
                            $("#product_orderdetails_price").val(d),
                            $("#product_orderdetails_bprice_hidden").val(a),
                            $("#product_orderdetails_quantity").val(1),
                            $("#product_orderdetails_discount").val(0),
                            $("#product_orderdetails_discount_val").val(0),
                            $("#kpb_product_yesno_hidden").val(1),
                            $("input#product_orderdetails_discount_val").trigger(s)),
                            $("#service_orderdetails_price").val(i),
                            service_order_sale(),
                            $(".ajax_loader", c).hide(),
                            $("#myModalkpb").modal("hide");
                    } else alert("Tipe Kendaraan Salah."), $("#motorcycle_type_code_kpb", c).focus(), $(".ajax_loader", c).hide();
                },
            });
        });
    }),
    $(function () {
        $("#motorcycle_buy_register").change(function () {
            return motorcycle_buy_register_onchange($(this).val()), !1;
        });
    }),
    $(function () {
        var r = $("#myModalkpb");
        $("#motorcycle_buy_register", r).change(function () {
            var e = $("#date_register").val(),
                t = $(this).val();
            return (
                $("#myloading").fadeIn(500),
                $.ajax({
                    type: "POST",
                    url: "../inventory/kpb-daterange-get.php?date_service=" + e + "&motorcycle_buy_register=" + t,
                    cache: !1,
                    async: !0,
                    dataType: "json",
                    complete: function () {
                        $("#myloading").fadeOut(500);
                    },
                    error: function (e) {
                        alert("Masalah Koneksi, Tolong Ulangi Kembali: " + e.status + " " + e.statusText), $("#myloading").fadeOut(500);
                    },
                    success: function (e) {
                        $("span#motorcycle_numdays", r).html(e), $("#myloading").fadeOut(500);
                    },
                }),
                !1
            );
        });
    }),
    $(function () {
        var k = $("#myModalservice");
        $(".service_order_sale_edit_details2", k).click(function () {
            $(".ajax_loader", k).show();
            var e = $("#service_scode", k).val(),
                t = $("#service_orderdetails_price", k).val(),
                r = $("#service_orderdetails_bprice_hidden", k).val(),
                a = $("#service_orderdetails_quantity", k).val(),
                d = $("#service_orderdetails_discount", k).val(),
                i = $("#service_orderdetails_discount_val", k).val(),
                s = $("#service_orderdetails_tax", k).val(),
                o = d.replace(/,/g, ""),
                c = i.replace(/,/g, ""),
                _ = s.replace(/,/g, ""),
                l = t.replace(/,/g, ""),
                n = a.replace(/,/g, ""),
                v = (l - o) * n,
                u = v.toLocaleString("en-US", { minimumFractionDigits: 2 }),
                p = $("#inner_id_hidden", k).val(),
                h = $("#service_shtquantity_hidden", k).val(),
                m = $("#service_spoquantity_hidden", k).val(),
                y = $("#service_quantity_hidden", k).val(),
                f = $("#service_bpoquantity_hidden", k).val(),
                b = $("#kpb_service_yesno_hidden", k).val(),
                g = ($("#" + p), '<td class="listnum_service_order_sale">#</td>');
            (g +=
                '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_scode">' +
                e +
                '</div><input name="service_scode_hidden[]" type="hidden" value="' +
                e +
                '"/><input name="kpb_service_yesno_hidden[]" type="hidden" value="' +
                b +
                '"/></a></td>'),
                (g +=
                    '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_price">' +
                    t +
                    '</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="' +
                    l +
                    '"/><input name="service_orderdetails_bprice_hidden[]" type="hidden" value="' +
                    r +
                    '"/></a></td>'),
                (g += '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_quantity">' + a + '</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="' + n + '"/></a></td>'),
                (g += '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount">' + d + '</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="' + o + '"/></a></td>'),
                (g +=
                    '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_discount_val">' +
                    i +
                    '</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="' +
                    c +
                    '"/></a></td>'),
                (g +=
                    '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_tax">' +
                    s +
                    '</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="' +
                    _ +
                    '"/></a></td>'),
                (g +=
                    '<td><a href="#" class="link_table service_order_sale_edit"><div class="service_orderdetails_subtotal">' +
                    u +
                    '</div><input class="service_subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="' +
                    v +
                    '"/></a></td>'),
                (g += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_shtquantity">' + h + "</div></a></td>"),
                (g += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_spoquantity">' + m + "</div></a></td>"),
                (g += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_quantity">' + y + "</div></a></td>"),
                (g += '<td class="td_hide"><a href="#" class="link_table service_order_sale_edit"><div class="service_bpoquantity">' + f + "</div></a></td>"),
                (g += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_order_sale(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
                $("#" + p)
                    .first()
                    .html($(g)),
                $(".ajax_loader", k).hide(),
                calc_service_order_sale(),
                $("#myModalservice").modal("hide");
        });
    }),
    $(function () {
        $(".dyn_service_order_sale").on("click", "a.service_order_sale_edit", function () {
            var a = $("#myModalservice"),
                e = $(this).closest("tr").find("input[name='service_scode_hidden[]']").val(),
                t = $(this).closest("tr").attr("id"),
                r = $(this).closest("tr").find("div.service_orderdetails_price").html(),
                d = $(this).closest("tr").find("input[name='service_orderdetails_bprice_hidden[]']").val(),
                i = $(this).closest("tr").find("div.service_orderdetails_quantity").html(),
                s = $(this).closest("tr").find("div.service_orderdetails_discount").html(),
                o = $(this).closest("tr").find("div.service_orderdetails_discount_val").html(),
                c = $(this).closest("tr").find("div.service_orderdetails_tax").html(),
                _ = $(this).closest("tr").find("div.service_shtquantity").html(),
                l = $(this).closest("tr").find("div.service_spoquantity").html(),
                n = $(this).closest("tr").find("div.service_quantity").html(),
                v = $(this).closest("tr").find("div.service_bpoquantity").html(),
                u = $(this).closest("tr").find("input[name='kpb_service_yesno_hidden[]']").val();
            return (
                $("#service_scode", a).val(e),
                $("#service_orderdetails_price", a).val(r),
                $("#service_orderdetails_bprice_hidden", a).val(d),
                $("#service_orderdetails_quantity", a).val(i),
                $("#service_orderdetails_discount", a).val(s),
                $("#service_orderdetails_discount_val", a).val(o),
                $("#service_orderdetails_tax", a).val(c),
                $("#inner_id_hidden", a).val(t),
                $("#service_shtquantity_hidden", a).val(_),
                $("#service_spoquantity_hidden", a).val(l),
                $("#service_quantity_hidden", a).val(n),
                $("#service_bpoquantity_hidden", a).val(v),
                $("#kpb_service_yesno_hidden", a).val(u),
                $(".auto_foc").keydown(function (e) {
                    if (13 == e.which) return e.preventDefault(), $(".auto_foc_trg").focus(), !1;
                }),
                $("#service_orderdetails_price", a).on("keyup", function () {
                    var e = $("#service_orderdetails_discount", a).val(),
                        t = $("#service_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#service_orderdetails_discount_val", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#service_orderdetails_discount", a).on("keyup", function () {
                    var e = $("#service_orderdetails_discount", a).val(),
                        t = $("#service_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#service_orderdetails_discount_val", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#service_orderdetails_discount_val", a).on("keyup", function () {
                    var e = $("#service_orderdetails_discount_val", a).val(),
                        t = $("#service_orderdetails_price", a).val(),
                        r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
                    $("#service_orderdetails_discount", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                a.modal({ show: !0 }),
                !1
            );
        });
    }),
    $("#users_code").on("change", function (e) {
        var t = $(this).val();
        "" == $.trim(t) ? ($("#users_code").focus(), alert("Kode Kosong")) : users_code_exist();
    }),
    $(".users_edit").change(function () {
        $("#users_clone").is(":checked") && users2_clone();
    }),
    $("#users_clone").change(function () {
        $(this).is(":checked") ? (users2_clone(), $(".clone_area").hide()) : (users2_reset(), $(".clone_area").show());
    }),
    $("#users2_code").on("change", function (e) {
        var t = $(this).val();
        "" == $.trim(t) ? ($("#users2_code").focus(), alert("Kode Kosong")) : users2_code_exist();
    }),
    $(function () {
        var d = $("#customer_new_modal");
        $("#customer_new_modal_form", d).submit(function (e) {
            e.preventDefault();
            var t = $("#customer_new_modal_form");
            $(".ajax_loader", d).show();
            var r = $("#users_code", d).val(),
                a = $("#users_name", d).val();
            $.ajax({
                type: "POST",
                url: "../../users/ajax/customer-new.php",
                data: t.serialize(),
                success: function (e) {
                    console.log(e), $(".typehead_customer #users_code").typeahead("val", r + " - " + a), $("#motorcycle_code").focus(), $(".ajax_loader", d).hide(), d.modal("hide");
                },
            });
        });
    }),
    $("#users_check").change(function () {
        $(this).is(":checked") ? users_check_checked() : users_check_unchecked();
    }),
    $("#motorcycle_code").on("change", function (e) {
        var t = $(this).val();
        "" == $.trim(t) ? ($("#motorcycle_code").focus(), alert("Kode Kosong")) : mcode_onchange(t);
    }),
    $(function () {
        var _ = $("#motorcycle_new_modal");
        $("#motorcycle_new_modal_form", _).submit(function (e) {
            e.preventDefault();
            var t = $("#motorcycle_new_modal_form"),
                r = $("#date_register").val();
            $(".ajax_loader", _).show(),
                $.ajax({
                    type: "POST",
                    url: "../inventory/ajax/motorcycle-new.php?date_service=" + r,
                    data: t.serialize(),
                    success: function (e) {
                        console.log(e);
                        var t = e.split(";");
                        $(".typehead_motorcycle #motorcycle_code").typeahead("val", t[10] + " - " + t[0]);
                        var r = t[1],
                            a = t[2],
                            d = t[3],
                            i = t[4],
                            s = t[5],
                            o = t[8];
                        t[9], t[3];
                        $("span#users_name").html(t[0]), $("span#motorcycle_frame_no").html(r + "/" + a), $("span#motorcycle_type_name").html(d + "/" + i + "/" + s), $("#service_order_code").focus();
                        var c = $("#myModalkpb");
                        $("span#motorcycle_numdays", c).html(o), $(".ajax_loader", _).hide(), _.modal("hide");
                    },
                });
        });
    }),
    $(function () {
        $(".calc_modal").on("click", function () {
            var a = $("#calc_modal"),
                e = $("#service_order_total_cash").val();
            $("#product_order_calc_bill", a).val(e),
                $("#product_order_calc_pay", a).focus(),
                $("#product_order_calc_pay", a).on("keyup", function () {
                    var e = $(this).val(),
                        t = $("#product_order_calc_bill", a).val(),
                        r = (e = e.replace(/,/g, "")) - (t = t.replace(/,/g, ""));
                    $("#product_order_calc_balance", a).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                a.modal({ show: !0 });
        });
    }),
    $(function () {
        var t = $("#calc_modal");
        $(".btn_calc", t).click(function () {
            var e = $("#product_order_calc_pay", t).val();
            $("#service_order_cash").val(e), $(".ajax_loader", t).show(), $(".modal").modal("hide"), $("#Submit").click();
        });
    }),
    $("input[type='text']").on("typeahead:selected", function (e, t) {
        var r = $(this).attr("rel"),
            a = $(this).val();
        $(this).typeahead("val", a), $("#" + r).focus();
    }),
    $("input[name=service_order_km_now]").on("keyup", function () {
        var e = parseFloat($(this).val()),
            t = 0;
        0 < e && (t = e + 2e3), $("input[name=service_order_km_next]").val(t);
    }),
    $("input[name=service_order_buy_pay]").click(function () {
        "service_order_buy_pay1_0" == this.id
            ? ($("#service_order_buy_pay_cash").show(), $("#service_order_buy_pay_bank").hide(), $("#service_order_buy_pay_credit").hide(), $("#Submit").hide(), $("#Submitpay").show())
            : "service_order_buy_pay1_1" == this.id
            ? ($("#service_order_buy_pay_cash").hide(), $("#service_order_buy_pay_bank").show(), $("#service_order_buy_pay_credit").hide())
            : ($("#service_order_buy_pay_cash").hide(), $("#service_order_buy_pay_bank").hide(), $("#service_order_buy_pay_credit").show(), $("#Submit").show(), $("#Submitpay").hide());
    }),
    $("a.service_order_edit").on("click", function () {
        var e = $("#myModalnew"),
            t = $(this).closest("tr").find("td.service_order_id_hidden").html();
        t = $(t).text();
        var r = $(this).closest("tr").find("td.service_order_status_hidden").html();
        if (((r = $(r).text()), $("#service_order_id", e).val(t), "sa" == r)) {
            $("button#btn_edit", e).show(),
                $("button#btn_proc", e).prop("disabled", !0),
                $("button#btn_pause", e).prop("disabled", !0),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !1),
                $("button#btn_print", e).prop("disabled", !0),
                edit_to_proc(e),
                play_to_pause(e, t);
            var a = "pdf/service-pkb-pdf.php?service_order_id=" + t;
        }
        if ("tmp" == r) {
            $("button#btn_edit", e).show(),
                $("button#btn_proc", e).prop("disabled", !1),
                $("button#btn_pause", e).prop("disabled", !0),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !1),
                $("button#btn_print", e).prop("disabled", !1),
                edit_to_proc(e),
                play_to_pause(e, t);
            a = "pdf/service-pkb-pdf.php?service_order_id=" + t;
        }
        if ("process" == r) {
            $("button#btn_edit", e).hide(),
                $("button#btn_proc", e).prop("disabled", !1),
                $("button#btn_pause", e).prop("disabled", !1),
                $("button#btn_unpaid", e).prop("disabled", !1),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !1),
                $("button#btn_print", e).prop("disabled", !1),
                proc_to_edit(e),
                play_to_pause(e, t);
            a = "pdf/service-pkb-pdf.php?service_order_id=" + t;
        }
        if ("pause" == r) {
            $("button#btn_edit", e).hide(),
                $("button#btn_proc", e).prop("disabled", !0),
                $("button#btn_pause", e).prop("disabled", !1),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !0),
                $("button#btn_print", e).prop("disabled", !1),
                proc_to_edit(e),
                pause_to_play(e, t);
            a = "pdf/service-pkb-pdf.php?service_order_id=" + t;
        }
        if ("unpaid" == r) {
            $("button#btn_edit", e).hide(),
                $("button#btn_proc", e).prop("disabled", !0),
                $("button#btn_pause", e).prop("disabled", !0),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !1),
                $("button#btn_cancel", e).prop("disabled", !1),
                $("button#btn_print", e).prop("disabled", !1),
                proc_to_edit(e),
                play_to_pause(e, t);
            a = "pdf/service-pkb-pdf.php?service_order_id=" + t;
        }
        if ("pmn" == r) {
            $("button#btn_edit", e).hide(),
                $("button#btn_proc", e).prop("disabled", !0),
                $("button#btn_pause", e).prop("disabled", !0),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !0),
                $("button#btn_print", e).prop("disabled", !1),
                proc_to_edit(e),
                play_to_pause(e, t);
            a = "pdf/service-inv-pdf.php?service_order_id=" + t;
        }
        if ("cancel" == r) {
            $("button#btn_edit", e).hide(),
                $("button#btn_proc", e).prop("disabled", !0),
                $("button#btn_pause", e).prop("disabled", !0),
                $("button#btn_unpaid", e).prop("disabled", !0),
                $("button#btn_pmn", e).prop("disabled", !0),
                $("button#btn_cancel", e).prop("disabled", !0),
                $("button#btn_print", e).prop("disabled", !0),
                edit_to_proc(e),
                play_to_pause(e, t);
            a = "pdf/service-inv-pdf.php?service_order_id=" + t;
        }
        var d = "location.href='service-edit.php?service_order_id=" + t + "&btn_status=btn_edit'";
        if ("sa" == r) d = "location.href='service-edit.php?service_order_id=" + t + "'";
        $("button#btn_edit", e).attr("onclick", d);
        var i = "location.href='service-edit.php?service_order_id=" + t + "&service_order_status=" + r + "&btn_status=btn_proc'";
        $("button#btn_proc", e).attr("onclick", i);
        var s = "location.href='service-unpaid.php?service_order_id=" + t + "'";
        $("button#btn_unpaid", e).attr("onclick", s);
        var o = r;
        "pmn" == r && (o = "unpaid");
        var c = "location.href='service-edit.php?service_order_id=" + t + "&service_order_status=" + o + "&btn_status=btn_pmn'";
        $("button#btn_pmn", e).attr("onclick", c);
        var _ = "service-cancel.php?service_order_id=" + t;
        $("form#delpopform", e).attr("action", _);
        var l = "window.open('" + a + "', '_blank');return false;";
        return $("button#btn_print", e).attr("onclick", l), e.modal({ show: !0 }), !1;
    }),
    $("a.service_order_paid").on("click", function () {
        var e = $("#myModalnew"),
            t = $(this).closest("tr").find("td.service_order_id_hidden").html();
        t = $(t).text();
        var r = $(this).closest("tr").find("td.service_order_status_hidden").html();
        if (((r = $(r).text()), $("#service_order_id", e).val(t), "pmn" == r)) {
            $("button#btn_pmn", e).prop("disabled", !1), $("button#btn_print", e).prop("disabled", !1);
            var a = "pdf/service-inv-pdf.php?service_order_id=" + t;
        }
        var d = r;
        "pmn" == r && (d = "unpaid");
        var i = "location.href='service-paid-edit.php?service_order_id=" + t + "&service_order_status=" + d + "&btn_status=btn_pmn'";
        $("button#btn_pmn", e).attr("onclick", i);
        var s = "window.open('" + a + "', '_blank');return false;";
        return $("button#btn_print", e).attr("onclick", s), e.modal({ show: !0 }), !1;
    }),
    $("a.service_order_onl_edit").on("click", function () {
        var e = $("#myModalnew"),
            t = $(this).closest("tr").find("td.service_order_id_hidden").html();
        (t = $(t).text()), $("#service_order_id", e).val(t);
        var r = "location.href='service-edit.php?service_order_id=" + t + "&service_order_status=&btn_status='";
        return $("button#btn_proc", e).attr("onclick", r), e.modal({ show: !0 }), !1;
    }),
    $("a.btn_history").on("click", function () {
        var e = $("#motorcycle_code").val();
        if ("" != $.trim(e)) {
            var t = "pdf/service-history-pdf.php?motorcycle_code=" + e;
            window.open(t, "popuppage", "width=640,toolbar=1,resizable=1,scrollbars=yes,height=400,top=100,left=100");
        }
    }),
    $("#service_bcode").on("change", function (e) {
        var t = $(this).val();
        $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg"), sbcode_onchange(t);
    }),
    $("#service_bcode").on("keyup", function (e) {
        "" == $.trim($(this).val()) ? $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-xs hidden-sm hidden-md hidden-lg") : $("#service_ov_flw").find("div.clear").attr("class", "clear hidden-sm hidden-md hidden-lg");
    }),
    $(function () {
        $(".dyn_service_vendor").on("click", "a.service_vendor_edit", function () {
            var i = $("#myModal"),
                e = $(this).closest("tr").find("input[name='service_bcode_hidden[]']").val(),
                t = $(this).closest("tr").attr("id"),
                r = $(this).closest("tr").find("div.service_orderdetails_price").html(),
                a = $(this).closest("tr").find("div.service_orderdetails_quantity").html(),
                d = $(this).closest("tr").find("div.service_orderdetails_discount").html(),
                s = $(this).closest("tr").find("div.service_orderdetails_discount_val").html(),
                o = $(this).closest("tr").find("div.service_orderdetails_tax").html();
            $("#service_orderdetails_price", i).val(r),
                $("#service_orderdetails_quantity", i).val(a),
                $("#service_orderdetails_discount", i).val(d),
                $("#service_orderdetails_discount_val", i).val(s),
                $("#service_orderdetails_tax", i).val(o),
                $("#inner_id_hidden", i).val(t);
            var c = Math.floor(100 * Math.random() + 1);
            $("#service_bcode", i).closest("div").remove();
            var _ = $(".append_div", i);
            (html = '<div class="col-md-8"><input name="service_code" type="text" class="textbox firstin auto_foc" id="service_bcode"> <span id="service_bcode_label">&nbsp;</span></div>'),
                _.append($(html)),
                $("#service_bcode", i)
                    .closest("div")
                    .addClass("typehead_service" + c),
                $("#service_bcode", i).val(e);
            var l = String.fromCharCode(65 + Math.floor(26 * Math.random())) + Date.now(),
                n = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    limit: 10,
                    remote: {
                        ttl: 1,
                        url: "../inventory/service-list.php?search=%QUERY",
                        wildcard: "%QUERY",
                        filter: function (e) {
                            return $.map(e, function (e) {
                                return { name: e };
                            });
                        },
                    },
                });
            return (
                n.initialize(),
                $(".typehead_service" + c + " #service_bcode").typeahead(null, { name: "typehead_account_" + l, displayKey: "name", source: n.ttAdapter() }),
                $(".auto_foc").keydown(function (e) {
                    if (13 == e.which) return e.preventDefault(), $(".auto_foc_trg").focus(), !1;
                }),
                $("#service_bcode", i).on("keydown", function (e) {
                    if (13999 == e.which) {
                        var t = $("#form_service_order", i),
                            r = $(this).val();
                        return (
                            $("#myloading").fadeIn(500),
                            $.post("../inventory/service-getcode.php?scode=" + r, t.serialize(), function (e) {
                                if (1 == e) alert("Kode Salah"), $("#myloading").fadeOut(500);
                                else {
                                    var t = e.split(";"),
                                        r = (t[0], t[1]);
                                    t[2];
                                    $("#service_orderdetails_price", i).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 })), $("#service_orderdetails_quantity", i).focus(), $("#myloading").fadeOut(500);
                                }
                            }),
                            !1
                        );
                    }
                }),
                $(".typehead_service" + c + " #service_bcode", i).on("typeahead:selected", function (e, t) {
                    var r = $("#form_service_order", i),
                        a = $(this).val(),
                        d = $("#service_order_id", i).val();
                    return (
                        $("#myloading").fadeIn(500),
                        $.post("../inventory/service-getcode.php?scode=" + a + "&service_order_id" + d, r.serialize(), function (e) {
                            if (1 == e) alert("Kode Salah"), $("#myloading").fadeOut(500);
                            else {
                                var t = e.split(";"),
                                    r = (t[0], t[1]);
                                t[2];
                                $("#service_orderdetails_price", i).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 })), $("#service_orderdetails_quantity", i).focus(), $("#myloading").fadeOut(500);
                            }
                        }),
                        !1
                    );
                }),
                $("#service_orderdetails_price", i).on("keyup", function () {
                    var e = $("#service_orderdetails_discount", i).val(),
                        t = $("#service_orderdetails_price", i).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#service_orderdetails_discount_val", i).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#service_orderdetails_discount", i).on("keyup", function () {
                    var e = $("#service_orderdetails_discount", i).val(),
                        t = $("#service_orderdetails_price", i).val(),
                        r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
                    $("#service_orderdetails_discount_val", i).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                $("#service_orderdetails_discount_val", i).on("keyup", function () {
                    var e = $("#service_orderdetails_discount_val", i).val(),
                        t = $("#service_orderdetails_price", i).val(),
                        r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
                    $("#service_orderdetails_discount", i).val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
                }),
                i.modal({ show: !0 }),
                !1
            );
        });
    }),
    $(function () {
        var h = $("#myModal");
        $(".service_vendor_edit_details2", h).click(function () {
            $(".ajax_loader", h).show();
            var e = $("#service_bcode", h).val(),
                t = $("#service_orderdetails_price", h).val(),
                r = $("#service_orderdetails_quantity", h).val(),
                a = $("#service_orderdetails_discount", h).val(),
                d = $("#service_orderdetails_discount_val", h).val(),
                i = $("#service_orderdetails_tax", h).val(),
                s = a.replace(/,/g, ""),
                o = d.replace(/,/g, ""),
                c = i.replace(/,/g, ""),
                _ = t.replace(/,/g, ""),
                l = r.replace(/,/g, ""),
                n = (_ - s) * l,
                v = n.toLocaleString("en-US", { minimumFractionDigits: 2 }),
                u = $("#inner_id_hidden", h).val(),
                p = ($("#" + u), '<td class="listnum_service_vendor">#</td>');
            (p += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_bcode">' + e + '</div><input name="service_bcode_hidden[]" type="hidden" value="' + e + '"/></a></td>'),
                (p += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_price">' + t + '</div><input name="service_orderdetails_price_hidden[]" type="hidden" value="' + _ + '"/></a></td>'),
                (p += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_quantity">' + r + '</div><input name="service_orderdetails_quantity_hidden[]" type="hidden" value="' + l + '"/></a></td>'),
                (p += '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount">' + a + '</div><input name="service_orderdetails_discount_hidden[]" type="hidden" value="' + s + '"/></a></td>'),
                (p +=
                    '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_discount_val">' + d + '</div><input name="service_orderdetails_discount_val_hidden[]" type="hidden" value="' + o + '"/></a></td>'),
                (p += '<td class="td_hide"><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_tax">' + i + '</div><input name="service_orderdetails_tax_hidden[]" type="hidden" value="' + c + '"/></a></td>'),
                (p +=
                    '<td><a href="#" class="link_table service_vendor_edit"><div class="service_orderdetails_subtotal">' +
                    v +
                    '</div><input class="subtotal_hidden" name="service_orderdetails_subtotal_hidden[]" type="hidden" value="' +
                    n +
                    '"/></a></td>'),
                (p += '<td><a href="javascript:;" class="btn btn-danger" onclick="remove_service_vendor(this);"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </a></td>'),
                $("#" + u).html($(p)),
                $(".ajax_loader", h).hide(),
                calc_service_vendor(),
                $("#myModal").modal("hide");
        });
    }),
    $(function () {
        $(".service_vendor").on("keyup", function () {
            var e = $("#service_orderdetails_price").val(),
                t = $("#service_orderdetails_quantity").val(),
                r = $("#service_orderdetails_discount_val").val();
            (e = e.replace(/,/g, "")), (t = t.replace(/,/g, ""));
            var a = (e - (r = r.replace(/,/g, ""))) * t;
            $("#service_orderdetails_subtotal").val(a.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $(".service_vendor_total").on("keyup", function () {
            calc_service_vendor();
        });
    }),
    $(function () {
        $("#service_orderdetails_discount").on("keyup", function () {
            var e = $("#service_orderdetails_discount").val(),
                t = $("#service_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / 100) * (t = t.replace(/,/g, ""));
            $("#service_orderdetails_discount_val").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $("#service_orderdetails_discount_val").on("keyup", function () {
            var e = $("#service_orderdetails_discount_val").val(),
                t = $("#service_orderdetails_price").val(),
                r = ((e = e.replace(/,/g, "")) / (t = t.replace(/,/g, ""))) * 100;
            $("#service_orderdetails_discount").val(r.toLocaleString("en-US", { minimumFractionDigits: 2 }));
        });
    }),
    $(function () {
        $("#service_order_discount_val").on("keyup", function () {
            var e = $("#service_order_discount").val();
            e = parseFloat(e) || 0;
            var t = $("#service_order_discount_val").val();
            t = t.replace(/,/g, "");
            var r = $("#service_order_discount_val_hidden").val(),
                a = ((r = parseFloat(r) || 0) / e) * 100;
            0 == r && (a = $("#service_orderdetails_total_hidden").val());
            var d = (t / a) * 100;
            (d = parseFloat(d) || 0), $("#service_order_discount").val(d.toLocaleString("en-US", { minimumFractionDigits: 2 })), calc_service_vendor(1);
        });
    }),
    $("input[name=service_vendor_pay]").click(function () {
        "service_vendor_pay1_0" == this.id
            ? ($("#service_vendor_pay_cash").show(), $("#service_vendor_pay_bank").hide(), $("#service_vendor_pay_credit").hide())
            : "service_vendor_pay1_1" == this.id
            ? ($("#service_vendor_pay_cash").hide(), $("#service_vendor_pay_bank").show(), $("#service_vendor_pay_credit").hide())
            : ($("#service_vendor_pay_cash").hide(), $("#service_vendor_pay_bank").hide(), $("#service_vendor_pay_credit").show());
    }),
    $("#village_code").on("change", function (e) {
        village_code_exist();
    }),
    $(function () {
        var d = $("#village_new_modal");
        $("#village_new_modal_form", d).submit(function (e) {
            e.preventDefault();
            var t = $("#village_new_modal_form"),
                r = $("#village_code", d).val(),
                a = $("#village_name", d).val();
            $(".ajax_loader", d).show(),
                $.ajax({
                    type: "POST",
                    url: "../../users/ajax/village-new.php",
                    data: t.serialize(),
                    success: function (e) {
                        console.log(e), $(".typehead_village #village_code").typeahead("val", r + " - " + a), $("#product_order_code").focus(), $(".ajax_loader", d).hide(), d.modal("hide");
                    },
                });
        });
    });
