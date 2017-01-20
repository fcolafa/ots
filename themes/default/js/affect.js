
function acord(){
$('dl dd').hide();
$('dl dt').click(function () {
    if ($(this).hasClass('activo')) {
        $(this).removeClass('activo');
        $(this).next().slideUp();
    } else {
     
        $('dl dt').removeClass('activo');
        $(this).addClass('activo');
        $('dl dd').slideUp();
        $(this).next().slideDown();
    }
 
});
}
function toolt_tip(){
        $('a[.tool_tip][rel]').each(function()
                        {
                                $(this).qtip(
                                {
                                        content: {

                                                text: '<img class="throbber" src="/projects/qtip/images/throbber.gif" alt="Loading..." />',
                                                ajax: {
                                                        url: $(this).attr('rel') // Use the rel attribute of each element for the url to load
                                                },
                                                title: {
                                                        text: 'Ticket - ' + $(this).text(), // Give the tooltip a title using each elements text
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
                                                event: 'click',// you can change the hover or so many more...
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


