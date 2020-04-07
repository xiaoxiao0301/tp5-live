# shellcheck disable=SC1113
# /usr/bin/sh

# swoole 服务器平滑重启
echo "loading"
# shellcheck disable=SC2006
pid=`pidof live_master`
kill -USR1 $pid
echo "loading success"