archive压缩包包含靶机运行的python3.8解释器，解释器本身不存在漏洞。
选手可以在利用代码最后一行加上`END`字符串，然后通过`cat test.py - | nc ip port`发送exp。