<div id="bitcoin_newsfeed">
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
var theUrl = baseUrl+'serve/v1/coin/feed?fsym=BTC&tsym=USD&feedType=CoinTelegraph';
s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
// embedder.parentNode.appendChild(s);
document.getElementById("bitcoin_newsfeed").appendChild(s);
})();
</script>
