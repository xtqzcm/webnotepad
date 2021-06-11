# webnotepad

Inspired by two projects:
  * [Minimalist Web Notepad][1]
  * [Minimalist Web Notepad API][2]


Comparing to the original [Minimalist Web Notepad][1], the current version supports rest API (credit to [Minimalist Web Notepad API][2] ) and it changes some CSS settings.

Demo: [webnotepad][3]

## Install
Please refer to [Minimalist Web Notepad][1]

## API
Please refer to [Minimalist Web Notepad API][2]

## Remark
If you install it on baota panel with Nginx, please add the following to pseudo static.
    
    location / {
        rewrite ^/([a-zA-Z0-9_-]+)$ /index.php?note=$1;
    }



[1]: https://github.com/pereorga/minimalist-web-notepad
[2]: https://github.com/Xiaobin2333/Minimalist-Web-Notepad-API
[3]: https://github.com/xtqzcm/webnotepad
