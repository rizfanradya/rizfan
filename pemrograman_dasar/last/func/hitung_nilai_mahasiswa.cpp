#include <iostream>
#include <iomanip>

using namespace std;

void hitung_nilai_mahasiswa()
{
  cout << "===================================" << endl;
  cout << "HITUNG NILAI MAHASISWA" << endl;
  cout << "===================================" << endl;

  float nilaiUTS, nilaiUAS, nilaiTugas, nilaiPresensi, nilaiEtika, nilaiAkhir;

  cout << "Masukkan nilai UTS: ";
  cin >> nilaiUTS;
  cout << "Masukkan nilai UAS: ";
  cin >> nilaiUAS;
  cout << "Masukkan nilai Tugas: ";
  cin >> nilaiTugas;
  cout << "Masukkan nilai Presensi: ";
  cin >> nilaiPresensi;

  nilaiEtika = (nilaiTugas + nilaiPresensi) / 2;

  nilaiAkhir = (0.2 * nilaiUTS) + (0.2 * nilaiUAS) + (0.2 * nilaiTugas) + (0.2 * nilaiEtika) + (0.2 * nilaiPresensi);

  cout << fixed << setprecision(2);
  cout << "Nilai ETIKA: " << nilaiEtika << endl;
  cout << "Nilai Akhir: " << nilaiAkhir << endl;

  if (nilaiAkhir >= 60)
  {
    cout << "Selamat, Anda Lulus!" << endl;
  }
  else
  {
    cout << "Maaf, Anda Tidak Lulus." << endl;
  }
}