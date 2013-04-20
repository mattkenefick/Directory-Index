Directory-Index
===============

This is a quick starter of how you can stylize your directory index
and make it more useful.


FEATURES _____________________________________

This adds a Search Box against filenames in your localhost. You
can start typing anywhere on the page and it'll open up the
dialog. Clicking one of the results will open the code view.

The third icon down is a code viewer. It uses CodeMirror to highlight
many types of files.

Check the screenshots folder to see how it looks.


INSTALL _______________________________________

Put both the .htaccess and the .index folder in the root of your
localhost. Make sure the .index folder can be accessed via your
httpd.conf.


REQUIREMENTS___________________________________

 - PHP + file_get_contents.

These aren't realistically necessary, but I haven't converted it
yet. So... for now they're required. I'll update it soon to make
these less necessary.