
var DirectoryIndex = new(function() {
    "use strict";

    // private vars
    var _self = this;

    // $DOM
    var $body;
    var $directory;
    var $document;
    var $sidebar;
    var $window;

    var _tabs = {};


    // Private Methods ________________________________________________

    function _setup() {
        $body      = $(document.body);
        $directory = $('table');
        $document  = $(document);
        $sidebar   = $('.search.tab-content');
        $window    = $(window);

        _tabs.directory = $directory;
        _tabs.search    = $("#tab-search");
        _tabs.code      = $("#tab-code");

        // listen to editor clicks
        $body.on    ('click', 'a.code-editor', _onClickCodeEditorLink);
        $document.on('keydown', _onKeyDown);
    };

    function _convertLastModifiedDate() {
        $directory.find('.last_modified').each(function() {
            var val = $(this).text();

            $(this).text(moment(val).fromNow());
        });
    };

    function _setDirectoryTableClasses() {
        $directory.addClass('directory tab-content');
        $directory.attr('id', 'tab-directory');

        // remove the header directory
        $directory.find('tr').eq(0).remove();

        $('table tr').each(function(i, obj) {
            var td = $(this).children('td');;

            $(this).addClass('row');

            td.eq(0).addClass('icon');
            td.eq(1).addClass('title');
            td.eq(2).addClass('last_modified');
            td.eq(3).addClass('filesize');
        });

        // adjust home
        if ($('table tr .title').eq(0).text() == 'Parent Directory') {
            $('table tr .icon').eq(0)
                .append(
                    $(document.createElement('a'))
                        .attr('href', '/')
                        .html('<span class="icon-home"></span>')
                )
                .find('img').remove();
        }
    };

    function _setupSearchForm() {
        $('.frmSearch').on('submit', function(e) {
            // stop submit
            e.preventDefault();

            var action, method, query;

            action = $(this).attr('action');
            method = $(this).attr('method') || 'getJSON';
            query  = $(this).find('input[name=txtQuery]').val();

            $[method](action, { txtQuery: query }, _onSearchComplete);
        });
    };

    function _setupTabs() {
        $body.find('a[data-tab]').on('click', _onClickTab);
    };

    function _updateDirectoryListings() {
        $directory.find('.title').each(function() {
            var $a, $el, href, title;

            $el   = $(this);
            href  = $el.find('a').attr('href');
            title = $el.text();

            if (title.match(/\.(css|diff|go|html|less|java|js|json|md|php|phps|pyc|py|rb|scss|sql|xml)/ig)) {
                $(document.createElement('a'))
                    .attr({
                        "class": "code-editor icon-newspaper",
                        "href": href
                    })
                    .appendTo($el);
            }
        });
    };


    // Event Handlers _________________________________________________

    function _onClickCodeEditorLink(e) {
        var $el, $iframe, href;

        $el  = $(this);
        href = this.href;

        // set tab data
        $(document.createElement('iframe'))
            .attr({
                "src": "/.index/api/editor/index.php?file=" + href
            })
            .appendTo(_tabs.code);

        // open tab
        $('.tabs .code').click();

        return false;
    };

    function _onClickTab(e) {
        var $el, tab;

        $el = $(this);
        tab = $el.data('tab');

        // content
        $body.removeClass('tab-search tab-code tab-directory');
        $body.addClass('tab-' + tab);

        return false;
    };

    function _onSearchComplete(data) {
        var $el;

        $el  = $sidebar.find('.search-results');
        data = $.parseJSON(data);

        // reset listings
        $el.html('');

        if (!data.length) {
            $(document.createElement('li'))
                .html("No results found.")
                .appendTo($el);
        }
        else {
            data.forEach(function(item) {
                if (!item)
                    return;

                item = item.replace(/\.\.\//ig, "");

                $(document.createElement('li'))
                    .append(
                        $(document.createElement('a'))
                            .attr({
                                "class": "code-editor",
                                "href": item
                            })
                            .html(item)
                        )
                    .appendTo($el);
            });
        }
    };

    function _onLoad() {
        _setup();

        _setDirectoryTableClasses();
        _convertLastModifiedDate();
        _updateDirectoryListings();

        _setupSearchForm();
        _setupTabs();
    };

    function _onKeyDown(e) {
        var code = String.fromCharCode(e.which);
            code = code.replace(/[^a-z0-9\_\*]+/i, '');

        if (!$body.hasClass('tab-search') && code.length) {
            $('.tabs .search').click();
            $('input[name=txtQuery]').focus();
        }
    };


    // On Load
    $(document).ready(_onLoad);

    return this;
})();

