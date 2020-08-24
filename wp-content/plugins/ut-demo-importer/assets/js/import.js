jQuery('[data-ut-demo-importer]').each(function() {
    var $this = jQuery(this),
    item = $this,
    tag = $this.find('.utdi-tag'),
    wait_message = $this.find('.wait-message'),
    view_site = $this.find('.btn-view-site'),
    title = $this.find('.fs-title'),
    demo_done = $this.find('.demo-done'),
    loadball = $this.find('.LoaderBalls'),
    content = $this.find('.demo-response .demo-response-content'),
    importbtn = $this.find('.import');
    view_site.hide();
    loadball.hide();
    demo_done.hide();
    $this.find('[data-import]').click(function(e) {
        e.preventDefault();
        var confrm = confirm('Please make sure you take backup of everything. Your default contents may be overwritten/lost. So it is strongly suggested to run importer on fresh installation of WordPress and make sure that all the plugins are installed and active before proceeding further.');
        if (confrm == true) {
            var $this = jQuery(this),
            demo = $this.data('import'),
            nonce = $this.data('nonce'),
            data = {
                action: 'ut_demo_importer',
                nonce: nonce,
                id: demo,
            };
            importbtn.html("Importing...");
            wait_message.show();
            loadball.show();
            jQuery.post(ajaxurl, data, function(response) {
                content.addClass('active');
                content.html(response);
                view_site.show();
                demo_done.show();
                loadball.hide();
                title.html("DEMO IMPORTED");
                wait_message.hide();
                item.addClass('imported');
                importbtn.html("Imported");
                tag.html("Imported");
                $this.html('Re-Import');
            }
            );
        }
    });
    jQuery('.dismiss').click(function() {
        content.removeClass('active');
    });
});