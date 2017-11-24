/*
 * @description: 基于 jQuery 的 UI 相关独立组件基类
 * @author: Bird.An
 * @update: Bird.An (2015-10-25 16:00)
 * @ToDo: this.boundingBox.off();
 */

(function() {
    function Widget() {
		this.boundingBox = null; // 组件内部的外层容器
    }

    Widget.prototype = {
    	// 为实例绑定自定义事件处理函数队列，type 为事件类型，handler 为待绑定的事件处理函数
    	typeOn: function(type, handler) {
            if (typeof this.handlers[type] === "undefined") {
                this.handlers[type] = [];
            }
            this.handlers[type].push(handler);
            return this;
        },

        // 触发事件名为 type 的事件处理函数队列
        fire: function(type, data) {
            if (this.handlers[type] instanceof Array) {
                var handlers = this.handlers[type],
                i, len;

                for (i=0,len=handlers.length; i<len; i++) {
                    handlers[i](data);
                }
            }
        },

        // 接口: 添加Dom节点
        renderUI: function() {},
        
        // 接口: 监听事件
        bindUI: function() {},

        // 接口: 初始化组件属性
        syncUI: function() {},

        // 接口: 销毁前的处理函数
        destructor: function() {},

        // 方法: 渲染组件
        render: function(container) {
            this.renderUI();
            this.handlers = {};
            this.bindUI();
            this.syncUI();
            $(container || document.body).append(this.boundingBox);
        },
        // 方法: 销毁组件
        destroy: function() {
            this.destructor();
            this.boundingBox.off(); // Could be changed !!!
            this.boundingBox.remove();
        }
    };

    window.Cp = {}; // 用于挂载组件的构造函数
    window.Widget = Widget;
})();