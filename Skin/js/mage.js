var Base = function() {

};

Base.prototype = {
    url: null,
    params: {},
    method: 'post',

    setUrl: function(url) {
        this.url = url;
        return this;
    },
    
    getUrl: function() {
        return this.url;
    },
    setMethod: function(method) {
        this.method = method;
        return this;

    },
    getMethod: function() {
        return this.method;
    },

    resetParam: function() {
        this.params = {};
        return this;
    },

    setParams: function(params) {
        this.params = params;
        return this;

    },
    getParams: function(key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] == 'undefined') {
            return null;
        }

        return this.params[key];
    },
    addParam: function(key, value) {
        this.params[key] = value;
        return this;
    },
    removeParam: function(key) {
        if (typeof this.params[key] != 'undefined') {
            delete this.params[key];
        }
        return this;
    },

    setForm: function(form) {
        this.setMethod($(form).attr('method'));
        this.setUrl($(form).attr('action'));
        this.setParams($(form).serializeArray());
        return this;
    },

    load: function() {

        var self = this;
        $.ajax({

            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            success: function(response) {
                self.manageHtml(response);
            }
        });
    },

    manageHtml: function(response) {


        if (typeof response.element == 'undefined') {
            return false;
        }
        if (typeof response.element == 'object') {
            $(response.element).each(function(i, element) {

                $(element.selector).html(element.html);
                //alert(element.selector);
            })
        } else {

            $(response.element.selector).html(response.element.html);
        }
    }
}