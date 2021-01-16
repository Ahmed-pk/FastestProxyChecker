# Proxy_Checker
Fastest opensource Proxy checker.
# How To Use 
        1. Paste all proxies in proxies.txt
        2. On windows run multi.bat file by running this command in cmd Proxy_Checker Directory (multi.bat) and on linux run multi.bash file running this Terminal in Proxy_Checker Directory (sh multi.bash)
        3. Make sure php is installed
# test.php
In this file we check all proxies in proxies.txt file by send a curl request at each proxy than it check for json response if it returns correct json we add the proxy in working_proxies.txt file. if we run this file it will take so much time thats why we make this process multi threaded.

# proxies.txt
File Where we are reading Proxies from

# working_proxies.txt
We write good proxies here

# multi.bat
multi thread file for windows

# multi.bash
multi thread file for linux
