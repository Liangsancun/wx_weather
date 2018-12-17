#coding=utf-8
import requests
import time#计时
import pymysql#数据库

'''
连接数据库
返回cursor,conn
'''
def connect_db():
	conn=pymysql.connect(host='127.0.0.1', 
	#远程ip地址host=，传到云端时修改为localhost=
		port=3306, #数据库的端口号
		user='parcruz', #数据库用户名
		passwd='1176love755', #数据库用户密码
		db='parcruz', #数据库

		)
	cursor=conn.cursor(cursor=pymysql.cursors.DictCursor)
	return cursor,conn

'''
得到天气信息的Json内容
输入：citycode（字符串）
返回：json格式
'''
def get_info(citycode):
	url="http://t.weather.sojson.com/api/weather/city/"+citycode #直接返回json格式的天气预报
	result=requests.get(url).text #text按照猜的编码格式进行解码
	return result

'''
更新天气信息内容
'''
def update_info():
	#连接数据库
	cursor,conn=connect_db()
	#去数据库的中ins_county表中选中weather_code列
	cursor.execute('select weather_code from ins_county') #执行sql语句
	listcodes=cursor.fetchall()#接收全部的返回行 




	#更新数据库的weather_info
	for citycode in listcodes:#citycode={"weather_code":'101010100'}
		time.sleep(0.3) # 设置时间间隔为 0.3 秒,因为这个接口阈值为每分钟 300 次，也就是每
	
#0.2 秒一次，这里保险点用 0.3 秒
		info=get_info(citycode['weather_code'])

		sql="update ins_county set weather_info='%s' where weather_code=%s"%(info, citycode['weather_code'])
		try:#执行SQL语句
			cursor.execute(sql)
			#提交到数据库执行
			conn.commit() #把得到的数据提交到数据库
			print("{}写入成功".format(citycode['weather_code']))#%s如同{}.format()
			print("\n")
		except:
			#发生错误时回滚
			conn.rollback()
	
	conn.close()#关闭数据库连接


if __name__=='__main__': #如果该文件不是被别的文件当做导入包导入的话
	update_info()
			
		

