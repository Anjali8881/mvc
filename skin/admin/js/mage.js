var Base = function(){
    
};

Base.prototype = {
    alert : function(){
        alert(111);
    },
    url : null,
    param : {},
    method : 'post',

    setUrl : function(url){
        this.url = url;
        return this;
    },

    getUrl : function(){
        return this.url;
    },

    setMethod : function(method){
        this.method = method;
        return this;
    },

    getMethod : function(){
        return this.method;
    },

    resetParams : function(){
        this.params  = {};
        return this;
    },

    setParams : function(params){
        this.params = params;
        return this;
    },

    getParams : function(key){
        if(typeof key === 'undefined'){
            return this.params;
        }
       if(typeof this.params[key] == 'undefined'){
           return null;
       }
       return this.params[key];
    },

    addParam : function(key,value){
        this.param[key] = value;
        return this;
    },

    removeParam : function(key){
        if(typeof this.params[key] != 'undefined'){
            delete this.params[key];
        }
        return this;
    },

    load : function(){
        var request = $.ajax({
            method : this.getMethod(),
            url : this.getUrl(),
            data : this.getParams(),
            success : function(response){
				$.each(response.element,function(i,element){
					$(element.selector).html(element.html);
				}) 
				//$(response.element.selector).html(response.element.html);
			}
            // success: function(response){
            //     $.each()
            //     // if(typeof response.element == 'undefined'){
            //     //     return false;
            //     // }
            //     // if(typeof response.element == 'object'){
            //     //     $.each(function(i,element){
            //     //         $(response.element.selector).html(response.element.html);
            //     //     })
            //     // }else{
            //     //     $(response.element.selector).html(response.element.html);
            //     // }
                
            // }
        });
    },

    upload : function () {
        $.ajax({
            method : this.getMethod(),
            url : this.getUrl(),
            data : this.getParams(),
            processData : false,
            contentType : false,
            success : function(response){
                $.each(response.element,function(i,element){
                    $(element.selector).html(element.html);
                })
            
            }
        });
        }

    // load : function(){
    //     var request = $.ajax({
    //         method : this.getMethod(),
    //         url : this.getUrl(),
    //         data : this.getParams(),
    //         success: function(response){
    //             alert(response);
    //         }
    //     });
    // }
}
var object = new Base();
// object.setParams({
//     name : 'anjali',

//     email : 'anjali@gmail.com'
// });
// console.log(object.getParams());
// object.setUrl('http://localhost/questecom/index.php?c=product&a=test');
// object.load();
