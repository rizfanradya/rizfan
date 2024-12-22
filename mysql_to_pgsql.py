import pandas as pd
from sqlalchemy import create_engine, inspect

# 1. Koneksi ke MySQL dan PostgreSQL
mysql_engine = create_engine(
    "mysql+pymysql://root:root@localhost/hctm_surgery")
pg_engine = create_engine(
    "postgresql://postgres:root@localhost/hctm_surgery")

# 2. Ambil Daftar Semua Tabel dari MySQL
inspector = inspect(mysql_engine)
tables = inspector.get_table_names()

# 3. Ekspor dan Impor Data
for table in tables:
    print(f"Processing table: {table}")

    # Ekspor dari MySQL
    df = pd.read_sql(f"SELECT * FROM {table}", con=mysql_engine)

    # Impor ke PostgreSQL (Buat tabel jika belum ada)
    df.to_sql(table, con=pg_engine, if_exists='replace', index=False)

    print(f"Table {table} imported successfully.")
