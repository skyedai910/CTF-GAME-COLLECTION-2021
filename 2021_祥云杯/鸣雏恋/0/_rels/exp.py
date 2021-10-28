#encoding:utf-8
import base64
white = open(r'./out/0.png', 'rb').read()
black = open(r'./out/1.png', 'rb').read()
#注意要填文件真实的地址
flag = ''
 
for i in range(129488):
    color = open(r'./out/%d.png'%i, 'rb').read()
    if(color == white):
        flag += '0'
    else:
        flag += '1'
#把二进制数转为字符串
ans = ''
length = len(flag)//8
for i in range(length):
    ans += chr(int(flag[i*8: (i+1)*8], 2))
 
print(ans)

file = open("1.txt",'w')
file.write(ans)
file.close()