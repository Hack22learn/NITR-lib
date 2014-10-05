# Used to Insert data in aurther table from jurnals
# All Auther belong to NITR are inserted into table

import MySQLdb
host='localhost'
username='root'
password='Wrong-Pass'
database='project2'
try:
    db = MySQLdb.connect(host,username,password,database)
except:
    print 'Unable to connect to database check your Username ,password, databasename or hostname'

cursor = db.cursor()
cursor.execute("select distinct authors,id,authorswithaffiliations from journals")
results = cursor.fetchall()
d=dict()

for tup in results:
    At=tup[0].split(', ')
    aff=tup[2].split(';')
    if len(At) !=len(aff):
        print 'Diff'
    for i in range(len(At)):
        if At[i] in d:
            d[At[i]]=d[At[i]]+'|'+str(tup[1])
        else:
            x=aff[i].find('Rourkela')
            if x!=-1:
                d[At[i]]=str(tup[1])
                
            
                
	


for key in d:
    sql="insert into authors (name,jids,countids) values('%s','%s','%d')" %(key,d[key],d[key].count('|')+1)
    cursor.execute(sql)
    try:
        db.commit()
    except:
        print "error aaya re"
        db.rollback()

db.close()

