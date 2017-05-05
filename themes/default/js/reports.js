function range() {
    var droplist = $('#Reports_range');
    var droptype = $('#Reports_type');
    var dropcc = $('#Reports_costc');
    var dropcon = $('#Reports_contractor');
    if (droptype.val() != '1')
        $('#contractor').hide();
    if (dropcc.val() != '2')
        $('#cc').hide();
    if (droplist.val() != '2')
        $('#range').hide();

    droplist.change(function (e) {
        if (droplist.val() == '2') {
            $('#range').show();
        } else {
            $('#range').hide();
        }

    });
    droptype.change(function (e) {
        if (droptype.val() == '1') {
            $('#contractor').show();
        } else {
            $('#contractor').hide();
        }
        if (droptype.val() == '2') {
            $('#cc').show();
        } else {
            $('#cc').hide();
        }
    });
    dropcc.change(function (e) {
        if (dropcc.val() == '0') {
                   $('#Reports_costc option').prop('selected', true);
        }
    });
    dropcon.change(function (e) {
        if (dropcon.val() == '0') {
                   $('#Reports_contractor option').prop('selected', true);
        }
    });
}