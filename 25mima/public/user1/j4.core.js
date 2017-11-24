/*
*j4 framework core library
*/
(function () {
    var innerPattern = {
        dateParsePattern: /^\s*([12]\d{3}|\d{2})[-\/\u5E74](1[0-2]|0?[1-9])[-\/\u6708]([12]\d|3[01]|0?[1-9])\u65E5?(?: (1\d|2[0-3]|0?[0-9])[:\u65F6]([1-5]\d|0?\d)[:\u5206]?([1-5]\d|0?\d)?)?/,
        stringFormatPattern: /\{(\d+)(?:\.([^:}]+))?(?::([FfPpDdCc]{1})(\d?))?\}/g,
        parseRepeatPattern: function (format, pos, patternChar) {
            var length = format.length, num2 = pos + 1;
            while ((num2 < length) && (format.charAt(num2) == patternChar)) {
                num2++;
            }
            return (num2 - pos);
        }
    };
    
    var _toString = Object.prototype.toString
    , _hasOwnProperty = Object.prototype.hasOwnProperty;
    
    Object.isArray = function(obj) {
        return _toString.call(obj) === '[object Array]';
    };
    
    Object.isString = function (obj) {
        return _toString.call(obj) === '[object String]';
    };
    
    Object.isFunction = function (obj) {
        return _toString.call(obj) === '[object Function]';
    };
    
    Object.isNumber = function (obj) {
        return _toString.call(obj) === '[object Number]';
    };
    
    Object.has = function(obj, key) {
        return _hasOwnProperty.call(obj, key);
    };
    
    Object.isEmpty = function(obj) {
        if (obj == null) return true;
        if (Object.isArray(obj) || Object.isString(obj)) return obj.length === 0;
        for (var key in obj) if (Object.has(obj, key)) return false;
        return true;
    };
    
    Object.isNull = function(obj) {
        return obj == null;
    };
    
    Object.toNumber = function(obj) {
        if (!Object.isNull(obj)) {
            return Number(obj);
        } else {
            return NaN;
       }
    };

    //**********************************************************************************************************************************
    // String(string)
    //**********************************************************************************************************************************
    string = function () {
    };
    
    string.trimLeft = String.trimLeft = function (str) {
        return str.trimLeft();
    };

    string.trimRight = String.trimRight = function (str) {
        return str.trimRight();
    };

    string.trim = String.trim = function (str) {
        return str.trim();
    };

    string.padLeft = String.padLeft = function (obj, width, padChar) {
        return obj.toString().padLeft(width, padChar);
    };

    string.padRight = String.padRight = function (obj, width, padChar) {
        return obj.toString().padRight(width, padChar);
    };

    string.isNullOrEmpty = String.isNullOrEmpty = function (str) {
        return str == null || str == "";
    };

    string.format = String.format = function () {
        var arg, formatStr, matchRgx;

        if (arguments.length < 2)
            return arguments[0] || '';

        if (arguments[1] && arguments[1] instanceof Array) {
            arg = [null];
            arg = arg.concat(arguments[1]);
        } else {
            arg = arguments;
        }
        formatStr = arguments[0];
        matchRgx = innerPattern.stringFormatPattern;
        return formatStr.replace(matchRgx, function (item, idx, property, specifier, precision) {
            var rst = arg[parseInt(idx) + 1];
            if (property != null) {
                rst = rst[property];
            }
            if (specifier != null) {
                switch (specifier) {
                    case "f":
                    case "F":
                        rst = Number(rst).toFixed(precision);
                        break;
                    case "d":
                    case "D":
                        rst = Number(rst).toFixed(0);
                        break;
                    case "p":
                    case "P":
                        rst = (Number(rst) * 100.0).toFixed(precision) + '%';
                        break;
                    case "c":
                    case "C":
                        var idx, tmp = [], negative = '';
                        rst = Number(rst).toFixed(precision);
                        if (rst < 0) {
                            rst = rst.slice(1);
                            negative = '-';
                        }
                        idx = (rst.indexOf('.') == -1 ? rst.length : rst.indexOf('.')) - 3;
                        tmp.push(rst.slice(idx, rst.length));
                        while (idx > 0) {
                            tmp.push(rst.slice(idx - 3 < 0 ? 0 : idx - 3, idx));
                            idx -= 3;
                        }
                        tmp.reverse();
                        rst = '\uFFE5' + negative + tmp.join(',');
                        break;
                }
            }
            return rst;
        });
    };

    String.prototype.trimLeft = function () {
        return this.replace(/^\s+/g, '');
    };

    String.prototype.trimRight = function () {
        return this.replace(/\s+$/g, '');
    };

    String.prototype.trim = function () {
        return this.trimLeft().trimRight();
    };

    String.prototype.padLeft = function (width, padChar) {
        var str = this;
        padChar = padChar == null ? ' ' : padChar.charAt(0);
        while (str.length < width) {
            str = padChar + str;
        }
        return str;
    };

    String.prototype.padRight = function (width, padChar) {
        var str = this;
        padChar = padChar == null ? ' ' : padChar.charAt(0);
        while (str.length < width) {
            str += padChar;
        }
        return str;
    };

    //**********************************************************************************************************************************
    // Date
    //**********************************************************************************************************************************
    Date.prototype.toString = function (format) {
        return this.toFormatString(format || 'yyyy-MM-dd hh:mm:ss');
    };

    Date.prototype.toFormatString = function (formatString) {
        var tmp = [], preChar = null, i = 0, len = formatString.length, current, value, repeat;
        while (i < len) {
            current = formatString.charAt(i);
            switch (current) {
                case 'y':
                    value = this.getFullYear().toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(repeat == 2 ? value.slice(repeat) : value);
                    i += repeat;
                    break;
                case 'M':
                    value = (this.getMonth() + 1).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 'Q':
                    value = (this.getQuarter()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 'd':
                    value = (this.getDate()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 'h':
                    value = (this.getHours()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 'm':
                    value = (this.getMinutes()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 's':
                    value = (this.getSeconds()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                case 'f':
                    value = (this.getMilliseconds()).toString();
                    repeat = innerPattern.parseRepeatPattern(formatString, i, current);
                    tmp.push(value.padLeft(repeat, '0'));
                    i += repeat;
                    break;
                default:
                    tmp.push(current);
                    i++;
                    break;
            }
        }
        return tmp.join('');
    };

    Date.prototype.getQuarter = function () {
        return Math.floor(this.getMonth() / 3) + 1;
    };

    Date.prototype.addMilliseconds = function (value) {
        var d = this;
        d.setTime(this.getTime() + value);
        return d;
    };

    Date.prototype.addSeconds = function (value) {
        return this.addMilliseconds(value * 0x3e8);
    };

    Date.prototype.addMinutes = function (value) {
        return this.addMilliseconds(value * 0xea60);
    };

    Date.prototype.addHours = function (value) {
        return this.addMilliseconds(value * 0x36ee80);
    };

    Date.prototype.addDays = function (value) {
        return this.addMilliseconds(value * 0x5265c00);
    };

    Date.prototype.addMonths = function (value) {
        var d = this;
        value += this.getMonth();
        if (value < 0) {
            d.setFullYear(this.getFullYear() + value / 12, value % 12 + 12, this.getDate());
        } else {
            d.setFullYear(this.getFullYear() + value / 12, value % 12, this.getDate());
        }
        return d;
    };

    Date.prototype.addYears = function (value) {
        return this.addMonths(value * 12);
    };

    Date.prototype.weekFirstDay = function () {
        return this.addDays(1 - this.getDay() || 7);
    };

    Date.prototype.weekLastDay = function () {
        return this.weekFirstDay().addDays(6);
    };

    Date.prototype.monthFirstDay = function () {
        var d = this;
        d.setDate(1);
        return d;
    };

    Date.prototype.monthLastDay = function () {
        return this.addMonths(1).monthFirstDay().addDays(-1);
    };

    Date.now = function () {
        return new Date();
    };

    Date.parse = function (dateStr) {
        var d = null;
        //yyyy-MM-dd hh:mm:ss,yyyy\u5E74MM\u6708dd\u65E5 hh\u65F6mm\u5206ss\u79D2,yyyy/MM/dd hh:mm:ss
        var matches = innerPattern.dateParsePattern.exec(dateStr);
        if (matches == null) {
            throw new Error("\u65E0\u6548\u7684\u65E5\u671F\u683C\u5F0F");
        }
        d = new Date(matches[1], Number(matches[2]) - 1, matches[3]);
        if(matches[4] != null){
            d.setHours(+matches[4]);
        } 
        if(matches[5] != null){
            d.setMinutes(+matches[5]);
        }
        if(matches[6] != null){
            d.setSeconds(+matches[6]);
        }
        return d;
    };
})();