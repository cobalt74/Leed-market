function cacheListFeed_toggle_div(maindiv) {
  var divmenubar = document.getElementById('menuBar');
  var Elem_article = document.querySelector('#main article');
  
  if(divmenubar.style.display=="none") {
    divmenubar.style.display = "block";
	if (Elem_article.style.position!="fixed") { Elem_article.style.width="67%"; }
    document.getElementById('cacheListFeed_divbut_return').parentNode.removeChild(document.getElementById('cacheListFeed_divbut_return'));
  } else {
    divmenubar.style.display = "none";
    Elem_article.style.width = "100%";
    Elem_article.innerHTML = '<div class="cacheListFeed_divbut" id="cacheListFeed_divbut_return" title="Afficher la liste des Feeds" onclick="cacheListFeed_toggle_div(this,\'menuBar\');"><</div>'+Elem_article.innerHTML;    
  }
}