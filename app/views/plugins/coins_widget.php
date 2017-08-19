<style >
div.ccc-coin-container {
    margin-right: 25px !important;
    background-color: #fff;
}
div.currencyMenuContainer {
    display: none;
}
div.ccc-widget {
    float: none !important;
}
</style>

<div style="padding:10px;margin-bottom:10px;padding-bottom:0px;border-bottom: 1px solid #f5eeee;">
    <h3 style="margin-bottom:0px;margin-top:0px;padding-top:0px;" class="tr-sec-title">
        <span class="glyphicon glyphicon-bitcoin" style="font-size:14px;"></span>
        markets
    </h3>
    <p style="color: #666;font-size:11px;">
        <strong>
        bitcoin, ethereum, dash
        </strong>
    </p>
</div>

<div id="coins_widget" style="padding:30px;padding-top:2px;display:table;">
</div>

<script type="text/javascript">
baseUrl = "https://widgets.cryptocompare.com/";
var scripts = document.getElementsByTagName("script");
var embedder = scripts[ scripts.length - 1 ];
(function (){
var appName = encodeURIComponent(window.location.hostname);
if(appName==""){appName="local";}
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
var theUrl = baseUrl+'serve/v2/coin/header?fsyms=BCH,LTC,DASH,XMR,BTC,ETH,DASH&tsyms=USD,EUR,CNY,GBP';
s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
// embedder.parentNode.appendChild(s);
document.getElementById("coins_widget").appendChild(s);
})();
</script>
