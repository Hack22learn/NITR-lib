import MySQLdb
#read deptCode-department and create dictionary
ls=['PH-Physics','BM-Biotechnology and Medical Engineering','MA-Mathematics','CY-Chemistry','EE-Electrical Engineering','ME-Mechanical Engineering','CR-Ceramic Engineering','MM-Metallurgical and Materials Engineering','FP-Food Process Engineering','LS-Life Science','CE-Civil Engineering','ER-Environment','CH-Chemical Engineering','MN-Mining Engineering','CS-Computer Science and Engineering','HS-Humanities and Social Sciences','EC-Electronics and Communication Engineering','ID-Industrial Design','NITR-others']
ls.append('SM-School of Management')
ls.append('ECE-Electronics & Communication Engineering')
dic=dict()
for el in ls:
    gl=el.split('-')
    dic[gl[0]]=[]
    dic[gl[0]].append(gl[1])
    dic[gl[0]].append('')
#for key in dic:
 #   print key,' -> ',dic[key]

host='localhost'
username='root'
password='Wrong-Pass'
database='project2'
try:
    db = MySQLdb.connect(host,username,password,database)
except:
    print 'Unable to connect to database check your Username ,password, databasename or hostname'
cursor = db.cursor()
sql='select department,id from journals;'
cursor.execute(sql)
result=cursor.fetchall()
for each in result:
    tc=each[0].split(', ')
    for key in tc:
        try:
            if dic[key][1] != '':
                dic[key][1]=dic[key][1]+'|'+str(each[1])
            else:
                dic[key][1]=str(each[1])
        except:
            print key
        
for key in dic:
        sql="insert into dept (code,name,jids,countids) values('%s','%s','%s','%d')" %(key,dic[key][0],dic[key][1],dic[key][1].count('|')+1)
        cursor.execute(sql)
        try:
            db.commit()
        except:
              print "error aaya re"
              db.rollback()
db.close()

