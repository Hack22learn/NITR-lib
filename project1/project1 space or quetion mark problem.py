# Remove all '?' and '/' from subject table
# Remove quetion mark accured due to excess space in excel at begining and at end
import MySQLdb

host='localhost'
username='root'
password='Wrong-Pass'
database='project1'
try:
    db = MySQLdb.connect(host,username,password,database)
except:
    print 'Unable to connect to database check your Username ,password, databasename or hostname'
cursor=db.cursor()
sql='SELECT id,subject FROM `libcat`; '
cursor.execute(sql)
results = cursor.fetchall()

for tup in results:
    sub=tup[1]
    # Use these lines for space problem
    #sub=tup[1].split(' ')
    #sub=[value for value in sub if value != ''] #remove all spaces
    #sub=' '.join(sub)
    
    if sub=='':
        sub='UNCATEGORIZED'
    else:
        # These code use to replace ? and / 
        sub=sub.replace('?','')
        sub=sub.replace('/','')
    
    sql="UPDATE  `libcat` SET subject = '%s' "%(sub) +"WHERE id = '%d';" % (tup[0])
    if sub !=tup[1]:
        try:
            #updating database
            cursor.execute(sql)
            db.commit()
        except:
            #rollback
            print 'error',tup[0],tup[1]
            db.rollback()
print 'Thank U'

