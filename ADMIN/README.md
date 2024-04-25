ADMIN folder:

You will notice that along with a hosting account, you have a folder created with the course number. In this folder is an ADMIN folder which has two files 

**code-viewer.php
table-viewer.php**


The purpose of these files is to provide myself and the TA's for the course, access to view your files. Otherwise we have no way to see your php code and table struture which makes it very hard for us to grade and help you. It only allows us access to what is in the course folder. We cannot access anything above the course folder. Both files only allow us to see your files and data we cannot edit or delete anything. This folder is required for us to be able to grade your work so do not delete it.  If you have any questions be sure to ask.

**code-viewer.php** allows us to see the actual contents of your files (php code gets executed ont he server but this file allows us to see your php code).
**table-viewer.php** acts like a simple version of phpmyadmin with reader only permission. 

This file is also a handy way for you to see what you have on the server. The url for you would be:

http://**yournetid**__.w3.uvm.edu/**course**__/ADMIN/code-viewer.php


In addition you will need to create a file named **credentials.php** with your **database reader password** which you will get when you create your database. After you recieve your final grade you can remove our access to your database by deleting the password.
