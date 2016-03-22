# Last FM Test API

This is an exercise to test the REST API from [Last.fm](http://www.lastfm.com), searching for most popular
artist by country.

## Try it
Clone this repo at some place on your computer, then copy config/config.ini.example to config/config.ini and edit
 it with your credentials. If you are using Apache web server, add the following configuration to your vhost 
 configuration:
 
```
<VirtualHost *:80>
  ServerName lastfm.yourdomain
  DocumentRoot "/path-to/lastfm/html/"
  DirectoryIndex index.php
  <Directory "/path-to/lastfm/html/">
    AllowOverride All
    Require all granted # This is required for Mac OS X Yosemite.
  </Directory>
</VirtualHost>
```

And don't forget to add the following line to your /etc/hosts
```
127.0.0.1   lastfm.yourdomain
```

