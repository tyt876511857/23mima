/*
 * @update: caowei 2016/05/18 将原有的两个页面融合为一
 * @Todo: 对优惠券自动选择增加价格判断
 */
var productBuy = function() {

    var hasAdded,
        tieredPrice,
        aliasMap = {
            "kids99": "201504",
            "standard": "201513",
            "general": "201506",
            "family": "201511",
            "double": "201512"
        };



    /* 购物车 */
    var CartView = function() {
        var _self = this;
        var _buyCode,_items = [];

        /*初始化购物车选择列表*/
        this.init = function (){
            /*var _productId = aliasMap[common.urlParams().p];
            $('#cartList').html($('#' + _productId)).find('.cart-amount-num').val('1');
            // _self.recover();
            _self.update();*/
        }

        this.update = function() {
            _buyCode = '';
            $('.cart-amount-num').each(function(index, el) {
                if ($(el).val()==0) return;
                _buyCode += $(el).attr('id') + '_' + $(el).val() + '|';
            });

            var cartItems = _buyCode.split('|'),
                tempArr;
            for (var i = 0; i < cartItems.length; i++) {
                tempArr = cartItems[i].split('_');
                if (tempArr.length < 3) continue;
                _items[i] = {
                    productId: tempArr[0],
                    productType: tempArr[1],
                    count: tempArr[2]
                }
            }
        }

        this.contain = function(productId) {
            for (var i = _items.length - 1; i >= 0; i--) {
                if (_items[i].productId == productId) {
                    return true;
                }
            }
            return false;
        };

        this.buyCode = function() {
            return _buyCode;
        };

        this.recover = function() {
            if (!$.cookie('buy_record')) return;
            var data = JSON.parse($.cookie('buy_record'))[0];
            $('#201513_0').val(data['201513_0']);
            $('#201511_0').val(data['201511_0']);
            $('#201512_0').val(data['201512_0']);
            $('#rcvName').val(data.rcvName);
            $('#rcvTel').val(data.rcvTel);
            $('#selProvince').val(data.selProvince);
            $('#selCity').val(data.selCity);
            $('#rcvAddress').val(data.rcvAddress);
        };

        this.record = function() {
            var buy_record = [{
                "201513_0": $('#201513_0').val(),
                "201511_0": $('#201511_0').val(),
                "201512_0": $('#201512_0').val(),
                "rcvName": $('#rcvName').val(),
                "rcvTel": $('#rcvTel').val(),
                "selProvince": $('#selProvince').val(),
                "selCity": $('#selCity').val(),
                "rcvAddress": $('#rcvAddress').val(),
                }];
            $.cookie('buy_record',JSON.stringify(buy_record), { expires: 0.001});
        };
    };


    /* 优惠券弹窗 */
    var CouponPopView = function(cashier) {
        var _self = this;
        var _template = {
            start: '<div class="coupon-list">',
            content: '<p id="cs-{id}" class="coupon-select {usageCountType} {limitType}">\
                        <input {checked} {disabled} id="coupon-{index}" type="checkbox" name="coupon" data-id="{id}" data-discount="{discountMoney}" >\
                        <label  class="{unusable}" for="coupon-{index}">{name}(优惠{discountMoneyStr}元)<span>有效期：{expireTimeStr} </span><span class="red">{limitTip}</span> </label>\
                        </p>',
            end: '</div>'
        };
        var _coupons = [];

        /* 加载优惠券 */
        var _load = function() {
            /*hasLogin && $.getJSON('/coupon/json/list', function(result) {
                if (!result.code) {
                    _updateCoupons(result.data);
                    cashier.updateWithOptimize();
                } else {
                    alert(result.msg);
                }
            });*/
        };

        /* 更新优惠券 */
        var _updateCoupons = function(coupons) {
            _coupons = coupons;
        };

        /* 返回选择的优惠券id集合 */
        var _selectedCouponIds = function() {
            var selected = [];
            $('#couponList').find('input:checked').each(function(i, v) {
                selected.push($(v).attr('data-id'));
            });
            return selected;
        };

        /* 使用产品限制 */
        var _productLimit = function(passList) {
            if (!passList || !passList.length) return false;
            for (var j = 0; j < passList.length; j++) {
                if (cashier.containProduct(passList[j])) {
                    return false;
                }
            }
            return true;
        };

        /* 优惠券是否可用 */
        var _isValid = function(coupon, selectedCouponsMoney) {
            return !(cashier.getOriginalPrice() < coupon['usageMoney'] || _productLimit(coupon['productLimit']) || new Date() > new Date(coupon['expireTime']))
                && cashier.getOriginalPrice() > selectedCouponsMoney;
        };

        /* 使用条件的提示 */
        var _tipOfCondition = function(coupon) {
            var tip = '无限制';
            if (coupon['productLimit'] && coupon['productLimit'].length) {
                tip = '指定产品';
            }
            if (coupon['usageMoney'] > 0) {
                tip = '满' + coupon['usageMoney'] + '元使用';
            }
            return tip;
        };

        /* 添加优惠券 */
        var _add = function(couponId) {
            var _couponId = couponId.toUpperCase();
            if (_couponId.length !== 8) {
                alert('优惠码不正确');
                return;
            }
            for (var i = _coupons.length - 1; i >= 0; i--) {
                if (_coupons[i].id ==  _couponId ) {
                    alert('此优惠券[' + _couponId + ']已在您的优惠券列表');
                    return;
                };
            };
            $.getJSON('/coupon/isvalid?cid=' + _couponId, function(result) {
                if (!result.code) {
                    alert('优惠券添加成功！');
                    _coupons.push(result.data);
                    _updateCoupons(_coupons);
                    cashier.updateWithOptimize();
                } else {
                    alert(result.msg);
                }
            });
        };

        /* 页面渲染 */
        var _render = function(optimizeChoose) {
            var selectedCouponIds = optimizeChoose ? _optimize() : selectedCouponIds(); // 选择的id集合
            var selectedCouponsMoney = _self.totalPrice(); // 选择的总金额
            var html = [],
                coupon;
            for (var i = 0; i < _coupons.length; i++) {
                coupon = $.extend({
                    index: i,
                    isValid: true
                }, _coupons[i]);
                coupon['selected'] = $.inArray(coupon['id'], selectedCouponIds) > -1;
                coupon['isValid'] = coupon['selected'] || _isValid(coupon, selectedCouponsMoney);
                coupon['condition'] = _tipOfCondition(coupon);
                coupon['limitType'] = coupon['usageLimit'] > 1 ? 'js-checkbox' : 'js-radio';
                coupon['limitTip'] = coupon['usageLimit'] > 1 ? '可叠加使用' : '不可叠加使用';
                coupon['discountMoneyStr'] = Number(coupon['discountMoney']);
                coupon['expireTimeStr'] = common.formatDate(new Date(coupon['expireTime']), 'yyyy/MM/dd');
                coupon['disabled'] = coupon['isValid'] ? '' : 'disabled';
                coupon['unusable'] = coupon['isValid'] ? '' : 'unusable';
                coupon['checked'] = coupon['selected'] ? 'checked' : '';

                if (coupon['isValid']) {
                    html.splice(0, 0, common.format(_template.content, coupon)); // 置顶
                } else {
                    html.push(common.format(_template.content, coupon)); // 追加
                }
            }
            html.splice(0, 0, _template.start);
            html.push(_template.end);
            $('#couponList').html(html.join('')).toggleClass('fn-hide', !_coupons.length);;
        };

        var _optimize = function() {
            var radioCoupon,multiCouponIds = [];
            for (var i = 0; i < _coupons.length; i++) {
                if(_isValid(_coupons[i], -1)){
                    if(_coupons[i]['usageLimit'] > 1) {
                        multiCouponIds.push(_coupons[i].id);
                    } else if (!radioCoupon || _coupons[i]['discountMoney'] > radioCoupon.discountMoney) {
                        radioCoupon = _coupons[i];
                    }
                }
            };
            return  radioCoupon ? multiCouponIds.concat(radioCoupon.id) : multiCouponIds;
        };


        // 事件绑定
        $('#couponList').on('click', '.coupon-select', function() {
            var that = this;
            //_render(); // 重新渲染
            if ($(this).is('.js-radio') && $(this).children('input').is(':checked')) {
                $('.js-radio').each(function(index, ele) {
                    if (ele.id != that.id) {
                        $(ele).children('input').prop('checked', false);
                    };
                });
            }
            cashier.update();
        });

        $('.coupon-btn').on('click', function() {
            _add($('.coupon-input').val());
            $('.coupon-input').val('');
            return false;
        });

        this.totalPrice = function() {
            var totalPrice = 0;
            $('#couponList').find('input:checked').each(function(i, v) {
                totalPrice += +($(v).attr('data-discount'));
            });
            return totalPrice;
        };
        this.selectedCouponIds = function() {
            return _selectedCouponIds();
        };
        this.optimizeChoose = function() {
            _render(true);
        };
        this.load = function() {
            _load();
        };

        // 加载优惠券
        _load();
    };

    /* 收银台 */
    var Cashier = (function() {
        var Cashier = function(){
            var _self = this;
            var _originalBalance = Number($("#avaBalance").attr('data-balance'));
            var _couponPopView = new CouponPopView(this),
                _cartView = new CartView();

            // 更新可用优惠券
            // 2016-5-19 更新惠券可用数量  暂未使用
            var _updateCoupon = function() {
                // if (_couponPopView.selectedCouponIds().length) {
                //     $('#myCoupon .available').html(_couponPopView.availableSize() + "张可用");
                //     $('#myCoupon .discount').html('减<span class="rmb"></span>' + _couponPopView.totalPrice().toFixed(2));
                // } else {
                //     $('#myCoupon .available').html(_couponPopView.availableSize() + "张可用");
                //     $('#myCoupon .discount').empty("");
                // };
            };

            var _isBalanceUsed = function() {
                return $("#payBalance").is(":checked");
            };

            var _updatePayPrice = function() {
                var payPrice = _self.getOriginalPrice();
                var remainBalance = _originalBalance;
                if (_couponPopView.totalPrice() > 0) {
                    payPrice -= _couponPopView.totalPrice();
                    payPrice > 0 ? payPrice = payPrice : payPrice = 0;
                    $('#couponMoney').html(_couponPopView.totalPrice().toFixed(2)).parent('p').show();
                } else {
                    $('#couponMoney').html('').parent('p').hide();
                }

                if (_isBalanceUsed()) {
                    remainBalance = _originalBalance - payPrice;
                    $('#balanceMoney').html((remainBalance > 0 ? payPrice : _originalBalance).toFixed(2)).parent('p').show();
                    payPrice -= _originalBalance;
                } else {
                    $('#balanceMoney').html('').parent('p').hide();
                }

                $('#productMoney').html(_self.getOriginalPrice().toFixed(2));
                $('#finalPrice').html((payPrice > 0 ? payPrice : 0).toFixed(2));
                $('#avaBalance').html((remainBalance > 0 ? remainBalance : 0).toFixed(2));
                $('.order-buy-btn').attr('disabled', _self.getOriginalPrice() <= 0);
            };

/*-----------发票数据---------------*/
            var _invoice = function() {
                
                var invoiceType = $("#invoice-status").attr("data-category"),
                    companyStatus= $(".j-choose-company").hasClass('invoice-choose-current'),
                    hasInvoice = false,
                    invoice = {};
                if(invoiceType === '1') {
                    hasInvoice = true;
                    invoice.invoiceType = 1;
                    var personalInvoice = {};
                    personalInvoice.invoiceContent = '购买产品明细';

                    if(!companyStatus){
                        personalInvoice.invoiceName = "个人";
                        personalInvoice.invoiceTitle = "个人";
                    }else{
                        personalInvoice.invoiceName = $('.invoice-normal-company').val();
                        personalInvoice.invoiceTitle = "单位";
                    }
                    invoice.personalInvoice = personalInvoice;
                }else if(invoiceType === '2') {
                    var  vatInvoice = {};
                    hasInvoice = true;
                    invoice.invoiceType = 2;
                    
                    $(".invoice-vat-wrap").find('input:text').each(function(index, el) {
                        var item = $(this).attr('data');

                            if (index > 7) return;
                            vatInvoice[item] = $(this).val();
                    });

                    var province = $('.inv-selProvince option:selected').text(),
                        city = $('.inv-selCity option:selected').text();
                    vatInvoice.invoiceContent = '购买产品明细';
                    vatInvoice.invoiceTakerAddress = province + city + $(".vat-receive-address").val();
                    invoice.vatInvoice = vatInvoice;
                }

                return [hasInvoice, invoice];
            }

            var _commit = function(data) {
                $.ajax({
                    type: "POST",
                        url: "/order/commit" + (common.urlParams()["upgrade"] ? "?upgrade=" +common.urlParams()["upgrade"] : ""),
                        contentType: "application/json",
                        data: JSON.stringify(data),
                        success: function(result){
                            if(!result.code){
                                orderId = result.data.orderId;
                                location.href = "/order/pay?id=" + orderId;
                            } else {
                                alert("订单生成错误,请重新提交");
                            }
                        }
                });

            };

            // 商品购买数量变化
            var _amountChange = function() {

                $(".cart-amount-reduce").on('click', function(){
                    var count = +$(this).next().val() <= 0 ? 0 : +$(this).next().val() -1;
                    $(this).next().val(count);
                    _self.updateWithOptimize();
                });

                $(".cart-amount-increase").on('click', function(){
                    var count = +$(this).prev().val() + 1;
                    $(this).prev().val(count);
                    _self.updateWithOptimize();
                });

                $('.cart-amount-num').keyup(function(e){
                    if(isNaN(+$(this).val()) || +$(this).val() < 0){
                        $(this).val('1');
                    }
                    _self.updateWithOptimize();
                });
            };

             // 更新阶梯价格
            var _updateTieredPrice = function (){
                if($.isEmptyObject(tieredPrice)) return ;
                var productCount = {};
                // 收集产品的购买数量
                $('.cart-amount-num').each(function(){
                    var $this = $(this);
                    productCount[parseInt($this.attr('id'))] = (productCount[parseInt($this.attr('id'))] || 0) + (+$(this).val());
                });

                for(var id in productCount){
                    var prices = tieredPrice[id];
                    if(!prices) continue;
                    var  tieredItem;
                    for(var i = 0, item; item = prices[i]; i++){
                        if(productCount[id] >= item.count){
                            tieredItem = item;
                            break;
                        }
                    }

                    // 更新UI价格
                    $('input[id^=' + id + '_]').attr('data-price', tieredItem.price);
                    $('#' + id).find('.pack-select-price span:eq(0)').html( (+tieredItem.price).toFixed(2));
                }
            };

            // 获取选择的产品总价
            var _getOriginalPrice = function (){
                _updateTieredPrice();
                var subtotalPrice = 0;
                var sltbox = $('.cart-amount-num');
                sltbox.each(function(i, e) {
                    subtotalPrice += parseFloat($(e).val() * $(e).attr('data-price'));
                });
                return subtotalPrice;
            };


            var _bindEventHandler = function() {

                // $(window).unload(function() {
                //     _cartView.record();
                // });

                $("#payBalance").on('click', function() {
                    _self.update();
                });

                $(".coupon .launch-hd").click(function() {
                    if($(this).next('div').is(':animated')) return;
                    var hasExpand = $(this).is('.launched');
                    if(hasExpand){
                        $(this).removeClass('launched').next('div').slideUp(200);
                    } else {
                        if(!hasLogin){
                          loginAndRegister.showPopm(function(){
                              // 谷歌分析
                              ga('send', 'event', '弹窗登陆成功');
                              hasLogin = true;
                              $.modal.close();
                              $(".coupon .launch-hd").click();
                              _couponPopView.load();
                            });
                          return false;
                        }
                        $(this).addClass('launched').next('div').slideDown(200);
                   }
                });

                $(".balance .launch-hd").click(function() {
                    if($(this).next('div').is(':animated')) return;
                    var hasExpand = $(this).is('.launched');
                    if(hasExpand){
                        $(this).removeClass('launched').next('div').slideUp(200);
                    }else {
                        $(this).addClass('launched').next('div').slideDown(200);
                    }
                });

                $("#orderfill").validate({
                    focusInvalid: true,
                    errorPlacement: function(error,element){
                        var error_div = element.parent();
                        error_div.append(error);
                    },
                    rules:{
                        name: {required: true, username: true},
                        mobile: {required: true, isMobile: true},
                        province: {notDefault: true},
                        city: {notDefault: true},
                        address: {required: true}
                    },
                    messages:{
                        name: {required: "请输入收件人姓名", username: "姓名只能包括中文字、英文字母、数字、下划线和空格"},
                        mobile: {required: "请输入收件人手机号码", isMobile: "请输入一个有效的手机号码"},
                        province: {notDefault: "请选择省份"},
                        city: {notDefault: "请选择城市"},
                        address: {required: "请填写收货的具体街道信息"}
                    },
                    submitHandler: function(form) {
                        var invoice = _invoice();
                        var postData = {
                            carts: _cartView.buyCode(),
                            name: $('#rcvName').val(),
                            mobile: $('#rcvTel').val(),
                            deliveryDateType:  '1',
                            address: $('#selProvince').val() + $('#selCity').val() + $('#rcvAddress').val(),
                            useBalance: _isBalanceUsed(),
                            coupons: _couponPopView.selectedCouponIds(),
                            hasInvoice: invoice[0],
                            invoice: invoice[1]
                        };
                        debugger;
                        console.log(postData);
                        _commit(postData);
                    }
                });
            };

            // public method
            this.init = function(tieredPriceParam){
                tieredPrice = tieredPriceParam;
                _cartView.init();
                _amountChange();
                _bindEventHandler();
                this.updateWithOptimize();
            };
            this.containProduct = function(productId) {
                return _cartView.contain(productId);
            };
            this.getOriginalPrice = function(){
                return _getOriginalPrice();
            };
            this.updateCoupon = function() {
                _updateCoupon();
            };
            this.updateWithOptimize = function(){
                _cartView.update();
                _couponPopView.optimizeChoose();
                _updateCoupon();
                _updatePayPrice();
            };

            this.update = function() {
                _updateCoupon();
                _updatePayPrice();
            };
        };

        // 单例
        var _singleton;
        return {
            init: function(){
                if(!_singleton) {
                    (_singleton = new Cashier()).init();
                }
            }
        }
    })();

    return {
        buyPage: function() {
            Cashier.init(); // 初始化收银台
        },
        orderPage: function() {
            $('.goto-pay').on('click', function() {
                $.getJSON('/order/pay?id=' + $(this).attr('data') + isWechatBrowser() ? '&showwxpaytitle=1' : '', function(result) {
                    !result.code ? onBridgeReady(result.data) : alert(result.msg);
                });
            });
        }
    }
}();
