#!/usr/bin/env python3

import os
import signal
import socketserver
import threading
import tempfile
import sys
import time


class threadedserver(socketserver.ThreadingMixIn, socketserver.TCPServer):
    pass

class incoming(socketserver.BaseRequestHandler):
    def setup(self):
        try:
            self.fd, self.filename = tempfile.mkstemp()
        except:
            self.request.send(b"something super bad happened\n")
            self.request.close()
            return


    def recvline(self):
        line = b""
        while True:
            read = self.request.recv(1)
            if not read or read == b"\n":
                break
            line += read
        line += b"\n"
        return line

    def handle(self):
        self.request.send(b"Run your python code with hottest jit tech!\n")
        self.request.send(b"You can prepare your code with \"END\" at the last line.\n")
        self.request.send(b"And send to me with: \"cat test.py - | nc 127.0.0.1 8888\" \n")

        try:
            data = b""
            while len(data) < 0x10000:
                line = self.recvline()
                if b"END" in line:
                    self.request.send(b"recv END.\n")
                    break
                data += line
            os.write(self.fd, data)
            os.close(self.fd)
        except Exception as e:
            import traceback; traceback.print_exc()
            self.request.send(b"something super bad happened\n")
            self.request.close()
            return

        pid = os.fork()
        if (pid < 0):
            self.request.send(b"something super bad happened\n")
            self.request.close()
            return

        if pid:
            self.request.close()
            return

        # reparent to init
        if os.fork():
            os._exit(0)

        os.setsid()
        signal.alarm(30)
        print("running %s" % self.filename.encode())
        os.dup2(self.request.fileno(), 0)
        os.dup2(self.request.fileno(), 1)
        os.dup2(self.request.fileno(), 2)
        os.execl("./bin/python3.8", "python3.8","./pypy.py", "--exec", self.filename)
        self.request.send("something real bad happened\n")
        self.request.close()

    def finish(self):
        time.sleep(1)
        print(b"remove %s" % self.filename.encode())
        os.remove(self.filename)


if __name__ == "__main__":
    os.chroot("/home/ctf")
    socketserver.TCPServer.allow_reuse_addr = True
    server = threadedserver(('0.0.0.0', 8888), incoming)
    server.timeout = 60 
    server_thread = threading.Thread(target=server.serve_forever)
    server_thread.daemon = False
    server_thread.start()
