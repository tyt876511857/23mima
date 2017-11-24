var common = function() {

    if(typeof console === 'undefined'){
        window.console = {log:function(){}, error:function(){}};
    }

    // prototype扩展
    function prototypeExtend() {
        // indexOf(兼容ie8)
        if (!Array.prototype.indexOf) {
            Array.prototype.indexOf = function(item) {
                for (var i = 0; i < this.length; i++) {
                    if (item === this[i]) return i;
                }
                return -1;
            };
        }

        // array的romove方法
        Array.prototype.remove = function(b) {
            var a = this.indexOf(b);
            if (a >= 0) {
                this.splice(a, 1);
                return true;
            }
            return false;
        };

    }

    // ajax全局设置
    function ajaxGlobalSteup() {
        $.ajaxSetup({
            cache: false
        });
        $(document).ajaxComplete(function(event, xhr, options) {
            if (xhr.status == 401) {
                // 未授权暂时跳转
                location.href = '/login?from=' + encodeURIComponent(location.pathname + location.search);
            }
        });
    }

    $(function() {
        // init
        ajaxGlobalSteup();
        prototypeExtend();
    });

    // public function
    return {
        formatIDCard: function(card) {
            return card ? [card.slice(0, 6), '****', card.slice(-4)].join('') : '';
        },
        /**
         * 格式化字符串 第一个参数为格式化模板 format('this is a {0} template!', 'format');
         * format('this is a {0.message} template!', { message: 'format'}); 等同于
         * format('this is a {message} template!', { message: 'format' });
         */
        format: function() {
            var template = arguments[0],
                templateArgs = arguments,
                stringify = function(obj) {
                    if (obj == null) {
                        return '';
                    } else if (typeof obj === 'function') {
                        return obj();
                    } else if (typeof obj !== 'string') {
                        return JSON.stringify ? JSON.stringify(obj) : obj;
                    }
                    return obj;
                };
            return template.replace(/\{\w+(\.\w+)*\}/g, function(match) {
                var propChains = match.slice(1, -1).split('.');
                var index = isNaN(propChains[0]) ? 0 : +propChains.shift();
                var arg, prop;
                if (index + 1 < templateArgs.length) {
                    arg = templateArgs[index + 1];
                    while (prop = propChains.shift()) {
                        arg = arg[prop];
                    }
                    return stringify(arg);
                }
                return match;
            });
        },
        urlParams: function () {
          // This function is anonymous, is executed immediately and
          // the return value is assigned to QueryString!
          var query_string = {};
          var query = window.location.search.substring(1);
          var vars = query.split("&");
          for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
                // If first entry with this name
            if (typeof query_string[pair[0]] === "undefined") {
              query_string[pair[0]] = decodeURIComponent(pair[1]);
                // If second entry with this name
            } else if (typeof query_string[pair[0]] === "string") {
              var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
              query_string[pair[0]] = arr;
                // If third or later entry with this name
            } else {
              query_string[pair[0]].push(decodeURIComponent(pair[1]));
            }
          }
            return query_string;
        },
        isEmptyObj: function (obj){
            for (var name in obj){return false;}
            return true;
        },
        pageNoCache: function (url){
          //<input type="hidden" id="page_no_cache" data-description="magic_methon_dont_touch_me_fuck_x5" value="no">
          var ele = document.getElementById('page_no_cache');
          if(ele != null){
            //alert(ele.value);
            ele.value == 'yes' ? (url ? location.replace(url) : location.reload()) : ele.value = 'yes';
          } else {
            alert('页面需要一个id为page_no_cache的隐藏input,详见此方法');
          }
        },
        formatDate: function(date, format){
            return format.replace('yyyy',date.getFullYear()).replace('MM', date.getMonth() + 1).replace('dd', date.getDate())
                   .replace('HH', date.getHours()).replace('mm', date.getMinutes()).replace('ss', date.getSeconds());
        }

    };
}();