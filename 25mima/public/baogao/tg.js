try {
    (function(a,b,c,d){
    a[c]=function(){a[c]['ar']=a[c]['ar']||[];a[c]['ar'].push(arguments);};
    var s=b.createElement('script');s.async = 1;s.src='//t.agrantsem.com/js/agt.js';
    var r=b.getElementsByTagName('script')[0];r.parentNode.insertBefore(s,r);
    })(window,document,'_agtjs','script');
    _agtjs('init','AG_863614_EAHA','$website$');
    _agtjs('trackPv');
    
    var agtGetTopUrl = function() {
        var win=window;
        var doc=document;
        var topwin=window.top || window.parent || window;
    
        var localUrl = "";
        try{
            localUrl=topwin.location.href;
        }catch(err){
            localUrl=doc.referrer || win.location.href;
        }
        return localUrl;
    };
    var agtTopUrl = agtGetTopUrl();
    
    var agtCheckString = function(regular, str) {
        var re = new RegExp(regular);
        return re.test(str);
    };
    
    var agtBindClick = function(element,fn){
        if(element.attachEvent){
            element.attachEvent('onclick',fn);
        }else if(element.addEventListener){
            element.addEventListener('click',fn);
        }
    };
    
    var agtBindEventByTimer = function(selector,fn){
        var interval=setInterval(function(){
            var elements=_agtjs.Sizzle(selector);
            if(elements && elements.length>0){
                clearInterval(interval);
                for(var i in elements){
                    agtBindClick(elements[i],fn);
                }
            }
        },1000);
    };
    
    function agt_102(){
        _agtjs('loadEvent',{atsev:102,'atsp1':$('#finalPrice').html(),'atsp2':'$orderid$'});
    }
    if (agtCheckString('http://m.23mofang.com/buy/trade',agtTopUrl)) {
        agt_102();
    }

    function agt_101(){
        _agtjs('loadEvent',{atsev:101,'atsp1':'$username$','atsp2':'$email$','atsp3':'$phone$'});
    }
    if (agtCheckString('http://m.23mofang.com/register/success',agtTopUrl)) {
        agt_101();
    }



} catch (err) {
    console.log('err:' + err);
}
