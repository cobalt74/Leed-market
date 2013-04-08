/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$.fx.speeds._default = 1;
$.fx.speeds.normal = 1;
var oldReadThis = readThis;

readThis = function(a, b, c, d) {

    /**
     * Pour la page générale seulement
     */
    if ($('#pageTop').html() == '') {

        var section = $(a).closest('section');

        /**
         * On met à jour le chiffre de "non-lus" dans la barre du haut
         * Le chiffre est entre parenthèses
         */
        var t = $('.articleSection').text();
        var nb = t.match(/\(([^)]+)\)/);
        if (nb) {
            nb = nb[1] - 1;
            $('.articleSection').text(t.replace(/\(.*?\)/, '(' + nb + ')'));
        }


        /**
         * On met à jour le nombre de non lus dans le flux en question
         */
        var feed_id = ($(section).find('.fleexed_feed').eq(0).data('feed'));
        var feed_a = $('#menuBar ul a[href$="feed=' + feed_id + '"]').next().find('span');
        nb = parseInt($(feed_a).text()) - 1;
        var feed_folder = ($(feed_a).closest('ul').prev('h1').find('.unreadForFolder'));
        if (nb > 0) {
            $(feed_a).text(nb);
        } else {
            $(feed_a).parent().remove();
        }

        /**
         * Puis dans le dossier
         */

        t = feed_folder.text().split(' ');
        t[0] = t[0] - 1;
        if (t[0] > 0) {
            $(feed_folder).html(t.join(' '));
        } else {
            $(feed_folder).remove();
        }


        //section.height(0);

        /**
         * Et on execute la fonction readThis normale 
         */
        oldReadThis(a, b, c, function() {           
 
            /**
             * Callback par défaut
             */
            if (typeof d == 'function') {
                d();
            } else {
                targetThisEvent($('.eventSelected').next(), true);
            }
            /**
             * On supprime complètement l'élément qui vient de disparaitre
             */
            section.removeClass('eventSelected');

            /**
             * Si en bas de page on réactualise pour avoir de nouveaux éléments
             */
            if ($('article section:visible').length == 0) {
                window.location.reload();
            }
        });

    } else {
        /**
         * Fonctionnement par défaut
         */
        oldReadThis(a, b, c, d);
    }
}


/**
 * Ajout de l'annulation du dernier élément marqué comme lu
 * (il reste marqué comme "lu" mais réapparait, c'est déjà bien)
 */
$(document).keydown(function(e) {
    /**
     * U = undo
     */
    if (e.keyCode == 85) {
        var hiddens = ($('article section:hidden'));
        if (hiddens.length > 0) {
            var lastSection = hiddens[hiddens.length - 1];
            $(lastSection).slideDown('fast');
            targetThisEvent(lastSection);
        }
    }

});