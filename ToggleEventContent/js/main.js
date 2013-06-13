/*
@name ToggleEventContent
@author Forty-Six <Forty-Six>
@link https://github.com/Forty-Six
@licence CC by nc sa http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
@version 0.3
@description Ce plugin ajoute un bouton à coté du titre de chaque événement pour en afficher ou non le contenu
*/

function FS_toggleEventContent(eventId) {

    // Affiche / Cache le contenu de l'événement désigné
    // Affiche / Cache les détails de l'événement entier désigné
    
	targetEvent = $('#event_' + eventId);
    optionsEvent = $('#eventOptions_' + eventId);
	eventButton = $('#FS_toggleEventContent_Button_' + eventId);
	
	if (targetEvent.css('display') == 'none') {
		open = 1;
		if (optionsEvent) optionsEvent.css('display', '');
	} else {
		open = 0;
		if (optionsEvent) optionsEvent.css('display', 'none');
	}
	
	targetEvent.slideToggle(200);
	eventButton.html((!open?'Toggle on':'Toggle off'));
}

