/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function toolt_tip(){
    $('a[.tool_tip][rel]').each(function() {
        $(this).qtip({
            content:{
                text: '<img class="throbber" src="/projects/qtip/images/throbber.gif" alt="Loading..." />',
                ajax: {
                    // Use the rel attribute of each element for the url to load
                    url: $(this).attr('rel')
                },
                title: {
                    // Give the tooltip a title using each elements text
                    text: 'Ticket - ' + $(this).text(), 
                    button: true
                }
            },
            position: {
                at: 'bottom center', 
                my: 'top center',
                viewport: $(window), 
                effect: false 
            },
            show: {
                event: 'click',
                solo: true 
            },
            hide: 'unfocus',
            style: {
                classes: 'qtip-wiki qtip-light qtip-shadow'
            }
        })
    })
    .click(function(event) { event.preventDefault(); });
}


