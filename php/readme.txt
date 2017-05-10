Because elvis doesn't allow external mysql connections:

  1. Make your own file called "connect.php" in the php folder
  2. Put the connection info here (we'll make an AWS db and post
     the info here)
  3. In any .php file that you need a db connection in, add a line
     near the top to "include_once("connect.php")"
  4. The git repo will automatically ignore any file called
     "connect.php" and there is already a connect.php in elvis
     on my account to connect to the elvis database
