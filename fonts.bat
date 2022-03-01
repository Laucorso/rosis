cd /projects/webfonts-loader-master/test
copy c:\wamp\www\new.rosistirem.com\resources\fonticons\* fonticons
call npm test
copy dist\fonticons.css c:\wamp\www\new.rosistirem.com\resources\css
copy dist\fonticons.woff2 \wamp\www\new.rosistirem.com\resources\fonts
cd /wamp/www/new.rosistirem.com
