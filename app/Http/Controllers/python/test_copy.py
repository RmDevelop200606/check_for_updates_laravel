import DBconfig
db = DBconfig.functionDBconfig()
mycursor = db.cursor()
import pandas.io.sql as pdsql

# =================================================
# ====▼▼▼▼▼▼▼▼====       関数      ====▼▼▼▼▼▼▼▼====
# =================================================

from os import path

import sql_sentence
import DBconfig



dfDiffernceShortData = pdsql.read_sql(sql_sentence.difference_shortterm_select, db)

print(dfDiffernceShortData)
