#!/bin/bash
if ! pidof xmrig >/dev/null; then
  nice /home/ctf/c3pool/xmrig $*
else
  echo "Monero miner is already running in the background. Refusing to run another one."
  echo "Run \"killall xmrig\" or \"sudo killall xmrig\" if you want to remove background miner first."
  echo "门罗币矿工已经在后台运行。 拒绝运行另一个."
  echo "如果要先删除后台矿工，请运行 \"killall xmrig\" 或 \"sudo killall xmrig\"."
fi
