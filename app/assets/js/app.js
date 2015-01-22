$(function() {
    // tooltip
    $("[data-toggle=tooltip], .Tooltip").tooltip();

    // popover
    $("[data-toggle=popover]").popover();
    $(document).on('click', '.popover-title .close', function (e) {
        var $target = $(e.target),
            $popover = $target.closest('.popover').prev();
        $popover && $popover.popover('hide');
    });

    // ajax modal
    $(document).on('click', '[data-toggle="ajaxModal"]', function (e) {
        e.preventDefault();
        $('#ajaxModal').remove();

        var $this = $(this),
            $remote = $this.data('remote') || $this.attr('href'),
            options = $this.data('options') || {},
            $modal = $('<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel" aria-hidden="true"><div id="ajaxModalContent"></div></div>');

        $this.blur();
        $('body').append($modal);
        $modal.modal(options);
        $('#ajaxModalContent').load($remote);
    });

    // ajax delete
    $(document).on('click', '.ajaxRemove', function(e) {
        e.preventDefault();

        var $this = $(this),
            url = $this.attr('href') || false,
            method = $this.data('method') || 'POST',
            message = $this.data('message') || 'Are you sure?',
            params = $this.data('params') || {},
            remove = $this.data('remove') || false;

        if (url) {
            bootbox.confirm(message, function(result) {                
                if (result) {
                    $.ajax({
                        url: url,
                        type: method,
                        data: params,
                        dataType: 'json',
                        success: function(res) {
                            if (res.redirect) {
                                window.location = res.redirect;
                                return;
                            }

                            if (res.success) {
                                $(remove).empty().remove();
                            }
                        }
                    });
                }
            }); 
        }
    });
});