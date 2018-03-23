import MySQLdb

class DB(object):
    def __init__(self):
        self._instance=None
        self._error=False
        self._count=0
        try:
            self.conn =MySQLdb.connect(host="localhost",
                                       user="root",
                                       passwd="Pralay@1999",
                                       db="test")
        except:
            print("Failed to connect to MySQLdb")