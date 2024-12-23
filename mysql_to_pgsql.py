import pandas as pd
from sqlalchemy import create_engine

# Konfigurasi Database
DB_SOURCE = 'postgresql://postgres:root@localhost/hctm_surgery_2'
DB_DESTINATION = 'postgresql://postgres:root@localhost/hctm_surgery'

EXPORT_FILE = 'exported_data.csv'
SOURCE_TABLE = 'procedurename'
DESTINATION_TABLE = 'procedure_name'

# 1. Export Data dari Database Asal


def export_to_csv():
    engine = create_engine(DB_SOURCE)
    query = f"SELECT * FROM {SOURCE_TABLE}"
    df = pd.read_sql(query, engine)

    # Transformasi Data
    # df.drop(columns=['color'], inplace=True)

    # Simpan ke CSV
    df.to_csv(EXPORT_FILE, index=False)
    print(
        f"Data dari tabel '{SOURCE_TABLE}' berhasil diekspor ke '{EXPORT_FILE}'.")

# 2. Import Data ke Database Tujuan


def import_from_csv():
    engine = create_engine(DB_DESTINATION)

    # Baca CSV
    df = pd.read_csv(EXPORT_FILE)

    # Import ke Database
    df.to_sql(DESTINATION_TABLE, engine, if_exists='append', index=False)
    print(
        f"Data berhasil diimpor ke tabel '{DESTINATION_TABLE}' di database tujuan.")


# Eksekusi
if __name__ == "__main__":
    export_to_csv()
    import_from_csv()
