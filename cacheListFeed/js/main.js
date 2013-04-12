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
	returnButton = document.createElement('div');
	returnButton.setAttribute("class", "cacheListFeed_divbut");
	returnButton.setAttribute("id", "cacheListFeed_divbut_return");
	returnButton.setAttribute("title", "Afficher la liste des Feeds");
	returnButton.setAttribute("onclick", "cacheListFeed_toggle_div(this,'menuBar');");
	returnButton.innerHTML = "<";
	// Insère l'élément sans altérer les événements existants.
	Elem_article.insertBefore(returnButton, Elem_article.firstChild);
  }
}